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
    $latUpper = $lat + $distance;
    $longLower = $long - $distance;
    $longUpper = $long + $distance;

    $pdo = new PDO('mysql:host='.$db_host.';dbname='.$database, $username, $pwd);
        if(!$pdo)
        {
            $echo("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        $query1;
       $filters = 0;
       $filterQuery="";
       if(isset($_GET['cbNone'])){
         if($filters == 0){
           $filterQuery="'None'";
         }
         else{
           $filterQuery = $filterQuery." OR Category='None'";
         }
         $filters=$filters+1;
       }
       if(isset($_GET['cbCE'])){
         if($filters == 0){
           $filterQuery="'Campus Event'";
         }
         else{
           $filterQuery = $filterQuery." OR Category = 'Campus Event'";
         }
         $filters=$filters+1;
       }
       if(isset($_GET['cbRR'])){
         if($filters == 0){
           $filterQuery="'Registration Required'";
         }
         else{
           $filterQuery = $filterQuery." OR Category = 'Registration Required'";
         }
         $filters=$filters+1;
       }
       if(isset($_GET['cbGL'])){
         if($filters == 0){
           $filterQuery="'Greek Lyfe'";
         }
         else{
           $filterQuery = $filterQuery." OR Category = 'Greek Lyfe'";
         }
         $filters=$filters+1;
       }
       if(isset($_GET['cbHH'])){
         if($filters == 0){
           $filterQuery="'Happy Hour'";
         }
         else{
           $filterQuery = $filterQuery." OR Category = 'Happy Hour'";
         }
         $filters=$filters+1;
       }
       if(isset($_GET['cbP'])){
         if($filters == 0){
           $filterQuery="'Pizza'";
         }
         else{
           $filterQuery = $filterQuery." OR Category = 'Pizza'";
         }
         $filters=$filters+1;
       }

       if($filters > 0){
         $query1 = $pdo->prepare("SELECT EventName, Lat, Lon, Description, StartTime, EndTime, Category, Image, Address, Hash FROM events WHERE Lat >= ".$latLower." AND Lat <= ".$latUpper." AND Lon >= ".$longLower." AND Lon <= ".$longUpper." AND (Category = ".$filterQuery. ")");
       }
       else{
         $query1 = $pdo->prepare("SELECT EventName, Lat, Lon, Description, StartTime, EndTime, Category, Image, Address, Hash FROM events WHERE Lat >= ".$latLower." AND Lat <= ".$latUpper." AND Lon >= ".$longLower." AND Lon <= ".$longUpper);
       }
       //Execute query
       $query1->execute(array());

       $rows = $query1->fetchAll(PDO::FETCH_ASSOC);
       echo json_encode($rows);
      }
?>
