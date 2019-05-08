<?php
	require_once('../class/classBase/DBModelo.class.php');
	require_once('../configuracion/parametros.conf.php');


	$conexion = new DBModelo($parametros['conexion']);
	$conexion->abrir_conexion();

	$result = 0;
	require("../class/Autor.class.php");
	$autor = new Autor('autores', $conexion);


	switch ($_POST['t_archivo']) {
		case 'audio':
				require("../class/Audio.class.php");
				require("../class/Audio_Autor.class.php");

				$archivo = new Audio('audios', $conexion);
				$audio_autor = new Audio_Autor('audios_autores', $conexion);

				foreach ($_POST as $campo => $valor) {
					if ($campo!='ruta' or $campo!='autores' or $valor!='array') {
						$_POST['tag'].=', '.$valor;
					}

					if ($campo=='autores') {
						foreach ($_POST['autores'] as $nombre) {
							$tag.= ', '.$nombre;
						}
					}
				}
				echo $_POST['tag'].= $tag;

				$id_archivo = $archivo->set($_POST);
				$i=0;
				foreach ($_POST['autores'] as $nombre) {

					$id_autor = $autor->get(array('id'),'nombre='."'".$nombre."'")[0]['id'];

					if (!$id_autor) {
						$id_autor = $autor->set( array('nombre'=>$nombre) );
					}

					$audio_autor->set(array('id_audio' => $id_archivo, 'id_autor' => $id_autor) );
				}

			break;
		case 'audiovisual':
				require("../class/Audiovisual.class.php");
				require("../class/Audiovisual_Autor.class.php");

				$archivo = new Audiovisual('audiovisuales', $conexion);
				$audiovisual_autor = new Audiovisual_Autor('audiovisuales_autores', $conexion);

				foreach ($_POST as $campo => $valor) {
					if ($campo!='ruta' or $campo!='autores' or $valor!='array') {
						$_POST['tag'].=', '.$valor;
					}

					if ($campo=='autores') {
						foreach ($_POST['autores'] as $nombre) {
							$tag.= ', '.$nombre;
						}
					}
				}
				echo $_POST['tag'].= $tag;

				$id_archivo = $archivo->set($_POST);
				$i=0;
				foreach ($_POST['autores'] as $nombre) {

					$id_autor = $autor->get(array('id'),'nombre='."'".$nombre."'")[0]['id'];

					if (!$id_autor) {
						$id_autor = $autor->set( array('nombre'=>$nombre) );
					}

					$audiovisual_autor->set(array('id_audiovisual' => $id_archivo, 'id_autor' => $id_autor) );
				}
			break;
		case 'proyecto':
				require("../class/Proyecto.class.php");
				require("../class/Proyecto_Autor.class.php");

				$archivo = new Proyecto('proyectos', $conexion);
				$proyecto_autor = new Proyecto_Autor('proyectos_autores', $conexion);

				foreach ($_POST as $campo => $valor) {
					if ($campo!='ruta' or $campo!='autores' or $valor!='array') {
						$_POST['tag'].=', '.$valor;
					}

					if ($campo=='autores') {
						foreach ($_POST['autores'] as $nombre) {
							$tag.= ', '.$nombre;
						}
					}
				}
				echo $_POST['tag'].= $tag;


				$id_archivo = $archivo->set($_POST);
				$i=0;
				foreach ($_POST['autores'] as $nombre) {

					$id_autor = $autor->get(array('id'),'nombre='."'".$nombre."'")[0]['id'];

					if (!$id_autor) {
						$id_autor = $autor->set( array('nombre'=>$nombre) );
					}

					$proyecto_autor->set(array('id_proyecto' => $id_archivo, 'id_autor' => $id_autor) );
				}
			break;
	}




?>