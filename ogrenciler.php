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
include_once 'functions.php';

$mysqli = connect();

$sinifId = null;
$ogretmenId = null;
foreach ($_GET as $key => $value) {
    $k = $key; # ogretmen id
    $v = $value; # sınıf
    $sinifId = $v;
    $ogretmenId = $k;
}

echo $ogretmenId . " " . $sinifId;

$sql = "select * from Teacher t where t.TeacherId = '{$ogretmenId}'";
$result = mysqli_query($mysqli,$sql);
$ogretmen = $result->fetch_row();

$ogretmen =  $ogretmen[1] . " " . $ogretmen[2];

date_default_timezone_set('Europe/Istanbul');
$date = date('d/m/Y', time());
$hour = date('G:i', time());
echo "<p>Sayın $ogretmen,  $date  tarihinde $sinifId için yoklama almaktasınız şu an saat $hour</p>";


$sql = "	SELECT *
	FROM Student s
	WHERE s.ClassId = '{$sinifId}'";

$result = mysqli_query($mysqli,$sql);
$str = '
<table id="example" class="display">
        <thead>
            <tr>
                <th></th>
                <th>İsim</th>
                <th>Soyisim</th>
                <th>Var/Yok</th>
            </tr>
        </thead>
        <tbody>
 ';

#echo var_dump(mysqli_fetch_array($result));
while($row = mysqli_fetch_array($result)) {
    #echo "<p>" . $row["FirstName"] . " " . $row["LastName"] . $row["StudentId"] . "</p>";
    $lastNameName = $row["LastName"];
    $firstName = $row["FirstName"];
    $studentId = $row["StudentId"];

    $s = "<tr><td></td><td>$firstName</td><td>$lastNameName</td>";
    $s = $s . '  <td>  <input type="checkbox" checked="checked" name="check_list[]" value="' . "{$studentId}" . '"</td></tr>' ;
    $str = $str . " " . $s;
}
$str = $str . "\n</tbody>\n</table>";

echo '<form action="yoklama.php">';
echo '<input type="hidden" name="' .  "bilgiler[]" . '" ' . 'value="' . "$ogretmenId" .  '">';
echo '<input type="hidden" name="' .  "bilgiler[]"  . '" ' . 'value="' . "$sinifId" .  '">';
echo $str  . '    <input type="submit" />';
echo '</form>';
/*
$html = '
<table id="example" class="display">
        <thead>
            <tr>
                <th></th>
                <th>İsim</th>
                <th>Soyisim</th>
                <th>Var/Yok</th>
            </tr>
        </thead>
        <tbody>
 ';

        <tr>
                <td></td>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>$320,800</td>
            </tr>
            
           </tbody>
           </table>
   ';*/




if ($mysqli !== null && $mysqli->ping()) {
    printf ("<p>Our connection is ok!</p>");
    $mysqli->close();
} else {
    printf("Error: %s\n", $mysqli->error);
}
?>
</body>
</html>