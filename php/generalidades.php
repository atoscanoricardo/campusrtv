<?php
	require_once('../class/classBase/DBModelo.class.php');
	require_once('../configuracion/parametros.conf.php');
	require_once('../class/classBase/Funciones.class.php');


	$con = new DBModelo($parametros['conexion']);
	$con->abrir_conexion();



	if ( isset( $_GET["q"] ) ) {

		switch ($_GET["q"]) {
			case 'total_recurso':
					$result = $con->query("SELECT count(id) FROM ".$_POST["tabla"] );
				break;
		}

		print_r($result[0]["count(id)"]);
	}
?>