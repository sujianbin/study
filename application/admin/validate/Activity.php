<?php
	namespace app\admin\validate;
	use think\Validate;

	class Activity extends Validate
	{
		//验证规则
		protected $rule = [
			'title'    =>'require',
			'picture'  =>'require',
			'detail'   =>'require',
			'order_id' =>'between:1,999999'
		];

		//错误提示
		protected $message = [
			'title'        =>'活动标题不能为空',
			'picture'     =>'请上传宣传图片',
			'detail'     =>'活动详情不能为空',
			'order_id'    =>'排序字段必须在1-999999之间'
		];

	}