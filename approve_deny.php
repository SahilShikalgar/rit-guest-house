<?php

  if(!empty($_POST))
  {
    $op=$_POST['op'];
    $id=$_POST['id'];
    $session=$_POST['session'];
    if($op=="approve")
    {
          require_once('connection.php');
          $con = mysqli_connect($host,$name,$pass,$db);

          require_once 'vendor/autoload.php';
                                              
          $transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
            ->setUsername('ritguesthouse@gmail.com')
            ->setPassword('qwerty@123')
          ; 
               
            $mailer = new Swift_Mailer($transport);

            $sql2 = "select * from requests where id='$id'";
            $rows2 = mysqli_query($con,$sql2);

            $sql3 = "delete from requests where id='$id'";
            mysqli_query($con,$sql3);

            foreach ($rows2 as $row2) {

               $session = $row2['request_by'];
               $guest = $row2['guest_name'];
               $number = $row2['number'];
               $sql = "select * from emp where id='$session'"; //session
               $rows = mysqli_query($con,$sql);

               foreach ($rows as $row) {
                
                $room_no = $row2['number'];
                $intime = $row2['intime'];
                $outtime = $row2['outtime'];
                $booking_price = $row2['booking_price'];

                 $sql5 = "update rooms set status='1',intime='$intime',out_time='$outtime',guest_name='$guest',bookedby='$session',booking_price='$booking_price' where number='$number'";

                 mysqli_query($con,$sql5);

                $body = "<div>Your booking request is accepted ....</div><br>
                <div>Room No : '$room_no'</div><br><div>In Date : '$intime'</div><br>
                <div>Out Date : '$outtime'</div>";
                 
                $message = (new Swift_Message('RIT GUEST HOUSE BOOKING'))
                  ->setFrom(['ritguesthouse@gmail.com' => 'RIT GUEST HOUSE'])
                  ->setTo([$row['email']])
                  ->setBody($body)
                  ->setContentType('text/html')
                ;
                 
                $mailer->send($message);
              }
            }
      }
      else
      {
               require_once('connection.php');
          $con = mysqli_connect($host,$name,$pass,$db);

          require_once 'vendor/autoload.php';
                                              

          $transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
            ->setUsername('ritguesthouse@gmail.com')
            ->setPassword('qwerty@123')
          ; 
               
            $mailer = new Swift_Mailer($transport);

            $sql2 = "select * from requests where id='$id'";
            $rows2 = mysqli_query($con,$sql2);

            $sql3 = "delete from requests where id='$id'";
            mysqli_query($con,$sql3);
            

            foreach ($rows2 as $row2) {

               $session = $row2['request_by'];
               $sql = "select * from emp where id='$session'"; //session
               $rows = mysqli_query($con,$sql);

               foreach ($rows as $row) {
                
                $room_no = $row2['number'];
                $intime = $row2['intime'];
                $outtime = $row2['outtime'];
              
                $sql6 = "update rooms set status='0',intime='0000-00-00',out_time='0000-00-00',guest_name='',bookedby='' where number='$room_no'";
                
               mysqli_query($con,$sql6);
                
                $body = "<div>Your booking request is denied for room number '$room_no'</div>";
                 
                $message = (new Swift_Message('RIT GUEST HOUSE BOOKING'))
                  ->setFrom(['ritguesthouse@gmail.com' => 'RIT GUEST HOUSE'])
                  ->setTo([$row['email']])
                  ->setBody($body)
                  ->setContentType('text/html')
                ;
                 
                $mailer->send($message);
              }
            }
      }
  }

?>