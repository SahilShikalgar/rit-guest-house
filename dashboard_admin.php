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
  <title>Guest House Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/ico" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPpusLlY5H-8iN4iQDzpksh9gD_s5gC9sM2wdY1y2y1pgtsjmE" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" type="text/css" href="dashboard.css">
	<script type="text/javascript" src="dashboard.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <style type="text/css">
    
  </style>
  <script type="text/javascript">

    function show1()
    {
      var id = document.getElementById('room_id').value; 
    }

    function show(id)
    {
        document.getElementById('room_id').value = id;
        var component = '#'+ id;
        $('#price_id').val($(component).val());
    }

    function show0(id)
    {
        document.getElementById('room_id1').value = id;
        
          $.ajax({
            type: "POST",
            url: "getintime.php",
            data: {
              "id":id
            },
            success:function(response){
              var json_obj = $.parseJSON(response);
              $('#date3').val(json_obj.intime);
            }
          });  
    }

    function onLoad() 
    {
      var input = document.getElementById("date1");
      var input2 = document.getElementById("date2");
      var input3 = document.getElementById("date3");
      var input4 = document.getElementById("date4");

      var today = new Date();
      
      var day = new String(today.getDate());
      var mon = new String(today.getMonth()+1);
      var yr = today.getFullYear();

        if(day.length < 2) { day = "0" + day; }
        if(mon.length < 2) { mon = "0" + mon; }

        var date = new String( yr + '-' + mon + '-' + day );

      input.setAttribute('value',date);
      input.setAttribute('min', date);

      input2.setAttribute('value',date);
      input2.setAttribute('min', date);
      input3.setAttribute('value',date);
      input3.setAttribute('max', date);
      
      input4.setAttribute('value',date);
      input4.setAttribute('max', date);
    }

    function change()
    {
       var input = document.getElementById("date1");
       var input2 = document.getElementById("date2");

       input2.setAttribute('value',input.value);
       input2.setAttribute('min', input.value);
    }
    
    function change2()
    {
       var input = document.getElementById("date3");
       var input2 = document.getElementById("date4");

       input.setAttribute('value',input2.value);
       input.setAttribute('max', input2.value);
    }

    function OTP()
    {
      document.getElementById('otp_btn').disabled=true;
      document.getElementById('msg').style.display="block";
    
      var email=$('#eml').val();

      
      $.ajax({
            type: "POST",
            url: "verification.php",
            data: {
              "email":email,
              "session":<?php echo json_encode($_SESSION['admin']); ?>,
            },
            success:function(response){
              if(response.trim()=='SUCCESS'){
                //alert("Data Submitted Successfully");
              }
              else
              {
                //alert("Data is not Submitted");
              }
            }
          }); 

      document.getElementById('otp').style.display="block";
      document.getElementById('verify').style.display="block";
    }

    function verify()
    {
      var enter_otp = document.getElementById('enter_otp').value;
      if(enter_otp.length!=6)
      {
        document.getElementById('valid_msg').style.display="block";
      }
      else
      {
        document.getElementById('valid_msg').style.display="none";
        $.ajax({
            type: "POST",
            url: "otp_verify.php",
            data: {
              "otp":enter_otp,
              "session":<?php echo json_encode($_SESSION['admin']); ?>,
            },
            success:function(response){
              var json_obj = $.parseJSON(response);
              console.log(json_obj.otp);
              if(json_obj.otp == enter_otp)
              {
                 document.getElementById('verify').disabled=true;
                 document.getElementById('enter_otp').readOnly =true;
                 document.getElementById('valid_msg').innerHTML="OTP verification done successfully";
                 document.getElementById('valid_msg').style.color='green';
                 document.getElementById('valid_msg').style.display="block";
                 document.getElementById('confirm').disabled=false;
              }
              else
              {
                document.getElementById('valid_msg').style.display="block";
              }
            }
          });  
      }
    }

    function removeMsg()
    {
        document.getElementById('valid_msg').style.display="none";
    }

