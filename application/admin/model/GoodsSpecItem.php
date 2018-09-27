<?php
	namespace app\admin\model;
	use think\Model;
	
	class GoodsSpecItem extends Model
	{
		protected $pk = 'id';
		public function afterSave($id)
		{
			$specValues = input('post.spec_values');
			$specValues = explode(PHP_EOL,$specValues);
			foreach ($specValues as $k=>$v){
				$v = str_replace('_', '', $v); // 替换特殊字符
	            $v = str_replace('@', '', $v); // 替换特殊字符
	            $v = trim($v);
	            if(empty($v)){
	                unset($specValues[$k]);
	            }else{
	                $specValues[$k] = $v;
	            }            
			}
			$specItems = $this::where('spec_id',$id)->column('value','id');
			/* 提交过来的 跟数据库中比较 不存在 插入*/
	        foreach($specValues as $k => $v){
	            if(!in_array($v, $specItems))  $datas[] = ['spec_id'=>$id,'value'=>$v];
	        }
	        // 批量添加数据
        	$datas && $this->saveAll($datas);
        	/* 数据库中的 跟提交过来的比较 不存在删除*/
        	if(is_array($specItems)){
        		foreach($specItems as $k => $v){
		            if(!in_array($v, $specValues)){      
		            	//删除规格对应规格产品 
		                $this->where('id',$k)->delete();//删除规格项
		                Db::name('goods_spec_price')->where("`key` REGEXP '^{$k}#' OR `key` REGEXP '#{$k}#' OR `key` REGEXP '#{$k}$' or `key` = '{$k}'")->delete(); //删除规格项价格表【没有更新影响到的商品的库存】
		            }
		        }
        	}
		}
	}