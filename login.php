<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>iDitari</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/icheck/skins/flat/aero.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="asset/img/logomi.png">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body id="mimin" class="dashboard form-signin-wrapper">

      <div class="container">

        <form class="form-signin" method="POST" action="login.php">
          <div class="panel periodic-login">
              <!-- <span class="atomic-number">28</span> -->
              <div class="panel-body text-center">

                  <h1 class="atomic-symbol"><p><img src="asset/img/FrontPageLogo.png"  style="width:250px;height:200px;"></p></h1>
                 <!--  <p class="atomic-mass">14.072110</p>
                  <p class="element-name">Miminium</p> -->

                  <i class="icons icon-arrow-down"></i>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" name="username" id="username" required>
                    <span class="bar"></span>
                    <label>Username</label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" name="password" id="password" required>
                    <span class="bar"></span>
                    <label>Password</label>
                  </div>
                  <label class="pull-left">
                  <input type="checkbox" class="icheck pull-left" name="remember" id="remember"/> Remember me
                  </label>
                  <input type="submit" class="btn col-md-12" name="signin" id="signin" value="Kyçu"/>
              </div>
                <div class="text-center" style="padding:5px;">
                    <a href="reg.php"><u>Regjistrohu</u></a>
                </div>
          </div>
        </form>

      </div>

      <!-- end: Content -->
      <!-- start: Javascript -->
      <script src="asset/js/jquery.min.js"></script>
      <script src="asset/js/jquery.ui.min.js"></script>
      <script src="asset/js/bootstrap.min.js"></script>

      <script src="asset/js/plugins/moment.min.js"></script>
      <script src="asset/js/plugins/icheck.min.js"></script>

      <!-- custom -->
      <script src="asset/js/main.js"></script>
      <script type="text/javascript">
       $(document).ready(function(){
         $('input').iCheck({
          checkboxClass: 'icheckbox_flat-aero',
          radioClass: 'iradio_flat-aero'
        });
       });
     </script>
     <!-- end: Javascript -->
   </body>
   </html>
   
   
   <?php

   session_start();
   require 'connection.php';


   if(isset($_COOKIE['username']))
   {
       header("Location:index.html") ;
   }

   if(isset($_POST['signin'])) {
       if (!$dbConn) {
           die('Could not connect: ' . mysqli_connect_error());
       }
       else
       {


           $usernameunsafe = $_POST['username'];
           $username = mysqli_real_escape_string($dbConn, $usernameunsafe);
           $passwordpahashunsafe = $_POST['password'];
           $passwordpahash = mysqli_real_escape_string($dbConn, $passwordpahashunsafe);
           $hash = hash('sha256', $passwordpahash);
           $salt = "";




           $querySalt = "select salt from users where user='$username'";
           $dbReplyNoHash = mysqli_query($dbConn, $querySalt);
           if (mysqli_num_rows($dbReplyNoHash) > 0) {
               while ($row = mysqli_fetch_assoc($dbReplyNoHash)) {
                   $salt = $row["salt"];
               }
           }
           $password = hash('sha256', $salt . $hash);

           $queryPwd = 'select * from users where User="' . $username . '" and SaltedHashPwd="' . $password . '"';
           $dbReplyHash = mysqli_query($dbConn, $queryPwd);
           if (mysqli_num_rows($dbReplyHash) > 0) {
               $_SESSION['username'] = $username;
               if(isset($_POST['remember']))
               {
                   setcookie('username',$usernameunsafe,time()+40);
                   setcookie('password',$passwordpahashunsafe,time()+40);
               }
               header('Location:Home.php');
           } else {
               echo "Wrong username or password!";
           }


       }
   }






   ?>