/*****************************Release Room******************************/
    function OTP1()
    {
      document.getElementById('otp_btn1').disabled=true;
      document.getElementById('msg1').style.display="block";
    
      var email=$('#eml1').val();

      
      $.ajax({
            type: "POST",
            url: "verification.php",
            data: {
              "email":email,
              "session":<?php echo json_encode($_SESSION['admin']); ?>,
            },
            success:function(response){
              if(response.trim()=='SUCCESS'){
                //alert("Data Submitted Successfully");
              }
              else
              {
                //alert("Data is not Submitted");
              }
            }
          }); 

      document.getElementById('otp1').style.display="block";
      document.getElementById('verify1').style.display="block";
    }

    function verify1()
    {
      var enter_otp = document.getElementById('enter_otp1').value;
      if(enter_otp.length!=6)
      {
        document.getElementById('valid_msg1').style.display="block";
      }
      else
      {
        document.getElementById('valid_msg1').style.display="none";
        $.ajax({
            type: "POST",
            url: "otp_verify.php",
            data: {
              "otp":enter_otp,
              "session":<?php echo json_encode($_SESSION['admin']); ?>,
            },
            success:function(response){
              var json_obj = $.parseJSON(response);
              console.log(json_obj.otp);
              if(json_obj.otp == enter_otp)
              {
                 document.getElementById('verify1').disabled=true;
                 document.getElementById('enter_otp1').readOnly =true;
                 document.getElementById('valid_msg1').innerHTML="OTP verification done successfully";
                 document.getElementById('valid_msg1').style.color='green';
                 document.getElementById('valid_msg1').style.display="block";

                 document.getElementById('confirm1').style.display="block";
                 document.getElementById('confirm1').disabled=false;
                 
                // var win = window.open('report.php?id='+document.getElementById('room_id1').value, '_blank',"width=1920, height=1080");
                
                if (! window.focus)return true;
                var href;
                var mylink = 'report.php?id='+document.getElementById('room_id1').value + '&indate='+ $('#date3').val() + '&outdate='+ $('#date4').val();
                if (typeof(mylink) == 'string')
                href=mylink;
                else
                href=mylink.href;
                window.open(href, "_blank", 'width=1920, height=1080');
                
                setTimeout(function(){
                     $.ajax({
                      type: "POST",
                      url: "release.php",
                      data: {
                        "room_id1":document.getElementById('room_id1').value,
                        "session":<?php echo json_encode($_SESSION['admin']); ?>,
                      },
                      success:function(response){
                        window.location='dashboard_admin.php';
                      }
                    }); 
                },2000);
              
                return false;
              }
              else
              {
                document.getElementById('valid_msg1').style.display="block";
              }
            }
          });  
      }
    }

    function removeMsg1()
    {
        document.getElementById('valid_msg1').style.display="none";
    }

/* *****************************************password validation *************** */
var check = function() 
{
  if(true)
  {

    if(document.getElementById('cp1').value == document.getElementById('ps').value)
      {
        document.getElementById('msg2_cp').style.color = 'red';
        document.getElementById('msg2_cp').innerHTML = 'old and new password is same';
        document.getElementById('btn_cp').disabled=true;
      }
      else
      {
        document.getElementById('msg2_cp').style.color = 'green';
        document.getElementById('msg2_cp').innerHTML = '';
        document.getElementById('btn_cp').disabled=true;
      }

      if (document.getElementById('cp1').value == document.getElementById('cp2').value && document.getElementById('cp1').value!='') 
      {
        if(document.getElementById('cp1').value != document.getElementById('ps').value)
        {
          document.getElementById('btn_cp').disabled=false;
        }
        document.getElementById('msg_cp').style.color = 'green';
        document.getElementById('msg_cp').innerHTML = 'matching';
      } 
      else
      {
        document.getElementById('msg_cp').style.color = 'red';
        document.getElementById('msg_cp').innerHTML = 'not matching';
        document.getElementById('btn_cp').disabled=true;
      } 
   }
}

