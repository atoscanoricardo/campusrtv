<?php
	require_once('../configuracion/parametros.conf.php');
	require_once('../class/classBase/DBModelo.class.php');
	require_once("../class/Imagen.class.php");


	$conexion = new DBModelo($parametros['conexion']);
	$conexion->abrir_conexion();

	$imagen = new Imagen('imagenes', $conexion);

	if($_SERVER['REQUEST_METHOD']=="POST"){
		//captura del nombre del archivo
		$remote_file = $_POST["filename"];
		//captura de imagen
	    $imgData1 = $_POST['imageData'];
	    //print_r(explode(':', substr($imgData1, 0, strrpos($imgData1, ';') ) )[1]);
	    $imgData = substr($imgData1, 1+strrpos($imgData1, ','));
	    //echo $extension = substr($imgData1, strrpos($imgData1, ','));
	    $imageStr = base64_decode($imgData);
		$image = imagecreatefromstring($imageStr);
		//creacion de nuevo nombre
	    $name = substr( md5(microtime()), 1, 25).'.'.pathinfo($remote_file, PATHINFO_EXTENSION);
	    //creacion segun el fomato
	    $ruta = '../img/carrusel/'.$name;
	    switch ( explode(':', substr($imgData1, 0, strrpos($imgData1, ';') ) )[1] ){
		    case 'image/jpeg':
		        $image = imagejpeg($image, $ruta);//imagecreatefromjpeg($remote_file);
		    break;
		    case 'image/gif':
		        $image = imagejpeg($image, $ruta);//imagecreatefromgif($remote_file);
		    break;
		    case 'image/png':
		        $image = imagejpeg($image, $ruta);//imagecreatefrompng($remote_file);
		    break;
		    default:
		        die('Error abriendo la imagen, es posible que sea muy pequeña o este corrupta');
		}

		$imagen->set(array('ruta' => $name, 'visible' => true));

		$arr_imagenes = $imagen->get();

		print_r(json_encode($arr_imagenes) );


	}
?>







