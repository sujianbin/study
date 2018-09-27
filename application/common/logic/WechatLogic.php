<?php
	namespace app\common\logic;
	use EasyWeChat\Factory;

	class WechatLogic
	{
		public function wxLogin()
		{
	        $config = $this->getConfig();
	        $app = Factory::officialAccount($config);
	        $oauth = $app->oauth;
	        $oauth->redirect()->send();
		}
		public function jssdk($APIs,$debug = false){
			$config = $this->getConfig();
	        $app = Factory::officialAccount($config);
	        return $app->jssdk->buildConfig($APIs, $debug, $beta = false, $json = true);
		}
		public function getAccessToken($flag = false)
		{
			$config = $this->getConfig();
	        $app = Factory::officialAccount($config);
	        $accessToken = $app->access_token;
	        $token = $accessToken->getToken($flag); // token 数组  token['access_token'] 字符串
			//$token = $accessToken->getToken(true); // 强制重新从微信服务器获取 token.
	        return $token['access_token'];
		}
		/**
		 * 发送模板消息
		 * @param  [type] $openid      [description]
		 * @param  [type] $template_id [description]
		 * @param  [type] $data        [description]
		 * @param  string $url         [description]
		 * @return [type]              [description]
		 */
		public function templateMessage($openid,$template_id,$data,$url = '')
		{
			$config = $this->getConfig();
	        $app = Factory::officialAccount($config);
			$app->template_message->send([
				'touser'      => $openid,
				'template_id' => $template_id,
				'url'         => $url,
				'data'        => $data
    		]);
		}
		/**
		 * 获取配置
		 * @return [type] [description]
		 */
		public function getConfig()
		{
			$wxConfig = config_cache('wechat','wechat');
	        $config = [
				'app_id' => $wxConfig['wechat_appid'],
				'secret' => $wxConfig['wechat_appsecret'],
				'mch_id' => $wxConfig['wechat_mch_id'],
				'key'    => $wxConfig['wechat_key'],// API 密钥
				
	            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
	            'response_type' => 'array',

	            'log' => [
	                'level' => 'debug',
	                'file' =>  env('RUNTIME_PATH') . 'log/wechat/easywechat.log',
	            ],
	            
	            /**
	             * OAuth 配置
	             *
	             * scopes：公众平台（snsapi_userinfo / snsapi_base）
	             * callback：OAuth授权完成后的回调页地址
	             */
	            'oauth' => [
	                'scopes'   => ['snsapi_userinfo'],
	                'callback' => url('Login/loginCallback'),
	            ],
	        ];
	        return $config;
		}
	}