function loadSelect(id,price_arg) {
  var component = '#'+ id;
  var price = price_arg.toString();
  
  var double_plus = price.substring(0,4);
  var double = price.substring(4,8);
  var single = price.substring(8,12);
  
  $(component).append("<option>"+ single +"</option>");
  $(component).append("<option>"+ double +"</option>");
  $(component).append("<option>"+ double_plus +"</option>");
}


  </script>
</head>
<body class="" onload="onLoad()" style="background-color:#f2f2f2">
	<nav class="mb-1 navbar navbar-expand-lg navbar-dark" style="background-color: #C52B2B;">
      <a class="navbar-brand" href="dashboard_admin.php">RIT Guest House</a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <spna class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbarSupportedContent-4" style="">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link waves-effect waves-light" href="dashboard_admin.php">
              <i class="fa fa-home"></i> Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect waves-light" href="requests.php">
              <i class="fa fa-bell"></i> Notifications
            </a>
          </li>
          <li class="nav-item dropdown" id="drop">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" >
              <i class="fa fa-user"></i> Profile </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
              <a class="dropdown-item waves-effect waves-light" href="" data-toggle="modal" data-target="#myModal">Change Password</a>
              <a class="dropdown-item waves-effect waves-light" href="logout.php">Log out</a>
            </div>
          </li>
          
        </ul>
      </div>
    </nav>	

