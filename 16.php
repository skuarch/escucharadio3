<?php
require_once "EscucharadioConnection.php";
$connection = new EscuchaRadioConnection();
$sql = "SELECT genre_name,station_id,station_name,station_url,station_language,station_active,station_type FROM stations LEFT JOIN genre ON (station_genre = genre_id) WHERE (station_active = 1) ORDER BY station_clicks desc limit 25,15";
$result = $connection->executeQuery($sql);

if ($result == NULL || empty($result)) {
    echo "lo sentimos en este momento no existen estaciones";
    return;
}

echo "<ul>";

foreach ($result as $rs) {
    ?>        

    <li> 
        <a href="javascript:launcher('<?php echo $rs['station_id'] ?>','<?php echo $rs['station_url'] ?>','<?php echo $rs['station_name'] ?>',<?php echo $rs['station_type'] ?>);">
            <?php echo $rs['station_name'] ?>
        </a>
    </li>

<?php } ?>
</ul>