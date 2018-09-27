<?php
	namespace app\admin\validate;
	use think\Validate;

	class Banner extends Validate
	{
		//验证规则
		protected $rule = [
			'name'     =>'require',
			'url'      =>'require|url',
			'picture'  =>'require',
			'order_id' =>'between:1,999999'
		];

		//错误提示
		protected $message = [
			'name'        =>'名称不能为空',
			'url.require' =>'跳转地址不能为空',
			'url.url'     =>'请输入正确格式url地址，包含http或https',
			'picture'     =>'请上传图片',
			'order_id'    =>'排序字段必须在1-999999之间'
		];

	}