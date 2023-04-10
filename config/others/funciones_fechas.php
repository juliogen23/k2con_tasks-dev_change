<?php
	function sumarDiasFecha($fecha,$dias) {
		if ($dias > 0) {
			$nuevafecha = strtotime ( '+'.$dias.' day' , strtotime ( $fecha ) ) ;
		} else {
			$nuevafecha = strtotime ( $dias.' day' , strtotime ( $fecha ) ) ;
		}
		$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
		return $nuevafecha;
	}
?>