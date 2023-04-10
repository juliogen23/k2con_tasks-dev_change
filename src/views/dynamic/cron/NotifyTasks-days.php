<?php
// Consulto los usuarios que tienen tareas pendientes y que estan proximo a expirar
$list_users = $CRUD->Written("SELECT * FROM contact WHERE contact_status = 1",null,true);

foreach ($list_users as $key => $value) 
{
    $contact_id    = $value['contact_id'];
        
    $arrayTask = [];
    $pending_h = "";
    $pending_d = "";
    $pending_e = "";
    
    $list_tasks = $CRUD->Written("SELECT *, DATEDIFF(task_duedate,'".date("Y-m-d")."') AS date_remaining FROM tasks_tasks WHERE (FIND_IN_SET('$contact_id',task_notify_to)) AND DATEDIFF(task_duedate,'".date("Y-m-d")."')<=1 AND task_completed=0 AND task_status=0",null,true);
    if(!empty($list_tasks)){
        foreach ($list_tasks as $key => $val) {
            $task_id = $val["task_id"];
            $arrayTask[] = $task_id; 
            $arraySubTask = [];
            $list_subTasks = $CRUD->Written("SELECT * FROM tasks_subtasks WHERE task_id=$task_id AND (subtask_completed IS NULL OR subtask_completed=0) AND deleted = 0",null,true);
            $date = new DateTime($val["task_duedate"]);
            $date3 = $date->format("m/d/Y h:i:s A");
            switch ($val["date_remaining"]) {

                case '0': // Task expiring in 1 hour
                    $pending_h .= "<h4 style='margin:0;'>".$val["task_title"]." <span style='color:#877457;font-weight: 100;'>Due for today: ".$date->format('h:i:s A')."</span></h4>";
                    if( !empty($list_subTasks) ){
                        foreach ($list_subTasks as $key => $valSub) {
                            $dateSub = new DateTime($valSub["subtask_duedate"]);
                            $staff_name = "";
                            if( $valSub["staff_name"]!="" ){ 
                                $staff_name = " Assigned to: ".$valSub["staff_name"];
                            }

                            $subtask_duedate = "";
                            if( $valSub["subtask_duedate"]!="" || $valSub["subtask_duedate"]!="0000-00-00" ){ 
                                $subtask_duedate = " <span style='color:#877457;font-weight: 100;'>Due: ".$dateSub->format('m/d/Y h:i:s A')."</span>";
                            }
                            $pending_h .= "<div style='margin:0;'>▢ ".$valSub["subtask_text"].$staff_name.$subtask_duedate."</div>";
                            $arraySubTask[] = $valSub["subtask_id"]; 
                        }
                    }
                    break;
                    
                case '1': // Task expiring in 24 hours
                    $pending_d .= "<h4 style='margin:0;'>".$val["task_title"]." <span style='color:#877457;font-weight: 100;'>Due: ".$date3."</span></h4>";
                    if( !empty($list_subTasks) ){
                        foreach ($list_subTasks as $key => $valSub) {
                            $dateSub = new DateTime($valSub["subtask_duedate"]);
                            $staff_name = "";
                            if( $valSub["staff_name"]!="" ){ 
                                $staff_name = " Assigned to: ".$valSub["staff_name"];
                            }

                            $subtask_duedate = "";
                            if( $valSub["subtask_duedate"]!="" || $valSub["subtask_duedate"]!="0000-00-00" ){ 
                                $subtask_duedate = " <span style='color:#877457;font-weight: 100;'>Due: ".$dateSub->format('m/d/Y h:i:s A')."</span>";
                            }
                            $pending_d .= "<div style='margin:0;'>▢ ".$valSub["subtask_text"].$staff_name.$subtask_duedate."</div>";
                            $arraySubTask[] = $valSub["subtask_id"]; 
                        }
                    }
                    break;
            
                default: // Task expired
                    $pending_e .= "<h4 style='margin:0;'>".$val["task_title"]." <span style='color:#877457;font-weight: 100;'>Due: ".$date3."</span></h4>";
                    if( !empty($list_subTasks) ){
                        foreach ($list_subTasks as $key => $valSub) {
                            $dateSub = new DateTime($valSub["subtask_duedate"]);
                            $staff_name = "";
                            if( $valSub["staff_name"]!="" ){ 
                                $staff_name = " Assigned to: ".$valSub["staff_name"];
                            }

                            $subtask_duedate = "";
                            if( $valSub["subtask_duedate"]!="" || $valSub["subtask_duedate"]!="0000-00-00" ){ 
                                $subtask_duedate = " <span style='color:#877457;font-weight: 100;'>Due: ".$dateSub->format('m/d/Y h:i:s A')."</span>";
                            }
                            $pending_e .= "<div style='margin:0;'>▢ ".$valSub["subtask_text"].$staff_name.$subtask_duedate."</div>";
                            $arraySubTask[] = $valSub["subtask_id"]; 
                        }
                    }
                    break;
            }
        }

        // Creo el cuerpo del mensaje
        $body = "<h2 align='center'>Here is the most recent tasks</h2> <br>";
        if(!empty($pending_h)){
            $body.= $pending_h;
        }
        if(!empty($pending_d)){
            $body.= $pending_d;
        }
        if(!empty($pending_e)){
            $body.= $pending_e;
        }
        $taskA = implode(",",$arrayTask);
        $res = $CRUD->Written("SELECT notif_id FROM notifications WHERE task_id = '$taskA' AND contact_id = $contact_id AND DATE(notif_date_sent) >= '".date("Y-m-d")."'",null,true);
        if( empty($res) && !empty($value['staff_email']) ){
            unset($_Valores);
            $_Valores["contact_id"]       = $contact_id;
            $_Valores["task_id"]          = $taskA;
            $_Valores["subtask_id"]       = implode(",",$arraySubTask);
            $_Valores["notif_created_at"] = date("Y-m-d H:i:s");
            $_Valores["notif_date_sent"]  = date("Y-m-d H:i:s");
            $_Valores["notif_via"]        = "Email";
            $_Valores["notif_content"]        = $body;
            $CRUD->Insert("notifications",$_Valores);

            $fromname = FROMNAME;
            $fromaddress = FROMADDRESS;
            $subject = "Here’s the latest activity";
            $message = $body.'<hr/><p style="text-align: center;">Click <a href="'.RAIZ_HTTPS.'">here</a> to see more details <br> Please do not reply this message</p>';		
        email($fromname, $fromaddress, $value['staff_name'], $value['staff_email'], $subject, $message);
        }
    }
}
?>