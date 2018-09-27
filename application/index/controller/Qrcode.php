<?php
namespace app\index\controller;
use think\Controller;
use Endroid\QrCode\QrCode as EndroidQrcode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;

class Qrcode extends Controller
{
	public function index()
	{
		return $this->fetch();
	}
	public function basic()
	{
		$EndroidQrcode = new EndroidQrcode('this is basic');
		header('Content-Type: '.$EndroidQrcode->getContentType());
		echo $EndroidQrcode->writeString();
	}
	public function advanced()
	{
		$EndroidQrcode = new EndroidQrcode('this is advanced');
		$EndroidQrcode->setSize(300);
		// Set advanced options
		$EndroidQrcode->setWriterByName('png');
		$EndroidQrcode->setMargin(10);
		$EndroidQrcode->setEncoding('UTF-8');
		$EndroidQrcode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
		$EndroidQrcode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
		$EndroidQrcode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
		//$EndroidQrcode->setLabel('Scan the code', 16, __DIR__.'/../assets/fonts/noto_sans.otf', LabelAlignment::CENTER);
		$EndroidQrcode->setLogoPath(env('ROOT_PATH').'public/static/admin/images/logo.png');
		$EndroidQrcode->setValidateResult(false);
		// Directly output the QR code
		header('Content-Type: '.$EndroidQrcode->getContentType());
		echo $EndroidQrcode->writeString();

		// Save it to a file
		//$EndroidQrcode->writeFile(env('ROOT_PATH').'qrcode.png');
	}
}