<?php
   include("./config/general/instances.php");
   

   $es_modulo = "";
   foreach($ARR_MODULES as $module => $module_config) {
		$s = substr($DESTINY,0,strlen($module));
		if ($s == $module) {
			$es_modulo = "modules/".$module."/";
			$DESTINY = str_replace($module."_","",$DESTINY);
			break;
		}
   }
   if($_SERVER['REQUEST_METHOD'] == 'POST' || !empty($_GET["P"])){//Peticion POST o una variable "P"
		if ($es_modulo)
			require_once("./src/".$es_modulo."controllers/".str_replace("_","/",$DESTINY).".php");//El primer valor es la raiz del array y el nombre del controlador a ejecutar
			
		else {
			require_once("./src/controllers/".str_replace("_","/",$DESTINY).".php");//El primer valor es la raiz del array y el nombre del controlador a ejecutar
		}
     
   }else{//En todas las peticiones get la solicitud espera una vista
		if ($es_modulo)
			require_once("./src/".$es_modulo."views/".str_replace("_","/",$DESTINY).".php");
		else
			require_once("./src/views/dynamic/".str_replace("_","/",$DESTINY).".php");
   }
  ?>