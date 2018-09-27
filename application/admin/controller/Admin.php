<?php
	namespace app\admin\controller;
	use think\Db;

	class Admin extends Base
	{
		/**
		 * 登录
		 * @return [type] [description]
		 */
		public function login()
		{
			if($this->request->isAjax())
			{
				$data = [      
					'user_name' =>input('post.userName/s'),
					'password'  =>input('post.pwd/s'),
					'captcha'   =>input('post.code')
		        ];
		        $results = $this->validate(
		        	$data,
		        	'\app\admin\validate\Admin.login'
		        );
		        if($results !== true){
		        	$json['code'] = 100;
		        	$json['msg'] = $results;
		        }else{
		        	$admin = Db::table("admin")->join(['admin_role'=>'r'],'r.id = admin.role_id')->where('user_name',$data['user_name'])->where('password',MD5($data['password']))->find();
		        	if($admin['admin_id']){
		        		//更新最新登录时间和ip
		        		$time = time();
		        		Db::table("admin")->where('admin_id',$admin['admin_id'])->update(['login_time'=>date('Y-m-d H:i:s',$time),'ip'=>$this->request->ip()]);
		        		session('user_name',$admin['user_name']);
		        		session('admin_id',$admin['admin_id']);
		        		session('right',$admin['right']);
		        		$json['code'] = 0;
						$json['msg'] = '验证成功';
						//登录日志
						admin_log('后台登录');
		        	}else{
		        		$json['code'] = 101;
						$json['msg'] = '用户名或者密码错误';
		        	}
		        }
				exit(json_encode($json));
			}
			return $this->fetch('login');
		}
		/**
		 * 登出
		 * @return [type] [description]
		 */
		public function logout()
		{
			session(null);
			$this->success('退出成功','admin/login');
		}
		/**
		 * 验证码
		 * @return [type] [description]
		 */
		public function vertify(){
			$configs = [
				//验证码字符集合
				'codeSet'  => '0123456789ACDEFGHJKLMNPQRSTUVWXY',
				// 验证码字体大小
				'fontSize' =>30,    
				// 验证码位数
				'length'   =>4,   
				// 关闭验证码杂点
				'useNoise' =>false,
				//验证码位数
				'length'   =>4,
	        ];
	        $captcha = new \think\captcha\Captcha($configs);
	        return $captcha->entry('login');
		}
		/**
		 * 直接修改显示和排序
		 * @return [type] [description]
		 */
		public function directChange()
		{
			if($this->request->isAjax()){
				$table = input('post.table/s');
				$value = input('post.value/d');
				$field = input('post.key/s');
				$id = input('post.id/d');
				if($table == 'category'){
					$results = Db::name($table)->where('cat_id',$id)->setField($field,$value);
				}else{
					$results = Db::name($table)->where('id',$id)->setField($field,$value);
				}
				$json['sql'] = Db::name($table)->getLastSql();
				if($results >= 0){
					$json['code'] = 0;
					$json['msg'] = '操作成功';
				}else{
					$json['code'] = 101;
					$json['msg'] = '操作失败';
				}
				exit(json_encode($json));
			}
		}
		/**
		 * 角色管理
		 * @return [type] [description]
		 */
		public function role()
		{
			$lists = Db::table('admin_role')->where('id','<>',1)->paginate();
			$this->assign("lists",$lists);
			return $this->fetch();
		}
		public function roleModify($id = 0)
		{
			if($id != 0){
				$model = Db::table('admin_role')->where('id',$id)->find();
				$this->assign('model',$model);
				$model['right'] = explode(',',$model['right']);
			}
			//获取所有权限
			$right = Db::name('system_right')->where('is_show',1)->where('type',1)->order('order_id asc')->select();
			if(is_array($right)){
				foreach ($right as $v){
					if(is_array($model['right'])){
						$v['checked'] = in_array($v['id'], $model['right']);
					}
					$rights[$v['group']][] = $v;
				} 
			}
			$this->assign('rights',$rights);
			//获取权限组
			$group = right_group();
			$this->assign("group",$group);
			return $this->fetch();
		}
		public function roleUpdate()
		{
			$data = input('post.');
			$message = $this->validate(
	        	$data,
	        	'\app\admin\validate\Admin.role'
	        );
	        if($message !== true){
	        	$this->error($message);
	        }
			$id = input('post.id/d');
			$data['right'] = implode(',',$data['right']);
			if($id){
				$model = Db::table('admin_role')->field('id')->where('id',$id)->find();
				if(!$model){
					$this->error('对不起暂无当前记录');
				}else{
					$results = Db::table('admin_role')->update($data);
					if($results >= 0){
						$this->success('修改成功');
					}else{
						$this->error('修改失败');
					}
				}
			}else{
				$results = Db::table('admin_role')->data($data)->insert();
				if($results){
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}
		}
		public function roleDelete($id)
		{
			if($id){
				$ids = explode(',',$id);
				$results = Db::table('admin_role')->where('id','<>',1)->whereIn('id',$ids)->delete();
				if($results){
					$this->success("成功删除{$results}条数据");
				}else{
					$this->error("删除失败");
				}
			}else{
				$this->error("删除失败");
			}
		}
		/**
		 * 管理员管理
		 * @return [type] [description]
		 */
		public function admin()
		{
			$lists = Db::table('admin')->field('admin.*,r.role_name')->join(['admin_role'=>'r'],'admin.role_id = r.id')->order('admin_id asc')->paginate();
			$this->assign("lists",$lists);
			return $this->fetch();
		}
		public function adminModify($id = 0)
		{
			if($id != 0){
				$model = Db::table('admin')->where('admin_id',$id)->find();
				if(!$model){
					$this->error('对不起暂无当前记录');
				}else{
					$this->assign('model',$model);
				}
			}
			$role = Db::table('admin_role')->field('id,role_name')->select();
			$this->assign('role',$role);
			return $this->fetch();
		}
		public function adminUpdate()
		{
			$data = input('post.');
			$message = $this->validate(
	        	$data,
	        	'\app\admin\validate\Admin.admin'
	        );
	        if($message !== true){
	        	$this->error($message);
	        }
			$id = input('post.admin_id/d');
			if($id){
				$model = Db::table('admin')->where('admin_id',$id)->find();
				if(!$model){
					$this->error('对不起，不存在当前记录');
				}else{
					if(isset($data['pwd']) && !empty($data['pwd'])){
						$data['password'] = md5($data['pwd']);
					}
					$results = Db::table('admin')->strict(false)->data($data)->where('admin_id',$id)->update();
					if($results >= 0){
						$this->success('修改成功');
					}else{
						$this->error('修改失败');
					}
				}
			}else{
				if(isset($data['pwd']) && !empty($data['pwd'])){
					$data['password'] = md5($data['pwd']);
				}else{
					$data['password'] = md5(123456);
				}
				$data['create_time'] = time();
				$results = Db::table('admin')->strict(false)->data($data)->insert();
				if($results){
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}
		}
		public function adminDelete($id)
		{
			if($id){
				$ids = explode(',',$id);
				$results = Db::table('admin')->whereIn('admin_id',$ids)->where('admin_id','<>',session('admin_id'))->delete();
				if($results){
					$this->success("成功删除{$results}条数据");
				}else{
					$this->error("删除失败");
				}
			}else{
				$this->error("删除失败");
			}
		}
		/**
		 * 管理员日志
		 * @return [type] [description]
		 */
		public function adminLog()
		{
			$lists = Db::table('admin_log')->field('admin_log.*,a.user_name')->join(['admin'=>'a'],'admin_log.admin_id = a.admin_id')->order('log_time desc')->paginate();
			$this->assign("lists",$lists);
			return $this->fetch();
		}
		/**
		 * 清除缓存
		 * @return [type] [description]
		 */
		public function cache()
		{
			//删除cache
			del_file(env('RUNTIME_PATH').'/cache',true);
			//删除temp
			del_file(env('RUNTIME_PATH').'/temp',true);
		}
	}