<div class="container">

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Change Password</h4><i id="close" class="fa fa-window-close fa-2x" style="color: #DE6262;" data-dismiss="modal"></i>
        </div>
        <div class="modal-body">
          <div class="row">
			<div class="col">
			<form action="dashboard_admin.php" method="post">    
          <div class="form-group"> 
            <label>Current Password</label>
            <div class="pass_show">
                  <input name="ps" id="ps" type="password" value="" class="form-control" placeholder="Current Password" required="" onkeyup="check();"> 
            </div>
          </div> 
              <div class="form-group"> 

                <label>New Password</label>
                <div class="pass_show">
                  <input id="cp1" name="cp1" type="password" value="" class="form-control" placeholder="New Password" required="" onkeyup="check();">
                  </div> 
                <span id="msg2_cp"></span>
              </div> 

              <div class="form-group"> 
                <label>Confirm Password</label>
                <div class="pass_show">
                  <input id="cp2" name="cp2" type="password" value="" class="form-control" placeholder="Confirm Password" required="" onkeyup="check();"> 
                </div>    
                <span id='msg_cp'></span>
              </div> 

              <button id="btn_cp" name="btn_cp" type="submit" class="btn b" disabled="">Change Password</button>
			</form>
			</div>  
		</div>
        </div>
        <div class="modal-footer">
          <small class="float-left">&copy; RIT Guest House , Sakhrale 415414</small>
        </div>
      </div>
      
    </div>
  </div>  
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12 p-3 text-white text-center" style="background-color: #E7C652;">
      <h4>AC Rooms</h4>
    </div>
    <?php
      require_once('connection.php');
      $con = mysqli_connect($host,$name,$pass,$db);
      $sql = "select * from rooms where type='AC'";
      $rows = mysqli_query($con,$sql);

      foreach ($rows as $row) {
    ?>
    <div class="col-lg-3 mt-3 mb-3">
      <div class="card-header head">
        Room Number : <?php echo $row['number'] ?>
      </div>
      <div class="card card-body">
      <table class="table table-hover">


        <tr><div><td>Room Type  </td><td><?php echo $row['type']; ?></td></div>
        </tr>

          <tr>
            <div class="">
              <td>Price (S/D) </td> 
              <td>
                <select class="form-control" id=<?php echo $row['number'];?>>
                </select>
                <script>
                  loadSelect(<?php echo $row['number'];?>,<?php print $row['price'];?>);
                </script>
              </td>
            </div>
          </tr>

         <?php 
          if($row['status']==1)
          {
              
            echo "<tr><div class=''><td>Booked by</td><td>".$row['bookedby']."</td></div></tr>";
            ?>
           
            <?php
          }
          else
          {
            
            echo "<tr style='background-color:#77cc6d; color:white'><td>Available </td><td>Yes</td></tr>";
          //  echo "<tr><div class=''><td>Out-time</td><td>".$row['out_time']."</td></div></tr>";
            //echo "<small class='mt-2 text-danger'>book another room</small>";
          }
        ?>
      </table>
      <?php 
      if($row['status']==1)
      {
          
        ?>
        
        <a onclick="show0(<?php echo $row['id']; ?>)" class="btn btn-secondary mt-3 text-white" data-toggle="modal" data-target="#myModal3" data-id="<?php echo $row['id'] ?>">Release</a>

       <?php
      }
      else
      {
        ?>
        
       <a onclick="show(<?php echo $row['number']; ?>)" class="btn btn-dark mt-3 text-white" data-toggle="modal" data-target="#myModal2" data-id="<?php echo $row['id'] ?>">Book</a>
        <?php  
      }
       ?>
      </div>
    </div>
    <?php 
      }
    ?>
  </div>
  <div class="row mb-5">
    <div class="col-md-12 p-3 text-white text-center" style="background-color: #E7C652;">
      <h4>NON-AC Rooms</h4>
    </div>
    <?php
      require_once('connection.php');
      $con = mysqli_connect($host,$name,$pass,$db);
      $sql = "select * from rooms where type='NON-AC'";
      $rows = mysqli_query($con,$sql);

      foreach ($rows as $row) {
    ?>
    <div class="col-lg-3 mt-3 mb-3">
      <div class="card-header head">
        Room Number : <?php echo $row['number'] ?>
      </div>
      <div class="card card-body">
      <table class="table table-hover">

        <tr><div><td>Room Type  </td><td><?php echo $row['type']; ?></td></div>
        </tr>


         <tr>
            <div class="">
              <td>Price (S/D) </td> 
              <td>
                <select class="form-control" id=<?php echo $row['number'];?>>
                </select>
                <script>
                  loadSelect(<?php echo $row['number'];?>,<?php print $row['price'];?>);
                </script>
              </td>
            </div>
          </tr>

         <?php 
          if($row['status']==0)
          {
            echo "<tr style='background-color:#77cc6d; color:white'><td>Available </td><td>Yes</td></tr>";
            ?>
           
            <?php
          }
          else
          {
            echo "<tr><div class=''><td>Booked by</td><td>".$row['bookedby']."</td></div></tr>";
          //  echo "<tr><div class=''><td>Out-time</td><td>".$row['out_time']."</td></div></tr>";
            //echo "<small class='mt-2 text-danger'>book another room</small>";
          }
        ?>
      </table>
      <?php 
      if($row['status']==0)
      {
        ?>
       <a onclick="show(<?php echo $row['number']; ?>)" class="btn mt-3 bg-dark text-white" data-toggle="modal" data-target="#myModal2" data-id="<?php echo $row['id'] ?>">Book</a>
       <?php
      }
      else
      {
        ?>
        <a onclick="show0(<?php echo $row['id']; ?>)" class="btn mt-3 bg-secondary text-white" data-toggle="modal" data-target="#myModal3" data-id="<?php echo $row['id'] ?>">Release</a>
        <?php  
      }
       ?>
      </div>
    </div>
    <?php 
      }
    ?>
  </div>
</div>

