<?php 
    unset($_Condition,$_Value);
    $task_id               = $_REQUEST["task_id"];
    $_Condition["task_id"] = $task_id;
    $_Value["task_status"] = 1;
    $event = $CRUD->Select("tasks_tasks",$_Condition)[0];
    if( $_SESSION[SESSION_SYSTEM."_user_type"]!=1 ){
        if( $event["task_creat_by"] != $_SESSION["user_id"] ){
                $re = false;
        }else{
                $re = true;
        }
    }else{
        $re = true;
    }
    if( $re ){
        echo $CRUD->Update("tasks_tasks", $_Condition, $_Value);
        $type    = "Deleted Task";
        $text    = "El usuario ".$_SESSION["user_id"]." Elimino el task";
        addUpdate($task_id,$type,$text,true);
    }	
?>