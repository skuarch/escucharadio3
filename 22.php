<?php

	require_once "EscucharadioConnection.php";
	require_once'20.php';
    $connection = new EscuchaRadioConnection();
    $appName = filterBadCharacters($_POST['appName']);
    $appVersion = filterBadCharacters($_POST['appVersion']);
    $userAgent = filterBadCharacters($_POST['userAgent']);
    $sql = sprintf("INSERT INTO navigator (navigator_appname, navigator_appversion, navigator_useragent) VALUES ('".$appName."','".$appVersion."','".$userAgent."');");
	$connection->executeUpdated($sql);