<!--Modal Book-->
<div class="container">

  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Book Room</h4><i id="close" class="fa fa-window-close fa-2x" style="color: #DE6262;" data-dismiss="modal"></i>
        </div>
        <div class="modal-body">
          <div class="row">

      <div class="col-md-6">
          <label>Email ID </label>
          <?php  
                require_once('connection.php');
                $session=$_SESSION['admin'];
                $con = mysqli_connect($host,$name,$pass,$db);

                $sql = "select * from emp where id='$session'"; //session
                $rows = mysqli_query($con,$sql);

                foreach ($rows as $row) {
                 
             ?>
              <div class="form-group"> 
                  <input type="email" class="form-control" name="eml" id="eml" readonly="" placeholder="" required="" value="<?php echo $row['email'] ?>"> 
              </div>
            <?php  
                }
            ?>
            <button class="btn b" onclick="OTP()" name="otp_btn" id="otp_btn">Generate OTP</button>
            <small id="msg" class="text-success" style="display: none">OTP sent successfully</small>
            <div style="display: none" id="otp">
              <label class="mt-3">Enter OTP</label>
              <div class="form-group"> 
                    <input name="enter_otp" id="enter_otp" type="number" maxlength="6" class="form-control" placeholder="Enter OTP" required="" value="" onkeyup="removeMsg()"> 
                  
                    <small class="" style="display: none; color: #d9534f;" id="valid_msg">Enter Valid OTP</small>
              </div>
            </div>
            <button class="btn b" style="display: none" name="verify" id="verify" onclick="verify()">Verify</button>
      </div>

      <div class="col-md-6"> 
        <form action="dashboard_admin.php" method="post">
            <input type="hidden" name="room_id" id="room_id"> 
            <input type="hidden" name="price_id" id="price_id"> 

            <label>In Date </label>
            <div class="form-group"> 
                  <input type="datetime-local" value="" class="form-control" placeholder="In Date" name="date1" id="date1" required="" onchange="change()"> 
              </div> 
             <label>Out Date(Tentative)</label>
              <div class="form-group"> 
                  <input type="date" name="date2" id="date2" value="" class="form-control" placeholder="Out Date" required=""> 
              </div> 
              
              <label>Guest Name</label>
              <div class="form-group"> 
                  <input type="text" name="guest" id="guest" value="" class="form-control" placeholder="Guest Name" required=""> 
              </div> 

              <button type="submit" class="btn b" name="confirm" id="confirm" onclick="show1()" disabled="">Confirm Booking</button>
            </form>
      </div>  
    </div>
        </div>
        <div class="modal-footer">
          <small class="float-left">&copy; RIT Guest House , Sakhrale 415414</small>
        </div>
      </div>
      
    </div>
  </div>  
</div>


<!--Modal Release-->
<div class="container">

  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog" style="margin-top: 60px;">
    
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Release Room</h4><i id="close" class="fa fa-window-close fa-2x" style="color: #DE6262;" data-dismiss="modal"></i>
        </div>
        <div class="modal-body">
          <div class="row">

      <div class="col-md-12">
        <label>Email ID </label>
          <?php  
                require_once('connection.php');
                $session=$_SESSION['admin'];
                $con = mysqli_connect($host,$name,$pass,$db);

                $sql = "select * from emp where id='$session'"; //session
                $rows = mysqli_query($con,$sql);

                foreach ($rows as $row) {
                 
             ?>
              <div class="form-group"> 
                  <input type="email" class="form-control" name="eml1" id="eml1" readonly="" placeholder="" required="" value="<?php echo $row['email'] ?>"> 
              </div>
            <?php  
                }
            ?>
            <button class="btn b" onclick="OTP1()" name="otp_btn1" id="otp_btn1">Generate OTP</button>
            <small id="msg1" class="text-success" style="display: none">OTP sent successfully</small>
             
            
            <div id="otp1" style="display: none">
                
                <div class="row mt-2">
                    <div class="col">
                    
                          <label>In Date </label>
                            <div class="form-group"> 
                                  <input type="date" class="form-control" placeholder="In Date" name="date3" id="date3" required=""> 
                            </div> 
                    </div>
                
                    <div class="col">
                        
                        <label>Out Date</label>
                         <div class="form-group"> 
                              <input type="date" name="date4" id="date4" value="" class="form-control" placeholder="Out Date" required="" onchange="change2()"> 
                          </div>
                    </div>
                </div>
                
              <label class="mt-3">Enter OTP</label>
              <div class="form-group"> 
                    <input name="enter_otp1" id="enter_otp1" type="number" maxlength="6" class="form-control" placeholder="Enter OTP" required="" value="" onkeyup="removeMsg1()"> 
                  
                    <small class="" style="display: none; color: #d9534f;" id="valid_msg1">Enter Valid OTP</small>
              </div>
            </div>
            <button class="btn b" style="display: none" name="verify1" id="verify1" onclick="verify1()">Verify</button>

        <form action="dashboard_admin.php" method="post">
             
             <input type="hidden" name="room_id1" id="room_id1"> 
            
             <button type="submit" class="btn b mt-3" name="confirm1" id="confirm1" onclick="show1()" disabled="" style="display : none">Release</button>
        </form>
      </div>
    </div>
        </div>
        <div class="modal-footer">
          <small class="float-left">&copy; RIT Guest House , Sakhrale 415414</small>
        </div>
      </div>
      
    </div>
  </div>  
