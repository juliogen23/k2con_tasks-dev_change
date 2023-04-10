<?php
unset($_condition,$_values);
if ($_REQUEST["cmp_providers_phone"] == "error") $_REQUEST["cmp_providers_phone"]   = "";
if ($_REQUEST["cmp_providers_phone2"] == "error") $_REQUEST["cmp_providers_phone2"] = "";
if( !empty($_REQUEST["providers_name_company"]) ) $_value["providers_name_company"] = $_REQUEST["providers_name_company"];
if( !empty($_REQUEST["providers_category"]) ) $_value["providers_category"]         = $_REQUEST["providers_category"];
if( !empty($_REQUEST["providers_country"]) ) $_value["providers_country"]           = implode(",",$_REQUEST["providers_country"]);
if( !empty($_REQUEST["providers_email"]) ) $_value["providers_email"]               = $_REQUEST["providers_email"];
if( !empty($_REQUEST["providers_name_contact"]) ) $_value["providers_name_contact"] = $_REQUEST["providers_name_contact"];
if( !empty($_REQUEST["cmp_providers_phone"]) ) $_value["providers_phone"]           = $_REQUEST["cmp_providers_phone"];
if( !empty($_REQUEST["cmp_providers_phone2"]) ) $_value["providers_phone2"]         = $_REQUEST["cmp_providers_phone2"];
if( !empty($_REQUEST["providers_link"]) ) $_value["providers_link"]                 = $_REQUEST["providers_link"];
if( !empty($_REQUEST["providers_address"]) ) $_value["providers_address"]           = $_REQUEST["providers_address"];
if( !empty($_REQUEST["providers_notes"]) ) $_value["providers_notes"]               = $_REQUEST["providers_notes"];

if(empty($_REQUEST["providers_id"])){
    $_value["providers_created_at"] = date("Y-m-d H:i:s");
    $_value["providers_created_by"] = $_SESSION["user_id"];
    $providers_id = $CRUD->Insert("providers",$_value);
}else{
    $_condition["providers_id"] = $_REQUEST["providers_id"];
    $providers_id = $_REQUEST["providers_id"];
    $CRUD->Update("providers",$_condition,$_value);
}

$_value["providers_id"] = $providers_id;
echo json_encode($_value);
?>