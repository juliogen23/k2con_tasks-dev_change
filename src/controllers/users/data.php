<?php
unset($_condition,$_values);
if( !empty($_REQUEST["name"]) ) $_value["staff_name"]     = ucwords($_REQUEST["name"]);
if( !empty($_REQUEST["user"]) ) $_value["staff_user"]     = $_REQUEST["user"];
if( !empty($_REQUEST["pass"]) && $_REQUEST["pass"] != "********" ) $_value["staff_pass"] = md5($_REQUEST["pass"]);
if( !empty($_REQUEST["email"]) ) $_value["staff_email"]   = $_REQUEST["email"];
if( !empty($_REQUEST["type"]) ) $_value["staff_type"]     = $_REQUEST["type"]; else $_value["staff_type"] = 2;
if( !empty($_REQUEST["lang"]) ) $_value["staff_lang"]     = $_REQUEST["lang"];
if( !empty($_REQUEST["status"]) ) $_value["staff_status"] = $_REQUEST["status"];

$_value["staff_initials"] = getIniciales($_REQUEST["name"]);
if(empty($_REQUEST["staff_id"])){
    $staff_id = $CRUD->Insert("staff",$_value);
}else{
    $_condition["staff_id"] = $_REQUEST["staff_id"];
    $staff_id = $_REQUEST["staff_id"];
    $CRUD->Update("staff",$_condition,$_value);
}

$_value["staff_id"] = $staff_id;
echo json_encode($_value);
?>