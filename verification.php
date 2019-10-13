<?php

	if(!empty($_POST))
	{
		$email=$_POST['email'];
    $session=$_POST['session'];
		require_once 'vendor/autoload.php';
    require_once('connection.php');

         $transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
            ->setUsername('ritguesthouse@gmail.com')
            ->setPassword('qwerty@123')
          ; 
               
          $con = mysqli_connect($host,$name,$pass,$db);

          $sql = "select * from emp where id='$session'"; //session
          $rows = mysqli_query($con,$sql);

          foreach ($rows as $row) {
                
            $mailer = new Swift_Mailer($transport);
            
            $otp = rand(100000,999999);


            mysqli_query($con,"update emp set otp='$otp' where id='$session'");

            $body = 'Hello, <p>OTP is : <span style="color:red;">'.$otp.'</span>.</p>';
             
            $message = (new Swift_Message('RIT GUEST HOUSE BOOKING | OTP VERIFICATION'))
              ->setFrom(['ritguesthouse@gmail.com' => 'RIT GUEST HOUSE'])
              ->setTo([$row['email']])
              ->setBody($body)
              ->setContentType('text/html')
            ;
             
            $mailer->send($message);
          }
     }
?>