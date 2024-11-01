<?php

function conectarDB() : mysqli {
	$db = new mysqli('localhost', 'root', '', 'bienesraices_crud');

	if (!$db) {
		echo "No se pudó conectar";
		exit;
	}

	return $db;
}