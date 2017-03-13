<html>
<?php

if(isset($_COOKIE['username'])and $_COOKIE['roli']=='1')
{
    header("Location:indexSH.php") ;
}
else if(isset($_COOKIE['username'])and $_COOKIE['roli']=='2')
{
    header("Location:indexA.php") ;
}
?>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="images/icon.ico" />
    <style>
        input[type=button], input[type=submit], input[type=reset] {
            background-color: #4C8CAF;
            color: white;
            padding: 5px 8px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 7px 2px;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 2px 2px 2px  #5252c2;
        }
    </style>
</head>
<body>

<header id="header"></header>
<div id="menu">
    <table>
        <tr>
            <td>
                <a href="index.php">Ballina</a>
            </td>
            <td>
                <li><a href="qytetet.php">Qytetet</a>
                    <ul>
                        <li><a href="qytetet.php#prishtina">Prishtina</a></li>
                        <li><a href="qytetet.php#ferizaji">Ferizaji</a></li>
                        <li><a href="qytetet.php#gjilani">Gjilani</a></li>
                        <li><a href="qytetet.php#prizreni">Prizreni</a></li>
                    </ul>
                </li>
            </td>
            <td><a href="ngjarjet.php">Ngjarjet</a></td>
            <td><a href="transporti.php">Transporti</a></td>
            <td><a href="identifikimi.php">Login</a></td>

        </tr>
    </table>
</div>
<div id="permbajtja">


    <div style="padding: 20px 40px;">
        <div class="login">

            <?php
            session_start();



            if(isset($_POST['logohu']))
            {
                require 'konektimi.php';
                $username=$_POST['username'];
                $password=$_POST['password'];
                $Roli = $_POST['roli'];

                if($Roli == "shfrytezues")
                {
                    $query=mysqli_query($con,'select * from shfrytezuesit where username="'.$username.'" and password="'.$password.'"');
                    $res=mysqli_fetch_row($query);
                    if($res)
                    {
                        if(isset($_POST['remember']))
                        {
                            setcookie('username',$username,time()+40);
                            setcookie('password',$password,time()+40);
                            setcookie('roli',"1",0);
                        }

                        $_SESSION['username']=$username;
                        setcookie('username',"$username",0);
                        setcookie('password',"$password",0);
                        setcookie('roli',"1",0);
                        header('Location:indexSH.php');

                    }
                    else { echo '<h4 class="heading">Keni shtypur gabim userin ose passwordin</h4><br>';}

                    if($username==''&&$password=='')
                    {
                        echo '<h3 class="heading">Shkruani te gjitha fushat </h3><br>';
                    }
                }


                else if ($Roli =="admin")
                {
                    $query=mysqli_query($con,'select * from adminat where username="'.$username.'" and password="'.$password.'"');
                    $res=mysqli_fetch_row($query);
                    if($res)
                    {
                        if(isset($_POST['remember']))
                        {
                            setcookie('username',$username,time()+40);
                            setcookie('password',$password,time()+40);
                            setcookie('roli',"2",0);


                        }

                        $_SESSION['username']=$username;
                        setcookie('username',"$username",0);
                        setcookie('password',"$password",0);
                        setcookie('roli',"2",0);
                        header('Location:indexA.php');

                    }
                    else { echo '<h4 class="heading">Keni shtypur gabim userin ose passwordin</h4><br>';}

                    if($username==''&&$password=='')
                    {
                        echo '<h3 class="heading">Shkruani te gjitha fushat </h3><br>';
                    }
                }
            }




            ?>
            <form name="formlogin"  method="POST" action="identifikimi.php" style="width: 350px; margin: 20px auto;">
                <fieldset style="text-align: center; padding: 20px 15px;">
                    <legend>Ju lutem identifikohuni p&#235;r t&#235; vazhduar</legend>
                    Ky&#231;uni si : <input type="radio" name="roli" value="shfrytezues" checked> Shfrytezues<br>
                    <input type="radio" name="roli" value="admin" style="margin-left:45px;margin-bottom: 20px;"> Admin<br>
                    P&#235;rdoruesi: <input type="text" name="username"  style="margin-bottom: 10px;margin-left:15px" required="true" placeholder="Username" autofocus><br>
                    Fjal&#235;kalimi: <input type="password" name="password"  style="margin-bottom: 10px;margin-left:15px" required="true" placeholder="Password" ><br>
                    <input  type="checkbox" name="remember" style='margin-top: 10px;margin-bottom: 10px;margin-left: -127px;'>Remember me <br>
                    <div style="text-align: right;">

                        <a style="margin-right: 36px" href="register.php">Regjistrohuni K&#235;tu</a>
                        <input style="margin-right:35px"type="submit" name="logohu" value="Log In">
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>
<div id="footer">
    <table>
        <tr>
            <td>
                <p style="color:white;"> Copyright : <abbr title="Grupi 4 ne P.SH">Grupi 4</abbr></p>
            </td>
            <td>
                <address align="right"><a href="mailto: contact@iditar.com">contact@iditar.com</a></address>
            </td>
        </tr>
    </table>
</div>
</body>
</html>