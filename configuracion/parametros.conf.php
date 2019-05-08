<?php
/*
* archivo conf 	parametros
* version       1.1
* autor         Alexander|Toscano kikret@gmail.com
* descripcion   Contiene parametros basicos para iniciar la aplicacion

Cpanel URL : http://cpanel.0lx.net
Username   : eshos_14069463
pass: eshost4


FTP User Name 	FTP Password	FTP Host Name		FTP Port
eshos_14069463	eshost4			ftp.0lx.net			21

dirccion electronica: http://nuevaweb000.0lx.net/campusrtv/

*/
	// script de upload


	$parametros = array('conexion1' 	=>	array('DB_HOST'=>'localhost',//su host
										  'DB_USER'=>'root',//su usuario
										  'DB_PASS'=>'root',//su contraseña
										  'DB_NAME'=>'campusrtv2'	//su base de datos
									),
						'conexion2' 	=>	array('DB_HOST'=>'sql213.0lx.net',//su host
										  'DB_USER'=>'eshos_14069463',//su usuario
										  'DB_PASS'=>'eshost4',//su contraseña
										  'DB_NAME'=>'eshos_14069463_campusrtv2'	//su base de datos
									),
						'conexion3' 	=>	array('DB_HOST'=>'192.168.4',//su host
										  'DB_USER'=>'root',//su usuario
										  'DB_PASS'=>'root',//su contraseña
										  'DB_NAME'=>'campusrtv2',	//su base de datos
									),

						'lenguajes'	=>	array('es'),//lenguajes usados en la aplicación
						'lenguaje'	=>	'es',//lenguaje usado por defecto
						'mensajes'	=>	array('Registro guardado con éxito',
										  'Error al guardar el registro',
										  'Llene los campos obligatorios',
										  'Registro elinimado',
										  'error al eliminar el registro'
									),
						'carpeta_archivo'=> array('imagen' => 'recursos/f_imagenes',
											'documento'=>'recursos/f_documentos'
									),
						'limite_archivos'=> array('documento' => 30000,
											'imagen'=>10000,
									 )

						);

	if ($_SERVER["SERVER_NAME"]=='localhost') {
		$parametros['conexion'] = $parametros['conexion1'];
	}else{
		$parametros['conexion'] = $parametros['conexion2'];
	}






?>