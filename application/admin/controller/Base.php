<?php
	namespace app\admin\controller;
	use think\Controller;
	use think\Db;

	class Base extends Controller
	{
		public function __construct()
		{
			error_reporting(E_ALL ^ E_NOTICE);
			parent::__construct();
		}
		public function initialize(){
			//过滤不需要登陆的行为
	        if(in_array($this->request->action(),array('login','logout','vertify'))){
	        	return true;
	        }else{
	        	if(session('admin_id') > 0){
	        		$this->operateVerity();//权限验证
	        	}else{
	        		$this->error('请先登录','admin/login');
	        	}
	        }
		}
		/**
		 * 操作权限验证
		 * @return [type] [description]
		 */
		private function operateVerity()
		{
			$controller = $this->request->controller();
			$action = $this->request->action();
			//无需验证的操作
			$uneedCheck = array('login','logout','vertify');
	    	if($controller == 'Index' || session('right') == 0){//后台首页控制器无需验证,超级管理员无需验证
	    		return true;
	    	}elseif($this->request->isAjax() || in_array($action,$uneedCheck)){//所有ajax请求不需要验证权限,登录逻辑无需验证权限
	    		return true;
	    	}else{
	    		$allRights = Db::name("system_right")->whereIn('id',session('right'))->cache(!config('app_debug'))->column('right');
	    		$allRightsValue = '';
				if(is_array($allRights)){
					foreach ($allRights as $v){
						$allRightsValue .= ',' . $v;
					}
				}
	    		$roleRight = explode(',',$allRightsValue);
	    		//检查是否拥有此操作权限
	    		if(!in_array($controller.'@'.$action, $roleRight)){
	    			$this->error('您没有操作权限['.($controller.'@'.$action).'],请联系超级管理员分配权限','index/index');
	    		}
	    	}
		}
	}