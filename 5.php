<?php

    require_once 'EscucharadioConnection.php';
    $connection = new EscuchaRadioConnection();
    $sql = "select count(*)num from stations where station_active = 1";
    $result = $connection->executeQuery($sql);
    echo $result[0][0];

?>
