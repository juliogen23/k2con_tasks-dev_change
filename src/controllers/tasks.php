<?php 
unset($Values,$Condicion);
if ($_REQUEST["action"] == "newTask") {
	$Values["task_title"] = $_REQUEST["task"];
	$Values["task_created_at"] = date("Y-m-d H:i:s");
	$Values["task_startdate"] = $_REQUEST["startdate"];
	$Values["task_duedate"] = $_REQUEST["duedate"];
	$Values["staff_id"] = $_REQUEST["staff"];
	$Values["task_creat_by"] = $_SESSION["user_id"];
	$Values["project_id"] = $_REQUEST["project"];
	if( !empty($_REQUEST["members"]) ){ $Values["task_members"] = implode(",",$_REQUEST["members"]); }
	if( !empty($_REQUEST["notify"]) ){ $Values["task_notify_to"] = implode(",",$_REQUEST["notify"]); }
	if( $_REQUEST["visible"]=="on" ) $Values["task_visible_in_dashboard"] = 1; else $Values["task_visible_in_dashboard"] = 0;
	$CRUD->Insert("tasks_tasks",$Values);
}
if ($_REQUEST["action"] == "editTask") {
	$Condicion["task_id"] = $_REQUEST["taskId"];
	$Values["task_title"] = $_REQUEST["task"];
	$Values["task_startdate"] = $_REQUEST["startdate"];
	$Values["task_duedate"] = $_REQUEST["duedate"];
	$Values["staff_id"] = $_REQUEST["staff"];
	$Values["project_id"] = $_REQUEST["project"];
	if( !empty($_REQUEST["members"]) ){ $Values["task_members"] = implode(",",$_REQUEST["members"]); }
	if( !empty($_REQUEST["notify"]) ){ $Values["task_notify_to"] = implode(",",$_REQUEST["notify"]); }
	if( $_REQUEST["visible"]=="on" ) $Values["task_visible_in_dashboard"] = 1; else $Values["task_visible_in_dashboard"] = 0;
	$CRUD->Update("tasks_tasks",$Condicion,$Values);
	$type    = "Edit Task";
	$text    = "El usuario ".$_SESSION["user_id"]." edito el task";
	addUpdate($task_id,$type,$text,true);
}
if ($_REQUEST["action"] == "move") {
	$Condicion["task_id"] = $_REQUEST["id"];
	$Values["task_startdate"] = $_REQUEST["start"];
	$Values["task_duedate"] = ($_REQUEST["end"])?sumarDiasFecha($_REQUEST["end"],-1):$_REQUEST["start"];
	$CRUD->Update("tasks_tasks",$Condicion,$Values);
}
if ($_REQUEST["action"] == "getDetails") {
	$Condicion["task_id"] = $_REQUEST["id"];
	$event = $CRUD->Select("tasks_tasks",$Condicion)[0];
	if( $_SESSION[SESSION_SYSTEM."_user_type"]!=1 ){
		if( $event["task_creat_by"] != $_SESSION["user_id"] ){
			$re = false;
		}else{
			$re = true;
		}
	}else{
		$re = true;
	}
	$event["task_delete"] = $re;

	echo json_encode($event);
}
if ($_REQUEST["action"] == "newUpdate") {
	
	$task_id = $_REQUEST["id"];
	$type = "manual";
	$text = $_REQUEST["update"];
	$id_update = addUpdate($task_id,$type,$text);
	
	unset($Values,$_condition);
	$_condition["task_id"] = $task_id;
	$query 				   = $CRUD->Select("tasks_tasks",$_condition)[0];
	if( !empty($query["task_members"]) ){ 
		$task_members 		   = explode(',',$query["task_members"]);
	}else{ 
		$task_members = array();
	}
	$task_members[] 	   = $query["staff_id"];
	foreach( $task_members as $task ){
		$Values["task_id"]     = $task_id;
		$Values["update_id"]   = $id_update;
		$Values["staff_id"]    = $task;
		$Values["created_at"]  = date("Y-m-d");
		$CRUD->Insert("tasks_updates_views",$Values);
	}
}
if ($_REQUEST["action"] == "deleteUpdate") {
	$Condicion["update_id"] = $_REQUEST["id"];
	$event = $CRUD->Delete("tasks_updates",$Condicion);
}
if ($_REQUEST["action"] == "deleteSubTask") {
	$Condicion["subtask_id"] = $_REQUEST["id"];
	$event = $CRUD->Delete("tasks_subtasks",$Condicion);
}
if ($_REQUEST["action"] == "getUpdates") {
	$Condicion["task_id"] = $_REQUEST["id"];
	$Condicion["deleted"] = 0;
	$updates = $CRUD->Written("
		SELECT 
			tu.*, 
			DATE_FORMAT(tu.update_createdat, '%m/%d/%Y') as fechaFormato,
			s.staff_name,
			tuv.viewed
		FROM 
			tasks_updates tu
			LEFT JOIN staff s ON s.staff_id = tu.update_createdby
			LEFT JOIN tasks_updates_views tuv ON tuv.update_id = tu.update_id AND tuv.staff_id = ".$_SESSION["user_id"]."
		WHERE 
			tu.task_id = ".$_REQUEST["id"]." AND tu.deleted = 0
	",NULL,TRUE);
	echo json_encode($updates);	
	unset($Values,$Condition);
	$query_ = $CRUD->Written("SELECT * FROM tasks_updates_views WHERE staff_id = ".$_SESSION["user_id"]." AND task_id= ".$_REQUEST["id"]." AND viewed=0",null, true);
	if( count($query_)>0 ){ 
		$Condition["staff_id"]  = $_SESSION["user_id"];
		$Condition["task_id"]   = $_REQUEST["id"];
		$Values["viewed"]   	= 1;
		$Values["viewed_at"] 	= date("Y-m-d H:i:s");
		$CRUD->Update("tasks_updates_views",$Condition,$Values);
	}
}
if ($_REQUEST["action"] == "newSubtask") {
	$Values["task_id"] = $_REQUEST["id"];
	$Values["subtask_text"] = $_REQUEST["subtask"];
	$Values["subtask_createdat"] = date("Y-m-d H:i:s");
	$Values["subtask_createdby"] = $_SESSION["user_id"];
	$CRUD->Insert("tasks_subtasks",$Values);
}
if ($_REQUEST["action"] == "updateSubtask") {
	$Condicion["subtask_id"] 	 = $_REQUEST["id"];
	$Values["subtask_text"]  	 = $_REQUEST["subtask"];
	$Values["staff_id"] 	 	 = $_REQUEST["staff_s"];
	$Values["subtask_createdat"] = date("Y-m-d H:i:s");
	$Values["subtask_createdby"] = $_SESSION["user_id"];
	$CRUD->Update("tasks_subtasks",$Condicion,$Values);
}
if ($_REQUEST["action"] == "updateDateSubtask") {
	$Condicion["subtask_id"] = $_REQUEST["id"];
	$Values["subtask_startdate"] = $_REQUEST["startdate"];
	$Values["subtask_duedate"] = $_REQUEST["duedate"];
	$CRUD->Update("tasks_subtasks",$Condicion,$Values);
}
if ($_REQUEST["action"] == "getSubtasks") {
	$Condicion["task_id"] = $_REQUEST["id"];
	$Condicion["deleted"] = 0;
	$tasks = $CRUD->Written("
		SELECT 
			ts.*, 
			DATE_FORMAT(ts.subtask_createdat, '%m/%d/%Y') as fechaFormato,
			s.staff_name
		FROM 
			tasks_subtasks ts
			LEFT JOIN staff s ON s.staff_id = ts.staff_id
		WHERE 
			ts.task_id = ".$_REQUEST["id"]." AND ts.deleted = 0
	",NULL,TRUE);
	echo json_encode($tasks);	
}

if ($_REQUEST["action"] == "completeSubtask") {
	echo $Condicion["subtask_id"] = $_REQUEST["id"];
	echo $Values["subtask_completed"] = $_REQUEST["status"];
	$CRUD->Update("tasks_subtasks",$Condicion,$Values);
}
if ($_REQUEST["action"] == "completeTask") {
	echo $Condicion["task_id"] = $_REQUEST["id"];
	echo $Values["task_completed"] = $_REQUEST["status"];
	if($_REQUEST["status"])
		echo $Values["task_completed_at"] = date("Y-m-d H:i:s");
	else
		echo $Values["task_completed_at"] = NULL;
	$CRUD->Update("tasks_tasks",$Condicion,$Values);
}
if ($_REQUEST["action"] == "getContactP") {
	unset($Condicion);
	$Condicion["project_id"] = $_REQUEST["id"];
	$contact = $CRUD->Written("SELECT * FROM contact_projects cp, contact c WHERE c.contact_id=cp.contact_id AND cp.project_id = :project_id",$Condicion,TRUE);
	$options = "";
	if( !empty($contact) ){ 
		foreach( $contact as $key=>$value){ 
			$options .= '<option value="'.$value["contact_id"].'">'.$value["contact_name"].'('.$value["contact_email"].')</option>';
		 }
	 }
	echo $options;
}
?>
