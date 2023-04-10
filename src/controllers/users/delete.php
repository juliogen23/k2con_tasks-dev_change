<?php 
unset($_Condition,$_Value);
$_Condition["staff_id"] = $_REQUEST["staff_id"];
$_Value["staff_status"] = 3;
echo $CRUD->Update("staff",$_Condition,$_Value);
?>