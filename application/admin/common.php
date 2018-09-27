<?php
	// 后台应用公共文件
	/**
	 * 后台操作日志
	 * @param  [type] $log_info [description]
	 * @return [type]           [description]
	 */
	function admin_log($log_info)
	{
		$log['admin_id'] = session('admin_id');
		$log['log_info'] = $log_info;
		$log['log_ip'] = request()->ip();
		$log['log_time'] = time();
		$log['log_url'] = request()->url();
		Db::table('admin_log')->insert($log);
	}
	/**
	 * 权限处资源类型
	 * @param  [type] $type [description]
	 * @return [type]       [description]
	 */
	function right_type($type)
	{
		switch ($type) {
			case 1:
				return '系统后台';
				break;
			case 2:
				return '商户平台';
				break;
			default:
				return '系统后台';
				break;
		}
	}
	/**
	 * 获取权限分组
	 * @return [type] [description]
	 */
	function right_group()
	{
		return [
			'system'  =>'系统设置',
			'content' =>'内容管理',
			'goods'   =>'商品中心',
			'member'  =>'会员中心',
			'orders'  =>'订单中心',
			'plugins' =>'插件管理',
		];
	}
	/**
	 * 获取顶部菜单
	 * @return [type] [description]
	 */
	function get_top_menu()
	{
		return [
			'system'  =>'系统管理',
			'content' =>'内容管理',
			'shop'    =>'商城管理',
			'plugin'  =>'插件管理'
		];
	}
	/**
	 * 根据角色获取对应菜单
	 * @param  [type] $rights [description]
	 * @return [type]         [description]
	 */
	function get_left_menu($rights)
	{
		$menu = get_all_menu();
		if($rights != 0 && is_array($menu)){
			$allRights = Db::name("system_right")->whereIn('id',$rights)->cache(!config('app_debug'))->column('right');
			$allRightsValue = '';
			if(is_array($allRights)){
				foreach ($allRights as $v){
					$allRightsValue .= ',' . $v;
				}
			}
			foreach ($menu as $k=>$v){
				foreach($v as $k1=>$v1){
					foreach ($v1['child'] as $k2=>$v2){
						if(strpos($allRightsValue,str_replace('/','@',$v2['url'])) === false){
							if(count($menu[$k][$k1]['child']) == 1){
								unset($menu[$k][$k1]);
							}else{
								unset($menu[$k][$k1]['child'][$k2]);
							}
						}
					}
				}
			}
		}
		return $menu;
	}
	/**
	 * 获取全部菜单
	 * @return [type] [description]
	 */
	function get_all_menu()
	{
		return [
			//系统管理
			'system'=>[
				'system'=>[
					'title' =>'系统管理',
					'icon'  =>'system',
					'child' =>[
						['title' =>'网站基本设置','url'=>'Config/index']
					]
				],
				'admin'=>[
					'title' =>'权限管理',
					'icon'  =>'menu',
					'child' =>[
						['title' =>'管理员管理','url'=>'Admin/admin'],
						['title' =>'管理员日志','url'=>'Admin/adminLog'],
						['title' =>'角色管理','url'=>'Admin/role'],
						['title' =>'权限资源管理','url'=>'System/right']
					]
				]
			],
			//内容管理
			'content'=>[
				'banner'=>[
					'title' =>'首页轮播图管理',
					'icon'  =>'item',
					'child' =>[
						['title' =>'轮播图列表','url'=>'Banner/index'],
						['title' =>'添加轮播图','url'=>'Banner/modify']
					]
				],
				'link'=>[
					'title' =>'友情链接管理',
					'icon'  =>'item',
					'child' =>[
						['title' =>'友情链接列表','url'=>'Link/index'],
						['title' =>'添加友情链接','url'=>'Link/modify']
					]
				],
				'comment'=>[
					'title' =>'在线留言管理',
					'icon'  =>'item',
					'child' =>[
						['title' =>'在线留言列表','url'=>'Comment/index']
					]
				]
			],
			//商城
			'shop'=>[
				'goods' =>[
					'title' =>'商品管理',
					'icon'  =>'menu',
					'child' =>[
						['title' =>'商品列表','url'=>'Goods/index'],
						['title' =>'商品分类','url'=>'Goods/category'],
						['title' =>'商品模型','url'=>'Goods/model'],
						['title' =>'商品规格','url'=>'Goods/spec'],
						['title' =>'商品属性','url'=>'Goods/attribute'],
						['title' =>'品牌列表','url'=>'Brand/index'],
						['title' =>'评价列表','url'=>'GoodsComment/index']
					]
				],
				'orders' =>[
					'title' =>'订单中心',
					'icon'  =>'menu',
					'child' =>[
						['title' =>'订单列表','url'=>'Orders/index'],
						['title' =>'订单日志','url'=>'Orders/log']
					]
				],
				'promotions' =>[
					'title' =>'促销管理',
					'icon'  =>'menu',
					'child' =>[
						['title' =>'抢购列表','url'=>'Promotions/index'],
						['title' =>'优惠券','url'=>'Promotions/coupon']
					]
				],
				'member'=>[
					'title' =>'会员管理',
					'icon'  =>'item',
					'child' =>[
						['title' =>'会员列表','url'=>'Member/index'],
						['title' =>'充值记录列表','url'=>'Member/recharge'],
						['title' =>'会员收益列表','url'=>'Member/profit'],
						['title' =>'提现申请列表','url'=>'Member/apply'],
					]
				],
				'report'=>[
					'title' =>'数据统计',
					'icon'  =>'menu',
					'child' =>[
						['title' =>'销售排行','url'=>'Report/goods'],
						['title' =>'会员排行','url'=>'Report/member'],
						['title' =>'会员统计','url'=>'Report/memberReport']
					]
				]
			],
			//插件
			'plugin'=>[
				'wechat'=>[
					'title' =>'微信管理',
					'icon'  =>'menu',
					'child' =>[
						//['title' =>'微信设置','url'=>'Wechat/config'],
						['title' =>'微信菜单','url'=>'Wechat/menu'],
						['title' =>'微信文章','url'=>'Wechat/article'],
						['title' =>'关键字回复','url'=>'Wechat/keywords']
					]
				],
				'database'=>[
					'title'=>'数据库管理',
					'icon'=>'item',
					'child'=>[
						['title' =>'数据库备份','url'=>'Database/index'],
						['title' =>'数据库还原','url'=>'Database/restore']
					]
				],
				'plugin'=>[
					'title' =>'第三方插件',
					'icon'  =>'item',
					'child' =>[
						['title' =>'插件库列表','url'=>'Plugin/index'],
						['title' =>'模块管理','url'=>'Module/index']
					]
				]
			]
		];
	}
	/**
	 * 格式化字节大小
	 * @param  number $size      字节数
	 * @param  string $delimiter 数字和单位分隔符
	 * @return string            格式化后的带单位的大小
	 */
	function format_bytes($size, $delimiter = '')
	{
		$units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
		for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
		return round($size, 2) . $delimiter . $units[$i];
	}
	/**
	 * 递归删除文件夹
	 * @param  [type]  $path   [description]
	 * @param  boolean $delDir [description]
	 * @return [type]          [description]
	 */
	function del_file($path,$delDir = FALSE) {
	    if(!is_dir($path))
	        return FALSE;		
		$handle = @opendir($path);
		if ($handle) {
			while (false !== ( $item = readdir($handle) )) {
				if ($item != "." && $item != "..")
					is_dir("$path/$item") ? del_file("$path/$item", $delDir) : unlink("$path/$item");
			}
			closedir($handle);
			if ($delDir) return rmdir($path);
		}else {
			if (file_exists($path)) {
				return unlink($path);
			} else {
				return FALSE;
			}
		}
	}
	/**
	 * 属性录入方式
	 * @param  [type] $type [description]
	 * @return [type]       [description]
	 */
	function attr_input_type($type)
	{
		if($type == 1){
			return '下拉选择';
		}else if($type ==2){
			return '多行文本';
		}else{
			return '手动录入';
		}
	}
	/**
	 * 下拉值（用于属性值）
	 * @param  [type] $value [description]
	 * @return [type]        [description]
	 */
	function option_val($value,$val)
	{
		$arr= '';
		$tmp_option_val = explode(PHP_EOL,$value);
        foreach($tmp_option_val as $k=>$v){
        	if($v == $val){
        		$arr .= "<option value='{$v}' selected>{$v}</option>";
        	}else{
        		$arr .= "<option value='{$v}'>{$v}</option>";
        	}
        	
        }
        return $arr;
	}
	/**
	 * 规格item是否选中
	 * @param  [type] $key [description]
	 * @param  [type] $arr [description]
	 * @return [type]      [description]
	 */
	function spec_checked($key,$arr){
		if(in_array($key,$arr)){
			return 'btn-current';
		}
		return;
	}
	/**
	 * 计算数组的笛卡尔积
	 * @return [type] [description]
	 */
	function combineDika() {
		$data = func_get_args();
		$data = current($data);
		$cnt = count($data);
		$result = array();
	    $arr1 = array_shift($data);
		foreach($arr1 as $key=>$item) 
		{
			$result[] = array($item);
		}		

		foreach($data as $key=>$item) 
		{                                
			$result = combineArray($result,$item);
		}
		return $result;
	}
	/**
	 * 两个数组的笛卡尔积
	 * @param  [type] $arr1 [description]
	 * @param  [type] $arr2 [description]
	 * @return [type]       [description]
	 */
	function combineArray($arr1,$arr2) {		 
		$result = array();
		foreach ($arr1 as $item1) 
		{
			foreach ($arr2 as $item2) 
			{
				$temp = $item1;
				$temp[] = $item2;
				$result[] = $temp;
			}
		}
		return $result;
	}
	/**
	 * 价格合计
	 * @param  [type] $goods_num   [description]
	 * @param  [type] $goods_price [description]
	 * @return [type]              [description]
	 */
	function goods_price($goods_num,$goods_price)
	{
		return round($goods_price*$goods_num,2);
	}
	/**
	 * 支付类型显示
	 * @param  [type] $is_pay   [description]
	 * @param  [type] $pay_type [description]
	 * @return [type]           [description]
	 */
	function pay_type_show($is_pay,$pay_type)
	{
		if($is_pay == 1){
			if($pay_type == 2){
				return '微信支付'; 
			}else{
				return '余额支付';
			}
		}else{
			return '--';
		}
	}
	/**
	 * 发票显示
	 * @param  [type] $is_invoice     [description]
	 * @param  [type] $invoice_header [description]
	 * @param  [type] $invoice_meg    [description]
	 * @return [type]                 [description]
	 */
	function invoice_show($is_invoice,$invoice_header,$invoice_meg)
	{
		$arr = '是否需要发票：';
		if($is_invoice == 1){
			$arr .= '是'.chr(10).'发票开头：'.$invoice_header.chr(10).'发票内容：'.$invoice_meg;
		}else{
			$arr .= '否';
		}
		return $arr;
	}
	/**
	 * 地址显示
	 * @param  [type] $name         [description]
	 * @param  [type] $phone        [description]
	 * @param  [type] $address      [description]
	 * @param  [type] $address_info [description]
	 * @return [type]               [description]
	 */
	function address_show($name,$phone,$address,$address_info)
	{
		$arr = "联系人：{$name}".chr(10)."联系电话：{$phone}".chr(10)."地址：{$address}".chr(10)."详细地址：{$address_info}";
		return $arr;
	}
	/**
	 * 反馈图集列表展示
	 * @param  [type] $pic [description]
	 * @return [type]      [description]
	 */
	function attach_show($pic)
	{
		$pic = explode(';',$pic);
		$html = '<ul style="text-align:center;width:100%;overflow:hidden;font-size:0;">';
		foreach ($pic as $k=>$v){
			$html .= '<li style="display:inline-block;text-align:center;;margin-left:5px;"><a href="'.$v.'" target="_blank"><img src="'.$v.'" width="100" height="80"/></a></li>';
		}
		$html .= '</ul>';
		return $html;
	}
	/**
	 * 单图显示
	 * @param  [type] $value [description]
	 * @param  [type] $field [description]
	 * @return [type]        [description]
	 */
	function pic_show($value,$field)
	{
		if(!empty($value)){
			return '<li class="file">
                <div class="file-panel">
                    <span class="cancel">删除</span>
                </div>
                <div class="img">
                    <img src="'.$value.'" alt="">
                </div>
                <input type="hidden" name="'.$field.'" value="'.$value.'" />
            </li>';
		}else{
			return null;
		}
	}