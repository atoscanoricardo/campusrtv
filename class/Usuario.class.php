<?php
/*
* clase 		Tabla
* version 		1.1
* autor 		Alexander|Toscano kikret@gmail.com
* descripcion 	Contiene métodos básicos de gestion de bases de datos
* tipo          Pública
*/
	require_once('classBase/Tabla.class.php');
	
	class Usuario extends Tabla{

		public function login($dato, $conexion){
			$arrUsuario = $this->get(array("id", "usuario","tipo"),"usuario='".$dato["usuario"]."' and contrasena='".$dato["contrasena"]."'");			
			return $arrUsuario;
		}

	}		
?>