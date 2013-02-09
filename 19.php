<?php

require_once'20.php';

if (empty($_POST) || count($_POST) < 10) {
    header("location:index.php");
}

$nombreEstacion = filterBadCharacters($_POST['nombreEstacion']);
$urlStreaming = strtolower(filterBadCharacters($_POST['urlStreaming']));
$genero = strtolower(filterBadCharacters($_POST['genero']));
$frecuencia = filterBadCharacters($_POST['frecuencia']);
$descripcion = strtolower(filterBadCharacters($_POST['descripcion']));
$estado = filterBadCharacters($_POST['estado']);
$pais = filterBadCharacters($_POST['pais']);
$lenguaje = strtolower(filterBadCharacters($_POST['lenguaje']));
$lenguaje = utf8_decode($_POST['lenguaje']);
$tipo = filterBadCharacters($_POST['tipo']);
$sitioWeb = strtolower(filterBadCharacters($_POST['sitioWeb']));

settype($nombreEstacion, "string");
settype($urlStreaming, "string");
settype($genero, "integer");
settype($frecuencia, "string");
settype($descripcion, "string");
settype($estado, "integer");
settype($pais, "integer");
settype($lenguaje, "string");
settype($tipo, "integer");
settype($sitioWeb, "string");

if(substr($urlStreaming, -strlen("/")) == "/"){
     $urlStreaming = substr($urlStreaming, 0, (strlen($urlStreaming)-1));
}

$sql = sprintf("INSERT INTO stations (
    station_name, 
    station_url, 
    station_genre, 
    station_frecuncie, 
    station_description, 
    station_clicks, 
    station_active,
    station_contry,
    station_language,
    station_type,
    station_website) 
    VALUES (
    '%s',
    '%s',
    '%d',
    '%s',
    '%s',
    '0',
    '%d',
    '%d',
    '%s',
    '%d',
    '%s');", addslashes($nombreEstacion), 
        addslashes($urlStreaming), 
        addslashes($genero), 
        addslashes($frecuencia), 
        addslashes($descripcion), 
        addslashes($estado), 
        addslashes($pais), 
        utf8_encode($lenguaje), 
        addslashes($tipo), 
        addslashes($sitioWeb));

require_once 'EscucharadioConnection.php';
$connection = new EscuchaRadioConnection();
$connection->executeUpdated($sql);

echo "la estacion se guardo correctamente ";

?>