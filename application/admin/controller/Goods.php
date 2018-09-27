<?php
	namespace app\admin\controller;
	use think\Db;
	use app\admin\logic\GoodsLogic;

	class Goods extends Base
	{
		/**
		 * 商品管理
		 * @return [type] [description]
		 */
		public function index()
		{
			$name = input('name/s');
			$cat_id = input('cat_id/d');
			$brand_id = input('brand_id/d');
			$btime = input('btime');
			$etime = input('etime');
			if($name){
				$map[] = ['g.goods_name','like',"%{$name}%"];
				$this->assign('name',$name);
			}
			if($cat_id){
				$map[] = ['g.cat_id','=',$cat_id];
				$this->assign('cat_id',$cat_id);
			}
			if($brand_id){
				$map[] = ['g.brand_id','=',$brand_id];
				$this->assign('brand_id',$brand_id);
			}
			if($btime){
				$this->assign("btime",$btime);
				$btime = strtotime($btime);
				$map[] = ['g.create_time','>=',$btime];
			}
			if($etime){
				$this->assign("etime",$etime);
				$etime = strtotime($etime)+60*60*24-1;
				$map[] = ['g.create_time','<=',$etime];
			}
			$lists = Db::name('goods')->alias('g')->field('g.*,c.name as goods_cat_name')->join('goods_category c','g.cat_id = c.id')->where($map)->paginate(config('paginate.list_rows'),false,['query'=>request()->param()]);
			$this->assign("lists",$lists);
			$goodsLogic = new GoodsLogic();
			$subList = $goodsLogic->getSubList(0,3);
			$this->assign('subList',$subList);
			$brandList = Db::name('brand')->cache('brand')->select();
			$this->assign('brandList',$brandList);
			return $this->fetch('goods');
		}
		/**
		 * 商品编辑
		 * @param  integer $id [description]
		 * @return [type]      [description]
		 */
		public function modify($id = 0)
		{
			if($id != 0){
				$goods = Db::name('goods')->where('id',$id)->find();
				$goods['goods_image'] = explode(';',$goods['goods_image']);
				$this->assign('goods',$goods);
			}
			//商品分类
			$goodsLogic = new GoodsLogic();
			$goodsCategory = $goodsLogic->getSubList(0,3);
			$this->assign('goodsCategory',$goodsCategory);
			//商品品牌
			$brandList = Db::name('brand')->cache('brand')->select();
			$this->assign('brandList',$brandList);
			//商品模型
			$goodsModel = Db::name('goods_model')->select();
			$this->assign('goodsModel',$goodsModel);
			return $this->fetch('goods_modify');
		}
		/**
		 * 获取商品属性输入框
		 * @return [type] [description]
		 */
		public function ajaxGoodsAttr()
		{
			$goods_id = input('goods_id/d',0);
			$model_id = input('model_id/d');
			
			//获取模型对应的属性列表
			$lists = Db::name('goods_attribute')->alias('g')->field('g.id,g.attr_name,g.attr_input_type,g.attr_values,a.attr_value')->leftJoin('goods_attr a',"a.goods_id = {$goods_id} AND g.id = a.attr_id")->where('g.model_id',$model_id)->order('g.order_id asc')->select();
			$this->assign('lists',$lists);
			return $this->fetch();
		}
		/**
		 * 获取规格
		 * @return [type] [description]
		 */
		public function ajaxGoodsSpec()
		{
			$goods_id = input('goods_id/d',0);
			$model_id = input('model_id/d');

			//获取模型对应的规格列表
			$lists = Db::name('goods_spec')->where('model_id',$model_id)->order('order_id asc')->select();
			if(is_array($lists)){
				foreach ($lists as $k=>$v){
					$lists[$k]['item'] = Db::name('goods_spec_item')->where('spec_id',$v['id'])->column('value','id');
				}
			}
			$this->assign('lists',$lists);

			//获取当前规格商品图
			$goodsSpecImageList = Db::name('goods_spec_image')->where('goods_id',$goods_id)->column('goods_image_url','goods_image_id');
			$this->assign('goodsSpecImageList',$goodsSpecImageList);

			//商品价格表存在的规格item集合
			$itemIds = Db::name('goods_spec_price')->field(['GROUP_CONCAT(`key` separator "#")'=>'itemIds'])->where('goods_id',$goods_id)->find();
			if(is_array($itemIds)){
				$itemIds = explode('#',$itemIds['itemIds']);
			}else{
				$itemIds = [];
			}
			$this->assign('itemIds',$itemIds);
			return $this->fetch();
		}
		/**
		 * 获取规格价格输入框
		 * @return [type] [description]
		 */
		public function ajaxGetSpecInput()
		{
			$goods_id = input('post.goods_id/d');
			$spec_arr = input('post.spec_arr/a',[[]]);
			$goodsLogic = new GoodsLogic();
			$arr = $goodsLogic->getSpecInput($goods_id,$spec_arr);
			exit($arr);
		}
		/**
		 * 商品更新（流程很多,直接使用ajax用户体验较好）
		 * @return [type] [description]
		 */
		public function update()
		{
			$data = input('post.');
			$goods_id = input('post.id/d');

			$message = $this->validate(
	        	$data,
	        	'\app\admin\validate\Goods.update'
	        );
	        if($message !== true){
	        	$json['code'] = 100;
	        	$json['desc'] = $message;
	        	exit(json_encode($json));
	        }
	        if(is_array($data['goods_image'])){
	        	$data['goods_image'] = implode(';',$data['goods_image']);
	        }
	        //商品更新
	        $goods = new \app\admin\model\Goods();
	        $data['update_time'] = time();
	        if($goods_id){
	        	Db::name('goods')->strict(false)->where('id',$goods_id)->strict(false)->data($data)->update();
	        	// 更新购物车价格
	        	Db::name('cart')->where('goods_id',$goods_id)->whereNull('spec_key')->setField('goods_price',input('post.goods_price'));
	        }else{
	        	$data['create_time'] = time();
	        	$goods_id = Db::name('goods')->strict(false)->insertGetId($data);
	        }
	        $goods->afterSave($goods_id);
	        $goodsLogic = new GoodsLogic();
	        $goodsLogic->saveGoodsAttr($goods_id); // 属性值赋值
			$json['code'] = 0;
        	$json['desc'] = '操作成功';
        	exit(json_encode($json));
		}
		/**
		 * 商品删除
		 * @param  integer $id [description]
		 * @return [type]      [description]
		 */
		public function delete($id)
		{
			if($id){
				$ids = explode(',',$id);
				// 判断此商品是否有订单
		        $order_info_count = Db::name('orders_info')->whereIn('goods_id',$ids)->group('goods_id')->column('goods_id');
		        if($order_info_count){
		            $goods_count_ids = implode(',',$order_info_count);
		            $this->error("ID为【{$goods_count_ids}】的商品有订单,不得删除!");
		        }
				$results = Db::name('goods')->delete($ids);//商品删除
				Db::name('cart')->whereIn('goods_id',$ids)->delete();  // 购物车
		        Db::name("orders_assess")->whereIn('goods_id',$ids)->delete();  //商品评论
		        Db::name("goods_spec_price")->whereIn('goods_id',$ids)->delete();  //商品规格
		        Db::name("goods_spec_image")->whereIn('goods_id',$ids)->delete();  //商品规格图片
		        Db::name("goods_attr")->whereIn('goods_id',$ids)->delete();  //商品属性
		        Db::name("goods_collect")->whereIn('goods_id',$ids)->delete();  //商品收藏
				if($results){
					$this->success('删除成功');
				}else{
					$this->error('删除失败');
				}
			}else{
				$this->error('请选择需要删除的项');
			}
		}

		/**
		 * 商品分类
		 * @return [type] [description]
		 */
		public function category()
		{
			$name = input('name/s');
			$path_id = input('path_id/d');
			if($name){
				$map[] = ['g.name','like',"%{$name}%"];
				$this->assign('name',$name);
			}
			if($path_id){
				$map[] = ['g.path_id','like',"%,{$path_id},%"];
				$this->assign('path_id',$path_id);
			}
			$lists = Db::name('goods_category')->alias('g')->fieldRaw('g.*,ifnull(a.name,"顶级分类") as parent_name')->leftJoin('goods_category a','g.parent_id = a.id')->where($map)->paginate(config('paginate.list_rows'),false,['query'=>request()->param()]);
			$this->assign("lists",$lists);
			$goodsLogic = new GoodsLogic();
			$subList = $goodsLogic->getSubList();
			$this->assign('subList',$subList);
			return $this->fetch('goods_category');
		}
		public function categoryModify($id = 0)
		{
			if($id != 0){
				$model = Db::name('goods_category')->where('id',$id)->find();
				$this->assign('model',$model);
			}
			$goodsLogic = new GoodsLogic();
			$subList = $goodsLogic->getSubList();
			$this->assign('subList',$subList);
			return $this->fetch('goods_category_modify');
		}
		public function categoryUpdate()
		{
			$data = input('post.');
			$message = $this->validate(
	        	$data,
	        	'\app\admin\validate\Goods.category'
	        );
	        if($message !== true){
	        	$this->error($message);
	        }
			$id = input('post.id/d');
			$data['name'] = $data['cat_name'];
			unset($data['cat_name']);
			$goodsLogic = new GoodsLogic();
			$data['path_id'] = $goodsLogic->getPathId($data['parent_id']);
			$data['level'] = $goodsLogic->getLevel($data['parent_id']);
			if($id){
				$model = Db::name('goods_category')->field('id')->where('id',$id)->find();
				if(!$model){
					$this->error('对不起暂无当前记录');
				}else{
					if($data['parent_id'] == $model['id']){
						$this->error('所属分类不能是当前分类');
					}
					$results = Db::name('goods_category')->update($data);
					if($results >= 0){
						$this->success('修改成功');
					}else{
						$this->error('修改失败');
					}
				}
			}else{
				$results = Db::name('goods_category')->data($data)->insert();
				if($results){
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}
		}
		public function categoryDelete($id = 0)
		{
			if($id != 0){
				//判断当前级别是否下级，如果有则不能删除
				$count = Db::name('goods_category')->where('parent_id',$id)->count();
				$count > 0 && $this->error('当前分类下还有子分类，不可删除');
				//判断当前分类下是否存在商品，若存在不可删除
				$goods_count = Db::name('goods')->where('cat_id',$id)->count();
				$goods_count > 0 && $this->error('当前分类下存在商品，不可删除');
				//分类删除
				$results = Db::name('goods_category')->delete($id);
				if($results){
					$this->success("删除成功");
				}else{
					$this->error("删除失败");
				}
			}else{
				$this->error("请选择要删除的数据");
			}
		}

		/**
		 * 商品模型
		 * @return [type] [description]
		 */
		public function model()
		{
			$lists = Db::name('goods_model')->paginate();
			$this->assign("lists",$lists);
			return $this->fetch('goods_model');
		}
		public function modelModify($id = 0)
		{
			if($id != 0){
				$model = Db::name('goods_model')->where('id',$id)->find();
				$this->assign('model',$model);
			}
			return $this->fetch('goods_model_modify');
		}
		public function modelUpdate()
		{
			$data = input('post.');
			$message = $this->validate(
	        	$data,
	        	'\app\admin\validate\Goods.model'
	        );
	        if($message !== true){
	        	$this->error($message);
	        }
			$id = input('post.id/d');
			if($id){
				$model = Db::name('goods_model')->field('id')->where('id',$id)->find();
				if(!$model){
					$this->error('对不起暂无当前记录');
				}else{
					$results = Db::name('goods_model')->update($data);
					if($results >= 0){
						$this->success('修改成功');
					}else{
						$this->error('修改失败');
					}
				}
			}else{
				$results = Db::name('goods_model')->data($data)->insert();
				if($results){
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}
		}
		public function modelDelete($id = 0)
		{
			if($id != 0){
				//当前模型下是否存在规格
				$spec_count = Db::name('goods_spec')->where('model_id',$id)->count();
				$spec_count > 0 && $this->error('当前商品模型下还存在规格，不可删除');
				//当前模型下是否存在属性
				$attr_count = Db::name('goods_attribute')->where('model_id',$id)->count();
				$attr_count > 0 && $this->error('当前商品模型下还存在属性，不可删除');
				//删除模型
				$results = Db::name('goods_model')->delete($id);
				if($results){
					$this->success("删除成功");
				}else{
					$this->error("删除失败");
				}
			}else{
				$this->error("请选择要删除的数据");
			}
		}

		/**
		 * 商品属性
		 * @return [type] [description]
		 */
		public function attribute()
		{
			$attr_name = input('attr_name/s');
			$model_id = input('model_id/d');
			if($attr_name){
				$map[] = ['g.attr_name','like',"%{$attr_name}%"];
				$this->assign('attr_name',$attr_name);
			}
			if($model_id){
				$map[] = ['g.model_id','=',$model_id];
				$this->assign('model_id',$model_id);
			}
			$lists = Db::name('goods_attribute')->alias('g')->field('g.*,m.name as model_name')->join('goods_model m','model_id = m.id')->where($map)->paginate(config('paginate.list_rows'),false,['query'=>request()->param()]);
			$this->assign("lists",$lists);
			$goodsModel = Db::name('goods_model')->select();
			$this->assign('goodsModel',$goodsModel);
			return $this->fetch('goods_attribute');
		}
		public function attributeModify($id = 0)
		{
			if($id != 0){
				$model = Db::name('goods_attribute')->where('id',$id)->find();
				$this->assign('model',$model);
			}
			$goodsModel = Db::name('goods_model')->select();
			$this->assign('goodsModel',$goodsModel);
			return $this->fetch('goods_attribute_modify');
		}
		public function attributeUpdate()
		{
			$data = input('post.');
			$message = $this->validate(
	        	$data,
	        	'\app\admin\validate\Goods.attribute'
	        );
	        if($message !== true){
	        	$this->error($message);
	        }
			$id = input('post.id/d');
			if($data['attr_input_type'] == 1 && empty($data['attr_values'])){
				$this->error('当属性录入方式为下拉选择时，可选值列表不能为空');
			}
			if($id){
				$model = Db::name('goods_attribute')->field('id')->where('id',$id)->find();
				if(!$model){
					$this->error('对不起暂无当前记录');
				}else{
					$results = Db::name('goods_attribute')->update($data);
					if($results >= 0){
						$this->success('修改成功');
					}else{
						$this->error('修改失败');
					}
				}
			}else{
				$results = Db::name('goods_attribute')->data($data)->insert();
				if($results){
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}
		}
		public function attributeDelete($id)
		{
			if($id){
				$ids = explode(',',$id);
				// 判断有无商品使用该属性
		        $count_ids = Db::name("goods_attr")->whereIn('attr_id',$ids)->group('attr_id')->column('attr_id');
		        if($count_ids){
		            $count_ids = implode(',',$count_ids);
		            $this->error("ID为【{$count_ids}】的属性有商品正在使用,不得删除!");
		        }
				$results = Db::name('goods_attribute')->delete($ids);
				if($results){
					$this->success("成功删除{$results}条数据");
				}else{
					$this->error("删除失败");
				}
			}else{
				$this->error("删除失败");
			}
		}

		/**
		 * 商品规格
		 * @return [type] [description]
		 */
		public function spec()
		{
			$spec_name = input('spec_name/s');
			$model_id = input('model_id/d');
			if($spec_name){
				$map[] = ['g.spec_name','like',"%{$spec_name}%"];
				$this->assign('spec_name',$spec_name);
			}
			if($model_id){
				$map[] = ['g.model_id','=',$model_id];
				$this->assign('model_id',$model_id);
			}
			//group_concat 会截取字符串，前端实际使用请做循环处理，这里只用于显示不会对逻辑造成影响
			$lists = Db::name('goods_spec')->alias('g')->fieldRaw('g.*,m.name as model_name,GROUP_CONCAT(s.value) as spec_values')->join('goods_model m','model_id = m.id')->join('goods_spec_item s','g.id = s.spec_id')->group('g.id')->paginate(config('paginate.list_rows'),false,['query'=>request()->param()]);
			$this->assign("lists",$lists);
			$goodsModel = Db::name('goods_model')->select();
			$this->assign('goodsModel',$goodsModel);
			return $this->fetch('goods_spec');
		}
		public function specModify($id = 0)
		{
			if($id != 0){
				$model = Db::name('goods_spec')->where('id',$id)->find();
				//获取对应规格项
				$model['spec_values'] = Db::name('goods_spec_item')->where('spec_id',$model['id'])->column('value','id');
				$model['spec_values'] = implode(PHP_EOL,$model['spec_values']);
				$this->assign('model',$model);
			}
			$goodsModel = Db::name('goods_model')->select();
			$this->assign('goodsModel',$goodsModel);
			return $this->fetch('goods_spec_modify');
		}
		public function specUpdate()
		{
			$data = input('post.');
			$message = $this->validate(
	        	$data,
	        	'\app\admin\validate\Goods.spec'
	        );
	        if($message !== true){
	        	$this->error($message);
	        }
			$id = input('post.id/d');
			unset($data['spec_values']);
			if($id){
				$model = Db::name('goods_spec')->field('id')->where('id',$id)->find();
				if(!$model){
					$this->error('对不起暂无当前记录');
				}else{
					$results = Db::name('goods_spec')->update($data);
					if($results >= 0){
						$goodsSpec = new \app\admin\model\GoodsSpecItem;
						$goodsSpec->afterSave($id);
						$this->success('修改成功');
					}else{
						$this->error('修改失败');
					}
				}
			}else{
				$results = Db::name('goods_spec')->insertGetId($data);
				if($results){
					$goodsSpec = new \app\admin\model\GoodsSpecItem;
					$goodsSpec->afterSave($results);
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}
		}
		public function specDelete($id)
		{
			if($id){
				$ids = explode(',',$id);
				//判断商品规格项
		        $count_ids = Db::name('spec_item')->whereIn('spec_id',$ids)->group('spec_id')->column('spec_id');
		        if($count_ids){
		            $count_ids = implode(',',$count_ids);
		            $this->error("ID为【{$count_ids}】的规格存在规格值，清空规格项后才可以删除!");
		        }
				$results = Db::name('goods_spec')->delete($ids);
				if($results){
					$this->success("成功删除{$results}条数据");
				}else{
					$this->error("删除失败");
				}
			}else{
				$this->error("删除失败");
			}
		}
	}