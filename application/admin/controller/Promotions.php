<?php
	namespace app\admin\controller;
	use think\Db;
	use app\admin\model\GoodsRushBuy;

	class Promotions extends Base
	{
		/**
		 * 商品抢购
		 * @return [type] [description]
		 */
		public function index()
		{
			$goodsRushBuy = new GoodsRushBuy;
			$lists = $goodsRushBuy->append(['status_desc'])->order('id desc')->paginate();
			$this->assign("lists",$lists);
			dump($lists);
			return $this->fetch('goods_rush_buy');
		}
		public function modify()
		{
			$id = input('id/d');
			if($id){
				$model = Db::name('goods_rush_buy')->where('id',$id)->find();
				$this->assign('model',$model);
			}
			return $this->fetch('goods_rush_buy_modify');
		}
	}