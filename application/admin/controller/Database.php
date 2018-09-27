<?php
	namespace app\admin\controller;
	use think\Db;
	use app\admin\util\BackupUtil as Backup;

	class Database extends Base
	{
		private $config;
		public function initialize()
		{
			$path = config('database.back_up_path');
			if(!is_dir($path)){
				mkdir($path, 0755, true);
			}
			$this->config = [
			    'path'     => realpath($path) . DIRECTORY_SEPARATOR,//数据库备份路径
			    'part'     => config('database.back_up_part'),//数据库备份卷大小
			    'compress' => config('database.back_up_compress'),//数据库备份文件是否启用压缩 0不压缩 1 压缩
			    'level'    => config('database.back_up_level') //数据库备份文件压缩级别 1普通 4 一般  9最高
			];
		}
		public function index()
		{
			$db = new Backup($this->config);
			$dbtables = $db->dataList();
	        $total = 0;
	        foreach ($dbtables as $k => $v) {
	            $dbtables[$k]['size'] = format_bytes($v['data_length'] + $v['index_length']);
	            $total += $v['data_length'] + $v['index_length'];
	        }
	        $this->assign('lists', $dbtables);
	        $this->assign('total', format_bytes($total));
	        $this->assign('tableNum', count($dbtables));
	        return $this->fetch();
		}
		/**
		 * 表优化
		 * @param  [type] $table [description]
		 * @return [type]        [description]
		 */
		public function optimize($table)
		{
			$db = new Backup($this->config);
			if($db->optimize($table)){
				$this->success("表优化成功{$table}",'Database/index');
			}else{
				$this->error("表优化失败{$table}",'Database/index');
			}
		}
		/**
		 * 表修复
		 * @param  [type] $table [description]
		 * @return [type]        [description]
		 */
		public function repair($table)
		{
			$db = new Backup($this->config);
			if($db->repair($table)){
				$this->success("表修复成功{$table}",'Database/index');
			}else{
				$this->error("表修复失败{$table}",'Database/index');
			}
		}
		/**
		 * 数据备份
		 * @return [type] [description]
		 */
		public function backUp($id = null,$start = null)
		{
			function_exists('set_time_limit') && set_time_limit(0);
			if($this->request->isPost()){
				$tables = input('post.checkbox/a');
				if(is_array($tables)){
					$lock = $this->config['path'] . 'backup.lock';
					if(is_file($lock)){
						exit(json_encode(['code'=>101,'info'=>'检测到有一个备份任务正在执行，请稍后再试！']));
					}else{
						file_put_contents($lock, time());
					}
					if(!is_writeable($this->config['path'])){
						exit(json_encode(['code'=>102,'info'=>'备份目录不存在或不可写，请检查后重试！']));
					}else{
						$file = [
							'name' =>date('Ymd-His',time()),
							'part' =>1
						];
						session('back_up_tables',$tables);
						session('back_up_file',$file);
						$tab = ['id'=>0,'start'=>0];
						exit(json_encode(['code'=>0,'table'=>$tables,'tab'=>$tab,'info'=>'准备成功']));
					}
				}else{
					$this->error('请选择需要备份的表','database/index');
				}
			}else if($this->request->isGet() && is_numeric($id) && is_numeric($start)){
				$tables = session('back_up_tables');
				$file = session('back_up_file');
				$db = new Backup($this->config);
				$start = $db->setTimeout(0)->setFile($file)->backup($tables[$id], $start);
				if($start === false){
					exit(json_encode(['code' => 103, 'info'=>'备份出错']));
				}else if($start === 0){
					if(isset($tables[++$id])){
						$tab = ['id'=>$id,'start'=>0];
						exit(json_encode(['tab' => $tab, 'info'=>'备份完成！', 'code'=>0]));
					}else{//备份完成清空缓存
						unlink($this->config['path'] . 'backup.lock');
						session('back_up_tables', null);
						session('back_up_file', null);
						exit(json_encode(['info'=>'备份完成！', 'code'=>0]));
					}
				}else{
					$tab  = ['id' => $id, 'start' => $start[0]];
					$rate = floor(100 * ($start[0] / $start[1]));
					exit(json_encode(['tab' => $tab, 'info'=>"正在备份...({$rate}%)", 'code'=>0]));
				}
			}else {//请求出错
				return json(array('info'=>'参数错误！', 'code'=>104));
			}
		}
		/**
		 * 数据还原
		 * @param  [type] $time  [description]
		 * @param  [type] $part  [description]
		 * @param  [type] $start [description]
		 * @return [type]        [description]
		 */
		public function restore($time = null,$part = null,$start = null)
		{	
			$db = new Backup($this->config);
			if(is_null($time) && is_null($part) && is_null($start)){
				$lists = $db->fileList();
				$this->assign('lists',$lists);
				return $this->fetch();
			}else if(is_numeric($time) && is_null($part) && is_null($start)){
				//$file = $db->getFile('timeverif',$time);
				$name = date('Ymd-His', $time) . '-*.sql*';
                $path = realpath($this->config['path']) . DIRECTORY_SEPARATOR . $name;
                $files = glob($path);
                $list = array();
                foreach ($files as $k=>$name) {
                    $basename = basename($name);
                    $match = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
                    $gz = preg_match('/^\\d{8,8}-\\d{6,6}-\\d+\\.sql.gz$/', $basename);
                    $list[$match[6]] = array($match[6], $name, $gz);
                }
                ksort($list);
                $last = end($list);
                if (count($list) === $last[0]) {
                   session('back_up_list',$list);
                   exit(json_encode(['code'=>0, 'info'=> "初始化完成！", 'tab'=>['part' => 1, 'start' => 0]]));
                } else {
                	exit(json_encode(['code'=>101, 'info'=> "备份文件可能已经损坏，请检查！"]));
                }
			}else if(is_null($time) && is_numeric($part) && is_numeric($start)){
				$list  = session('back_up_list');
				$start = $db->setTimeout(0)->setFile($list[$part])->import($start);
				if(false === $start){
					exit(json_encode(['code' => 102, 'info'=>'还原数据出错！']));
				} elseif(0 === $start) { //下一卷
					if(isset($list[++$part])){
						$data = ['part' => $part, 'start' => 0];
						exit(json_encode(['code' => 0, 'info'=>"正在还原...#{$part}", 'tab'=>$data]));
					} else {
						session('back_up_list', null);
						exit(json_encode(['code' => 0, 'info'=>"还原完成！"]));
					}
				} else {
					$data = ['part' => $part, 'start' => $start[0]];
					if($start[1]){
						$rate = floor(100 * ($start[0] / $start[1]));
						exit(json_encode(['code' => 0, 'info'=>"正在还原...#{$part} ({$rate}%)", 'tab'=>$data]));
					} else {
						$data['gz'] = 1;
						exit(json_encode(['code' => 0, 'info'=>"正在还原...#{$part}", 'tab'=>$data]));
					}
				}
			}else{
				return json(array('info'=>'参数错误！', 'code'=>103));
			}
		}
		/**
		 * 下载文件
		 * @param  [type] $time [description]
		 * @return [type]       [description]
		 */
		public function download($time)
		{
			$db = new Backup($this->config);
			$db->downloadFile($time);
		}
		/**
		 * 文件删除
		 * @param  [type] $time [description]
		 * @return [type]       [description]
		 */
		public function delete($time)
		{
			$db = new Backup($this->config);
			$results = $db->delFile($time);
			if($results){
				$this->success('备份文件删除成功','database/restore');
			}else{
				$this->error('删除失败','database/restore');
			}
		}
	}