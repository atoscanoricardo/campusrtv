<?php
/*
* clase 		Tabla
* version 		1.1
* autor 		Alexander|Toscano kikret@gmail.com
* descripcion 	Contiene metodos basicos de gestion de bases de datos
* tipo 			Pública
*/


class Tabla {
    public $nombre_tabla;
    protected $BDobj;
    public $campos;

    public function __construct($nombre=null, $BDobj){
    	$this->nombre_tabla = $nombre;
    	$this->BDobj = $BDobj;
    	$this->campos = $this->SQLColumna("COLUMN_NAME");
    }

	public function __destruct(){

    }

    public function set($user_data=array()){

    	$cad_campos=" (";
	    $cad_valores=" values (";
		$coma=" ";
		$valRegistro="";

    	#retorna nombres y tipos de datos de las columnas
    	$arr_campos_tabla = array('NOMBRE_COLUMNA'=>$this->SQLColumna("COLUMN_NAME"),
    							  'TIPO_DATO_CAMPOS'=>$this->SQLColumna("DATA_TYPE")
    							);

    	#creacion de sql para insertar en tabla
		$sql_insert="INSERT INTO ".$this->nombre_tabla;


		#creacion de un arreglo con los campos que contienen informacion
		foreach ($user_data as $campo => $valor) {
			if(in_array($campo, $arr_campos_tabla["NOMBRE_COLUMNA"])){
			   $pos=array_search($campo, $arr_campos_tabla["NOMBRE_COLUMNA"]);
			   $arrCadenaSQL[] = Array($campo, $valor, $arr_campos_tabla["TIPO_DATO_CAMPOS"][$pos]);
			}
		}

		#creacion de cadenas de campos y valores dependiendo del tipo
		foreach ($arrCadenaSQL as $arrRegsistro){
				switch ($arrRegsistro[2]) {
					case 'int':
						$valRegistro=$coma . $arrRegsistro[1];
					break;
					case 'tinyint':
						$valRegistro=$coma . $arrRegsistro[1];
					break;
					case 'varchar':
						$valRegistro=utf8_encode($coma . "'" . $arrRegsistro[1] . "'");
					break;
					case 'char':
						$valRegistro=utf8_encode($coma . "'" . $arrRegsistro[1] . "'");
					break;
					case 'blob':
						$valRegistro=utf8_encode($coma . "'" . $arrRegsistro[1] . "'");
					break;
					case 'datetime':
						$valRegistro=utf8_encode($coma . "'" . $arrRegsistro[1] . "'");
					break;
					case 'date':
						$valRegistro=utf8_encode($coma . "'" . $arrRegsistro[1] . "'");
					break;
				}

					$cad_campos.=$coma.$arrRegsistro[0];
					$cad_valores.=$valRegistro;
					$coma=", ";
			}
			#finalizacion de cadenas indivduales
			$cad_campos.=")";
	        $cad_valores.=")";

			#union de cadenas para generar el sql
			$this->BDobj->sql=$sql_insert . $cad_campos . $cad_valores;

			$this->BDobj->conexion->query($this->BDobj->sql);

			$ultimo_id = $this->BDobj->conexion->insert_id;

			return $ultimo_id;
	}

	private function SQLColumna($IS_C){

    	$this->BDobj->sql= "SELECT ".$IS_C.
			  " FROM INFORMATION_SCHEMA.COLUMNS".
			  " WHERE table_name = '".$this->nombre_tabla."'".
			  " AND table_schema = '".$this->BDobj->db_name."'";

		$result = $this->BDobj->conexion->query($this->BDobj->sql);

    	if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
			    $campos[]=$row[$IS_C];
			}
    	}
		return $campos;
	}

	public function get($arrCampos=array('*'), $condicion=null, $add=null) {

		$campos=null;
		$coma='';
		$row = null;

		foreach ($arrCampos as $campo) {
			$campos.= $coma . $campo;
			$coma=', ';
		}

		if($condicion){
			$condicion="WHERE ".$condicion;
		}

		$this->BDobj->sql = "SELECT ".$campos." FROM ".$this->nombre_tabla." ".$condicion.' '.$add;
		$result = $this->BDobj->conexion->query($this->BDobj->sql);

		if($result!=null){
			while ($objColumnas = $result->fetch_object())  {
				if (is_object($objColumnas)) {
					$row[] = get_object_vars($objColumnas);
				}
			}
		}

	    return $row;
	}

	public function edit($arrCampos=array(), $condicion=null) {
		$sql = "UPDATE ".$this->nombre_tabla." SET ";
		$coma='';

		$arr_campos_tabla = array('NOMBRE_COLUMNA'=>$this->SQLColumna("COLUMN_NAME"),
    							  'TIPO_DATO_CAMPOS'=>$this->SQLColumna("DATA_TYPE")
    							);
		#creacion de un arreglo con los campos que contienen informacion
		foreach ($arrCampos as $campo => $valor) {
			if(in_array($campo, $arr_campos_tabla["NOMBRE_COLUMNA"])){
			   $pos=array_search($campo, $arr_campos_tabla["NOMBRE_COLUMNA"]);
			   $arrCadenaSQL[] = Array($campo, $valor, $arr_campos_tabla["TIPO_DATO_CAMPOS"][$pos]);
			}
		}


		#creacion de cadenas de campos y valores dependiendo del tipo
		foreach ($arrCadenaSQL as $arrRegsistro){
				switch ($arrRegsistro[2]) {
					case 'tinyint':
						$valRegistro=$arrRegsistro[1];
					break;
					case 'int':
						$valRegistro=$arrRegsistro[1];
					break;
					case 'varchar':
						$valRegistro=utf8_encode("'" . $arrRegsistro[1] . "'");
					break;
					case 'char':
						$valRegistro=utf8_encode("'" . $arrRegsistro[1] . "'");
					break;
					case 'blob':
						$valRegistro=utf8_encode("'" . $arrRegsistro[1] . "'");
					break;
					case 'datetime':
						$valRegistro=utf8_encode("'" . $arrRegsistro[1] . "'");
					break;
					case 'date':
						$valRegistro=utf8_encode("'" . $arrRegsistro[1] . "'");
					break;
					case 'time':
						$valRegistro=utf8_encode("'" . $arrRegsistro[1] . "'");
					break;
				}

					$sql.=$coma.$arrRegsistro[0]."=".$valRegistro;
					$coma=", ";
			}

		if($condicion){
			$condicion=" WHERE ".$condicion;
		}

		$sql.=$condicion;

		$this->BDobj->sql=$sql;

		$this->BDobj->conexion->query($this->BDobj->sql);

	}

	public function delete($arrCondiciones=array()) {
		$sql=null;
		$puntoycoma=" ";

		foreach ($arrCondiciones as $condicion) {
			$sql.=$puntoycoma."DELETE FROM ".$this->nombre_tabla." WHERE ".$condicion;
			$puntoycoma="; ";
		}

		$this->BDobj->sql=$sql;
		$this->BDobj->conexion->multi_query($this->BDobj->sql);
	}

	public function find($campos, $condicion){
		$this->BDobj->sql = "SELECT ".$campos." FROM ".$this->nombre_tabla." WHERE ".$condicion;
		$result = $this->BDobj->conexion->multi_query($this->BDobj->sql);

		if($result!=null){
			while ($objColumnas = $result->fetch_object())  {
				if (is_object($objColumnas)) {
					$row[] = get_object_vars($objColumnas);
				}
			}
		}

	    return $row;
	}

}
?>