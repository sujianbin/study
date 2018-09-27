<?php
	namespace app\admin\controller;
	use think\Db;

	class Orders extends Base
	{
		/**
		 * 订单列表
		 * @return [type] [description]
		 */
		public function index()
		{	
			$name = input('title');
			$orders = input('orders');
			$pay_type = input('pay_type/d');
			$is_pay = input('is_pay/d');
			$status = input('status/d');
			$btime = input('btime');
			$etime = input('etime');
			$mark = input('mark');//标记
			$id = input('id/d');
			if(!empty($id)){
				$map[] = ['m.id','=',$id];
				$this->assign('id',$id);
			}
			if(!empty($name)){
				$map[] = ['m.realname','like',"%{$name}"];
				$this->assign("name",$name);
			}
			if(!empty($orders)){
				$map[] = ['o.out_trade_no','=',$orders];
				$this->assign("orders",$orders);
			}
			if(!empty($status)){
				$map[] = ['o.status','=',$status];
				$this->assign("status",$status);
			}
			if(!empty($pay_type)){
				$map[] = ['o.pay_type','=',$pay_type];
				$this->assign("pay_type",$pay_type);
			}
			if(!empty($is_pay)){
				$map[] = ['o.is_pay','=',$is_pay];
				$this->assign("is_pay",$is_pay);
			}
			if($btime){
				$this->assign("btime",$btime);
				$btime = strtotime($btime);
				$map[] = ['o.create_time','>=',$btime];
			}
			if($etime){
				$this->assign("etime",$etime);
				$etime = strtotime($etime)+60*60*24;
				$map[] = ['o.create_time','<=',$etime];
			}
			$export = input('export/d',0);
			if($export == 1){
				$lists = Db::name('orders')->alias('o')->field('o.*,group_concat(i.goods_name) as goods_name,m.realname')->where($map)->join('orders_info i','o.id = i.orders_id')->join('member m','o.member_id = m.id')->group('o.id')->order('o.create_time desc')->select();
				$ordersUtil = new \app\admin\util\OrdersUtil;
				$ordersUtil->export($lists);
			}else{
				$member = Db::name('member')->field('realname,id')->select();
				$this->assign('member',$member);
				$lists = Db::name('orders')->alias('o')->field('o.*,group_concat(i.goods_name) as goods_name,m.realname')->where($map)->join('orders_info i','o.id = i.orders_id')->join('member m','o.member_id = m.id')->group('o.id')->order('o.create_time desc')->paginate(config('paginate.list_rows'),false,['query'=>request()->param()]);
				$this->assign("lists",$lists);
				return $this->fetch();
			}
		}
		/**
		 * 订单详情
		 * @return [type] [description]
		 */
		public function modify($id = 0)
		{	
			if($id != 0){
				$model = Db::name('orders')->where("id",$id)->find();//订单表
				$info = Db::name('orders_info')->alias('i')->field('i.*,g.goods_picture')->join('goods g','i.goods_id = g.id')->where('i.orders_id',$id)->select();
				if($model){
					$this->assign("model",$model);
					$this->assign("info",$info);
					//订单日志
					$log = Db::name('orders_log')->alias('l')->field('l.*,a.user_name')->leftJoin(['admin'=>'a'],'l.admin_id = a.admin_id')->where('l.orders_id',$id)->order('create_time desc')->select();
					$this->assign('log',$log);
					return $this->fetch();
				}else{
					$this->error('当前订单不存在');
				}
			}else{
				$this->error('参数不完整');
			}
		}
		/**
		 * 订单操作
		 * @return [type] [description]
		 */
		public function update()
		{
			$orders_id = input('post.orders_id/d');
			$is_pay = input('post.is_pay/d');
			$status = input('post.status/d');
			$mark = input('post.mark','','trim');
			if($is_pay == 1 && $status == 1){
				$json['code'] = 101;
				$json['desc'] = '当付款状态变更为已付款时，订单状态不能为未付款';
			}else if(!$mark){
				$json['code'] = 101;
				$json['desc'] = '操作备注不能为空';
			}else{
				$data = [
					'is_pay' =>$is_pay,
					'status' =>$status,
					'expire_time'=>strtotime(input('post.expire_time'))
				];
				Db::name('orders')->where('id',$orders_id)->data($data)->update();
				$is_notice = input('post.is_notice/d');
				$datas = [
					'orders_id'=>$orders_id,
					'admin_id'=>session('admin_id'),
					'mark'=>$mark,
					'create_time'=>time(),
					'ip'=>request()->ip(),
					'status'=>$status,
					'is_pay'=>$is_pay,
					'is_notice'=>$is_notice,
				];
				$results = DB::name('orders_log')->data($datas)->insert();
				if($results){
					if($status == 3){//订单已完成，收益转正
						Db::name('member_income')->where('orders_id',$orders_id)->where('type',1)->setField('status',2);
					}
					if($is_notice == 1){//发送消息通知
						$noticeLogic = new \app\common\logic\NoticeLogic;
						$noticeLogic->orderStatus($orders_id);
					}
					$json['code'] = 0;
					$json['desc'] = '操作成功';
				}else{
					$json['code'] = 101;
					$json['desc'] = '操作失败。请稍后重试';
				}
			}
			return json($json);
		}
		/**
		 * 删除订单
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function delete($id)
		{
			$results = Db::name('orders')->delete($id);
			if($results){
				Db::name('orders_info')->where('orders_id',$id)->delete();
				Db::name('orders_log')->where('orders_id',$id)->delete();
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}
		/**
		 * 订单日志
		 * @return [type] [description]
		 */
		public function log()
		{
			$name = input('title');
			$orders = input('orders');
			$btime = input('btime');
			$etime = input('etime');
			if(!empty($name)){
				$map[] = ['a.user_name','like',"%{$name}"];
				$this->assign("name",$name);
			}
			if(!empty($orders)){
				$map[] = ['o.out_trade_no','=',$orders];
				$this->assign("orders",$orders);
			}
			if($btime){
				$this->assign("btime",$btime);
				$btime = strtotime($btime);
				$map[] = ['l.create_time','>=',$btime];
			}
			if($etime){
				$this->assign("etime",$etime);
				$etime = strtotime($etime)+60*60*24;
				$map[] = ['l.create_time','<=',$etime];
			}
			$lists = Db::name('orders_log')->alias('l')->field('l.*,a.user_name,o.out_trade_no')->leftJoin(['admin'=>'a'],'l.admin_id = a.admin_id')->join('orders o','l.orders_id = o.id')->where($map)->order('l.create_time desc')->paginate(config('paginate.list_rows'),false,['query'=>request()->param()]);
			$this->assign("lists",$lists);
			return $this->fetch();
		}
		/**
		 * 日志删除
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function logDelete($id)
		{
			$results = Db::name('orders_log')->delete($id);
			if($results){
				$this->success('删除成功');
			}else{
				$this->error('删除失败');
			}
		}
		public function ceshi($id)
		{
			$noticeLogic = new \app\common\logic\NoticeLogic;
			$noticeLogic->orderReminder($id);
		}
		public function test()
		{
			dump(curl_version());
		}
	}