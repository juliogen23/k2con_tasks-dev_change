<?php

$bitacora_none=["[object Object]","src/"];
$bitacora_status=true;
//if(empty($_COOKIE["rand_id"])){ setcookie("rand_id", rand(), time() + 100 * 24 * 60 * 60); }

foreach ($bitacora_none as $key => $value){
  $bitacora_status=(strpos(URL,$value)===false)?$bitacora_status:false;
}
// SELECT `b_id`, `b_accion`, `b_url`, `b_dir`, `b_method`, `b_datos`, `b_fecha`, `usu_id`, `rand_id`, `b_ip` FROM `bitacora` WHERE 1
if ($bitacora_status){
    $_Campos_Valores=[];
    $method=($_SERVER['REQUEST_METHOD'] == 'POST' || !empty($_GET["P"]))?"POST":"GET";
    $_Campos_Valores["b_accion"]= "Access to '".URL."' -> '".$_RUTES[URL]."' -> METHOD $method";
    $_Campos_Valores["b_url"]= URL;
    $_Campos_Valores["b_dir"]= $_RUTES[URL];
    $_Campos_Valores["b_method"]=$method;
    $_Campos_Valores["b_datos"]= (strpos(json_encode($_REQUEST),"password")===false)?json_encode($_REQUEST):"key included";
    $_Campos_Valores["b_fecha"] = date("Y-m-d H:i:s");
    $_Campos_Valores["b_ip"]  = $_SERVER["REMOTE_ADDR"];
    $_Campos_Valores["usu_id"]  = (!empty($_SESSION["user_id"]))?$_SESSION["user_id"]:0;
    $_Campos_Valores["rand_id"]  = $_COOKIE["rand_id"];
    $CRUD->Insert("bitacora",$_Campos_Valores);
}
?>
