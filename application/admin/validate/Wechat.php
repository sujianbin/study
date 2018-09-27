<?php
	namespace app\admin\validate;
	use think\Validate;

	class Wechat extends Validate
	{
		//验证规则
		protected $rule = [
			'title'    =>'require|checkEmpty',
			'detail'   =>'require',
			'order_id' =>'between:1,999999',
			'name'     =>'require|checkEmpty'
		];

		//错误提示
		protected $message = [
			'title'    =>'文章标题不能为空',
			'detail'   =>'详细内容不能为空',
			'order_id' =>'排序字段必须在1-999999之间',
			'name'     =>'公众号名称不能为空'
		];

		//验证场景
		protected $scene = [
			'article' =>['title','detail','order_id'],
			'config'  =>['name']
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