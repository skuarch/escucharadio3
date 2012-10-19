<?php
    require_once "EscucharadioConnection.php";
    $connection = new EscuchaRadioConnection();
    $sql = "SELECT COUNT(*)quantity, genre_name, station_id, station_type FROM stations LEFT JOIN genre ON (station_genre = genre_id) WHERE (station_active = 1) GROUP BY genre_name ORDER BY genre_name ASC;";
    $result = $connection->executeQuery($sql);
    $i = 0;

    if ($result == NULL || empty($result)) {        
        echo "lo sentimos en este momento no existen estaciones";        
        return;
    }

    foreach ($result as $rs) {        
?> 
        <div class="_37">
            <a href="javascript:launcher('<?php echo $rs['station_id'] ?>','<?php echo $rs['station_url'] ?>','<?php echo $rs['station_name'] ?>',<?php echo $rs['station_type']?>);">
                <div class="_38">
                    <div class="_40"><?php echo $rs['genre_name'] ?></div>        
                    <br/>
                    estaciones: <span><?php echo utf8_encode($rs['quantity']) ?></span>            
                </div>
                <div class="_39"></div>                
            </a>            
        </div>
<?php 
        $i++; 
        if($i==3){
            echo "<br/>";
            $i=0;
        }
   
    } // end foreach 
?>