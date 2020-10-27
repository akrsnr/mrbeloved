<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <html>
  <?php
  include_once 'functions.php';

  $mysqli = connect();
    $query = "  SELECT t.FirstName , t.LastName , t.TeacherId 
  FROM Teacher t ";

  $result = mysqli_query($mysqli,$query);
  $str = "";
 #echo var_dump($result);
while($row = mysqli_fetch_array($result)) {
  #echo "<p>" . $row["FirstName"] . " " . $row["LastName"] . "</p>";
  $s = teachersToButtons($row["FirstName"], $row["LastName"], $row["TeacherId"]);
  $str = $str . " " . $s;
}

#echo $str;
  echo '<form action="sinif.php">';
  echo $str;
  echo "</form>";
/*
  <form action="sinif.php">
        <p><input type="submit" name="Hoca A" value="qwqwqwq" /></p>
        <p><input type="submit" name="Hoca B" value="xzczxdf sdfsd sdfdsf" /></p>
        <p><input type="submit" name="hocaCFunction" value="hoca C" /></p>
  </form>*/



  $mysqli->close();


  ?>

</html>