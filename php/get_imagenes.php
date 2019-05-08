<?php

	require_once('../configuracion/parametros.conf.php');
	require_once('../class/classBase/DBModelo.class.php');
	require_once("../class/Imagen.class.php");


	$conexion = new DBModelo($parametros['conexion']);
	$conexion->abrir_conexion();

	$imagen = new Imagen('imagenes', $conexion);

	if (isset($_POST['get_images'])) {

		switch ($_POST['get_images']) {
			case 'all':
					$arr_imagenes = $imagen->get(array("*"),'', 'ORDER BY id DESC');
				break;
		}

		print_r(json_encode($arr_imagenes) );

	}

?>