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
/*
  $sql = "SELECT t.TeacherId 
FROM Teacher t 
WHERE t.FirstName = 'x' AND t.LastName = 'y'";

$result = mysqli_query($mysqli,$sql);

echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Age</th>
<th>Hometown</th>
<th>Job</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['AttendanceId'] . "</td>";
  echo "<td>" . $row['DayDate'] . "</td>";
  echo "<td>" . $row['Age'] . "</td>";
  echo "<td>" . $row['Hometown'] . "</td>";
  echo "<td>" . $row['Job'] . "</td>";
  echo "</tr>";
}*/

#echo $_SERVER['QUERY_STRING'];
#echo var_dump();
  include_once 'functions.php';

$mysqli = connect();

$k = "";
$v = "";
foreach ($_GET as $key => $value) { 
  $k = $key;
  $v = $value;
}

echo "Sayın " . $v . ", lütfen sınıf seçiniz";

$sql = "SELECT *
  FROM Class c ";

  $result = mysqli_query($mysqli,$sql);
  $str = "";
  

while($row = mysqli_fetch_array($result)) {
  //echo "<p>" . $row["ClassId"] . "</p>";
  $s = classesToButtons($row["ClassId"], $k);
  $str = $str . " " . $s;
}

  echo '<form action="ogrenciler.php">';
  echo $str;
  echo "</form>";

function classesToButtons($c, $i)
  {
    $str = '<p><input type="submit" value="' . $c  . '" name="' . $i . '"/></p>';
    return $str;
  }

if (isset($_GET['HocaA'])) {
        hocaAFunction($val);
      } elseif (isset($_GET['HocaB'])) {
        hocaBFunction();
      } elseif (isset($_GET['Hoca C'])) {
        hocaCFunction();
      }


    function hocaAFunction($val) {
        #if (isset($_GET['HocaA'])) { echo $_GET['HocaA']); } else echo 'wwr'
        #echo 'hoca A' . $val;
      }

      function hocaBFunction() {
        echo 'hoca B';
      }

      function hocaCFunction() {
        echo 'hoca C';
      }
/*
      function connect() 
      {
         $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'TestSistem';
  $db_port = 8889;

  $mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
  );
  
  if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
  }


  return   $mysqli;
      }*/

      if ($mysqli !== null && $mysqli->ping()) {
  printf ("<p>Our connection is ok!</p>"); 
  $mysqli->close();
} else {
  printf ("Error: %s\n", $mysqli->error); 
}
    
      
    ?>

</html>