<?php
unset($_condition,$_values);
if ($_REQUEST["cmp_contact_phone"] == "error") $_REQUEST["cmp_contact_phone"] = "";
if( !empty($_REQUEST["contact_company"]) ) $_value["contact_company"] = $_REQUEST["contact_company"];
if( !empty($_REQUEST["contact_name"]) ) $_value["contact_name"] = $_REQUEST["contact_name"];
if( !empty($_REQUEST["cmp_contact_phone"]) ) $_value["contact_phone"] = $_REQUEST["cmp_contact_phone"];
if( !empty($_REQUEST["contact_email"]) ) $_value["contact_email"] = $_REQUEST["contact_email"];
if( !empty($_REQUEST["contact_notes"]) ) $_value["contact_notes"] = $_REQUEST["contact_notes"];

if(empty($_REQUEST["contact_id"])){
    $_value["created_at"] = date("Y-m-d H:i:s");
    $_value["created_by"] = $_SESSION["user_id"];
    $contact_id = $CRUD->Insert("contact",$_value);
}else{
    $_condition["contact_id"] = $_REQUEST["contact_id"];
    $contact_id = $_REQUEST["contact_id"];
    $CRUD->Update("contact",$_condition,$_value);
}

$_value["contact_id"] = $contact_id;
echo json_encode($_value);
?>