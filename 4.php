<?php

    require_once "EscucharadioConnection.php";
    $connection = new EscuchaRadioConnection();
    $sql = "SELECT station_id, station_name, station_url, station_type FROM stations  WHERE station_id = " . $_POST['id'] . " ORDER BY station_id desc limit 15";    
    $result = $connection->executeQuery($sql);

    echo $result[0][0];
    echo "|";
    echo $result[0][1];
    echo "|";
    echo $result[0][2];
    echo "|";
    echo $result[0][3];
    
?>