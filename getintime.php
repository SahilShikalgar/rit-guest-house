 <?php

 	if(!empty($_POST))
	{
      require_once('connection.php');
	    $id=$_POST['id'];
      
      
      $con = mysqli_connect($host,$name,$pass,$db);
      
          $sql = "select * from rooms where id='$id'";
         $rows = mysqli_query($con,$sql);

     
      foreach($rows as $row) 
      {
  	  		echo json_encode(array("intime"=>$row['intime']));
  	  }
    }
 ?>