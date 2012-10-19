<input class="_21" type="button" value="<< regresar" onclick="javascript:ajaxStations()"/>     
<input class="_21" type="button" value="borrar mis favoritos" onclick="javascript:deleteCookies()"/>     
<span class="_13"> todas las estaciones que escuches se guardaran en tus favoritos</span>
<br/>
<br/>

<?php

if($_POST['cookieStations'] == null || empty($_POST['cookieStations']) || strlen($_POST['cookieStations']) < 1){
    echo "reproduce una estacion para que se guarde en tus favoritos";
    return;
}

require_once "EscucharadioConnection.php";
$connection = new EscuchaRadioConnection();
$in = str_replace("|", ",", $_POST['cookieStations']);
$in = substr($in, 0, strlen($in) - 1);
$sql = "SELECT genre_name, station_id, station_name, station_url, station_language, station_active, station_type FROM stations LEFT JOIN genre ON (station_genre = genre_id) WHERE (station_active = 1) AND (station_id IN(" . $in . "))";
$result = $connection->executeQuery($sql);
$i = 0;

if ($result == NULL || empty($result)) {
    echo "reproduce una estacion para que se guarde en tus favoritos";
    return;
}

foreach ($result as $rs) {
    ?> 
    <div class="_31">
        <a href="javascript:deleteFavoritesStation(<?php echo $rs['station_id'] ?>)" title="borrar estacion de mis favoritos">
            <div class="_35">

            </div>
        </a>
        <a href="javascript:launcher('<?php echo $rs['station_id'] ?>','<?php echo $rs['station_url'] ?>','<?php echo $rs['station_name'] ?>',<?php echo $rs['station_type'] ?>);">
            <div class="_32">
                <div class="_34"><?php echo $rs['station_name'] ?></div>        
                <br/>
                genero:<span><?php echo $rs['genre_name'] ?></span>
                idioma: <span><?php echo utf8_encode($rs['station_language']) ?></span>            
            </div>
            <div class="_33"></div>                
        </a>            
    </div>
    <?php
    $i++;
    if ($i == 3) {
        echo "<br/>";
        $i = 0;
    }
} // end foreach 
?>