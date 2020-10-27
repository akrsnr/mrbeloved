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

#echo 'soner';
$mysqli = connect();



if(!empty($_GET['bilgiler'])) {
    $sinifId = $_GET['bilgiler'][1];
    $ogretmenId = $_GET['bilgiler'][0];
    /*foreach($_GET['bilgiler'] as $check) {
        echo $check; //echoes the value set in the HTML form for each checked checkbox.
        //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
        //in your case, it would echo whatever $row['Report ID'] is equivalent to.
    }*/
}
else
    return;

date_default_timezone_set('Europe/Istanbul');
$date = date('Y-m-d G:h:i', time());
#echo $date . "  -->  ";

$sql = "INSERT INTO TestSistem.Attendance (DayDate,Presence,StudentId,TeacherId) VALUES ";
/*
$sql = "INSERT INTO TestSistem.Attendance (DayDate 				,Presence,StudentId,TeacherId)
						   VALUES ('$date',                       1			,1			,1);";
*/

/*
 # sql insert
if ($mysqli->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
*/

if(!empty($_GET['check_list'])) {
    #foreach($_GET['check_list'] as $check) {
    for ($i = 0; $i < count($_GET['check_list']) ; ++$i) {
        $date = date('Y-m-d G:h:i', time());
        $studentId = $_GET['check_list'][$i];
        $sql = $sql . "\n" . "  ('$date',                       1			,$studentId	,$ogretmenId),";
        #echo $_GET['check_list'][$i]; //echoes the value set in the HTML form for each checked checkbox.
        //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
        //in your case, it would echo whatever $row['Report ID'] is equivalent to.
    }
}

#echo $sql . "   <<--->>";

// 5A fark o gün gelenler olmayanları verecek
$gelenler = $_GET['check_list'] ?? array();
$sqlStudent = "SELECT s.StudentId 
FROM Student s
WHERE s.ClassId = '" . "$sinifId" . "';";

$result = mysqli_query($mysqli,$sqlStudent);

$tumOgrenicler = array() ;
#echo var_dump(mysqli_fetch_assoc($result));
while( $row = mysqli_fetch_assoc($result)){
    $tumOgrenicler[] = $row['StudentId'];
}

#echo var_dump($gelenler);
$gelmeyenler = array_diff($tumOgrenicler, $gelenler);
#echo var_dump($gelmeyenler);

if(!empty($gelmeyenler)) {
    #foreach($_GET['check_list'] as $check) {
    for ($i = 0; $i < count($gelmeyenler) ; ++$i) {
        $date = date('Y-m-d G:h:i', time());
        $studentId = $gelmeyenler[$i];
        $sql = $sql . "\n" . "   ('$date',                      0		,$studentId	,$ogretmenId),";
        #echo $_GET['check_list'][$i]; //echoes the value set in the HTML form for each checked checkbox.
        //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
        //in your case, it would echo whatever $row['Report ID'] is equivalent to.
    }
}

$sql[strlen($sql) - 1] = ';';
# $sql . "   <<--->>";

# sql insert
#$sql = "INSERT INTO TestSistem.Attendance (DayDate,Presence,StudentId,TeacherId) VALUES ('2020-10-25 21:09:57', '1' ,'4' ,'3'); INSERT INTO TestSistem.Attendance (DayDate,Presence,StudentId,TeacherId) VALUES ('2020-10-25 21:09:57', '0' ,'3' ,'3');";

if ($mysqli->query($sql) === TRUE) {
    echo "Yoklama başarılı!";
} else {
    echo "Hata bildiriniz: " . $sql . "<br>" . $mysqli->error;
}



if ($mysqli !== null && $mysqli->ping()) {
    #printf ("<p>Our connection is ok!</p>");
    $mysqli->close();
} else {
    printf("Error: %s\n", $mysqli->error);
}

?>
</body>
</html>