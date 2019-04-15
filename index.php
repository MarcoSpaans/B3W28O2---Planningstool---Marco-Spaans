<?php

require 'connect_MySQL.php';

$sql = "SELECT * FROM planning ORDER BY Start_Time ASC;";
$result = mysqli_query($dbc,$sql);

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/index.css">
    <title></title>
  </head>
  <body>
    <div class="center">

    <h1>PLANNING LIST</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>persoon die het uitleg</th>
          <th>Naam spel</th>
          <th>starttijd</th>
          <th>tijdspanne</th>
        </tr>
      </thead>
      <tbody>
        <?php

        while ($row = mysqli_fetch_array($result)) {
          echo '<tr><td>'.$row["ID"].'</td>
          <td>'.$row["Explain_person"].'</td>
          <td>'.$row["Name_Game"].'</td>
          <td>'.$row["Start_Time"].'</td>
          <td>'.$row["Time_Span"].'</td>
          <td><a href="editplanning.php?ID='.$row["ID"].'">bewerk</a></td>
          <td><a href="deleteplanning.php?ID='.$row["ID"].'">verwijderen</a></td>
          <td><td><a href="detailplanning.php?ID='.$row["ID"].'">details</a></td></td></tr>';
        }

         ?>

      </tbody>
    </table>
    <br>
    <a id="add" href="addplanning.php">create planning</a>
  </div>
  </body>
</html>
