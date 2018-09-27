<?php
	namespace app\common\logic;
	use think\Db;
	use app\common\logic\WechatLogic;
	use EasyWeChat\Factory;

	class NoticeLogic
	{
		/**
		 * 充值成功通知
		 * @param  [type] $recharge_id [description]
		 * @return [type]              [description]
		 */
		public function recharge($recharge_id)
		{
			$template_id = 's5oEqVLd1tyW-HHehM_nIJxBmPtCs6YN52pRyEfxhoc';
			$wechatLogic = new WechatLogic;
			$recharge = Db::name('member_recharge')->field('money,create_time,member_id')->where('id',$recharge_id)->find();
			$member = Db::name('member')->field('openid,realname')->where('id',$recharge['member_id'])->find();
			$data = [
				'first'    =>['尊敬的用户'.$member['realname'].'，您本次充值成功到账','#173177'],
				'keyword1' =>[date('Y-m-d H:i:s',$recharge['create_time']),'#173177'],
				'keyword2' =>[$recharge['money'],'#173177'],
				'remark'   =>'如有疑问请联系我司客服，感谢您的支持!'
			];
			$url = request()->domain().'/member/income/type/2.html';
			$wechatLogic->templateMessage($member['openid'],$template_id,$data,$url);
			$message = [
				'member_id'=>$recharge['member_id'],
				'title'=>'您好，您成功充值金额'.$recharge['money'].'元',
				'url'=>['url'=>'member/income','param'=>['type'=>2]]
			];
			$this->sendNotice(1,$message);
		}
		/**
		 * 支付成功通知
		 * @param  [type] $orders_id [description]
		 * @return [type]            [description]
		 */
		public function order($orders_id)
		{
			$template_id = 'Nsh1j97kbwhjGcePf7eJvK_8u0xaOmfEdc6-QlzzyMU';
			$wechatLogic = new WechatLogic;
			$orders = Db::name('orders')->field('out_trade_no,pay_time,pay_money,member_id')->where('id',$orders_id)->find();
			$member = Db::name('member')->field('openid')->where('id',$orders['member_id'])->find();
			$data = [
				'first'    =>['您已成功下单','#173177'],
				'keyword1' =>[$orders['out_trade_no'],'#173177'],
				'keyword2' =>[round($orders['pay_money'],2).'元','#173177'],
				'keyword3' =>['鑫蚂蚁财税','#173177'],
				'keyword4' =>[date('Y-m-d H:i:s',$orders['pay_time']),'#173177'],
				'remark'   =>'如有疑问请联系我司客服，感谢您的支持!'
			];
			$url = request()->domain().'/order/detail/id/'.$orders_id.'.html';
			$wechatLogic->templateMessage($member['openid'],$template_id,$data,$url);
			$message = [
				'member_id'=>$orders['member_id'],
				'title'=>'您好，您已成功下单',
				'url'=>['url'=>'order/detail','param'=>['id'=>$orders_id]]
			];
			$this->sendNotice(2,$message);
		}
		/**
		 * 收益通知
		 * @param  [type] $datas [description]
		 * @return [type]        [description]
		 */
		public function income($datas)
		{
			$template_id = 'mJx0IguxDdGIU3i7Nu7puX9txTu_gqvW6Yj6xTUIpTc';
			$wechatLogic = new WechatLogic;
			$data = [
				'first'    =>['亲！您团队下新增一笔消费','#173177'],
				'keyword1' =>[$datas['realname'],'#173177'],
				'keyword2' =>[$datas['money'],'#173177'],
				'keyword3' =>[date('Y-m-d H:i:s',$datas['pay_time']),'#173177'],
				'remark'   =>'收益金额：'.$datas['income']."元\r\n如有疑问请联系我司客服，感谢您的支持!"
			];
			$url = request()->domain().'/member/income/type/1.html';
			$wechatLogic->templateMessage($datas['openid'],$template_id,$data,$url);
			$message = [
				'member_id'=>$datas['invite_id'],
				'title'=>'您的团队有一笔消费，您成功获取收益',
				'url'=>['url'=>'member/income','param'=>['type'=>1]]
			];
			$this->sendNotice(3,$message);
		}
		/**
		 * 订单状态变更
		 * @param  [type] $orders_id [description]
		 * @return [type]            [description]
		 */
		public function orderStatus($orders_id)
		{
			$template_id = 't8WHw3F7_rpzHoNzgC8SY6y-sYDhDpc8FT9bDrg1rso';
			$wechatLogic = new WechatLogic;
			$orders = Db::name('orders')->field('out_trade_no,create_time,member_id,is_pay,status')->where('id',$orders_id)->find();
			$member = Db::name('member')->field('openid')->where('id',$orders['member_id'])->find();
			$data = [
				'first'    =>['您的订单状态已发生变更','#173177'],
				'keyword1' =>[order_status($orders['is_pay'],$orders['status'],false),'#173177'],
				'keyword2' =>[date('Y-m-d H:i:s',$orders['create_time']),'#173177'],
				'keyword3' =>[$orders['out_trade_no'],'#173177'],
				'remark'   =>'如有疑问请联系我司客服，感谢您的支持!'
			];
			$url = request()->domain().'/order/detail/id/'.$orders_id.'.html';
			$wechatLogic->templateMessage($member['openid'],$template_id,$data,$url);
			$message = [
				'member_id'=>$orders['member_id'],
				'title'=>'您的订单状态已发生变更',
				'url'=>['url'=>'order/detail','param'=>['id'=>$orders_id]]
			];
			$this->sendNotice(2,$message);
		}
		/**
		 * 订单到期提醒
		 * @param  [type] $orders_id [description]
		 * @return [type]            [description]
		 */
		public function orderReminder($orders_id)
		{
			$template_id = 'lIRSaZNazqST0IpsMynDYSv7OAMptejscahnpC561cM';
			$wechatLogic = new WechatLogic;
			$orders = Db::name('orders')->field('out_trade_no,create_time,member_id,is_pay,status')->where('id',$orders_id)->find();
			$member = Db::name('member')->field('openid')->where('id',$orders['member_id'])->find();
			$etime = date('Y-m-d',strtotime("+1 year",$orders['create_time']));
			$data = [
				'first'    =>['您的订单即将到期','#173177'],
				'keyword1' =>[$orders['out_trade_no'],'#173177'],
				'keyword2' =>[date('Y-m-d',$orders['create_time']),'#173177'],
				'keyword3' =>[$etime,'#173177'],
				'remark'   =>'如有疑问请联系我司客服，感谢您的支持!'
			];
			$url = 'http://mycs.husan.com.cn'.'/order/detail/id/'.$orders_id.'.html';
			$wechatLogic->templateMessage($member['openid'],$template_id,$data,$url);
			$message = [
				'member_id'=>$orders['member_id'],
				'title'=>'您的订单即将到期',
				'url'=>['url'=>'order/detail','param'=>['id'=>$orders_id]]
			];
			$this->sendNotice(2,$message);
		}
		/**
		 * 抢单成功通知
		 * @param  [type] $task_id [description]
		 * @return [type]          [description]
		 */
		public function task($task_id)
		{
			$template_id = 'oq-ipVrPjsQwapgQq1CNZcAmk7eLv65K5RhuiwIwL_Y';
			$wechatLogic = new WechatLogic;
			$task = Db::name('orders_info')->alias('i')->field('i.staff_id,i.goods_name,m.realname as member_name,j.create_time,o.out_trade_no,i.orders_id,o.member_id')->join('orders o','i.orders_id = o.id')->join('member m','o.member_id = m.id')->join('staff_orders_join j','j.orders_info_id = i.id')->where('i.id',$task_id)->find();
			$staff = Db::name('staff')->field('openid')->where('id',$task['staff_id'])->find();
			$data = [
				'first'    =>['恭喜您抢单成功','#173177'],
				'keyword1' =>[date('Y-m-d H:i:s',$task['create_time']),'#173177'],
				'keyword2' =>[$task['member_name'],'#173177'],
				'remark'   =>'如有疑问请联系我司客服，感谢您的支持!'
			];
			$url = request()->domain().'/staff.php/member/ordersdetail/id/'.$task_id.'.html';
			$wechatLogic->templateMessage($staff['openid'],$template_id,$data,$url);
			$message = [
				'staff_id'=>$task['staff_id'],
				'title'=>'抢单成功通知',
				'url'=>['url'=>'member/ordersDetail','param'=>['id'=>$task_id]]
			];
			$this->sendNotice(4,$message);
			//通知消费者
			$template_id = 'r1Zx05D7Cqlcr3e7VywTX8dYrV0i_Bn1yVkBbYGal8M';
			$data = [
				'first'    =>['您好，您的订单已成功分配','#173177'],
				'keyword1' =>[$task['out_trade_no'],'#173177'],
				'keyword2' =>[$task['goods_name'],'#173177'],
				'remark'   =>'如有疑问请联系我司客服，感谢您的支持!'
			];
			$member = Db::name('member')->field('openid')->where('id',$task['member_id'])->find();
			$url = request()->domain().'/order/detail/id/'.$task['orders_id'].'.html';
			$wechatLogic->templateMessage($member['openid'],$template_id,$data,$url);
			$message = [
				'member_id'=>$task['member_id'],
				'title'=>'订单分配成功通知',
				'url'=>['url'=>'order/detail','param'=>['id'=>$task['orders_id']]]
			];
			$this->sendNotice(5,$message);
		}
		/**
		 * 有新的反馈通知给消费者
		 * @param  [type] $id [任务id]
		 * @return [type]     [description]
		 */
		public function taskFeedback($id)
		{
			$template_id = 'sfICgR1xfwPt1ca1raOyqx9nrErTpW5INj-PBBQ7_as';
			$wechatLogic = new WechatLogic;
			$task = Db::name('orders_info')->alias('i')->field('i.goods_name,o.member_id,m.openid')->join('orders o','i.orders_id = o.id')->join('member m','o.member_id = m.id')->where('i.id',$id)->find();
			$data = [
				'first'    =>['您有一个新的服务反馈通知','#173177'],
				'keyword1' =>['代理记账','#173177'],
				'keyword2' =>['服务中','#173177'],
				'keyword3' =>['您购买的商品'.$task['goods_name'].'有新的反馈','#173177'],
				'remark'   =>'如有疑问请联系我司客服，感谢您的支持!'
			];
			$url = request()->domain().'/order/feedback/id/'.$id.'.html';
			$wechatLogic->templateMessage($task['openid'],$template_id,$data,$url);
			$message = [
				'member_id'=>$task['member_id'],
				'title'=>'服务反馈通知',
				'url'=>['url'=>'order/feedback','param'=>['id'=>$id]]
			];
			$this->sendNotice(6,$message);
		}
		/**
		 * 站内消息
		 * @param  [type] $type [description]
		 * @param  [type] $data [description]
		 * @return [type]       [description]
		 */
		public function sendNotice($type,$data)
		{
			if($type == 1 || $type == 2 || $type == 3 || $type == 5 || $type == 6){//充值成功|下单成功|收益到账|服务开始通知|反馈通知
				$message = [
					'member_id'   =>$data['member_id'],
					'create_time' =>time(),
					'title'       =>$data['title'],
					'url'         =>json_encode($data['url'])
				];
				Db::name('member_notice')->data($message)->insert();
			}else if($type == 4){
				$message = [
					'staff_id'   =>$data['staff_id'],
					'create_time' =>time(),
					'title'       =>$data['title'],
					'url'         =>json_encode($data['url'])
				];
				Db::name('staff_notice')->data($message)->insert();
			}
			return true;
		}
	}