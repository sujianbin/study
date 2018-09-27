<?php
	namespace app\admin\controller;
	use think\Db;

	class GoodsComment extends Base
	{
		public function index()
		{
			$username = input('username/s');
			if($username){
				$map[] = ['username','like',"%{$username}%"];
				$this->assign('username',$username);
			}
			$content = input('content/s');
			if($content){
				$map[] = ['content','like',"%{$content}%"];
				$this->assign('content',$content);
			}
			$lists = Db::name('orders_assess')->where('parent_id',0)->where($map)->order('create_time desc')->paginate();
			$this->assign("lists",$lists);
			return $this->fetch();
		}
		public function modify($id = 0)
		{
			if($id){
				$model = Db::name('orders_assess')->where('id',$id)->find();
				if($model){
					$reply = Db::name('orders_assess')->where('parent_id',$id)->order('create_time desc')->select();
					$this->assign('model',$model);
					$this->assign('reply',$reply);
					return $this->fetch();
				}else{
					$this->error("不存在当前记录");
				}
			}else{
				$this->error("不存在当前记录");
			}
		}
		public function update()
		{
			$id = input('post.id/d');
			$model = Db::name('orders_assess')->where('id',$id)->find();
			if($model){
				$add['parent_id'] = $id;
	            $add['content'] = trim(input('post.content'));
	            $add['goods_id'] = $model['goods_id'];
	            $add['goods_name'] = $model['goods_name'];
	            $add['orders_id'] = $model['orders_id'];
	            $add['create_time'] = time();
	            $add['username'] = 'admin';
	            $add['is_show'] = 1;
	            $add['ip_address'] = $this->request->ip();
	            empty($add['content']) && $this->error('请填写回复内容');
	            $results =  Db::name('orders_assess')->data($add)->insert();
	            if($results){
	                $this->success('回复成功');
	            }else{
	                $this->error('回复失败');
	            }
			}else{
				$this->error("不存在当前记录");
			}
		}
		public function delete($id)
		{
			if($id){
				$ids = explode(',',$id);
				$results = Db::name('orders_assess')->delete($ids);
				//删除对应回复
				Db::name('orders_assess')->whereIn('parent_id',$id)->delete();
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