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
    <link rel="stylesheet" type="text/css" href="asset/css/plugins/fullcalendar.min.css"/>
    <link href="asset/css/style.css" rel="stylesheet">
    <!-- end: Css -->

    <link rel="shortcut icon" href="asset/img/logomi.png">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">


        var jsonData = $.ajax({
            url: "getDataStatistikatNotat.php",
            dataType: "json",
            async: false
        }).responseText;

        var myArr = JSON.parse(jsonData);

        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Klaset');
            data.addColumn('number', 'Nota Mesatare');
            for (var i = 0; i < myArr.length; i++) {

                data.addRows([[myArr[i]['klasa'], parseFloat(myArr[i]['mesatarja'])]]);
            }

            var options = {
                title: 'Notat mesatare sipas klaseve',
                width: 500,
                height: 332,
                vAxis: {
                    viewWindowMode:'explicit',
                    viewWindow: {
                        max:5,
                        min:0
                    }
                },

            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('notat'));

            chart.draw(data, options);
        }

    </script>


    <script type="text/javascript">


        function verifyorder() {
            var order = document.getElementById('value').value;

            var emripartise = order;
            var jsonData = $.ajax({
                url: "getDataNotatNxensive.php?t=".concat(emripartise),
                dataType: "json",
                async: false
            }).responseText;

            var myArr = JSON.parse(jsonData);


            google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawBasic);

            function drawBasic() {

                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Emri');
                data.addColumn('number', 'Nota Mesatare');
                for (var i = 0; i < myArr.length; i++) {

                    data.addRows([[myArr[i]['emri'], parseFloat(myArr[i]['mesatarja'])]]);
                }

                var options = {
                    title: 'Notat mesatare sipas nxensive',
                    width: 500,
                    height: 300,
                    vAxis: {
                        viewWindowMode:'explicit',
                        viewWindow: {
                            max:5,
                            min:0
                        }
                    },

                };

                var chart = new google.visualization.ColumnChart(
                    document.getElementById('notatnxensit'));

                chart.draw(data, options);
            }
        }

    </script>



</head>
<?php
session_start();
if($_SESSION['username']=="NoUserActive")
{

    echo("<script>location.href = 'login.php';</script>");
}
?>
<body id="mimin" class="dashboard">
<!-- start: Header -->
<nav class="navbar navbar-default header navbar-fixed-top">
    <div class="col-md-12 nav-wrapper">
        <div class="navbar-header" style="width:100%;">
            <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
            </div>
            <a href="Home.php" class="navbar-brand">
                <b>iDitari</b>
            </a>

            <ul class="nav navbar-nav search-nav">
                <li>
                    <div class="search">
                        <span class="fa fa-search icon-search" style="font-size:23px;"></span>
                        <div class="form-group form-animate-text">
                            <input type="text" class="form-text" required>
                            <span class="bar"></span>
                            <label class="label-search">Type anywhere to <b>Search</b> </label>
                        </div>
                    </div>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span>
                        <?php
                        require 'connection.php';
                        $uid=$_SESSION['username'];
                        $querySignUp = "select concat(emri,' ',mbiemri) emrimbiemri from users where user='$uid'";
                        $dbReplygetName = mysqli_query($dbConn, $querySignUp);
                        while($row=mysqli_fetch_assoc($dbReplygetName))
                            echo $row["emrimbiemri"];



                        ?>

                    </span></li>
                <li class="dropdown avatar-dropdown">
                    <img src="asset/img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                    <ul class="dropdown-menu user-dropdown">
                        <li><a href="#"><span class="fa fa-user"></span> My Profile</a></li>
                        <li><a href="#"><span class="fa fa-calendar"></span> My Calendar</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="more">
                            <ul>
                                <li><a href=""><span class="fa fa-cogs"></span></a></li>
                                <li><a href=""><span class="fa fa-lock"></span></a></li>
                                <li><a href="logout.php"><span class="fa fa-power-off "></span></a></li>


                                </span></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li ><a href="#" class="opener-right-menu"><span class="fa fa-comment-o"></span></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- end: Header -->

