<?php
	namespace app\admin\model;
	use think\Model;
	
	class GoodsRushBuy extends Model
	{
		/**
		 * 状态描述
		 * 不存在的字段
		 * @param  [type] $value [description]
		 * @param  [type] $data  [description]
		 * @return [type]        [description]
		 */
	    public function getStatusDescAttr($value, $data)
	    {
	        if($data['is_end'] == 1){
	            return '已结束';
	        }else{
	            if($data['buy_num'] >= $data['goods_num']){
	                return '已售罄';
	            }else{
	                if($data['start_time'] > time()){
	                    return '未开始';
	                }else if ($data['start_time'] < time() && $data['end_time'] > time()) {
	                    return '进行中';
	                }else{
	                    return '已过期';
	                }
	            }
	        }
	    }
	}