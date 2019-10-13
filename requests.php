<?php
    session_start();   
  function go($path)
  {  
    header('Location: '.$path);
  }
  if(isset($_SESSION['admin']))
  {
    
  }
  else
  {
    go('login.php');
  }

  echo '  <script>
 var isNS = (navigator.appName == "Netscape") ? 1 : 0;
  if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
  function mischandler(){
   return false;
 }
  function mousehandler(e){
     var myevent = (isNS) ? e : event;
     var eventbutton = (isNS) ? myevent.which : myevent.button;
    if((eventbutton==2)||(eventbutton==3)) return false;
 }
 document.oncontextmenu = mischandler;
 document.onmousedown = mousehandler;
 document.onmouseup = mousehandler;
  </script>';
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/ico" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPpusLlY5H-8iN4iQDzpksh9gD_s5gC9sM2wdY1y2y1pgtsjmE" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript">

    function approve(id)
    {
        alert('click on OK button and wait for 5 sec to complete action ...');
          
          $.ajax({
            type: "POST",
            url: "approve_deny.php",
            data: {
              "id":id,
              "op":"approve",
              "session":<?php echo json_encode($_SESSION['admin']); ?>,
            },
            success:function(response){
                
                alert('Response sent to user');
                window.location.href="requests.php";

            }
          }); 
    }

    function deny(id)
    {
        alert('click on OK button and wait for 5 sec to complete action ...');
          
       $.ajax({
            type: "POST",
            url: "approve_deny.php",
            data: {
              "id":id,
              "op":"deny",
              "session":<?php echo json_encode($_SESSION['admin']); ?>,
            },
            success:function(response){
                alert('Response sent to User');
                window.location.href="requests.php";
            }
          }); 
    }
  </script>
    <style type="text/css">
    
    </style>
</head>
<body style="background-color:#f2f2f2">
  <nav class="mb-1 navbar navbar-expand-lg navbar-dark" style="background-color: #C52B2B;">
      <a class="navbar-brand" href="dashboard_admin.php">RIT Guest House</a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <spna class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbarSupportedContent-4" style="">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light" href="dashboard_admin.php">
              <i class="fa fa-home"></i> Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link waves-effect waves-light" href="requests.php">
              <i class="fa fa-bell"></i> Notifications
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light" href="logout.php">
              <i class="fa fa-sign-out"></i> Logout
            </a>
          </li>
          
        </ul>
      </div>
    </nav>  
    <?php  
      require_once('connection.php');
      $con = mysqli_connect($host,$name,$pass,$db);
      $sql = "select * from requests";
      $rows = mysqli_query($con,$sql);
    ?>
    <div class="container">
      <div class="row mt-5">
        <div class="col">
        <div class="table-responsive">    
          <table class="table table-hover table-bordered">

              <tr class="text-center" style="background-color: #E7C652; color: white; font-size: 18px;">
                <th>Room Number</th>
                <th>Guest Name</th>
                <th>Request By</th>
                <th>In Date</th>
                <th>Out Date</th>
                <th>Phone</th>
                <th>Approve</th>
                <th>Deny</th>
              </tr>
              <?php  
               foreach ($rows as $row) {

                $con = mysqli_connect($host,$name,$pass,$db);
                $id = $row['request_by'];
                $sql2 = "select * from emp where id='$id'";
                $rows2 = mysqli_query($con,$sql2);

                  foreach ($rows2 as $row2) {
                       echo "<tr class='text-center'>";
                       echo "<td>".$row['number']."</td>
                        <td>".$row['guest_name']."</td>
                        <td>".$row2['name']."</td>
                        <td>".$row['intime']."</td>
                        <td>".$row['outtime']."</td>
                        <td>".$row2['phone']."</td>";

                        $d = $row['id'];


                      $number = $row['number'];

                      $sql3 = "select * from rooms where number='$number'";
                      $rows3 = mysqli_query($con,$sql3);

                      foreach ($rows3 as $row3) {
                        if($row3['status'] == 1) {
                          echo '<td><button data-toggle="tooltip" title="Already Booked" class="btn btn-dark" disabled onclick="approve(\''.$d.'\')">Approve</button>';
                          echo '<td><button class="btn btn-danger" onclick="deny(\''.$d.'\')">Deny</button>';
                        }
                        else {
                          echo '<td><button class="btn btn-dark" onclick="approve(\''.$d.'\')">Approve</button>';
                          echo '<td><button class="btn btn-danger" onclick="deny(\''.$d.'\')">Deny</button>';
                        }
                      }
                      
                      echo "</tr>"; 
                  }
                }
              ?>
          </table>
         </div>
        </div>
      </div>
    </div>
</body>
</html>