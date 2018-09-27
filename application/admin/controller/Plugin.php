<?php
	namespace app\admin\controller;
	use think\Db;

	class Plugin extends Base
	{
		public function index()
		{
			$lists = Db::name('plugin')->order('order_id asc')->select();
			$this->assign('lists',$lists);
			return $this->fetch();
		}
		public function modify($id)
		{
			$model = Db::name('plugin')->where('id',$id)->find();
			$model['config'] = $this->config($model['code'],$model['type']);
			$model['data'] = unserialize($model['data']);
			$this->assign('model',$model);
			return $this->fetch();
		}
		public function update()
		{
			$id = input('post.id/d');
			$model = Db::name('plugin')->where('id',$id)->find();
			if($model){
				$config = $this->config($model['code'],$model['type']);
				$data = input('post.');
				$data = serialize($data);
				$update = [
					'data'    =>$data,
					'name'    =>$config['name'],
					'desc'    =>$config['desc'],
					'code'    =>$config['code'],
					'version' =>$config['versin'],
					'author'  =>$config['author'],
					'icon'    =>$config['icon'],
				];
				$results = Db::name('plugin')->data($update)->where('id',$id)->update();
				if($results){
					$this->success('操作成功');
				}else{
					$this->success('保存失败');
				}
			}else{
				$this->error('不存在当前插件');
			}
		}
		/**
		 * 获取配置参数
		 * @param  [type] $name [description]
		 * @param  [type] $type [description]
		 * @return [type]       [description]
		 */
		private function config($name,$type)
		{
			if($type == 'payment'){//支付
				if($name == 'weixin'){//微信支付
					$data = [
						'code'   =>'weixin',
						'name'   =>'微信支付',
						'desc'   =>'微信支付,包含扫码支付和js支付',
						'versin' =>'1.0',
						'author' =>'sujianbin',
						'icon'   =>'/public/static/plugins/plugin/image/payment_weixin.jpg',
						'config' =>[
							['name'=>'appid','type'=>'text','msg'=>'绑定的微信公众号appid'],
							['name'=>'appsecrect','type'=>'text','msg'=>'微信公众号密匙，使用微信js支付必须'],
							['name'=>'mchid','type'=>'text','msg'=>'商户id'],
							['name'=>'key','type'=>'text','msg'=>'商户密匙'],
							['name'=>'smchid','type'=>'text','msg'=>'服务商户号，用于企业付款'],
						],
					];
				}else if($name == 'alipay'){//支付宝支付
					$data = [
						'code'   =>'alipay',
						'name'   =>'支付宝支付',
						'desc'   =>'支付宝电脑、手机支付',
						'versin' =>'1.0',
						'author' =>'sujianbin',
						'icon'   =>'/public/static/plugins/plugin/image/payment_alipay.jpg',
						'config' =>[
							['name'=>'app_id','type'=>'text','msg'=>'应用ID'],
							['name'=>'sign_type','type'=>'text','msg'=>'签名方式默认RSA2'],
							['name'=>'alipay_public_key','type'=>'textarea','msg'=>'支付宝公钥'],
							['name'=>'merchant_private_key','type'=>'textarea','msg'=>'商户私钥'],
							['name'=>'charset','type'=>'text','msg'=>'编码格式默认UTF-8'],
							//['name'=>'alipay_pay_method','type'=>'select','msg'=>'接口类型','option'=>['1'=>'使用担保交易接口','2'=>'使用即时到帐交易接口']],
						],
					];
				}
			}else if($type == 'login'){//授权登陆
				if($name == 'weixin'){//微信授权
					$data = [
						'code'   =>'weixin',
						'name'   =>'微信授权登陆',
						'desc'   =>'微信授权',
						'versin' =>'1.0',
						'author' =>'sujianbin',
						'icon'   =>'/public/static/plugins/plugin/image/login_weixin.png',
						'config' =>[
							['name'=>'appid','type'=>'text','msg'=>'微信公众号appid'],
							['name'=>'appsecrect','type'=>'text','msg'=>'微信公众号密匙'],
							['name'=>'appcallback','type'=>'text','msg'=>'授权回调地址，非专业人员请不要随意更改'],
							['name'=>'appscopes','type'=>'select','msg'=>'授权类型','option'=>['snsapi_userinfo'=>'弹窗授权','snsapi_base'=>'静默授权']],
							['name'=>'appsubscribe','type'=>'select','msg'=>'是否需要关注，需要则会在用户授权时，提示用户先进行关注公众号','option'=>['0'=>'否','1'=>'是']],
							['name'=>'appsubscribetype','type'=>'select','msg'=>'用户引导逻辑实现方式','option'=>['0'=>'系统跳转页面','1'=>'返回数据后程序开发']],
							['name'=>'appsubscribeurl','type'=>'text','msg'=>'引导用户扫描二维码关注页面，非专业人员请不要随意更改'],
						],
					];
				}else if($name == 'miniprogram'){//小程序授权
					$data = [
						'code'   =>'miniprogram',
						'name'   =>'微信小程序授权登陆',
						'desc'   =>'微信小程序授权',
						'versin' =>'1.0',
						'author' =>'sujianbin',
						'icon'   =>'/public/static/plugins/plugin/image/login_miniprogram.jpg',
						'config' =>[
							['name'=>'appid','type'=>'text','msg'=>'微信小程序appid'],
							['name'=>'appsecrect','type'=>'text','msg'=>'微信小程序密匙'],
						],
					];
				}else if($name == 'qq'){//qq授权
					$data = [
						'code'   =>'qq',
						'name'   =>'qq授权登陆',
						'desc'   =>'qq授权',
						'versin' =>'1.0',
						'author' =>'sujianbin',
						'icon'   =>'/public/static/plugins/plugin/image/login_qq.png',
						'config' =>[
							['name'=>'appid','type'=>'text','msg'=>'APP ID'],
							['name'=>'appkey','type'=>'text','msg'=>'APP Key'],
							['name'=>'appcallback','type'=>'text','msg'=>'回调地址'],
						],
					];
				}
			}else if($type == 'sms'){//短信接口
				if($name == 'aliyundy'){//阿里大于
					$data = [
						'code'   =>'aliyundy',
						'name'   =>'阿里大于',
						'desc'   =>'阿里云大于短信',
						'versin' =>'1.0',
						'author' =>'sujianbin',
						'icon'   =>'/public/static/plugins/plugin/image/sms_aliyundy.jpg',
						'config' =>[
							['name'=>'accessKeyId','type'=>'text','msg'=>'accessKeyId'],
							['name'=>'accessKeySecret','type'=>'text','msg'=>'accessKeySecret'],
						],
					];
				}
			}
			return $data;
		}
	}