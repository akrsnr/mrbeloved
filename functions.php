<?php

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
}

function teachersToButtons($f, $l, $i)
{
    $str = '<p><input type="submit" value="' . $f . " " . $l  . '" name="' . $i . '"/></p>';
    return $str;
}
?>