<?php
//This is the api for getting all of the events
//GET Request must contain:
//  lat, long, distance
//Returns list of events
//68.9722 mile = 111 km = 1 lat/long point
  $db_host  = 'host';
  $username = 'user';
  $pwd  = 'pwd';
  $database  = 'db';

  if(isset($_GET['lat']) && isset($_GET['long']) && isset($_GET['distance'])){
    $lat = $_GET['lat'];
    $long = $_GET['long'];
    $distance = $_GET['distance'] / 68.9722;
    $latLower = $lat - $distance;
    $latLUpper = $lat + $distance;
    $longLower = $long - $distance;
    $longUpper = $long + $distance;


    $pdo = new PDO('mysql:host='.$db_host.';dbname='.$database, $username, $pwd);
        if(!$pdo)
        {
            $echo("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
    $query1 = $pdo->prepare("SELECT EventName, Lat, Lon, Description, StartTime, EndTime, Category, Image FROM ".$usertablename." WHERE Lat >= ".$latLower." AND Lat <= ".$latUppwer." AND Lon >= ".$longLower." AND Lon <= ".$longUpper);
    //Execute query
    $query1->execute(array());

    $rows = $query1->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows);
  }
?>
