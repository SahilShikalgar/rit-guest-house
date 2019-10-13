<?php  
	if(isset($_POST))
	{
		require_once('connection.php');
	    $id = $_REQUEST['room_id1'];
	    $con = mysqli_connect($host,$name,$pass,$db);
	    $sql = "update rooms set status='0',intime='0000-00-00',out_time='0000-00-00',guest_name='',bookedby='' ,booking_price='' where id='$id'";
	    $res = mysqli_query($con,$sql);

	    echo "<script>window.location='dashboard_admin.php'</script>";
	}
	else
	{
	    echo "<script>window.location='login.php'</script>";
	}
?>