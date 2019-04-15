<?php

if(isset($_GET['ID'])){
  $id = $_GET['ID'];
} else {
  $id = null;
}

if (isset($_POST["delete"])) {

  require_once 'connect_MySQL.php';

  $sql = "DELETE FROM planning WHERE ID='".$id."';";

  if ($dbc->query($sql) === TRUE) {
    //Als query correct is uitgevoerd
    echo "planning deleted";
    echo "<a href='index.php'>terug naar overzicht</a>";
  } else {
    //Wanneer er iets fout is gegaan met de uitvoer van de query
    echo "hey, don't click on me. its annoying. (>3<)";
  }

  mysqli_close($dbc);

}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/delete.css">
    <meta charset="utf-8">
    <title>delete planning</title>
  </head>
  <body>
    <h1>DELETE PLANNING</h1>

    <form class="" action="deleteplanning.php?ID=<?php echo $id; ?>" method="post">
      <h3>ARE YOU SURE YOU WANT TO DELETE THIS PLANNING?</h3>

      <button id="yes" type="submit" name="delete">Yes</button>
      <a href="index.php"><button id="no" type="button" name="button">No</button></a><br>


    </form>

  </body>
</html>