<div class="container-fluid mimin-wrapper">

    <!-- start:Left Menu -->
    <div id="left-menu">
        <div class="sub-left-menu scroll">
            <ul class="nav nav-list">
                <li><div class="left-bg"></div></li>
                <li class="time">
                    <h1 class="animated fadeInLeft">21:00</h1>
                    <p class="animated fadeInRight">Sat,October 1st 2029</p>
                </li>
                <li class="active ripple">
                    <a class="tree-toggle nav-header"><span class="fa-book fa"></span> Notimi
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li onclick="location.href='NotoNxenesit.php';"><a href="NotoNxenesit.php">Noto Nxenesit</a></li>
                    </ul>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa-pencil fa"></span> Regjistrimi
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li onclick="location.href='ShtoLende.php';"><a href="ShtoLende.php">Regjistro Lenden</a></li>
                        <li onclick="location.href='ShtoProfNeLende.php';"><a href="ShtoProfNeLende.php">Regjistro Prof ne lende</a></li>
                    </ul>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa-child fa"></span> Nxenesit
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li onclick="location.href='InsertNxensit.php';"><a href="InsertNxensit.php">Shto Nxenesin</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
    <!-- end: Left Menu -->


    <!-- start: content -->
    <div id="content">
        <div class="panel">
            <div class="panel-body">
                <div class="col-md-6 col-sm-12">
                    <h3 class="animated fadeInLeft">Moti per sot</h3>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="col-md-6 col-sm-6 text-right" id="Location1" style="padding-left:10px;">
                        <h3 id="genti" style="color:#DDDDDE;"><span class="fa  fa-map-marker"></span> Prishtina</h3>
                        <h1 style="margin-top: -10px;color: #ddd;">
                            <?php
                            $long="21.16688";
                            $lat="42.672722";
                            $jsonurl = "http://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$long&appid=fa99dba19045c5e44732f794badae6bc";
                            $json = file_get_contents($jsonurl);
                            $jsondata=json_decode($json);
                            $weather =$jsondata->weather[0]->main;
                            $temp=$jsondata->main->temp;
                            $tempC=$temp -273.15;
                            echo $tempC;
                            ?><sup>o</sup></h1>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="wheather">
                            <?php




                            if($weather=="Rain")
                            {
                                echo "<div class='stormy rainy animated pulse infinite'><div class='shadow'></div></div>";

                            }
                            else if($weather=="Clouds")
                            {
                                echo "<div class='cloudy animated pulse infinite'><div class='shadow'></div></div>";

                            }
                            else if($weather=="Snow")
                            {
                                echo '  <div class="snowy rainy animated pulse infinite">
                                <div class="shadow">
                                  
                                </div>
                            </div>
                            <div class="sub-wheather snowy-sub-wheather">
                              <div class="rain">
                                  <div class="droplet droplet1"></div>
                                  <div class="droplet droplet2"></div>
                                  <div class="droplet droplet3"></div>
                                  <div class="droplet droplet4"></div>
                                  <div class="droplet droplet5"></div>
                                  <div class="droplet droplet6"></div>
                                </div>
                            </div>
                          ';

                            }
                            else if($weather=="Extreme")
                            {
                                echo '  <div class="stormy rainy animated pulse infinite">
                              <div class="shadow">
                                
                              </div>
                            </div>
                            <div class="sub-wheather">
                              <div class="thunder">
                                
                              </div>
                              <div class="rain">
                                  <div class="droplet droplet1"></div>
                                  <div class="droplet droplet2"></div>
                                  <div class="droplet droplet3"></div>
                                  <div class="droplet droplet4"></div>
                                  <div class="droplet droplet5"></div>
                                  <div class="droplet droplet6"></div>
                                </div>
                              <div class="tornado">
                                  <div class="wind wind1"></div>
                                  <div class="wind wind2"></div>
                                  <div class="wind wind3"></div>
                                  <div class="wind wind4"></div>
                              </div>
                            </div>
                          ';

                            }
                            else if($weather=="Clear")
                            {
                                echo '<div class="suny">
    <div class="sun animated pulse infinite">
    </div>
    
</div>';

                            }


                            ?>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12" style="padding:20px;">
            <div class="col-md-12 padding-0">
                <div class="col-md-8 padding-0">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-6">
                            <div class="panel box-v1">

                               </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel box-v1">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel box-v4">
                        <div class="col-md-12 card-wrap padding-0">



                <div class="col-md-6" style="width: 550px;">
                    <div class="panel">
                        <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                                <h4>Line Chart</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-sm-12">
                                <div class="mini-onoffswitch pull-right onoffswitch-danger" style="margin-top:10px;">
                                    <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch12" checked>
                                    <label class="onoffswitch-label" for="myonoffswitch1"></label>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-bottom:50px;">
                            <div id="notat">

                            </div>

                        </div>
                    </div>



                    <!-- versioni i sakte i orders -->

 <div class="col-md-6" style=" width: 550px;">
                    <div class="panel">
                        <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                                <h4>Orders</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-sm-12">
                                <div class="mini-onoffswitch pull-right onoffswitch-primary" style="margin-top:10px;">
                                    <input type="checkbox" name="onoffswitch3" class="onoffswitch-checkbox" id="myonoffswitch32" checked>
                                    <label class="onoffswitch-label" for="myonoffswitch3"></label>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-bottom:50px;">
                            <div>
                                <!-- Insertimi ne option list i klaseve nga databaza -->
                                <?php

                                require 'connection.php';
                                $sqlQuery = "select distinct klasa from ditari d, studentet s where s.sid=d.sid order by klasa";
                                $dbResponse = mysqli_query($dbConn , $sqlQuery);

                                echo "<select id='value' name='value'>";
                                while($row = mysqli_fetch_assoc($dbResponse)) {
                                    echo "<option value='".$row["klasa"]."'>".$row["klasa"]."</option>";
                                }
                                echo "</select>"
                                ?>




                                <input type="button" value="Shiko" onclick="verifyorder();" />

                            </div>
                            <div id="notatnxensit">

                            </div>
                        </div>
                    </div>
                </div> 
                    <!-- end versioni i sakte orders -->
                </div>



                

