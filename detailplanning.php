<?php
require_once 'connect_MySQL.php';

$message = array();

if(isset($_GET['ID'])){
  $id = $_GET['ID'];
} else {
  $id = null;
}

//gamedata
$sql = "SELECT * FROM games WHERE name IN (SELECT Name_Game FROM planning WHERE ID='".$id."')";
$result = mysqli_query($dbc,$sql);
$game = mysqli_fetch_array($result);

//planningdata
$sql = "SELECT * FROM planning WHERE ID='".$id."'";
$result = mysqli_query($dbc,$sql);
$planning = mysqli_fetch_array($result);

//check save input
$min_players = 0;
if (isset($_POST['save'])) {
  for ($i=1; $i <= $game['max_players']; $i++) {
    if (!empty($_POST['player_name'.$i])) {
      $min_players++;
    }
  }
  if ($min_players >= $game['min_players']) {
    for ($i=1; $i <= $game['max_players']; $i++) {
      $sql = "INSERT INTO `players`(`Player_Name`, `Name_Game`, `Start_Time`) VALUES ('".$_POST['player_name'.$i]."', '".$game['name']."', '".$planning['Start_Time']."')";
      if ($dbc->query($sql) === TRUE) {
        //Als query correct is uitgevoerd
        $message['ok'][] = "Player ".$i." has been added!";
      } else {
        //Wanneer er iets fout is gegaan met de uitvoer van de query
        $message['error'][] = "Error: " . $sql . "<br>" . $dbc->error;
      }
    }
  } else {
      $message['error'][] = "Warning: this game must have a minumal of ".$game['min_players']." players!";
  }
}

$sql = "SELECT player_name FROM players WHERE Name_Game='".$game['name']."' AND Start_Time='".$planning['Start_Time']."'";
$result = mysqli_query($dbc,$sql);
while ($player = mysqli_fetch_array($result)) {
  $players[] = $player;
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/detail.css">
    <title>details</title>
  </head>
  <body>
    <?php
    foreach($message as $type => $messages){
      foreach($messages as $key => $text){
        echo "\n\t\t<div class=\"message_".$type."\">".$text."</div>";
      }
    }
    ?>

    <h1>DETAIL PLANNING</h1>
    <a href="index.php">terug naar overzicht</a>

    <?php

    echo "<h3>Image</h3>";
    echo "<img src='img/".$game['image']."'></img>";

    echo "<h3>informatie over het spel</h3>";
    echo $game['youtube'];
    echo $game['description'];
    echo "<h5>max_players</h5>";
    echo $game['max_players'];
    echo "<h5>min_players</h5>";
    echo $game['min_players'];
    echo "<h5>website</h5>";
    echo "<p>voor meer info <a href='".$game['url']."'>klik hier</a></p>";

    echo "<h3>Geplande tijd</h3>";
    echo "<p>".$planning['Start_Time']."</p>";

    echo "<h3>Uitleggevende</h3>";
    echo "<p>".$planning['Explain_person']."</p>";

    echo "<h3>Spelers</h3>";
    if (count($players) > 0) {
      foreach ($players as $key => $playername) {
        echo $playername['player_name']."<br><br>";
      }
      echo "<a href='editplayers.php?ID=".$id."'>bewerken</a>";
    } else {

    echo "<form class='' action='detailplanning.php?ID=".$id."' method='post'>";
    for ($i=1; $i <= $game['max_players']; $i++) {
      echo "<input type='text' value='' name='player_name".$i."' placeholder='naam speler ".$i."'><br><br>";
    }
    echo "<input type='submit' name='save' value='save'>";
    echo "</form>";
  }

     ?>

  </body>
</html>
