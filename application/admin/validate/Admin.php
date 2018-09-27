<?php
	namespace app\admin\validate;
	use think\Validate;

	class Admin extends Validate
	{
		//验证规则
		protected $rule = [
			'user_name'        =>'require|checkEmpty',
			'password'         =>'require|checkEmpty',
			'captcha'          =>'require|captcha:login',
			'role_name'        =>'require|checkEmpty',
			'role_description' =>'require|checkEmpty',
			'right'            =>'require|checkEmpty',
			'role_id'          =>'require'
		];

		//错误提示
		protected $message = [
			'user_name'        =>'用户名不能为空',
			'password'         =>'密码不能为空',
			'captcha'          =>'验证码不正确',
			'role_name'        =>'角色名称不能为空',
			'role_description' =>'角色描述不能为空',
			'right'            =>'请选择对应角色的权限资源',
			'role_id'          =>'请选择所属角色'
		];

		//验证场景
		protected $scene = [
			'login' =>['user_name','password','captcha'],
			'role'  =>['role_name','role_description','right'],
			'admin' =>['user_name','role_id']
		];

		/**
		 * 自定义验证函数去除空格判断是否为空
		 * @param  [type] $value [description]
		 * @return [type]        [description]
		 */
		protected function checkEmpty($value)
	    {
	    	if(!isset($value)){
	    		return false;
	    	}
	        if (is_string($value)) {
	            $value = trim($value);
	        }
	        if (empty($value)) {
	            return false;
	        }
	        return true;
	    }
	    
	}