<?php

    $id = $_POST['stationId'];

    require_once 'EscucharadioConnection.php';
    $connection = new EscuchaRadioConnection();
    $sql = "select station_clicks from stations where station_id = " . $id;
    $result = $connection->executeQuery($sql);

    if ($result[0]['station_clicks'] == null) {
        $sql2 = "update stations set station_clicks = 1 where station_id = " . $id;
    } else {
        $r = $result[0]['station_clicks'] + 1;
        $sql2 = "update stations set station_clicks = " . $r . " where station_id = " . $id;
    }

    echo $sql2;

    $connection->executeUpdated($sql);

?>
