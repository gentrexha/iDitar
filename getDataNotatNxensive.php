<?php


header("Content-Type: application/json");

require 'connection.php';

if (!$dbConn)
{
    die('Connection to database couldnt be established: '.mysqli_connect_error());
}

if(isset($_REQUEST["t"]))
{
    $Klasa=$_REQUEST["t"];
    $sqlQuery = "select avg(nota) mesatarja,concat(s.emri,' ',s.mbiemri) emri from ditari d, studentet s where s.sid=d.sid and  klasa='$Klasa' group by s.sid";
    $dbResponse = mysqli_query($dbConn , $sqlQuery);
    if (!$dbResponse)
    {
        die('Database couldnt be reached: ' . $dbResponse );
    }
    else
    {
        $rows = array();
        while($r = mysqli_fetch_assoc($dbResponse)) {
            $rows[] = $r;
        }
        print json_encode($rows, JSON_PRETTY_PRINT);
    }
}
?>