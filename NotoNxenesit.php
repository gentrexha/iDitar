<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="description" content="Miminium Admin Template v.1">
    <meta name="author" content="Isna Nur Azis">
    <meta name="keyword" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Miminium</title>

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
    <script type="text/javascript">
        $(".select2-A").select2({
            placeholder: "Select a state",
            allowClear: true
        });
    </script>
    <![endif]-->
</head>

<body id="mimin" class="dashboard form-signin-wrapper">

<div class="container">

    <form class="form-signin" method="POST" action="NotoNxenesit.php">
        <div class="panel periodic-login">
            <span class="atomic-number">28</span>
            <div class="panel-body text-center">
                <h1 class="atomic-symbol">Mi</h1>
                <p class="atomic-mass"></p>
                <p class="element-name">Noto Nxënësin</p>

                <i class="icons icon-arrow-down"></i>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <?php

                    require 'connection.php';
                    $sqlQuery = "select concat(emri,' ',mbiemri) emri,sid from studentet";
                    $dbResponse = mysqli_query($dbConn , $sqlQuery);

                    echo "<select type='text' class='form-text' name='sid' id='sid' >";
                    echo "<option value='NULL' style='display:none'><span class='bar'></span><label>Emri & Mbiemri</label></option>";
                    while($row = mysqli_fetch_assoc($dbResponse)) {
                        echo "<option style='color:black' value='".$row["sid"]."'>".$row["emri"]."</option>";
                    }
                    echo "</select>"
                    ?>

                </div>
                <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <?php

                    require 'connection.php';
                    $sqlQuery = "select emri,lid from lendet";
                    $dbResponse = mysqli_query($dbConn , $sqlQuery);

                    echo "<select type='text' class='form-text' name='lid' id='lid' >";
                    echo "<option value='NULL' style='display:none'><span class='bar'></span><label>Lënda</label></option>";
                    while($row = mysqli_fetch_assoc($dbResponse)) {
                        echo "<option style='color:black' value='".$row["lid"]."'>".$row["emri"]."</option>";
                    }
                    echo "</select>"
                    ?>

                </div><div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <select type="text" class="form-text" name="nota" id="nota" >
                        <option value="NULL" style="display:none">
                            <span class="bar"></span>
                            <label>Nota</label>
                        </option>
                        <option value="5" style="color:black">5</option>
                        <option value="4" style="color:black">4</option>
                        <option value="3" style="color:black">3</option>
                        <option value="2" style="color:black">2</option>
                        <option value="1" style="color:black">1</option>
                    </select>

                </div>

                </div>
                <input type="submit" class="btn col-md-12" name="noto" id="noto" value="Noto Nxënësin"/>
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

if(isset($_POST['noto']))
{
    $sid=$_POST['sid'];
    $lid=$_POST['lid'];
    $nota=$_POST['nota'];
    $Useri=$_SESSION['username'];
    $data = date("Y-m-d H:i:s");

    $sql = "Select uid from users where User='$Useri'";
    $result = mysqli_query($dbConn, $sql);

        while($row = mysqli_fetch_assoc($result)) {
            $uid=$row["uid"];
        }

    $querySignUp = "insert into ditari (sid,lid,uid,nota,data) values('$sid','$lid','$uid','$nota','$data')";

    $dbReplySignUp = mysqli_query($dbConn, $querySignUp);
    if ($dbReplySignUp) {
       // header('Location:Home.php');
        echo "Nxensi u notua me sukses! ";
        //die();
    } else {
        echo "Something went wrong, please try again!";
    }

}

?>