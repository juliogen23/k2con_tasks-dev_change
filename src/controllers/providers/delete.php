<?php 
unset($_Condition,$_Value);
$_Condition["providers_id"] = $_REQUEST["providers_id"];
$_Value["providers_status"] = 1;
echo $CRUD->Update("providers",$_Condition,$_Value);
?>