<!-- te dhenat e shfrytezuesit -->
           <div class="col-md-4">
                    <div class="col-md-12 padding-0">
                        <div class="panel box-v2">
                            <div class="panel-heading padding-0">
                                <img src="asset/img/bg2.jpg" class="box-v2-cover img-responsive"/>
                                <div class="box-v2-detail">
                                    <img src="asset/img/avatar.jpg" class="img-responsive"/>
                                   <span>
                        <?php
                        require 'connection.php';
                        $uid=$_SESSION['username'];
                        $querySignUp = "select concat(emri,' ',mbiemri) emrimbiemri from users where user='$uid'";
                        $dbReplygetName = mysqli_query($dbConn, $querySignUp);
                        while($row=mysqli_fetch_assoc($dbReplygetName))
                            echo $row["emrimbiemri"];



                        ?>
                            
                        </span>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-12 padding-0 text-center">
                                    <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                        <h3><span>
                                            <?php
                                            require 'connection.php';
                                            $query="select count(*) nrlendet from lendet";
                                            $dbReplaygetStudentet=mysqli_query($dbConn,$query);
                                            while ($row=mysqli_fetch_assoc($dbReplaygetStudentet))
                                                 echo $row["nrlendet"];
                                             
                                             ?>
                                        </span></h3>
                                        <p>Lende</p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-6 padding-0">
                                        <h3>
                                        <span>
                                            <?php
                                            require 'connection.php';
                                            $query="select count(*) numri from studentet";
                                            $dbReplaygetStudentet=mysqli_query($dbConn,$query);
                                            while ($row=mysqli_fetch_assoc($dbReplaygetStudentet))
                                                 echo $row["numri"];
                                             
                                             ?>
                                        </span></h3>
                                        <p>Nxenes</p>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-12 padding-0">
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="col-md-12 padding-0">
                       
                    </div>

                   
                </div>

