<?php
	namespace app\admin\controller;
	use think\Db;

	class System extends Base
	{
		/**
		 * 权限资源
		 * @return [type] [description]
		 */
		public function right()
		{
			$name = input('name/s');
			$groups = input('groups/s');
			if($name){
				$map[] = ['name','like',"%{$name}%"];
				$this->assign('name',$name);
			}
			if($groups){
				$map[] = ['group','=',$groups];
				$this->assign('groups',$groups);
			}
			$lists = Db::name('system_right')->where($map)->where("is_show",1)->order('order_id asc')->paginate();
			$this->assign("lists",$lists);
			//获取分组
			$group = right_group();
			$this->assign("group",$group);
			return $this->fetch();
		}
		public function rightModify($id = 0)
		{
			//获取分组
			$group = right_group();
			$this->assign("group",$group);
			//获取全部控制器
			$controllerPath = APP_PATH.'admin/controller';
	     	$controllerList = array();
	     	$dirRes   = opendir($controllerPath);
	     	while($dir = readdir($dirRes)){
	     		if(!in_array($dir,array('.','..'))){
	     			$controllerList[] = basename($dir,'.php');
	     		}
	     	}
	     	$this->assign('controllerList',$controllerList);
			if($id == 0){
				return $this->fetch();
			}else{
				$model = Db::name('system_right')->where('id',$id)->find();
				$model['right'] = explode(',',$model['right']);
				$this->assign('model',$model);
				return $this->fetch();
			}
		}
		public function ajaxMethod()
		{
			if($this->request->isAjax()){
				$controller = input('post.controller/s');
				if(!empty($controller)){
					$method = get_class_methods("app\\admin\\controller\\".str_replace('.php','',$controller));
			     	$baseMethod = get_class_methods('app\admin\controller\Base');
			     	$allMethod  = array_diff($method,$baseMethod);
			     	$html = '';
			     	foreach ($allMethod as $v){
			     		$val = strtolower($v);
			     		$html .= '<label onclick="add_item();">
                            <input type="checkbox" value="'.$val.'" />
                            <span style="float: left;margin-right: 15px;">'.$val.'</span>
                        </label>';
			     	}
			     	exit($html);
				}
			}
		}
		public function rightUpdate()
		{
			$data = input('post.');
			$data['right'] = isset($data['right']) ? implode(',',$data['right']) : '';
			$message = $this->validate(
	        	$data,
	        	'\app\admin\validate\System.rightUpdate'
	        );
	        if($message !== true){
	        	$this->error($message);
	        }else{
	        	$id = input('post.id/d');
				if($id){
					$model = Db::name('system_right')->field('id')->where('id',$id)->find();
					if(!$model){
						$this->error('对不起暂无当前记录');
					}else{
						$results = Db::name('system_right')->strict(false)->update($data);
						if($results >= 0){
							$this->success('修改成功');
						}else{
							$this->error('修改失败');
						}
					}
				}else{
					$results = Db::name('system_right')->strict(false)->data($data)->insert();
					if($results){
						$this->success('添加成功');
					}else{
						$this->error('添加失败');
					}
				}
	        }
		}
		public function rightDelete($id)
		{
			if($id){
				$results = Db::name('system_right')->whereIn("id",$id)->setField("is_show",0);
				if($results){
					$this->success("成功删除{$results}条数据");
				}else{
					$this->error("删除失败");
				}
			}else{
				$this->error("删除失败");
			}
		}
	}