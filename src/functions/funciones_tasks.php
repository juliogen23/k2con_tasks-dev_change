<?php
	function addUpdate($task_id,$type,$text,$status=false) {
		global $CRUD;
		if( $status ){
			$Values["deleted"] = 1;
		}
		$Values["task_id"] = $task_id;
		$Values["update_text"] = $text;
		$Values["update_type"] = $type;
		$Values["update_createdby"] = $_SESSION["user_id"];
		$Values["update_createdat"] = date("Y-m-d");
		return $CRUD->Insert("tasks_updates",$Values);
	}
?>