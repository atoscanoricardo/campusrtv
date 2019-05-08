<?php
	require_once('../class/classBase/DBModelo.class.php');
	require_once('../configuracion/parametros.conf.php');

	$conexion = new DBModelo($parametros['conexion']);
	$conexion->abrir_conexion();


	$result = array();
	$indices = array('audios', 'videos', 'proyectos');
	$i=0;
	foreach ($_POST['consulta'][0]['tablas'] as $tabla) {
		//switch para condicion de consulta por item

		if ($tabla != ''){
			$result[$indices[$i] ] = $conexion->query("SELECT * FROM ".$tabla);
		}

		$i++;
	}
	print_r( json_encode($result) );
?>