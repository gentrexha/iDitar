<?php
$long="21.16688";
$lat="42.672722";
$jsonurl = "http://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$long&appid=fa99dba19045c5e44732f794badae6bc";
$json = file_get_contents($jsonurl);
$jsondata=json_decode($json);
$weather =$jsondata->weather[0]->main;
$temp=$jsondata->main->temp;
$tempC=$temp -273.15;

echo $weather."   ".$tempC;
?>