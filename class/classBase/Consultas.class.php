<?php
	session_start();
	/*
		tipos: 0-administrador, 1-autor, 2-experto, 3-invitado
	*/
	class Consultas{

		public $sql='';
		public $incremento=2;
		//traer todo
		public function get_all($table, $tag){
			$lim_inf = $_SESSION['lim_inf'];
			$lim_sup = $lim_inf+$this->incremento;
			$like = ( $tag !=null )? "WHERE tag LIKE '%".$tag."%' OR nombre LIKE '%".$tag."%' " : '';
			echo 'limit '.$lim_inf.', '.$lim_sup;
			return $this->sql = "SELECT * FROM ".$table.' '.$like.' limit '.$lim_inf.', '.$lim_sup;
		}
		//trae listado de autores
		public function list_all_autor(){
			echo 'limit '.$lim_inf.', '.$lim_sup;
			return $this->sql = "SELECT * FROM usuarios WHERE tipo = 1";
			$this->sql;
		}

		public function get_for_fied($table, $field, $q){
			$lim_inf = $_SESSION['lim_inf'];
			$lim_sup = $lim_inf+$this->incremento;
			echo 'limit '.$lim_inf.', '.$lim_sup;
			return $this->sql = "SELECT * FROM ". $table ." WHERE ".$field." LIKE '%".$q."%'" .' limit '.$lim_inf.', '.$lim_sup;
			$this->sql;
		}

		public function get_all_for_q($obj, $q){
			$or = '';
			$like ='';
			$lim_inf = $_SESSION['lim_inf'];
			$lim_sup = $lim_inf+$this->incremento;
			foreach ($obj->campos as $key) {
				$like.= $or.$key." LIKE '%".$q."%'";
				$or = ' or ';
			}
			echo 'limit '.$lim_inf.', '.$lim_sup;
			return $this->sql = "SELECT * FROM ".$obj->nombre_tabla." WHERE ".$like.' limit '.$lim_inf.', '.$lim_sup;
			$this->sql;
		}

		public function get_first($limit, $table){
			echo 'limit '.$lim_inf.', '.$lim_sup;
			return $this->sql = "SELECT * FROM $table ORDER BY id ASC limit $limit" ;
			$this->sql;
		}


	}

?>