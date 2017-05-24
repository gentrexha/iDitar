<?php


header("Content-Type: application/json");

require 'connection.php';

if (!$dbConn)
{
    die('Connection to database couldnt be established: '.mysqli_connect_error());
}

$sqlQuery = "select avg(nota) mesatarja, klasa from ditari d, studentet s where s.sid=d.sid GROUP by klasa";
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
?>