<!-- Opsioni orders -->


               <!--  <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                                <h4>Orders</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-sm-12">
                                <div class="mini-onoffswitch pull-right onoffswitch-primary" style="margin-top:10px;">
                                    <input type="checkbox" name="onoffswitch3" class="onoffswitch-checkbox" id="myonoffswitch32" checked>
                                    <label class="onoffswitch-label" for="myonoffswitch3"></label>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body" style="padding-bottom:50px;">
                            <div> -->
                                <!-- Insertimi ne option list i klaseve nga databaza -->
                              <!--   <?php

                                require 'connection.php';
                                $sqlQuery = "select distinct klasa from ditari d, studentet s where s.sid=d.sid order by klasa";
                                $dbResponse = mysqli_query($dbConn , $sqlQuery);

                                echo "<select id='value' name='value'>";
                                while($row = mysqli_fetch_assoc($dbResponse)) {
                                    echo "<option value='".$row["klasa"]."'>".$row["klasa"]."</option>";
                                }
                                echo "</select>"
                                ?> -->



<!-- 
                                <input type="button" value="Shiko" onclick="verifyorder();" />

                            </div>
                            <div id="notatnxensit">

                            </div>
                        </div>
                    </div>
                </div>  -->
                <!-- end of opsioni orders -->
            </div>
                           
                            </div> -->
                        </div>
                    </div>
                </div>
       

                    <div class="col-md-12 padding-0">
                       
                    </div>

                   
                </div> -->
            </div>

            
            </div>
            <div class="col-md-12">
                
            </div>
        </div>
    </div>
    <!-- end: content -->


    <!-- start: right menu -->
    <div id="right-menu">
        <!-- <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#right-menu-user">
                    <span class="fa fa-comment-o fa-2x"></span>
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#right-menu-notif">
                    <span class="fa fa-bell-o fa-2x"></span>
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#right-menu-config">
                    <span class="fa fa-cog fa-2x"></span>
                </a>
            </li>
        </ul> -->

        <div class="tab-content">
            <div id="right-menu-user" class="tab-pane fade in active">
                <div class="search col-md-12">
                    <input type="text" placeholder="search.."/>
                </div>
                <div class="user col-md-12">
                    <ul class="nav nav-list">
                        <li class="online">
                            <img src="asset/img/avatar.jpg" alt="user name">
                            <div class="name">
                                <h5><b>Bill Gates</b></h5>
                                <p>Hi there.?</p>
                            </div>
                            <div class="gadget">
                                <span class="fa  fa-mobile-phone fa-2x"></span>
                            </div>
                            <div class="dot"></div>
                        </li>

                        <!--                      <img src="asset/img/avatar.jpg" alt="user name">-->
                        <!--                      <div class="name">-->
                        <!--                        <h5><b>Bill Gates</b></h5>-->
                        <!--                        <p>Hi there.?</p>-->
                        <!--                      </div>-->
                        <!--                      <div class="gadget">-->
                        <!--                        <span class="fa  fa-mobile-phone fa-2x"></span> -->
                        <!--                      </div>-->
                        <!--                      <div class="dot"></div>-->
                        <!--                    </li>-->

                    </ul>
                </div>
                <!-- Chatbox -->
                <div class="col-md-12 chatbox">
                    <div class="col-md-12">
                        <a href="#" class="close-chat">X</a><h4>Akihiko Avaron</h4>
                    </div>
                    <div class="chat-area">
                        <div class="chat-area-content">
                            <div class="msg_container_base">
                                <ul id="messages"></ul>
