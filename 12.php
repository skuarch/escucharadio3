<input class="_21" type="button" value="hacer otra busqueda" onclick="javascript:ajaxSearch()"/>     
<br/>
<br/>
<?php   

    require_once 'EscucharadioConnection.php';
    require_once '13.php';

    if ($_POST['string'] == "") {
        $_POST['string'] = "";
        return;
    }else{
        
        $search = addslashes(filterBadCharacters($_POST['string']));
        
    }
    
    $i=0;    
    $connection = new EscuchaRadioConnection();
    $connection->executeUpdated(utf8_decode(utf8_encode("insert into searches (search_text) values ('".$search."')")));
    $sql = "SELECT  station_id, station_name, station_url, station_language, station_active, station_type FROM stations LEFT JOIN complement ON(stations.station_id = complement.complement_station_id) WHERE (station_active = 1) AND (complement_text LIKE '%".$search."%');";    
    $result = $connection->executeQuery($sql);
    
    if ($result == NULL || empty($result)) {        
        echo "no se encontraron resultado para tu busqueda";        
        return;
    }

    foreach ($result as $rs) {        
?> 
        <div class="_37">
            <a href="javascript:launcher('<?php echo $rs['station_id'] ?>','<?php echo $rs['station_url'] ?>','<?php echo $rs['station_name'] ?>',<?php echo $rs['station_type']?>);">
                <div class="_38">
                    <div class="_40"><?php echo $rs['station_name'] ?></div>        
                    <br/>
                    <!--genero:<span><?php echo $rs['genre_name'] ?></span>-->
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