<?php
	namespace app\admin\controller;
	use think\Db;

	class Wechat extends Base
	{
		/**
		 * 微信配置（废弃不再支持，改为文件配置，不让非专业人员修改）
		 * @return [type] [description]
		 */
		public function config()
		{
			die;
			if($this->request->isPost()){
				$data = input('post.');
				$type = $data['type'];
				unset($data['type']);
				$model = Db::name('wechat_config')->where('type',$type)->column('value','name');
				if(is_array($model)){
					foreach ($data as $k=>$v){
						$newData = ['name'=>$k,'value'=>$v,'type'=>$type];
						if(!isset($model[$k])){
							Db::name('wechat_config')->data($newData)->insert();
						}else{
							if($mdoel[$k] != $v){
								Db::name('wechat_config')->where('name',$k)->data($newData)->update();
							}
						}
					}
				}else{
					foreach ($data as $k=>$v){
						$newData[] = ['name'=>$k,'value'=>$v,'type'=>$type];
					}
					Db::name('wechat_config')->insertAll($newData);
				}
				cache("config_$type",NULL);
				$this->success('操作成功');
			}else{
				$group = [
					'wechat'      =>'公众号设置',
					'miniprogram' =>'小程序设置',
				];
				$this->assign('group',$group);
				$type = input('type','wechat');
				$this->assign("type",$type);
				$model = Db::name('wechat_config')->where('type',$type)->column('value','name');
				$this->assign('model',$model);
				return $this->fetch($type);
			}
		}
		/**
		 * 默认菜单列表
		 * @return [type] [description]
		 */
		public function menu()
		{
			// $buttons = [
			//     [
			//         "type" => "click",
			//         "name" => "今日歌曲",
			//         "key"  => "V1001_TODAY_MUSIC",
			//         "sub_button"=> []
			//     ],
			//     [
			//         "name"       => "菜单",
			//         "sub_button" => [
			//             [
			//                 "type" => "view",
			//                 "name" => "搜索",
			//                 "url"  => "http://www.soso.com/"
			//             ],
			//             [
			//                 "type" => "view",
			//                 "name" => "视频",
			//                 "url"  => "http://v.qq.com/"
			//             ],
			//             [
			//                 "type" => "click",
			//                 "name" => "赞一下我们",
			//                 "key" => "V1001_GOOD"
			//             ],
			//         ],
			//     ],
			// ];
			// $weixin = new \login\weixin\weixin;
			// $results = $weixin->createMenu($buttons);
			// dump($results);
			// array(2) {
			// 	["errcode"] => int(0)
			// 	["errmsg"] => string(2) "ok"
			// }
			$lists = Db::name('wechat_menu')->order('status desc')->paginate();
			$this->assign("lists",$lists);
			return $this->fetch();
		}
		/**
		 * 默认菜单编辑
		 * @param  integer $id [description]
		 * @return [type]      [description]
		 */
		public function menuModify($id = 0)
		{
			if($this->request->isAjax()){
				$menu = array_filter(json_decode(input('post.menu','','trim'),true));
				//return $menu['menu']['button'];
				$weixin = new \login\weixin\weixin;
				$results = $weixin->createMenu($menu['menu']['button']);
				if($results['errcode'] == 0){
					Db::name('wechat_menu')->where('id','<>',$id)->setField('status',0);
					$data['name'] = input('post.name');
					$data['data'] = json_encode($menu['menu']['button']);
					$data['status'] = 1;
					if($id){
						Db::name('wechat_menu')->data($data)->where('id',$id)->update();
					}else{
						Db::name('wechat_menu')->data($data)->insert();
					}
				}
				return json($results);
			}else{
				if($id){
					$model = Db::name('wechat_menu')->where('id',$id)->find();
					$menu['menu']['button'] = json_decode($model['data']);
					$this->assign('model',$model);
				}else{
					$menu['menu']['button'] = [];
				}
				$this->assign('menu',json_encode($menu));
				$this->assign('id',$id);
				$this->assign('v',time());
				$lists = Db::name('wechat_article')->select();
				$this->assign('lists',$lists);
				return $this->fetch();
			}
		}
		/**
		 * 设置菜单
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function menuEffective($id)
		{
			$model = Db::name('wechat_menu')->where('id',$id)->find();
			$button = json_decode($model['data']);
			$weixin = new \login\weixin\weixin;
			$results = $weixin->createMenu($button);
			if($results['errcode'] == 0){
				Db::name('wechat_menu')->where('id',"<>",$id)->setField('status',0);
				Db::name('wechat_menu')->where('id',$id)->setField('status',1);
				$this->success('设置成功');
			}else{
				$this->error('设置失败，错误代码：'.$results['errcode'].'，错误提示：'.$results['errmsg']);
			}
		}
		public function menuDelete($id)
		{
			if($id){
				$results = Db::name('wechat_menu')->delete($id);
				if($results){
					$this->success("成功删除");
				}else{
					$this->error("删除失败");
				}
			}else{
				$this->error("请选择需要删除的数据");
			}
		}
		/**
		 * 微信文章管理
		 * @return [type] [description]
		 */
		public function article()
		{
			$lists = Db::name('wechat_article')->order('order_id asc')->paginate();
			$this->assign("lists",$lists);
			return $this->fetch();
		}
		public function articleModify($id = 0)
		{
			if($id == 0){
				return $this->fetch();
			}else{
				$model = Db::name('wechat_article')->where('id',$id)->find();
				$this->assign('model',$model);
				return $this->fetch();
			}
		}
		public function articleUpdate()
		{
			$data = input('post.');
			$message = $this->validate(
	        	$data,
	        	'\app\admin\validate\Wechat.article'
	        );
	        if($message !== true){
	        	$this->error($message);
	        }
			$id = input('post.id/d');
			if($id){
				$model = Db::name('wechat_article')->field('id')->where('id',$id)->find();
				if(!$model){
					$this->error('对不起暂无当前记录');
				}else{
					$results = Db::name('wechat_article')->update($data);
					if($results >= 0){
						$this->success('修改成功');
					}else{
						$this->error('修改失败');
					}
				}
			}else{
				$data['create_time'] = time();
				$results = Db::name('wechat_article')->data($data)->insert();
				if($results){
					$this->success('添加成功');
				}else{
					$this->error('添加失败');
				}
			}
		}
		public function articleDelete($id = 0)
		{
			if($id){
				$ids = explode(',',$id);
				$results = Db::name('wechat_article')->delete($ids);
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
		 * 关键字回复
		 * @return [type] [description]
		 */
		public function keywords()
		{
			$this->error('程序正在努力开发中');
		}
	}