<!--                                <div class="row msg_container send">-->
<!--                                    <div class="col-md-9 col-xs-9 bubble">-->
<!--                                        <div class="messages msg_sent">-->
<!--                                            <p>that mongodb thing looks good, huh?-->
<!--                                                tiny master db, and huge document store</p>-->
<!--                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-3 col-xs-3 avatar">-->
<!--                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="row msg_container receive">-->
<!--                                    <div class="col-md-3 col-xs-3 avatar">-->
<!--                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">-->
<!--                                    </div>-->
<!--                                    <div class="col-md-9 col-xs-9 bubble">-->
<!--                                        <div class="messages msg_receive">-->
<!--                                            <p>that mongodb thing looks good, huh?-->
<!--                                                tiny master db, and huge document store</p>-->
<!--                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="row msg_container send">-->
<!--                                    <div class="col-md-9 col-xs-9 bubble">-->
<!--                                        <div class="messages msg_sent">-->
<!--                                            <p>that mongodb thing looks good, huh?-->
<!--                                                tiny master db, and huge document store</p>-->
<!--                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-3 col-xs-3 avatar">-->
<!--                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="row msg_container receive">-->
<!--                                    <div class="col-md-3 col-xs-3 avatar">-->
<!--                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">-->
<!--                                    </div>-->
<!--                                    <div class="col-md-9 col-xs-9 bubble">-->
<!--                                        <div class="messages msg_receive">-->
<!--                                            <p>that mongodb thing looks good, huh?-->
<!--                                                tiny master db, and huge document store</p>-->
<!--                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="row msg_container send">-->
<!--                                    <div class="col-md-9 col-xs-9 bubble">-->
<!--                                        <div class="messages msg_sent">-->
<!--                                            <p>that mongodb thing looks good, huh?-->
<!--                                                tiny master db, and huge document store</p>-->
<!--                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-3 col-xs-3 avatar">-->
<!--                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">-->
<!--                                    </div>-->
<!--                                </div>-->
<!---->
<!--                                <div class="row msg_container receive">-->
<!--                                    <div class="col-md-3 col-xs-3 avatar">-->
<!--                                        <img src="asset/img/avatar.jpg" class=" img-responsive " alt="user name">-->
<!--                                    </div>-->
<!--                                    <div class="col-md-9 col-xs-9 bubble">-->
<!--                                        <div class="messages msg_receive">-->
<!--                                            <p>that mongodb thing looks good, huh?-->
<!--                                                tiny master db, and huge document store</p>-->
<!--                                            <time datetime="2009-11-13T20:00">Timothy • 51 min</time>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </div>
                    <div id="chat-input" class="chat-input">
                        <form class="form-inline" id="messageForm">
<!--                            <input id="nameInput" type="text" class="input-medium" placeholder="Name" />-->
                            <input id="messageInput" type="text" class="input-xxlarge" placeHolder="Type here..." />
                            <input type="submit" value="Send" />
                        </form>
                        <form id="videoChatForm"><input type="submit" value="Start chat!"/></form>
                    </div>
                    <div class="user-list">
                        <ul>
                            <li class="online">
                                <a href=""  data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <div class="user-avatar"><img src="asset/img/avatar.jpg" alt="user name"></div>
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="away">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="away">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="away">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="away">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">
                                    <div class="dot"></div>
                                </a>
                            </li>
                            <li class="away">
                                <a href="" data-toggle="tooltip" data-placement="left" title="Akihiko avaron">
                                    <img src="asset/img/avatar.jpg" alt="user name">
                                    <div class="dot"></div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="right-menu-notif" class="tab-pane fade">

                <ul class="mini-timeline">
                    <li class="mini-timeline-highlight">
                        <div class="mini-timeline-panel">
                            <h5 class="time">07:00</h5>
                            <p>Coding!!</p>
                        </div>
                    </li>

                    <li class="mini-timeline-highlight">
                        <div class="mini-timeline-panel">
                            <h5 class="time">09:00</h5>
                            <p>Playing The Games</p>
                        </div>
                    </li>
                    <li class="mini-timeline-highlight">
                        <div class="mini-timeline-panel">
                            <h5 class="time">12:00</h5>
                            <p>Meeting with <a href="#">Clients</a></p>
                        </div>
                    </li>
                    <li class="mini-timeline-highlight mini-timeline-warning">
                        <div class="mini-timeline-panel">
                            <h5 class="time">15:00</h5>
                            <p>Breakdown the Personal PC</p>
                        </div>
                    </li>
                    <li class="mini-timeline-highlight mini-timeline-info">
                        <div class="mini-timeline-panel">
                            <h5 class="time">15:00</h5>
                            <p>Checking Server!</p>
                        </div>
                    </li>
                    <li class="mini-timeline-highlight mini-timeline-success">
                        <div class="mini-timeline-panel">
                            <h5 class="time">16:01</h5>
                            <p>Hacking The public wifi</p>
                        </div>
                    </li>
                    <li class="mini-timeline-highlight mini-timeline-danger">
                        <div class="mini-timeline-panel">
                            <h5 class="time">21:00</h5>
                            <p>Sleep!</p>
                        </div>
                    </li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>

            </div>
            <div id="right-menu-config" class="tab-pane fade">
                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Notification</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-info">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch1" checked>
                            <label class="onoffswitch-label" for="myonoffswitch1"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Custom Designer</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-danger">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch2" checked>
                            <label class="onoffswitch-label" for="myonoffswitch2"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Autologin</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-success">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch3" checked>
                            <label class="onoffswitch-label" for="myonoffswitch3"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Auto Hacking</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-warning">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch4" checked>
                            <label class="onoffswitch-label" for="myonoffswitch4"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Auto locking</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch5" checked>
                            <label class="onoffswitch-label" for="myonoffswitch5"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>FireWall</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch6" checked>
                            <label class="onoffswitch-label" for="myonoffswitch6"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>CSRF Max</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-warning">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch7" checked>
                            <label class="onoffswitch-label" for="myonoffswitch7"></label>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Man In The Middle</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-danger">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch8" checked>
                            <label class="onoffswitch-label" for="myonoffswitch8"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-6 padding-0">
                        <h5>Auto Repair</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="mini-onoffswitch onoffswitch-success">
                            <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch9" checked>
                            <label class="onoffswitch-label" for="myonoffswitch9"></label>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <input type="button" value="More.." class="btnmore">
                </div>

            </div>
        </div>
    </div>
    <!-- end: right menu -->

