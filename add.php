<?php
//This is the api for adding an event
//GET Request must contain:
//  name, lat, long, description, start, end, category, image
//Returns success or failure

  $db_host  = 'host';
  $username = 'user';
  $pwd  = 'pwd';
  $database  = 'db';

  if(isset($_GET['name']) && isset($_GET['lat']) && isset($_GET['long']) && isset($_GET['description']) && isset($_GET['start']) && isset($_GET['end']) && isset($_GET['category']) && isset($_GET['image'])){
    $name = $_GET['name'];
    $lat = $_GET['lat'];
    $lon = $_GET['long'];
    $des = $_GET['description'];
    $start = $_GET['start'];
    $end = $_GET['end'];
    $category = $_GET['category'];
    $image = $_GET['image'];

    $pdo = new PDO('mysql:host='.$db_host.';dbname='.$database, $username, $pwd);
        if(!$pdo)
        {
            $echo("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
    $query1 = $pdo->prepare("INSERT INTO ".$usertablename." (EventName, Lat, Lon, Description, StartTime, EndTime, Category, Image) VALUES ($name, $lat, $lon, $des, $start, $end, $category, $image);");
    //Execute query
    $query1->execute(array());
  }
?>
