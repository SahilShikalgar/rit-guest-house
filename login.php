<?php  
  function go($path)
  {  
    header('Location: '.$path);
  }

  session_start();
  if(isset($_SESSION['user']))
  {
    go('dashboard.php');
  }
  else if(isset($_SESSION['admin']))
  {
    go('dashboard_admin.php');
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>Guest House Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/ico" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPpusLlY5H-8iN4iQDzpksh9gD_s5gC9sM2wdY1y2y1pgtsjmE" />
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
 <link rel="stylesheet" type="text/css" href="login.css">
 <style type="text/css">
   #myModal {
      top:2%;
      outline: none;
      overflow:auto;
   }
 </style>
</head>

<body class="">
  <section class="login-block">

    <div class="container">
      <div class="row">
        <div class="col-md-4 login-sec">
            <h2 class="text-center" style="color:#C52B2B;">Login Now</h2>
            <form class="login-form" action="login.php" method="post">
               <div class="form-group">
                  <label for="exampleInputEmail1" class="text-uppercase">Username</label>
                  <input type="text" class="form-control" placeholder="" required="" name="username">  
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                <input type="password" class="form-control" placeholder="" required="" name="password">
              </div>

              <button type="submit" class="btn btn-danger btn-login" name="login">Log In</button>
              
           </form>
            <div class="copy-text">Developed and Designed by <a data-toggle="modal" data-target="#myModal">IT Department<div>        </div></a></div>
      </div>

    <div class="col-md-8 banner-sec" id="id">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
                 <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>

  <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
           <img class="d-block img-fluid" src="https://www.ritindia.edu/images/hostel/guest-house.jpg" alt="First slide" width="100%">
            <div class="carousel-caption d-none d-md-block">
              <div class="banner-text">
                  <h2>Wel-come to RIT Guest House</h2>
                  <p>A new college guest house has been commissioned for the visiting guest and for the parents. </p>
              </div>  
           </div>
       </div>
      <div class="carousel-item">
        <img class="d-block img-fluid" src="https://www.ritindia.edu/images/hostel/guest-house.jpg" alt="First slide" width="100%">
        <div class="carousel-caption d-none d-md-block">
          <div class="banner-text">
            <h2>Welcome to RIT Guest House</h2>
            <p>Note....... Parents can stay in a guest house for maximum 3 days only They are welcome to stay beyond 3 days provided if they pay the double amount.</p>
        </div>  
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://www.ritindia.edu/images/hostel/guest-house.jpg" alt="First slide" width="100%">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Welcome to RIT Guest House</h2>
            <p>Note....... Parents can stay in a guest house for maximum 3 days only They are welcome to stay beyond 3 days provided if they pay the double amount.</p>
        </div>  
    </div>
  </div>
  </div>     
        
    </div>
  </div>
</div>
</section>

<div class="container">
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">About Us</h4><i id="close" class="fa fa-window-close fa-2x" style="color: #DE6262;" data-dismiss="modal"></i>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
                <table class="table table-hover">
                  <tbody>
                    <tr><td><center>A new college guest house has been commissioned for the visiting guest and for the parents.</center></td></tr>

                    <tr><td><center>For more details please contact Manager: Mr. Akash M. Chavan on Mob. 8600933067</center></td></tr>

                    <tr>
                      <td><center>RIT Guest House , Rajaramnagar, Islampur, Dist. Sangli,
Maharashtra, India - 415414.</center></td>
                    </tr>
                    <tr>
                      <td><center>Developed & Designed by <a href="https://www.linkedin.com/in/sahil-shikalgar-6aa11b103" class="text-danger">Sahil Shikalgar, BTECH-IT 2018-19</a></center></td>
                    </tr>
                    <tr><td><center>Supported by Mohsin N Mulla & Kedar S Kulkarni</center></td></tr>
                    <tr><td><center>For Website Support Contact Number : 8668295633 , 9552772851</center></td></tr>
                    <tr><td><center>Developed and Designed by <a href="https://www.ritindia.edu/index.php/departments/information-technology/about-the-department" class="text-danger">IT Department</a></center></td></tr>
                  </tbody>
                </table>
            </div>  
          </div>
        </div>
        <div class="modal-footer">
          <small class="float-left">&copy; RIT Guest House</small>
        </div>
      </div>
      
    </div>
  </div>  
</div>
</body>
</html>

<?php 
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
  if(isset($_REQUEST['login']))
  {
    require_once('connection.php');
    $con = mysqli_connect($host,$name,$pass,$db);

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql = "select * from emp where id='$username' and password='$password'";

    $records = mysqli_query($con,$sql);

    foreach ($records as $row) 
    {
      if($row['id']==="admin")
      {
          $_SESSION['admin']=$row['id'];
          echo "<script> window.location='dashboard_admin.php';</script>"; 
      }
      else
      {   
          $_SESSION['user']=$row['id'];
          echo "<script> window.location='dashboard.php';</script>"; 
      }
    }
    echo "<script>alert('login id or password is incorrect ! please try again');  window.location='login.php';</script>"; 
  }
?>