<?php
	/**
	 * tpweb
	 * ============================================================================
	 * 版权所有 2018-2020 搁浅，并保留所有权利。
	 * 网站地址: http://tpweb.sujianbin.com
	 * ----------------------------------------------------------------------------
	 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用.
	 * 不允许对程序代码以任何形式任何目的的再发布。
	 * ============================================================================
	 * Author: 搁浅
	 * Date: 2018-05-20
	 */
	namespace app\admin\model;
	use think\Model;
	use think\Db;
	
	class Goods extends Model
	{
		protected $pk = 'id';
		/**
		 * 商品更新后置操作
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function afterSave($goods_id)
		{
			//商品价格赋值
			$goodsItem = input('post.item/a');
			if(is_array($goodsItem)){
				$keyArr = '';
				foreach ($goodsItem as $k=>$v){
					$keyArr .= $k.',';
					$v['price'] = trim($v['price']);
                	$v['store_count'] = trim($v['store_count']);
                	$data = ['goods_id' => $goods_id, 'key' => $k, 'key_name' => $v['key_name'], 'price' => $v['price'], 'store_count' => $v['store_count']];
                	$goodsSpecPrice = Db::name('goods_spec_price')->where(['goods_id'=>$goods_id,'key'=>$k])->find();
                	if($goodsSpecPrice){
                		Db::name('goods_spec_price')->where('id',$goodsSpecPrice['id'])->data($data)->update();
                	}else{
                		Db::name('goods_spec_price')->data($data)->insert();
                	}
                	// 更新购物车价格
                	Db::name('cart')->where('goods_id',$goods_id)->where('spec_key',$k)->setField('goods_price',$v['price']);
				}
				if($keyArr){
					//这里不删除购物车的商品规格记录，结算时判断对应库存，查不到或者为0时表示不可结算
					Db::name('goods_spec_price')->where('goods_id',$goods_id)->whereNotIn('key',$keyArr)->delete();
				}
			}else{
				Db::name('goods_spec_price')->where('goods_id',$goods_id)->delete();
			}
			//商品规格item图
			$itemImage = input('post.item_img/a');
			if(is_array($itemImage)){
				$keyArr = '';
				foreach ($itemImage as $k=>$v){
					$keyArr .= $k.',';
					$v = trim($v);
					if(!empty($v)){
						$data = ['goods_id' => $goods_id, 'goods_image_id' => $k, 'goods_image_url' => $v];
						$goodsSpecImage = Db::name('goods_spec_image')->where('goods_id',$goods_id)->where('goods_image_id',$k)->find();
						if($goodsSpecImage){
							Db::name('goods_spec_image')->where('id',$goodsSpecImage['id'])->data($data)->update();
						}else{
							Db::name('goods_spec_image')->data($data)->insert();
						}
					}
				}
				if($keyArr){
					Db::name('goods_spec_image')->where('goods_id',$goods_id)->whereNotIn('goods_image_id',$keyArr)->delete();
				}
			}else{
				Db::name('goods_spec_image')->where('goods_id',$goods_id)->delete();
			}
			//更新商品库存
			$goodsLogic = new \app\common\logic\GoodsLogic;
			$goodsLogic->refreshStock($goods_id);
		}
	}