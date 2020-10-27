<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width,
          user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
# o tarih aralığında var olan toplan öğrenci sayısı (1 leri saymak yeterli)

# anasayfa
# tüm sınıfların gunluk 1 lerinin sayısı 5A 6A ...

include_once 'functions.php';
$mysqli = connect();

$sql= "SELECT * FROM Class";

$result = mysqli_query($mysqli,$sql);
$str = "";

while($row = mysqli_fetch_array($result)) {
    echo "<p>" . $row["ClassId"] . "</p>";
}


if ($mysqli !== null && $mysqli->ping()) {
    printf ("<p>Our connection is ok!</p>");
    $mysqli->close();
} else {
    printf("Error: %s\n", $mysqli->error);
}
?>

</body>
</html>