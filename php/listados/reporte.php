<?php

	require_once('../../class/classBase/DBModelo.class.php');
	require_once('../../class/classBase/Funciones.class.php');
	require_once('../../class/classBase/Consultas.class.php');
	require_once('../../class/Audio.class.php');
	require_once('../../class/Audiovisual.class.php');
	require_once('../../class/Proyecto.class.php');
	require_once('../../configuracion/parametros.conf.php');


  $conexion = new DBModelo($parametros['conexion']);
  $conexion->abrir_conexion();

  $funcion = new Funciones();
  $consulta = new Consultas();

  if(isset($_POST['id']) && isset($_POST['tb'])){
  	$result = $conexion->query( "SELECT * FROM ".$_POST['tb']." WHERE id=".$_POST['id'] )[0];

  	echo json_encode($result);
  }


?>