</div>


<!--*************************************************************************-->

<div class="container">

  <div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog" style="margin-top: 60px;">
    
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Notifications / Requests</h4><i id="close" class="fa fa-window-close fa-2x" style="color: #DE6262;" data-dismiss="modal"></i>
        </div>
        <div class="modal-body">
          <div class="row">
             <div class="col">
       
             </div>
          </div>
        </div>
        <div class="modal-footer">
          <small class="float-left">&copy; RIT Guest House , Sakhrale 415414</small>
        </div>
      </div>
      
    </div>
  </div>  
</div>
</body>
</html>

<?php  
  if(isset($_REQUEST['confirm']))
  {
      $id =  $_REQUEST['room_id']; 
      $date1 =  $_REQUEST['date1'];
      $date2 =  $_REQUEST['date2'];
      $guest =  $_REQUEST['guest'];
      $user = $_SESSION['admin'];
      $booking_price = $_REQUEST['price_id'];

      require_once('connection.php');
      $con = mysqli_connect($host,$name,$pass,$db);
      $sql = "update rooms set status='1',intime='$date1',out_time='$date2',guest_name='$guest',bookedby='$user',booking_price='$booking_price' where number='$id'";
      $res = mysqli_query($con,$sql);
      if($res > 0)
        echo "<script>alert('Booking Done Successfully'); window.location='dashboard_admin.php'</script>";
  }

  // if(isset($_REQUEST['confirm1']))
  // {
  //   require_once('connection.php');
  //   $id = $_REQUEST['room_id1'];
  //   $con = mysqli_connect($host,$name,$pass,$db);
  //   $sql = "update rooms set status='0',intime='',out_time='',guest_name='',bookedby='',booking_price='' where id='$id'";
  //   $res = mysqli_query($con,$sql);

  //   echo "<script>window.location='dashboard_admin.php'</script>";
  // }

  if(isset($_REQUEST['btn_cp']))
  {
    require_once('connection.php');
    $id = $_SESSION['admin'];

    $old = $_REQUEST['ps'];
    $new = $_REQUEST['cp1'];

    $con = mysqli_connect($host,$name,$pass,$db);
    $sql = "select * from emp where id='$id'";
    $rows = mysqli_query($con,$sql);

    foreach ($rows as $row ) 
    {
      if($row['password']==$old)
      {
        $sql1 = "update emp set password='$new' where id='$id'";
        mysqli_query($con,$sql1);
        echo "<script>alert('password changed successfully !'); window.location='dashboard_admin.php'</script>";
      }
      else
      {
        echo "<script>alert('old password might be wrong !'); window.location='dashboard_admin.php'</script>";
      }
    }

    echo "<script>window.location='dashboard_admin.php'</script>";
  }
?>