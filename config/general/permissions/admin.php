<?php
	addRute("DAHBOARD","","DAHBOARD","<i class='fa fa-plus'></i>");
	addRute("index","index","Home","<i class='fa fa-angle-right'></i>","DAHBOARD");
	
    // Users
    addRute("usersList","users_list","Users","<i class='fa fa-angle-right'></i>","DAHBOARD");
    addRute("dataUser","users_data");  
    addRute("statusUser","users_status");  
    addRute("deleteUser","users_delete");  

    // Contact
    addRute("contactList","contact_list","Directory","<i class='fa fa-angle-right'></i>","DAHBOARD");
    addRute("dataContact","contact_data");  
    addRute("deleteContact","contact_delete");  

    // Providers
    addRute("providersList","providers_list","Providers","<i class='fa fa-angle-right'></i>","DAHBOARD");
    addRute("dataProviders","providers_data");  
    addRute("deleteProviders","providers_delete");  
    
    // Task
    addRute("tasks","tasks");  
    addRute("tasksCalendar","tasks-calendar");  
    addRute("deleteTask", "tasks_delete");
    
    // Project
    addRute("dataProject","project_data");
    addRute("deleteProject","project_delete"); 
    
 ?>
