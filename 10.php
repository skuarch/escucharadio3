<?php
require_once 'EscucharadioConnection.php';
$connection = new EscuchaRadioConnection();
$sql = "SELECT station_contry, contry_name, contry_id, COUNT(*)acumulated FROM stations LEFT JOIN countries ON (station_contry = contry_id) WHERE (station_active = 1) GROUP BY station_contry";
$result = $connection->executeQuery($sql);
$i = 1;
?>
<br/>
<br/>
<table id="_36">
    <tbody>
        <tr>
            <?php
            if ($result == NULL) {
                return;
            }

            foreach ($result as $value) {

                if ($i == 8) {
                    echo "<tr>";
                }
                ?>
                <td>

                    <a href="javascript:stationCountriesShow(<?php echo $value['contry_id'] ?>)">
                        <?php echo utf8_encode($value['contry_name']) . " (" . $value['acumulated'] . ")"; ?>
                    </a>                

                </td>    
                <?php
                $i++;

                if ($i == 8) {
                    echo "</tr>";
                    $i = 1;
                }
            }
            ?>
    </tbody>
</table>