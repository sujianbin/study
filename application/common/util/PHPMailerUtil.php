<?php
	namespace app\common\util;
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	class PHPMailerUtil
	{
		public function sendEmail($to,$subject,$content)
		{
			$smtp = config_cache('config.smtp');
		    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		    try {
		        //Server settings
		        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		        $mail->CharSet  = 'UTF-8';
		        $mail->isSMTP();                                      // Set mailer to use SMTP
		        $mail->Host = $smtp['smtp_server'];                   // Specify main and backup SMTP servers
		        $mail->SMTPAuth = true;                               // Enable SMTP authentication
		        $mail->Username = $smtp['smtp_user'];                 // SMTP username
		        $mail->Password = $smtp['smtp_pwd'];                  // SMTP password
		        
		        if($smtp['smtp_port'] == 465){
		            $mail->SMTPSecure = 'ssl';                        // Enable TLS encryption, `ssl` also accepted
		        }else{
		            $mail->SMTPSecure = 'tls';                        // Enable TLS encryption, `ssl` also accepted
		        }
		        $mail->Port = $smtp['smtp_port'];                     // TCP port to connect to
		        
		        //Recipients
		        $mail->setFrom($smtp['smtp_user'],$smtp['smtp_name']);//sender
		        //$mail->addAddress('joe@example.net', 'Joe User');   // Add a recipient
		        if(is_array($to)){
		            foreach ($to as $v){
		                $mail->addAddress($v);                        // Name is optional
		            }
		        }else{
		            $mail->addAddress($to);                           // Name is optional
		        }
		        //$mail->addAddress('sujianbin891547860@163.com');   
		        //$mail->addReplyTo('891547860@qq.com', '苏剑斌');
		        //$mail->addCC('cc@example.com');
		        //$mail->addBCC('bcc@example.com');
		        
		        //Attachments
		        //$mail->addAttachment('/var/tmp/file.tar.gz');        // Add attachments
		        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name
		        
		        //Content
		        $mail->isHTML(true);                                   // Set email format to HTML
		        $mail->Subject = $subject;
		        $mail->Body    = $content;
		        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		        $mail->send();
		        return ['code'=>0,'desc'=>'发送成功'];
		    } catch (Exception $e) {
		        return ['code'=>100,'desc'=>$mail->ErrorInfo];
		    }
		}
	}