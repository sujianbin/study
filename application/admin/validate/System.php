<?php
	namespace app\admin\validate;
	use think\Validate;

	class System extends Validate
	{
		//验证规则
		protected $rule = [
			'name'     =>'require|checkEmpty',
			'group'    =>'require|checkEmpty',
			'right'    =>'require',
			'order_id' =>'between:1,999999'
		];

		//错误提示
		protected $message = [
			'name'     =>'资源名称不能为空',
			'group'    =>'请选择所属分组',
			'right'    =>'权限码不能为空',
			'order_id' =>'排序字段必须在1-999999之间'
		];

		//验证场景
		protected $scene = [
			'rightUpdate' =>['name','group','right','order_id']
		];
		
		/**
		 * 自定义验证函数去除空格判断是否为空
		 * @param  [type] $value [description]
		 * @return [type]        [description]
		 */
		protected function checkEmpty($value)
	    {
	        if (is_string($value)) {
	            $value = trim($value);
	        }
	        if (empty($value)) {
	            return false;
	        }
	        return true;
	    }
	    
	}