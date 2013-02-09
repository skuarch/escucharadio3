<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link rel="stylesheet" href="css/default.css" type="text/css"/>        
        <link rel="icon" href="images/favicon.ico" type="image/x-icon"> 

        <script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="js/functions.js" type="text/javascript"></script>                

        <title>escucharadio</title>
    </head>

    <body oncontextmenu="return false;">

        <div class="_46">

            <div class="_47">
                <img class="_48" src="images/escucharadio3.png" width="208" height="31" alt=""/> 
                <a href="index.php">
                    <div class="_50">
                        home
                    </div>
                </a>  
            </div>

        </div>

        <br/>
        <br/>
        <br/>
        <br/>
        <br/>

        <div class="_1">
            <form action="javascript:addStation()" method="post" name="form1" id="form1" accept-charset="utf-8">

                <table>

                    <tbody>
                        <tr>
                            <td>
                                Nombre estacion: 
                            </td>
                            <td>
                                <input type="text" name="nombreEstacion" size="85"/> *
                            </td>
                            <td id="errorNombreEstacion" class="_53">
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                URL Streaming: 
                            </td>
                            <td>
                                <input type="text" name="urlStreaming" size="85"/> *
                            </td>
                            <td id="errorUrlStreaming" class="_53">
                                
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Genero: 
                            </td>
                            <td>
                                <?php
                                require_once 'EscucharadioConnection.php';
                                $connection = new EscuchaRadioConnection();
                                $sql = "SELECT * FROM genre ";
                                $result = $connection->executeQuery($sql)
                                ?>
                                <select name="genero">                                        
                                    <?php
                                    foreach ($result as $r) {
                                        echo "<option value='" . $r['genre_id'] . "'>" . $r['genre_name'] . "</option>";
                                    }
                                    ?>
                                </select> 
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Frecuencia: 
                            </td>
                            <td>
                                <input type="text" name="frecuencia" size="85"/>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Descripcion: 
                            </td>
                            <td>                                    
                                <textarea name="descripcion" rows="8" cols="65"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Estado: 
                            </td>
                            <td>
                                <select name="estado">
                                    <option value="1">activo</option>
                                    <option value="0">desactivado</option>
                                </select> 
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Pais: 
                            </td>
                            <td>
                                <?php
                                require_once 'EscucharadioConnection.php';
                                $connection = new EscuchaRadioConnection();
                                $sql = "SELECT * FROM countries";
                                $result = $connection->executeQuery($sql)
                                ?>
                                <select name="pais">
                                    <?php
                                    foreach ($result as $r) {
                                        echo utf8_encode("<option value='" . $r['contry_id'] . "'>" . $r['contry_name'] . "</option>");
                                    }
                                    ?>
                                </select> 
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Lenguaje: 
                            </td>
                            <td>
                                <?php
                                require_once 'EscucharadioConnection.php';
                                $connection = new EscuchaRadioConnection();
                                $sql = "SELECT * FROM languaje";
                                $result = $connection->executeQuery($sql)
                                ?>
                                <select name="lenguaje">                                        
                                    <?php
                                    foreach ($result as $r) {
                                        echo utf8_encode("<option value='" . $r['languaje_name'] . "'>" . $r['languaje_name'] . "</option>");
                                    }
                                    ?>
                                </select> 
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Tipo: 
                            </td>
                            <td>
                                <select name="tipo">
                                    <option value="1">shoutcast</option>
                                    <option value="2">icecast</option>
                                </select> 
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Sitio web: 
                            </td>
                            <td>
                                <input type="text" name="sitioWeb" size="85"/>
                            </td>
                        </tr>

                        <tr>
                            <td>

                            </td>
                            <td>
                                <input type="reset" name="reset" value="limpiar formulario"/>
                                <input type="button" name="enviar" value="guardar" onclick="javascript:addStation(this)"/>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </form>  
            
            <br/>
            <br/>
            
            <div class="_3"></div> <!-- line -->
            
            <div class="_20">
                <br/>todos los derechos reservados de autor skuarch | las estaciones son de sus autores | <a href="14.php">terminos legales</a>
            </div>

        </div>

    </body>
</html>