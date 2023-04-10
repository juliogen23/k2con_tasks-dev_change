<?php
	function cargar_archivo_con_nombre_y_ext($campo_archivo,$ruta_archivo, $nombre_archivo, $nombre_archivo_alternativo){ //GUARDA CON NOMBRE DADO Y MANTIENE EXTENSION
			if (is_uploaded_file($_FILES[$campo_archivo]['tmp_name'])){
				$arrDatos = pathinfo($_FILES[$campo_archivo]['name']);
				$nombre_archivo_temp=$nombre_archivo.".".$arrDatos['extension'];
				copy($_FILES[$campo_archivo]['tmp_name'],$ruta_archivo.$nombre_archivo_temp);
			}else {		
				$nombre_archivo_temp=$nombre_archivo_alternativo;
			}
			return $nombre_archivo_temp;
	}
	function cargar_archivo_con_nombre($campo_archivo,$ruta_archivo, $nombre_archivo, $nombre_archivo_alternativo){ //GUARDA CON NOMBRE DADO Y MANTIENE EXTENSION
			if (is_uploaded_file($_FILES[$campo_archivo]['tmp_name'])){
				$arrDatos = pathinfo($_FILES[$campo_archivo]['name']);
				$nombre_archivo_temp=$nombre_archivo;
				copy($_FILES[$campo_archivo]['tmp_name'],$ruta_archivo.$nombre_archivo_temp);
			}else {		
				$nombre_archivo_temp=$nombre_archivo_alternativo;
			}
			return $nombre_archivo_temp;
	}
	function cargar_archivo_con_nombre_y_ext_multiple($campo_archivo,$ruta_archivo, $nombre_archivo, $nombre_archivo_alternativo,$pos){ //GUARDA CON NOMBRE DADO Y MANTIENE EXTENSION
			if (is_uploaded_file($_FILES[$campo_archivo]['tmp_name'][$pos])){
				$arrDatos = pathinfo($_FILES[$campo_archivo]['name'][$pos]);
				$nombre_archivo_temp=$nombre_archivo.".".$arrDatos['extension'];
				copy($_FILES[$campo_archivo]['tmp_name'][$pos],$ruta_archivo.$nombre_archivo_temp);
			}else {		
				$nombre_archivo_temp=$nombre_archivo_alternativo;
			}
			return $nombre_archivo_temp;
	}	
?>
