<?php

session_start();
$_SESSION['username']="NoUserActive";


echo("<script>location.href = 'login.php';</script>");
//session_destroy('username');

//header("Location:login.php");

?>