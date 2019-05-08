<?php
/*
* clase         DBModelo
* version       1.1
* autor         Alexander|Toscano kikret@gmail.com
* descripcion   Contiene metodos basicos de conexion a bases de datos
* tipo          Publica
*/


class DBModelo {
    public $db_host;
    public $db_user;
    public $db_pass;
    public $db_name;
    public $db_port;
    public $soket;
    public $sql;
    public $rows = array();
    public $conn;

    #construccion
    public function __construct($conexion){
        $this->db_host  = $conexion['DB_HOST'];
        $this->db_user  = $conexion['DB_USER'];
        $this->db_pass  = $conexion['DB_PASS'];
        $this->db_name  = $conexion['DB_NAME'];
        $this->query    = null;
        $this->rows     = null;
        $this->conexion = null;
    }
    #conectar la base de datos
    public function abrir_conexion() {
        if(!isset($this->db_port)){
            $this->db_port = '';
        }
        $this->conexion = new mysqli($this->db_host, $this->db_user,$this->db_pass, $this->db_name);
    }

    public function get_tablas(){
        $result = $this->conexion->query("SHOW TABLE STATUS FROM ".$this->db_name);
        $cadena = "<table><tr><td colspan='2'><form name='fmTablas'></td></tr>";
        while($objTablas = $result->fetch_object()) {
            $cadena.="<tr><td><input type='checkbox' value='".$objTablas->Name."'  checked='checked'></td><td>".$objTablas->Name."</td></tr>";
        }
        $cadena.="<tr><td colspan='2'><input type='submit' value='Generar'></td></tr>";
        $cadena.="</form>";
        return $cadena;
    }

    public function query($sql){
        $row = null;
        $this->sql = $sql;
        $result = $this->conexion->query($this->sql);

        if($result!=null){
            while ($objColumnas = $result->fetch_object())  {
                if (is_object($objColumnas)) {
                    $row[] = get_object_vars($objColumnas);
                }
            }
        }

        return $row;
    }

    #desconectar la base de datos
    public function cerrar_conexion() {
        $this->conexion->close();
    }
    #destruccion de datos de la clase
    public function __destruct(){
        $this->db_host  = null;
        $this->db_user  = null;
        $this->db_pass  = null;
        $this->db_name  = null;
        $this->sql      = null;
        $this->rows     = null;
        $this->conexion = null;
    }
}
?>