<?php
	namespace app\admin\validate;
	use think\Validate;

	class Brand extends Validate
	{
		//验证规则
		protected $rule = [
			'name'     =>'require',
			'logo'     =>'require',
			'order_id' =>'between:1,999999'
		];

		//错误提示
		protected $message = [
			'name'     =>'品牌名称不能为空',
			'logo'     =>'请上传品牌logo',
			'order_id' =>'排序字段必须在1-999999之间'
		];
		
	}