</div>

<!-- start: Mobile -->
<div id="mimin-mobile" class="reverse">
    <div class="mimin-mobile-menu-list">
        <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
            <ul class="nav nav-list">
                <li class="active ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa-home fa"></span>Dashboard
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="dashboard-v1.html">Dashboard v.1</a></li>
                        <li><a href="dashboard-v2.html">Dashboard v.2</a></li>
                    </ul>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa-diamond fa"></span>Layout
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="topnav.html">Top Navigation</a></li>
                        <li><a href="boxed.html">Boxed</a></li>
                    </ul>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa-area-chart fa"></span>Charts
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="chartjs.html">ChartJs</a></li>
                        <li><a href="morris.html">Morris</a></li>
                        <li><a href="flot.html">Flot</a></li>
                        <li><a href="sparkline.html">SparkLine</a></li>
                    </ul>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa fa-pencil-square"></span>Ui Elements
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="color.html">Color</a></li>
                        <li><a href="weather.html">Weather</a></li>
                        <li><a href="typography.html">Typography</a></li>
                        <li><a href="icons.html">Icons</a></li>
                        <li><a href="buttons.html">Buttons</a></li>
                        <li><a href="media.html">Media</a></li>
                        <li><a href="panels.html">Panels & Tabs</a></li>
                        <li><a href="notifications.html">Notifications & Tooltip</a></li>
                        <li><a href="badges.html">Badges & Label</a></li>
                        <li><a href="progress.html">Progress</a></li>
                        <li><a href="sliders.html">Sliders</a></li>
                        <li><a href="timeline.html">Timeline</a></li>
                        <li><a href="modal.html">Modals</a></li>
                    </ul>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa fa-check-square-o"></span>Forms
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="formelement.html">Form Element</a></li>
                        <li><a href="#">Wizard</a></li>
                        <li><a href="#">File Upload</a></li>
                        <li><a href="#">Text Editor</a></li>
                    </ul>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa fa-table"></span>Tables
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="datatables.html">Data Tables</a></li>
                        <li><a href="handsontable.html">handsontable</a></li>
                        <li><a href="tablestatic.html">Static</a></li>
                    </ul>
                </li>
                <li class="ripple">
                    <a href="calendar.html">
                        <span class="fa fa-calendar-o"></span>Calendar
                    </a>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa fa-envelope-o"></span>Mail
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="mail-box.html">Inbox</a></li>
                        <li><a href="compose-mail.html">Compose Mail</a></li>
                        <li><a href="view-mail.html">View Mail</a></li>
                    </ul>
                </li>
                <li class="ripple">
                    <a class="tree-toggle nav-header">
                        <span class="fa fa-file-code-o"></span>Pages
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                    </a>
                    <ul class="nav nav-list tree">
                        <li><a href="forgotpass.html">Forgot Password</a></li>
                        <li><a href="login.php">SignIn</a></li>
                        <li><a href="reg.php">SignUp</a></li>
                        <li><a href="article-v1.html">Article v1</a></li>
                        <li><a href="search-v1.html">Search Result v1</a></li>
                        <li><a href="productgrid.html">Product Grid</a></li>
                        <li><a href="profile-v1.html">Profile v1</a></li>
                        <li><a href="invoice-v1.html">Invoice v1</a></li>
                    </ul>
                </li>
                <li class="ripple"><a class="tree-toggle nav-header"><span class="fa "></span> MultiLevel  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                    <ul class="nav nav-list tree">
                        <li><a href="view-mail.html">Level 1</a></li>
                        <li><a href="view-mail.html">Level 1</a></li>
                        <li class="ripple">
                            <a class="sub-tree-toggle nav-header">
                                <span class="fa fa-envelope-o"></span> Level 1
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>
                            <ul class="nav nav-list sub-tree">
                                <li><a href="mail-box.html">Level 2</a></li>
                                <li><a href="compose-mail.html">Level 2</a></li>
                                <li><a href="view-mail.html">Level 2</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="credits.html">Credits</a></li>
            </ul>
        </div>
    </div>
