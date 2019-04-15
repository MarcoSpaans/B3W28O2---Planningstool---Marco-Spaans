<?php

$message = array();

if (isset($_POST['add'])) {

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

    $sql = "INSERT INTO planning (Name_Game, Start_Time, Time_Span, Explain_person) VALUES ('".$game."', '".$time."', '".$timespan."', '".$explain."')";

    if ($dbc->query($sql) === TRUE) {
      //Als query correct is uitgevoerd
      $message['ok'][] = "new planning has been added!";
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
    <link rel="stylesheet" href="css/add.css">
    <meta charset="utf-8">
    <title>add planning</title>
  </head>
  <body>
    <?php
    foreach($message as $type => $messages){
      foreach($messages as $key => $text){
        echo "\n\t\t<div class=\"message_".$type."\">".$text."</div>";
      }
    }
    ?>
    <h1>ADD PLANNING</h1>

    <form class="" action="addplanning.php" method="post">
      <p>Naam uitleggever</p>
      <input class="input" type="text" name="explain" value="">
      <p>Start tijd (--:--)</p>
      <input class="input" type="text" name="time" value="">
      <p>tijdspanne (--:--)</p>
      <input class="input" type="text" name="timespan" value="">
      <p>Selecteer een spel</p>
      <select class="input" name="game">

        <?php

        require_once 'connect_MySQL.php';

        $sql = "SELECT name FROM games ORDER BY name ASC;";

        $result = mysqli_query($dbc,$sql);

        while ($row = mysqli_fetch_array($result)) {
         ?>
         <option value="<?php echo $row['name'];  ?>"><?php echo $row["name"]; ?></option>

       <?php } ?>

     </select><br><br>

      <input id="add" type="submit" name="add" value="ADD"><br><br>

      <a href="index.php">terug naar overzicht</a>
    </form>
  </body>
</html>
