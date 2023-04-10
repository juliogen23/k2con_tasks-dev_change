<?php
	addRute("DAHBOARD","","DAHBOARD","<i class='fa fa-plus'></i>");
	addRute("index","index","Home","<i class='fa fa-angle-right'></i>","DAHBOARD");
	
    // Users
    addRute("dataUser","users_data");  
    
    // Task
    addRute("tasks","tasks");  
    addRute("tasksCalendar","tasks-calendar");  
    addRute("deleteTask", "tasks_delete");

    // Project
    addRute("dataProject","project_data");
    // addRute("deleteProject","project_delete");  

 ?>
