<?php
unset($_condition,$_values);

if( !empty($_REQUEST["name"]) ) $_value["project_name"] = $_REQUEST["name"];

if(empty($_REQUEST["project_id"])){
    $project_id = $CRUD->Insert("projects",$_value);
}else{
    $_condition["project_id"] = $_REQUEST["project_id"];
    $project_id = $_REQUEST["project_id"];
    $CRUD->Update("projects",$_condition,$_value);
}
$_value["project_id"] = $project_id;

// 
if( !empty($_REQUEST["contact"]) ){
    unset($_condition,$_values);
    $_value["contact"] = $_REQUEST["contact"];
    $_condition["project_id"] = $project_id;
    $contact_projects = $CRUD->Written("SELECT contact_id FROM contact_projects WHERE project_id=:project_id",$_condition,true);
    $array = [];
    foreach($contact_projects as $ar){
        $array[$ar["contact_id"]] = $ar["contact_id"];
    }
    // $contact = implode(",",$_REQUEST["contact"]);
    $contact = $_REQUEST["contact"];

    $resultado1 = array_diff($array, $contact);
    $resultado2 = array_diff($contact,$array);

    if( !empty($resultado1) ){ 
        foreach(  $resultado1 as $key=>$value){
            unset($_conditionD);
            $_conditionD["contact_id"] = $value;
            $_conditionD["project_id"] = $project_id; 
            $CRUD->Delete("contact_projects", $_conditionD);
        }
    }

    if( !empty($resultado2) ){ 
        foreach(  $resultado2 as $key=>$value){
            unset($_val);
            $_val["contact_id"] = $value;
            $_val["project_id"] = $project_id; 
            $CRUD->Insert("contact_projects", $_val);
        }
     }
}

echo json_encode($_value);
?>