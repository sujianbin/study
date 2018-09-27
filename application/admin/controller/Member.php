<?php
	namespace app\admin\controller;
	use think\Db;

	class Member extends Base
	{
		/**
		 * 会员管理
		 * @return [type] [description]
		 */
		public function index()
		{	
			$name = input('title');
			$btime = input('btime');
			$etime = input('etime');
			$export = input('export/d',0);
			if(!empty($name)){
				$map[] = ['m.realname|m.nickname','like',"%{$name}%"];
				$this->assign("name",$name);
			}
			if($btime){
				$this->assign("btime",$btime);
				$btime = strtotime($btime);
				$map[] = ['m.create_time','>=',$btime];
			}
			if($etime){
				$this->assign("etime",$etime);
				$etime = strtotime($etime)+60*60*24;
				$map[] = ['m.create_time','<=',$etime];
			}
			if($export == 1){
				$lists = Db::name('member')->alias('m')->field('m.id,m.realname,m.nickname,m.head,m.phone,m.balance,m.recharge,m.invite_id,m.create_time,m1.realname as invite_name,ifNUll(sum(o.pay_money),"0.00") as money')->where($map)->leftJoin('member m1','m.invite_id = m1.id')->leftJoin('orders o','m.id = o.member_id')->group('m.id')->order('m.create_time desc')->select();
				$memberUtil = new \app\admin\util\MemberUtil;
				$memberUtil->export($lists);
			}else{
				$lists = Db::name('member')->alias('m')->field('m.id,m.realname,m.nickname,m.head,m.phone,m.balance,m.recharge,m.invite_id,m.create_time,m1.realname as invite_name,ifNUll(sum(o.pay_money),"0.00") as money')->where($map)->leftJoin('member m1','m.invite_id = m1.id')->leftJoin('orders o','m.id = o.member_id')->group('m.id')->order('m.create_time desc')->paginate(config('paginate.list_rows'),false,['query'=>request()->param()]);
				$this->assign("lists",$lists);
				return $this->fetch();
			}
		}
		public function modify($id = 0)
		{
			if($id != 0){
				$model = Db::name('member')->where('id',$id)->find();
				
				if($model){
					$this->assign('model',$model);
					return $this->fetch();
				}else{
					$this->error('当前会员不存在');
				}
			}else{
				$this->error('参数不完整');
			}
		}
		public function update()
		{
			$data = input('post.');
			$message = $this->validate(
	        	$data,
	        	'\app\admin\validate\member'
	        );
	        if($message !== true){
	        	$this->error($message);
	        }
			$id = input('post.id/d');
			if($id){
				$model = Db::name('member')->field('id')->where('id',$id)->find();
				if(!$model){
					$this->error('对不起暂无当前记录');
				}else{
					$results = Db::name('member')->update($data);
					if($results >= 0){
						$this->success('修改成功');
					}else{
						$this->error('修改失败');
					}
				}
			}else{
				$this->error('参数不完整');
			}
		}
		/**
		 * 充值记录
		 * @return [type] [description]
		 */
		public function recharge()
		{
			$name = input('title');
			if(!empty($name)){
				$map[] = ['m.realname','like',"%{$name}%"];
				$this->assign("name",$name);
			}
			$status = input('status/d',0);
			if(!empty($status)){
				$map[] = ['r.status','=',$status];
				$this->assign("status",$status);
			}
			$btime = input('btime');
			if($btime){
				$this->assign("btime",$btime);
				$btime = strtotime($btime);
				$map[] = ['r.create_time','>=',$btime];
			}
			$etime = input('etime');
			if($etime){
				$this->assign("etime",$etime);
				$etime = strtotime($etime)+60*60*24;
				$map[] = ['r.create_time','<=',$etime];
			}
			$lists = Db::name('member_recharge')->alias('r')->field('r.*,m.realname,m.nickname')->join('member m','member_id = m.id')->where('r.type',1)->where($map)->order('r.create_time desc')->paginate(config('paginate.list_rows'),false,['query'=>request()->param()]);
			$this->assign("lists",$lists);
			return $this->fetch();
		}
		public function rechargeDelete($id = 0)
		{
			if($id){
				$model = Db::name('member_recharge')->where('id',$id)->value('id');
				if(!$model){
					$this->error('当前记录不存在');
				}else{
					$results = Db::name('member_recharge')->delete($id);
					if($results){
						admin_log('充值记录删除');
						$this->success('删除成功');
					}else{
						$this->error('删除失败');
					}
				}
			}else{
				$this->error('请选择要删除的记录项');
			}
		}
		/**
		 * 会员收益列表
		 * @return [type] [description]
		 */
		public function profit()
		{
			$name = input('title');
			$orders = input('orders');
			$btime = input('btime');
			$etime = input('etime');
			if(!empty($name)){
				$map[] = ['m.realname','like',"%{$name}"];
				$this->assign("name",$name);
			}
			if(!empty($orders)){
				$map[] = ['o.orders_id','=',$orders];
				$this->assign("orders",$orders);
			}
			if($btime){
				$this->assign("btime",$btime);
				$btime = strtotime($btime);
				$map[] = ['i.create_time','>=',$btime];
			}
			if($etime){
				$this->assign("etime",$etime);
				$etime = strtotime($etime)+60*60*24;
				$map[] = ['i.create_time','<=',$etime];
			}
			$lists = Db::name('member_income')->alias('i')->field('i.id,i.title,i.status,i.create_time,i.money,m.realname,o.out_trade_no')->join('member m','i.member_id = m.id')->leftJoin('orders o','i.orders_id = o.id')->where('i.type',1)->where($map)->order('i.create_time desc')->paginate(config('paginate.list_rows'),false,['query'=>request()->param()]);

			$this->assign("lists",$lists);
			return $this->fetch();
		}
		/**
		 * 收益删除
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function profitDelete($id)
		{
			if($id){
				$model = Db::name('member_income')->where('id',$id)->where('type',1)->value('id');
				if(!$model){
					$this->error('当前记录不存在');
				}else{
					$results = Db::name('member_income')->delete($id);
					if($results){
						admin_log('收益记录删除');
						$this->success('删除成功');
					}else{
						$this->error('删除失败');
					}
				}
			}else{
				$this->error('请选择要删除的记录项');
			}
		}
		/**
		 * 提现申请
		 * @return [type] [description]
		 */
		public function apply()
		{	
			$name = input('title');
			$is_deal = input('is_deal/d',2);
			$btime = input('btime');
			$etime = input('etime');
			if(!empty($name)){
				$map[] = ['m.realname','like',"%{$name}%"];
				$this->assign("name",$name);
			}
			if($is_deal != 2){
				$map[] = ['i.is_deal','=',$is_deal];
				$this->assign("is_deal",$is_deal);
			}
			if(!empty($btime)){
				$this->assign("btime",$btime);
				$btime = strtotime($btime);
				$map[] = ['i.create_time','>=',$btime];
			}
			if(!empty($etime)){
				$this->assign("etime",$etime);
				$etime = strtotime($etime)+60*60*24;
				$map[] = ['i.create_time','<=',$etime];
			}
			$map[] = ['i.type','=',2];
			$lists = Db::name('member_income')->alias('i')->field('i.id,i.money,m.realname,i.is_deal,i.create_time')->where($map)->join('member m','i.member_id = m.id')->paginate(config('paginate.list_rows'),false,['query'=>request()->param()]);
			$this->assign("lists",$lists);
			return $this->fetch();
		}
		/**
		 * 提现申请编辑
		 * @return [type] [description]
		 */
		public function applyModify($id)
		{	
			$map[] = ['id','=',$id];
			$map[] = ['type','=',2];
			$model = Db::name('member_income')->where($map)->find();
			if($model){
				$member = Db::name('member')->field('realname,nickname')->where('id',$model['member_id'])->find();
				$this->assign('member',$member);
				$this->assign('model',$model);
				return $this->fetch('apply_modify');
			}else{
				$this->error('暂无当前申请记录');
			}
		}
		/**
		 * 提现申请处理
		 * @return [type] [description]
		 */
		public function applyUpdate()
		{
			$id = input('post.id/d');
			$map[] = ['id','=',$id];
			$map[] = ['type','=',2];
			$model = Db::name('member_income')->where($map)->find();
			if($model){
				if($model['is_deal'] == 1){
					$this->error('当前提现申请已处理，请勿重复处理');
				}else{
					$picture = input('post.picture');
					if(!$picture){
						$this->error('请上传凭证');
					}else{
						$is_deal = input('post.is_deal/d',0);
						$data = [
							'picture'=>$picture,
							'is_deal'=>$is_deal,
						];
						$results = Db::name('member_income')->where('id',$id)->data($data)->update();
						if($results){
							$this->success('操作成功');
						}else{
							$this->error('处理失败');
						}
					}
				}
			}else{
				$this->error('暂无当前申请记录');
			}
		}
		/**
		 * 提现申请删除
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function applyDelete($id)
		{
			if($id){
				$model = Db::name('member_income')->where('id',$id)->where('type',2)->value('id');
				if(!$model){
					$this->error('当前记录不存在');
				}else{
					$results = Db::name('member_income')->delete($id);
					if($results){
						admin_log('提现申请删除');
						$this->success('删除成功');
					}else{
						$this->error('删除失败');
					}
				}
			}else{
				$this->error('请选择要删除的记录项');
			}
		}
		/**
		 * 余额调整
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function balanceEdit($id)
		{
			$this->assign('member_id',$id);
			$member = Db::name('member')->field('id,realname')->select();
			$this->assign('member',$member);
			return $this->fetch('balance_edit');
		}
		/**
		 * 更新余额
		 * @return [type] [description]
		 */
		public function balanceUpdate()
		{
			$member_id = input('post.member_id/d');
			$status = input('post.status/d');
			$money = input('post.money');
			if(!$member_id){
				$this->error('请选择所属会员');
			}else if(!preg_match('/^([1-9]\d*(\.\d*[1-9])?)|(0\.\d*[1-9])$/', $money)){
				$this->error('请输入正确的金额数');
			}else{
				$data = [
					'title'=>'系统调整',
					'member_id'=>$member_id,
					'money'=>$money,
					'create_time'=>time(),
					'status'=>1,
					'type'=>$status,
					'out_trade_no'=>time().rand(10000,99999),
				];
				$results = Db::name('member_recharge')->data($data)->insert();
				if($results){
					if($status == 1){
						Db::name('member')->where('id',$member_id)->setInc('balance',$money);
					}else{
						Db::name('member')->where('id',$member_id)->setDec('balance',$money);
					}
					admin_log('余额调整删除');
					$this->success('操作成功');
				}else{
					$this->error('操作失败');
				}
			}
		}
	}