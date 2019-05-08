<?php
/**
* Clase de funciones
*/

class Funciones
{
	public $arrObjetos;
	public $usuario;
	public $recursos;




	public function __construct($arrObjetos=null){
		if(isset($arrObjetos)){
			$this->arrObjetos = $arrObjetos;
			$this->asignacionObjetos();
		}
	}
	public function linkTag($tags){
		$links='';
		if(isset($tags)){
			$links.='|';
			$arrTags = explode(",", trim($tags));

			foreach ($arrTags as $key => $tag) {
				$links.=" <a href='?modulo=mod_proyectos&tag=$tag'>$tag</a> |";
			}
		}
		return $links;
	}

	private function asignacionObjetos(){
		foreach ($this->arrObjetos as $objeto) {

			switch (get_class($objeto)){
				case 'Recursos':
					$this->recursos = $objeto;
					break;

				case 'Usuario':
					$this->usuario = $objeto;
					break;
			}
		}
	}



	public function getRecursos($tipo=0, $lim_inf=0, $lim_sup=7, $order='ano'){

		$cadena='';
		$arr_recursos = $this->recursos->get(array('*'), "tipo=$tipo", "LIMIT $lim_inf, $lim_sup");

		foreach ($arr_recursos as $recurso) {
				$cadena.=' <div class="media">
								<div class="media-left">
		                            <a href="#">
		                              <i class="fa fa-file-audio-o  fa-3x"></i>
		                            </a>
		                        </div>
								<div class="media-body">
									<h4 class="media-heading">'.$recurso['titulo'].'</h4>
			                        <a href="'.$recurso['url'].'">'.$this->acortarTexto($recurso['url']).'...</a>
			                        <br/><small>'.$recurso['ano'].'</small>
			                     </div>

		                    </div>';
		}

		 return $cadena;
	}




	public function getTags($lim_inf=0, $lim_sup=2, $order='id'){

		$cadena='';
		$arr_tag = $this->proyecto->get(array('tag'), null, "ORDER BY ".$order." DESC LIMIT $lim_inf, $lim_sup");
		$arr_palabras = array();

		foreach ($arr_tag as $tag) {
			$arr_palabras = array_merge($arr_palabras, explode(',', $tag['tag']) );
		}

		$arr_tag = array_unique($this->arraytolower($arr_palabras,true));

		asort($arr_tag);

		foreach ($arr_tag as $palabra) {
					$cadena.='<a href="#" class="list-group-item">'.
								$palabra.
							'<span class="badge"></span></a>';
		}

		return $cadena;
	}

	public function arraytolower($array, $include_leys=false) {

	    if($include_leys) {
	      foreach($array as $key => $value) {
	        if(is_array($value))
	          $array2[strtolower($key)] = arraytolower(trim($value), $include_leys);
	        else
	          $array2[strtolower($key)] = strtolower(trim($value));
	      }
	      $array = $array2;
	    }
	    else {
	      foreach($array as $key => $value) {
	        if(is_array($value))
	          $array[$key] = arraytolower(trim($value), $include_leys);
	        else
	          $array[$key] = strtolower(trim($value));
	      }
	    }

	    return $array;
  	}

  	public function acortarTexto($cadena){
  		$cadena = substr($cadena, 0, 20);
  		return $cadena;
  	}

}


?>