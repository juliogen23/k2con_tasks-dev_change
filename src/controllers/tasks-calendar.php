<?php
	$where = "AND t.task_visible_in_dashboard = ". $_REQUEST["typeTask"]; 
	( $_REQUEST["completed"]=="false" )? $where .= " AND t.task_completed = 0": $where .= " AND 1=1";
	( $_REQUEST["project"] AND $_REQUEST["project"]!="" )? $where .= " AND project_id IN(".$_REQUEST["project"].") ": $where1 .= "";
	if( $_REQUEST["staff"] AND $_REQUEST["staff"]!="" ){
		$where_m = "";
		$array_staff = explode(",", $_REQUEST["staff"]);
		foreach ($array_staff as $k => $v) {
			$where_m .= " OR FIND_IN_SET('".$v."',t.task_members)"; 
		}
		 $where .= " AND (t.staff_id IN(".$_REQUEST["staff"].") ".$where_m.")  "; 
	}else{ 
		$where1 .= "";
	}
	$tasks = $CRUD->Written("SELECT *, DATEDIFF(t.task_duedate,'".date("Y-m-d H:i:s")."') as diferencia, DATE_FORMAT(t.task_startdate,'%Y-%m-%d') AS task_startdate_, (SELECT COUNT(tuv.task_id) FROM tasks_updates_views tuv WHERE tuv.task_id=t.task_id AND tuv.viewed=0 AND tuv.staff_id = ".$_SESSION["user_id"].") AS total_ FROM tasks_tasks t WHERE t.task_status=0 ".$where,null,true);

	foreach($tasks as $t) {
		
		if ($t["task_taked"]) { $color = "#0d6efd"; $textColor = "#ffffff";  $borderColor  = "#0d6efd"; }
		else {$color = "#eaeaea"; $textColor = "#666666";  $borderColor  = "#666666"; }
		$diferencia = $t["diferencia"];
		if ($diferencia < 0) $urgente = "red";
		elseif ($diferencia < 2) $urgente = "yellow";
		else $urgente = "green";
		
		
		$arrTasks[] = array(
			"id" => $t["task_id"],
			"title" => $t["task_title"],
			"start" => $t["task_startdate_"],
			"end" => sumarDiasFecha($t["task_duedate"],1),
			"color" => $color,
			"textColor" => $textColor,
			"borderColor" => $borderColor,
			"urgent" => $urgente,
			"task_completed" => $t["task_completed"],
			"total_" => $t["total_"]
		);
	}
	echo json_encode(( $arrTasks )? $arrTasks : []);
	
?>