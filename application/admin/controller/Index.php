<?php
	namespace app\admin\controller;
	use think\Db;

	class Index extends Base
	{
		public function index()
		{
			//获取上目录
			$topMenu = get_top_menu();
			$this->assign('topMenu',$topMenu);
			//获取左侧全部目录
			$leftMenu = get_left_menu(session('right'));
			$this->assign('leftMenu',$leftMenu);
			return $this->fetch();
		}
		public function home(){
			//获取当前登录用户的登录ip和时间
			$admin = Db::table('admin')->field('login_time,ip')->where('admin_id',session('admin_id'))->find();
			$this->assign("admin",$admin);
			//信息统计
			//会员总数
			$allMember = Db::name('member')->count();
			//待处理订单
			$orders = Db::name('orders')->where('status',1)->count();
			//商品总数
			$allProduct = Db::name('goods')->count();
			//今日统计
			$time = strtotime(date('Y-m-d 00:00:00',time()));
			//新增会员
			$addMember = Db::name('member')->where('create_time','>=',$time)->count();
			//新增订单
			$addOrders = Db::name('orders')->where('create_time','>=',$time)->count();
			//新增商品
			$addProduct = Db::name('goods')->where('create_time','>=',$time)->count();
			$info = [
				'allMember'  =>$allMember,
				'orders'     =>$orders,
				'allProduct' =>$allProduct,
				'addMember'  =>$addMember,
				'addOrders'  =>$addOrders,
				'addProduct' =>$addProduct,
				'time'       =>date('Y-m-d',time()),
			];
			$this->assign('info',$info);
			return $this->fetch();
		}
	}