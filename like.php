<?php
//This is the api for liking an event
//GET Request must contain:
//  hash
//Returns success or failure

  $db_host  = 'host';
  $username = 'user';
  $pwd  = 'pwd';
  $database  = 'db';

  if(isset($_GET['hash'])){
    $hash = $_GET['hash'];

    $pdo = new PDO('mysql:host='.$db_host.';dbname='.$database, $username, $pwd);
        if(!$pdo)
        {
            $echo("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
    $query1 = $pdo->prepare("UPDATE events SET Likes = Likes + 1 WHERE Hash = '".$hash."';");
    //Execute query
    $query1->execute(array());

  }
?>
