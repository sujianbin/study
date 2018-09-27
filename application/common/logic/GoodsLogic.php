<?php
	namespace app\common\logic;
	use think\Db;

	class GoodsLogic
	{
		/**
		 * 更新商品库存
		 * @param  [type] $goods_id [description]
		 * @return [type]           [description]
		 */
		public function refreshStock($goods_id)
		{
			$count = Db::name("goods_spec_price")->where("goods_id", $goods_id)->count();
		    if($count == 0) return false;
		    $store_count = Db::name("goods_spec_price")->where("goods_id", $goods_id)->sum('store_count');
		    Db::name('goods')->where('id',$goods_id)->setField('store_count',$store_count);
		}
	}