<?php

//database connectie
require_once 'connect_MySQL.php';

$message = array();

//get id from _GET
if(isset($_GET['ID'])){
  $id = $_GET['ID'];
} else {
  $id = null;
}

//ophalen game info
$sql = "SELECT * FROM games WHERE name IN (SELECT Name_Game FROM planning WHERE ID='".$id."')";
$result = mysqli_query($dbc,$sql);
$game = mysqli_fetch_array($result);

//ophalen planning info
$sql = "SELECT * FROM planning WHERE ID='".$id."'";
$result = mysqli_query($dbc,$sql);
$planning = mysqli_fetch_array($result);

if (isset($_POST['save'])) {
  foreach ($_POST['player_name'] as $playerid => $name) {

    $sql = "UPDATE `players` SET `Player_Name`='".$name."' WHERE ID='".$playerid."'";

    if ($dbc->query($sql) === TRUE) {
      //Als query correct is uitgevoerd
      $message['ok'][] = "player ".$name." has been updated!";
    } else {
      //Wanneer er iets fout is gegaan met de uitvoer van de query
      $message['error'][] = "Error: " . $sql . "<br>" . $dbc->error;
    }

  }

  if (!isset($message['error'])) {
    header('Location: detailplanning.php?ID='.$id);
    exit;
  }

}

//ophalen players op basis van game naam en start tijd
$sql = "SELECT player_name, ID FROM players WHERE Name_Game='".$game['name']."' AND Start_Time='".$planning['Start_Time']."'";
$result = mysqli_query($dbc,$sql);
while ($player = mysqli_fetch_array($result)) {
  $players[] = $player;
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/edit.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    foreach($message as $type => $messages){
      foreach($messages as $key => $text){
        echo "\n\t\t<div class=\"message_".$type."\">".$text."</div>";
      }
    }
    ?>
    <h1>EDIT PLAYERS</h1>
    <form class="" action="editplayers.php?ID=<?php echo $id; ?>" method="post">

    <?php

    foreach ($players as $key => $player) {
        echo "<input class='input' type='text' value='".$player['player_name']."' name='player_name[".$player['ID']."]' placeholder=''><br><br>";
      }

     ?>

     <input id="edit" type="submit" name="save" value="bijwerken">
   </form>
  </body>
</html>
