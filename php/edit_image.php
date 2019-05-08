<?php
	require_once('../configuracion/parametros.conf.php');
	require_once('../class/classBase/DBModelo.class.php');
	require_once("../class/Imagen.class.php");

	$conexion = new DBModelo($parametros['conexion']);
	$conexion->abrir_conexion();

	$imagen = new Imagen('imagenes', $conexion);
	switch ($_POST["metodo"]) {
		case 'edit':
			$imagen->edit(array('visible' => $_POST['visible']), 'id='.$_POST['id'] );
		break;
		case 'delete':
			$imagen->delete(array('id='.$_POST['id']));
			$file = '../img/carrusel/'.$_POST['ruta'];
			@chmod($file,0777);
			@unlink($file);
		break;


	}


?>