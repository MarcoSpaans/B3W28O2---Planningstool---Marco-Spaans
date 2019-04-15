<?php

require_once 'connect_MySQL.php';
$message = array();
//Ophalen van de ID uit de url request
if(isset($_GET['ID'])){
  $id = $_GET['ID'];
} else {
  $id = null;
}

if (isset($_POST['edit'])) {

  if (empty($_POST['explain'])) {
    $message['error'][] = 'this field is required!';
  } else {
    $explain = trim($_POST['explain']);
  }

  if (empty($_POST['time'])) {
    $message['error'][] = 'this field is required!';
  } else {
    $time = trim($_POST['time']);
  }

  if (empty($_POST['timespan'])) {
    $message['error'][] = 'this field is required!';
  } else {
    $timespan = trim($_POST['timespan']);
  }

  if (empty($_POST['game'])) {
    $message['error'][] = 'this field is required!';
  } else {
    $game = trim($_POST['game']);
  }

  if (count($message['error']) < 1) {

    require_once 'connect_MySQL.php';

    $sql = "UPDATE planning SET Name_Game='".$game."', Start_Time='".$time."', Time_Span='".$timespan."', Explain_person='".$explain."' WHERE ID='".$id."';";

    if ($dbc->query($sql) === TRUE) {
      //Als query correct is uitgevoerd
      $message['ok'][] = "planning has been edited!";
    } else {
      //Wanneer er iets fout is gegaan met de uitvoer van de query
      $message['error'][] = "Error: " . $sql . "<br>" . $dbc->error;
    }

    mysqli_close($dbc);

  }

}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/edit.css">
    <title>edit planning</title>
  </head>
  <body>
    <?php
    foreach($message as $type => $messages){
      foreach($messages as $key => $text){
        echo "\n\t\t<div class=\"message_".$type."\">".$text."</div>";
      }
    }
    ?>
    <h1>EDIT PLANNING</h1>

    <?php

    require_once 'connect_MySQL.php';

    $sql = "SELECT * FROM planning WHERE ID=".$id;
    $result = mysqli_query($dbc,$sql);

    while ($row = mysqli_fetch_array($result)) {

     ?>

    <form class="" action="editplanning.php?ID=<?php echo $id; ?>" method="post">
      <p>Naam uitleggever</p>
      <input class="input" type="text" name="explain" value="<?php echo $row['Explain_person'] ?>">
      <p>Start tijd (--:--)</p>
      <input class="input" type="text" name="time" value="<?php echo $row['Start_Time'] ?>">
      <p>tijdspanne (--:--)</p>
      <input class="input" type="text" name="timespan" value="<?php echo $row['Time_Span'] ?>">
      <p>Selecteer een spel</p>
      <select class="input" class="" name="game">

      <?php } ?>

        <?php

        require 'connect_MySQL.php';

        $sql = "SELECT name FROM games ORDER BY name ASC;";

        $result = mysqli_query($dbc,$sql);

        while ($row = mysqli_fetch_array($result)) {
         ?>
         <option value="<?php echo $row['name'];  ?>"><?php echo $row["name"]; ?></option>

       <?php } ?>

     </select><br><br>

      <input id="edit" type="submit" name="edit" value="EDIT"><br><br>

      <a href="index.php">terug naar overzicht</a>
  </body>
</html>
