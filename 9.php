<input class="_21" type="button" value="todos los paises" onclick="javascript:ajaxCountries()"/>    
<br/>
<br/>

<?php 
    require_once 'EscucharadioConnection.php';
    $connection = new EscuchaRadioConnection();
    $sql = "SELECT genre_name,station_id,station_name,station_url,station_language,station_active,station_type FROM stations LEFT JOIN genre ON (station_genre = genre_id) WHERE (station_active = 1) AND (station_contry = ".$_POST['id']."  ) ";
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
                    <div class="_40"><?php echo $rs['station_name'] ?></div>        
                    <br/>
                    genero:<span><?php echo $rs['genre_name'] ?></span>
                    idioma: <span><?php echo utf8_encode($rs['station_language']) ?></span>            
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