<?php 
unset($_Condition,$_Value);
$_Condition["contact_id"] = $_REQUEST["contact_id"];
$_Value["contact_status"] = 1;
echo $CRUD->Update("contact",$_Condition,$_Value);
?>