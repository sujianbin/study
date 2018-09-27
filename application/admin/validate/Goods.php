<?php
	namespace app\admin\validate;
	use think\Validate;

	class Goods extends Validate
	{
		//验证规则
		protected $rule = [
			'cat_name'        =>'require|checkEmpty',
			'name'            =>'require|checkEmpty',
			'attr_name'       =>'require|checkEmpty',
			'spec_name'       =>'require|checkEmpty',
			'model_id'        =>'require',
			'attr_input_type' =>'between:0,2',
			'spec_values'     =>'require|checkEmpty',
			'goods_name'      =>'require|checkEmpty',
			'cat_id'          =>'number|gt:0',
			'goods_price'     =>['require','regex'=>'([1-9]\d*(\.\d*[1-9])?)|(0\.\d*[1-9])'],
			'goods_picture'   =>'require',
			'goods_detail'    =>'require',
			'order_id'        =>'between:0,999999'
		];

		//错误提示
		protected $message = [
			'cat_name'        =>'商品分类名称不能为空',
			'name'            =>'模型名称不能为空',
			'attr_name'       =>'商品属性名称不能为空',
			'model_id'        =>'请先添加商品模型',
			'attr_input_type' =>'请选择合适的录入方式',
			'goods_name'      =>'商品名称不能为空',
			'cat_id'          =>'请选择商品所属分类',
			'goods_price'     =>'出售价不能为空，且必须大于0',
			'goods_picture'   =>'商品列表图不能为空',
			'goods_detail'    =>'商品详情不能为空',
			'order_id'        =>'排序字段必须在1-999999之间',
			'spec_name'       =>'规格名称不能为空',
			'spec_values'     =>'规格项不能为空'
		];

		//验证场景
		protected $scene = [
			'category'  =>['cat_name','order_id'],//商品分类
			'model'     =>['name'],//商品模型
			'attribute' =>['attr_name','model_id','attr_input_type','order_id'],//商品属性
			'spec'      =>['spec_name','model_id','spec_values','order_id'],//商品规格
			'update'    =>['goods_name','cat_id','goods_price','goods_picture','goods_detail','order_id']//商品更新
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