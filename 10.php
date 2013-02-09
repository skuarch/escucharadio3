<?php
    require_once "EscucharadioConnection.php";
    $connection = new EscuchaRadioConnection();
    $sql = "SELECT station_contry, contry_name, contry_id, COUNT(*)acumulated FROM stations LEFT JOIN countries ON (station_contry = contry_id) WHERE (station_active = 1) GROUP BY station_contry";
    $result = $connection->executeQuery($sql);
    $i = 0;

    if ($result == NULL || empty($result)) {        
        echo "lo sentimos en este momento no existen estaciones";        
        return;
    }

    foreach ($result as $rs) {        
?> 
        <div class="_37">
            <a href="javascript:stationCountriesShow(<?php echo $rs['contry_id'] ?>)">
                <div class="_38">
                    <div class="_40"><?php echo utf8_encode($rs['contry_name']) ?></div>        
                    <br/>
                    estaciones: <span><?php echo $rs['acumulated'] ?></span>            
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
