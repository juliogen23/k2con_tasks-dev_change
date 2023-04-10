<?php
// function pt($text){
//   global $arrTranslate;
//   if (in_array($text,$arrTranslate)){
// 	  return $arrTranslate[$text];
//   } else {
// 	  $CRUD= new CRUD();
//     unset($Campos_Valores);
// 	  $Campos_Valores["texto"] = $text;
// 	  $CRUD->Insert("sys_textos",$Campos_Valores);
//     unset($Campos_Valores);
// 	  return $text;
//   }
// }
//fechas
function formatDate($fecha) {
  if (empty($fecha)){ return;}
  list($fecha,$hora) = explode(" ",$fecha);
  list($a,$m,$d) = explode("-",$fecha);
  return $m."/".$d."/".$a;
}
function formatDateV($fecha) {
  if (empty($fecha)){ return;}
  list($fecha,$hora) = explode(" ",$fecha);
  list($a,$m,$d) = explode("-",$fecha);
  return $d."/".$m."/".$a;
}
function formatoFecha($fecha,$format=Format_Fecha){
  $F=($format)?$format:Format_Fecha;
  return ($fecha)?date($F,strtotime($fecha)):"";
}
function formatDateTime($fecha) {
  if(empty($fecha))return;

  list($fecha,$hora) = explode(" ",$fecha);
  list($a,$m,$d) = explode("-",$fecha);
  list($H,$i,$s) = explode(":",$hora);
  return $m."/".$d."/".$a." ".$H.":".$i.":".$s;
}
function formatDateMysql($fecha) {
  list($m,$d,$a) = explode("/",$fecha);
  return $a."-".$m."-".$d;
}
function formatDateMysql2($fecha) {
  list($d,$m,$a) = explode("/",$fecha);
  return $a."-".$m."-".$d;
}
//imagenes
function IMG_Move($FILES,$_nameFile,$dir){
  if($FILES["name"]){
		$info = new SplFileInfo($FILES["name"]);
		if (strtoupper($info->getExtension())=='JPG' || strtoupper($info->getExtension())=='JPEG'|| strtoupper($info->getExtension())=='PNG'){
			$tempFile=$FILES["tmp_name"];
			$targetPath="./src/upload/".$dir;
			$nameFile=$_nameFile.".".strtoupper($info->getExtension());
			$targetFile=$targetPath.$nameFile;
			if (move_uploaded_file($tempFile,"$targetFile")){
				return $nameFile;
			}
		}
	}
}

function claveAleatoriaNumber($long = 6) {
		$num='';
	   for ($i=0; $i < $long;$i++){
	   	$num.=rand(0,9);
	   }
		 return $num;
	}
?>
