<?php 
unset($_Condition,$_Value);
$_Condition["project_id"] = $_REQUEST["project_id"];
$_Value["project_status"] = 2;
echo $CRUD->Update("projects",$_Condition,$_Value);
?>