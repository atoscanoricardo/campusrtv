<?php

/**
*
*/
class Funciones{

	public function get_tag($tag){
		return $arr_tag = explode(",", $tag);
	}

	public function get_tag_link($arr_tag){
		$tag_linked='';

		foreach ($arr_tag as $tag) {
			$tag_linked.= "[<a href='listados.php?tag=".$tag."'>".$tag."</a>] ";
		}

		return $tag_linked;
	}

	public function report_resource($recursos){
		$detalles='<ul class="list-group">

					';
		foreach ($recursos as $key) {
			$detalles.= "<li class='list-group-item'>
							".$key['nombre']."
							<a href='?'><small align='rigth'>Ver...</small></a>
					  </li>
					";
		}
		return $detalles."</ul>";
	}

	public function trunk_link($url, $length){
		return "...".substr($url , 30, $length)."...";
	}

}

?>