</div>
<button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
    <span class="fa fa-bars"></span>
</button>
<!-- end: Mobile -->

<!-- start: Javascript -->
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>


<!-- plugins -->
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/fullcalendar.min.js"></script>
<script src="asset/js/plugins/jquery.nicescroll.js"></script>
<script src="asset/js/plugins/jquery.vmap.min.js"></script>
<script src="asset/js/plugins/maps/jquery.vmap.world.js"></script>
<script src="asset/js/plugins/jquery.vmap.sampledata.js"></script>
<script src="asset/js/plugins/chart.min.js"></script>

<!-- chat -->
<script src="asset/js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js"></script>
<script src="asset/js/nodeClient.js"></script>


<!-- custom -->
<script src="asset/js/main.js"></script>
<script type="text/javascript">
    (function(jQuery){

        // start: Chart =============

        Chart.defaults.global.pointHitDetectionRadius = 1;
        Chart.defaults.global.customTooltips = function(tooltip) {

            var tooltipEl = $('#chartjs-tooltip');

            if (!tooltip) {
                tooltipEl.css({
                    opacity: 0
                });
                return;
            }

            tooltipEl.removeClass('above below');
            tooltipEl.addClass(tooltip.yAlign);

            var innerHtml = '';
            if (undefined !== tooltip.labels && tooltip.labels.length) {
                for (var i = tooltip.labels.length - 1; i >= 0; i--) {
                    innerHtml += [
                        '<div class="chartjs-tooltip-section">',
                        '   <span class="chartjs-tooltip-key" style="background-color:' + tooltip.legendColors[i].fill + '"></span>',
                        '   <span class="chartjs-tooltip-value">' + tooltip.labels[i] + '</span>',
                        '</div>'
                    ].join('');
                }
                tooltipEl.html(innerHtml);
            }

            tooltipEl.css({
                opacity: 1,
                left: tooltip.chart.canvas.offsetLeft + tooltip.x + 'px',
                top: tooltip.chart.canvas.offsetTop + tooltip.y + 'px',
                fontFamily: tooltip.fontFamily,
                fontSize: tooltip.fontSize,
                fontStyle: tooltip.fontStyle
            });
        };
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };
        var lineChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "My First dataset",
                fillColor: "rgba(21,186,103,0.4)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(66,69,67,0.3)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [18,9,5,7,4.5,4,5,4.5,6,5.6,7.5]
            }, {
                label: "My Second dataset",
                fillColor: "rgba(21,113,186,0.5)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [4,7,5,7,4.5,4,5,4.5,6,5.6,7.5]
            }]
        };

        var doughnutData = [
            {
                value: 300,
                color:"#129352",
                highlight: "#15BA67",
                label: "Alfa"
            },
            {
                value: 50,
                color: "#1AD576",
                highlight: "#15BA67",
                label: "Beta"
            },
            {
                value: 100,
                color: "#FDB45C",
                highlight: "#15BA67",
                label: "Gamma"
            },
            {
                value: 40,
                color: "#0F5E36",
                highlight: "#15BA67",
                label: "Peta"
            },
            {
                value: 120,
                color: "#15A65D",
                highlight: "#15BA67",
                label: "X"
            }

        ];


        var doughnutData2 = [
            {
                value: 100,
                color:"#129352",
                highlight: "#15BA67",
                label: "Alfa"
            },
            {
                value: 250,
                color: "#FF6656",
                highlight: "#FF6656",
                label: "Beta"
            },
            {
                value: 100,
                color: "#FDB45C",
                highlight: "#15BA67",
                label: "Gamma"
            },
            {
                value: 40,
                color: "#FD786A",
                highlight: "#15BA67",
                label: "Peta"
            },
            {
                value: 120,
                color: "#15A65D",
                highlight: "#15BA67",
                label: "X"
            }

        ];

        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(21,186,103,0.4)",
                    strokeColor: "rgba(220,220,220,0.8)",
                    highlightFill: "rgba(21,186,103,0.2)",
                    highlightStroke: "rgba(21,186,103,0.2)",
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
                {
                    label: "My Second dataset",
                    fillColor: "rgba(21,113,186,0.5)",
                    strokeColor: "rgba(151,187,205,0.8)",
                    highlightFill: "rgba(21,113,186,0.2)",
                    highlightStroke: "rgba(21,113,186,0.2)",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
            ]
        };

        window.onload = function(){
            var ctx = $(".doughnut-chart")[0].getContext("2d");
            window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {
                responsive : true,
                showTooltips: true
            });

            var ctx2 = $(".line-chart")[0].getContext("2d");
            window.myLine = new Chart(ctx2).Line(lineChartData, {
                responsive: true,
                showTooltips: true,
                multiTooltipTemplate: "<%= value %>",
                maintainAspectRatio: false
            });

            var ctx3 = $(".bar-chart")[0].getContext("2d");
            window.myLine = new Chart(ctx3).Bar(barChartData, {
                responsive: true,
                showTooltips: true
            });

            var ctx4 = $(".doughnut-chart2")[0].getContext("2d");
            window.myDoughnut2 = new Chart(ctx4).Doughnut(doughnutData2, {
                responsive : true,
                showTooltips: true
            });

        };

        //  end:  Chart =============

        // start: Calendar =========
        $('.dashboard .calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: '2015-02-12',
            businessHours: true, // display business hours
            editable: true,
            events: [
                {
                    title: 'Business Lunch',
                    start: '2015-02-03T13:00:00',
                    constraint: 'businessHours'
                },
                {
                    title: 'Meeting',
                    start: '2015-02-13T11:00:00',
                    constraint: 'availableForMeeting', // defined below
                    color: '#20C572'
                },
                {
                    title: 'Conference',
                    start: '2015-02-18',
                    end: '2015-02-20'
                },
                {
                    title: 'Party',
                    start: '2015-02-29T20:00:00'
                },

                // areas where "Meeting" must be dropped
                {
                    id: 'availableForMeeting',
                    start: '2015-02-11T10:00:00',
                    end: '2015-02-11T16:00:00',
                    rendering: 'background'
                },
                {
                    id: 'availableForMeeting',
                    start: '2015-02-13T10:00:00',
                    end: '2015-02-13T16:00:00',
                    rendering: 'background'
                },

                // red areas where no events can be dropped
                {
                    start: '2015-02-24',
                    end: '2015-02-28',
                    overlap: false,
                    rendering: 'background',
                    color: '#FF6656'
                },
                {
                    start: '2015-02-06',
                    end: '2015-02-08',
                    overlap: true,
                    rendering: 'background',
                    color: '#FF6656'
                }
            ]
        });
        // end : Calendar==========

        // start: Maps============

        jQuery('.maps').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#fff',
            hoverOpacity: 0.7,
            selectedColor: '#666666',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#C8EEFF', '#006491'],
            normalizeFunction: 'polynomial'
        });

        // end: Maps==============

    })(jQuery);
</script>
<!-- end: Javascript -->
</body>
</html>