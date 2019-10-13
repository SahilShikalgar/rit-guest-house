<?php

  if(!empty($_POST))
  {
    $id=$_POST['id'];
    $session=$_POST['session'];

    require_once('connection.php');
    $con = mysqli_connect($host,$name,$pass,$db);

    require_once 'vendor/autoload.php';
        

    $transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
      ->setUsername('ritguesthouse@gmail.com')
      ->setPassword('qwerty@123')
    ; 
         

    $sql = "select * from emp where id='$session'"; //session
    $rows = mysqli_query($con,$sql);

    foreach ($rows as $row) {
          
      $mailer = new Swift_Mailer($transport);

      $body = '<div>Booking request has been sent to admin successfully ! you will be notified soon on your email ...</div>
      ';
       
      $message = (new Swift_Message('RIT GUEST HOUSE BOOKING'))
        ->setFrom(['ritguesthouse@gmail.com' => 'RIT GUEST HOUSE'])
        ->setTo([$row['email']])
        ->setBody($body)
        ->setContentType('text/html')
      ;
       
      $mailer->send($message);
    }
  }
?>