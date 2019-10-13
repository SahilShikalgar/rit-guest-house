 <?php

 	if(!empty($_POST))
	{
      require_once('connection.php');
	    $otp=$_POST['otp'];
      $session = $_POST['session'];
      $con = mysqli_connect($host,$name,$pass,$db);
      $sql = "select * from emp where id='$session'";
      $rows = mysqli_query($con,$sql);
     
      foreach($rows as $row) 
      {
  	  		echo json_encode(array("otp"=>$row['otp']));
  	  }
    }
 ?>