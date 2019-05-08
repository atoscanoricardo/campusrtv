<?php
	require_once('../../class/classBase/DBModelo.class.php');
	require_once('../../configuracion/parametros.conf.php');


	$conexion = new DBModelo($parametros['conexion']);
	$conexion->abrir_conexion();

	require("../../class/Autor.class.php");
	$aud_aut = new Autor('autores', $conexion);

	$arrAutores =  $aud_aut->get();
	$autores = '';

	foreach ($arrAutores as $value) {
		$autores.= $value['nombre'].',';
	}

	print_r( $autores );
?>