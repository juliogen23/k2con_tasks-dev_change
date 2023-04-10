<?php
	$staff = $CRUD->Written("SELECT * FROM staff WHERE staff_status IN(1,2) ORDER BY staff_name",null,true);
	$projects = $CRUD->Written("SELECT * FROM projects WHERE project_status=0 ORDER BY project_name",null,true);
	$contacts = $CRUD->Written("SELECT * FROM contact WHERE contact_status=0 AND contact_email<>'' AND contact_email IS NOT NULL ORDER BY contact_name",null,true);
	$contacts_projects = $CRUD->Written("SELECT * FROM contact_projects",null,true);
	foreach( $contacts_projects as $key=>$value){ 
		$contacts_projects[$value["project_id"]] .= $value["contact_id"].",";
	 }

?>
<?php include("./src/views/static/head.php"); ?>

<?php include("./src/views/static/menu.php"); ?>
	<div class="container" style="max-width:100%">
		<div class='row'>
			<div class='col-md-3 p-4 pb-0 pb-md-4'>
				<div class="d-flex">
					<a class="me-4" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="fa fa-bars fa-lg"></i></a> 
					<button onclick="newTask()" class="btn btn-primary btn-sm w-100">New Task</button> 
						<select class="form-select ms-2" name="typeTask" id="typeTask" onchange="refreshCalendar()">
							<option value="0">Internal</option>
							<option value="1">Client Dashboard</option>
						</select>
					<a class="ms-4 d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fa fa-filter fa-lg"></i></a>
				</div>
				<hr>

				<!-- Filter -->
				<div class="offcanvas offcanvas-end menu-canvas m-0" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
					<div class="offcanvas-header">
						<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
						<div class="mb-2">
							<b> <label class="ms-3">
									<input class="form-check-input me-1" type="checkbox" onclick="allChecked('staff')" id="allstaff">
							</label> Staff <a href="javascript:modalStaff()" class="float-end"><i class="fa fa-plus"></i></a></b>
						</div>
						<div class="list-group list_staff">
							<?php foreach($staff as $s) { $staff_id = $s["staff_id"]; ?>
							<label class="list-group-item">
								<input class="form-check-input me-1" type="checkbox" id="staffCheck<?php echo $staff_id; ?>" onclick="refreshCalendar()" value="<?php echo $staff_id; ?>" name="filter_staff[]">
								<span id="staff_<?php echo $staff_id; ?>"><?php echo $s["staff_name"]; ?> <?php echo  ( $_SESSION["user_id"]==$staff_id )? "<i class='fa fa-user-circle text-secondary'></i>":""; ?></span>
								<?php if( $_SESSION[SESSION_SYSTEM."_user_type"] == 1 ){ ?>
								<a href="javascript:modalStaff('<?php echo $staff_id; ?>','<?php echo $s['staff_name']; ?>','<?php echo $s['staff_user']; ?>','<?php echo $s['staff_email']; ?>','<?php echo $s['staff_type']; ?>','<?php echo $s['staff_status']; ?>')" class="float-end text-primary"><i class="fa fa-edit"></i></a>
								<?php } ?>
							</label>
							<?php } ?>
						</div>	
						<hr>
						<div class="mb-2">
							<b><label class="ms-3">
									<input class="form-check-input me-1" type="checkbox" onclick="allChecked('project')" id="allproject">
							</label>Projects <a href="javascript:modalProject()" class="float-end"><i class="fa fa-plus"></i></a></b>
						</div>
						<div class="list-group list_project">
							<?php foreach($projects as $p) { $project_id = $p["project_id"]; ?>
							<label class="list-group-item" id="projectLabel<?php echo $project_id; ?>">
								<input class="form-check-input me-1" type="checkbox" onclick="refreshCalendar()" id="projectCheck<?php echo $project_id; ?>" value="<?php echo $project_id; ?>" name="filter_project[]">
								<span id="project_<?php echo $project_id; ?>"><?php echo $p["project_name"]; ?></span>
								<?php if( $_SESSION[SESSION_SYSTEM."_user_type"] == 1 ){ ?>
								<span class="float-end">
									<a href="javascript:modalProject('<?php echo $project_id; ?>','<?php echo $p['project_name']; ?>','<?php echo ( $contacts_projects[$project_id] )? $contacts_projects[$project_id]: ''; ?>')"  id="a_<?php echo $project_id; ?>" class="text-primary"><i class="fa fa-edit"></i></a>
									<a href="javascript:deleteProject('<?php echo $project_id; ?>')" class="text-danger"><i class="fa fa-trash-o"></i></a>
								</span>
								<?php } ?>
							</label>
							<?php } ?>
						</div>			
						<hr>
						<div class="mb-2">
							<b>More</b>
						</div>
						<div class="list-group">
							<label class="list-group-item">
								<input type="checkbox" id="showCompleted" onclick="refreshCalendar()"> Show completed
							</label>
						</div>
						<div class="mt-5">
							<i class="fa fa-circle" style="color:red"></i> Expired
							<i class="fa fa-circle ps-3" style="color:yellow"></i> Tomorrow
							<i class="fa fa-circle ps-3" style="color:green"></i> + 2days
						</div>
					</div>
				</div>
				<!-- End Filter -->

			</div>
			<div class='col-md-9'>
				<div id='calendar' class="calendar-position"></div>
			</div>
		</div>
		
		<?php include("./src/views/static/bottom.php"); ?>	
	</div>

<!-- Modal -->
<form id="taskForm" action="<?php echo RAIZ; ?>tasks">
<div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true">
  <div id="divModalDialog" class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
		
		  <div class="modal-header">
			<h5 class="modal-title" id="taskModalTitle">New Task</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">

			<nav class="d-md-none nav-taps">
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<button class="nav-link" data-bs-toggle="tab" data-bs-target="#divColUpdates" type="button" role="tab" aria-controls="divColUpdates" aria-selected="true">Notes</button>
					<button class="nav-link" data-bs-toggle="tab" data-bs-target="#divColSubtasks" type="button" role="tab" aria-controls="divColSubtasks" aria-selected="false">Subtasks</button>
					<button class="nav-link active nav-link-task" data-bs-toggle="tab" data-bs-target="#nav-task" type="button" role="tab" aria-controls="nav-task" aria-selected="false">Task</button>
				</div>
			</nav>
			<div id="nav-tabContent" class="row" style="height:100%">
				<!-- <div class="fade show active" id="divColSubtasks" role="tabpanel" aria-labelledby="divColSubtasks" tabindex="0">...</div>
				<div class="fade" id="divColSubtasks" role="tabpanel" aria-labelledby="nav-subtask" tabindex="0">...</div>
				<div class="fade" id="nav-task" role="tabpanel" aria-labelledby="nav-task" tabindex="0">...</div> -->
			<!-- </div> -->
			
			 <!-- <div class="row" style="height:100%"> -->

				<div id="divColUpdates" class="col fade d-md-block2" role="tabpanel" aria-labelledby="divColSubtasks" tabindex="0"  style="border-right: 1px solid #ccc;height: 100%;">
					<div class="row">
						<div class="col">
							Notes
						</div>
					</div>
					<div class="row bottom-0">
						<div class="col-12 mt-2">
							<div class="input-group mb-3">
							  <input id="newUpdate" name="newUpdate" type="text" class="form-control" placeholder="New update" aria-label="New update" aria-describedby="button-addon2">
							  <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="addUpdate()">Add</button>
							</div>
						</div>
					</div>
					<div class="row bottom-0">
						<div id="updatesDiv" class="col-12 mt-2 body-chat">
							
						</div>
					</div>
				</div>

				<div id="divColSubtasks" class="col fade d-md-block2" role="tabpanel" aria-labelledby="nav-notes" tabindex="0" style="border-right: 1px solid #ccc;height: 100%;">
				
					<div class="row">
						<div class="col">
							Subtasks
						</div>
					</div>
					<div class="row bottom-0">
						<div class="col-12 mt-2">
							<div class="input-group mb-3">
							  <input id="newSubtask" name="newSubtask"  type="text" class="form-control" placeholder="New subtask" aria-label="New subtask" aria-describedby="button-addon3">
							  <button class="btn btn-outline-secondary" type="button" id="button-addon3" onclick="addSubtask()">Add</button>
							</div>
						</div>
					</div>
					<div class="row bottom-0">
						<div id="subtasksDiv" class="col-12 body-chat">
							
						</div>
					</div>
				</div>


				<div class="col fade  show active d-md-block" id="nav-task" role="tabpanel" aria-labelledby="nav-task" tabindex="0" >
					 <div class="row">
					  <div class="col-md-12">
						<label for="task" class="form-label">Task Title</label>
						<input type="text" name="task"  id="task" class="form-control" placeholder="Task Title" required>
					  </div>
					  <div class="col-md-6 mt-2">
						<label for="startdate" class="form-label">From</label>
						<input type="datetime-local" name="startdate" id="startdate" class="form-control" placeholder="From" required>
					  </div>		  
					  <div class="col-md-6 mt-2">
						<label for="duedate" class="form-label">Due Date</label>
						<input type="datetime-local" name="duedate" id="duedate" class="form-control" placeholder="Due Date" required>
					  </div>		  
					  <div class="col-md-6 mt-2">
						<label for="duedate" class="form-label">Owner</label>				
						<select class="form-select" name="staff" id="staff" required>
							<option></option>
							<?php foreach($staff as $s) { ?>
								<option id="staffOption<?php echo $s["staff_id"]; ?>" value="<?php echo $s["staff_id"]; ?>"><?php echo $s["staff_name"]; ?></option>
							<?php } ?>
						</select>
					  </div>		  
					  <div class="col-md-6 mt-2">
						<label for="duedate" class="form-label">Project</label>				
						<select class="form-select" name="project" id="project" required onchange="getContactProject()">
							<option></option>
							<?php foreach($projects as $p) { ?>
								<option id="projectOption<?php echo $p["project_id"]; ?>" value="<?php echo $p["project_id"]; ?>"><?php echo $p["project_name"]; ?></option>
							<?php } ?>
						</select>
					  </div>
					  <div class="col-md-12 mt-2 d-none" id="contentNotify">
						<label for="duedate" class="form-label">Notify</label>				
						<select class="form-select" name="notify[]" id="notify" multiple="multiple">
							<option></option>
						</select>
					  </div>				  
					  <div class="col-md-12 mt-2">
						<label for="duedate" class="form-label">Members <a data-bs-toggle="collapse" href="#collapseMembers" role="button" aria-expanded="false" aria-controls="collapseMembers"><i class="fa fa-plus"></i></a></label>				
						<div class="collapse" id="collapseMembers">
							<select class="form-select" name="members[]" id="members" multiple="multiple" size="5">
								<?php foreach($staff as $p) { ?>
									<option id="staffOption2<?php echo $p["staff_id"]; ?>" value="<?php echo $p["staff_id"]; ?>"><?php echo $p["staff_name"]; ?></option>
								<?php } ?>
							</select>
						</div>
					  </div>
					  <div class="col-md-12 mt-2" id="VisibleTask">
						<div class="card card-body ">
							<div class="me-auto"><input id="taskVisible" type="checkbox" name="visible"> Visible in Client Dashboard</div>
						</div>
					  </div>	
					  <div class="col-md-12 mt-2 d-none" id="completedTask">
						<div class="card card-body ">
							<div class="me-auto"><input id="taskCompleted" type="checkbox" onclick="completarTask(this.checked)"> Completed</div>
						</div>
					  </div>	
					  <div class="col-md-12 mt-2 d-none" id="deleteTask">
						<div class="card card-body ">
							<a href="javascript:deletetask()" class="text-primary"><i class="fa fa-trash"></i> Delete task</a>
						</div>
					  </div>	
					 </div>		  
				</div>

			</div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Submit</button>
		  </div>
		  <input type="hidden" name="action" id="taskModalAction" value="newTask">
		  <input type="hidden" name="taskId" id="taskId" value="">
		
    </div>
  </div>
</div>
</form>
<!-- End Modal -->

<!-- Modal staff -->
<form method="post" onsubmit="StaffForm(event)" id="staffForm" class="needs-validation" enctype="multipart/form-data" name="staffInfo">
<div class="modal fade" id="modalstaffModal" tabindex="-1" aria-labelledby="modalstaffModalLabel" aria-hidden="true">
  <div id="divModalDialog" class="modal-dialog">
    <div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="staffModalTitle">New staff</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
		
			<div class="row" style="height:100%">
				<div class="col">
					<div class="form-floating mb-3">
						<input type="text" name="name"  id="staff_name" class="form-control" placeholder="Name" required>
						<label for="name" class="form-label  py-2"><i class="fa fa-address-card text-secondary"></i> Name</label>
					</div>
				</div>
				<?php if($_SESSION[SESSION_SYSTEM."_user_type"]==1){?>
				<div class="col">
					<div class="form-floating mb-3">
						<input type="email" name="email"  id="staff_email" class="form-control" placeholder="Email" required>
						<label for="email" class="form-label p-2"><i class="fa fa-envelope text-secondary"></i> Email</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-floating mb-3">
						<input type="text" name="user"  id="staff_user" class="form-control" placeholder="User" required>
						<label for="user" class="form-label p-2"><i class="fa fa-user text-secondary"></i> User</label>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-floating mb-3">
						<input type="password" name="pass"  id="staff_pass" class="form-control" placeholder="Password" required>
						<label for="pass" class="form-label p-2"><i class="fa fa-lock text-secondary"></i> Pasword</label>
					</div>
				</div>
				<div class="col-md-12 mb-3">
					<select name="type" id="staff_type" class="form-select py-2 required">
						<option value="">Type</option>
						<option value="1">Admin</option>
						<option value="1">User</option>
					</select>
				</div>
				<div class="col-md-12">
					<select name="status" id="staff_status" class="form-select py-2 required">
						<option value="">Status</option>
						<option value="1">Active</option>
						<option value="2">Inactive</option>
					</select>
				</div>	  
				<?php } ?>
			</div>
		
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Submit</button>
		</div>
		<input type="hidden" name="staff_id" id="staffId" value="">
		
    </div>
  </div>
</div>
</form>
<!-- End Modal staff -->

<!-- Modal project -->
<form method="post" onsubmit="projectForm(event)" id="projectForm" class="needs-validation" enctype="multipart/form-data" name="projectInfo">
<div class="modal fade" id="modalProjectModal" tabindex="-1" aria-labelledby="modalProjectModalLabel" aria-hidden="true">
  <div id="divModalDialog" class="modal-dialog">
    <div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="projectModalTitle">New Project</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
		
			<div class="row" style="height:100%">
				<div class="col-12">
					<div class="form-floating mb-3">
						<input type="text" name="name"  id="project_name" class="form-control" placeholder="Name" required>
						<label for="name" class="form-label  py-2">Name</label>
					</div>
				</div>
				<div class="col-md-12">
					<label for="duedate" class="form-label">Members</label>				
					<select class="form-select" name="contact[]" multiple id="contact">
						<option >Selected</option>
						<?php foreach($contacts as $p) { ?>
							<option id="contactOption<?php echo $p["contact_id"]; ?>" value="<?php echo $p["contact_id"]; ?>"><?php echo $p["contact_name"]; ?> (<?php echo $p["contact_email"]; ?>)</option>
						<?php } ?>
					</select>
				</div>		  
			</div>
		
		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Submit</button>
		</div>
		<input type="hidden" name="project_id" id="projectId" value="">
		
    </div>
  </div>
</div>
</form>
<!-- End Modal project -->
<?php include("./src/views/static/footer.php"); ?>
<script>
	if(localStorage.getItem('typeTask')){
		let t = localStorage.getItem('typeTask');
		// document.querySelector("#typeTask" + t).setAttribute("checked","");
		document.getElementById("typeTask").value = t;
	}

	if(localStorage.getItem('staff') || localStorage.getItem('project')){
		if(localStorage.getItem('staff')){
			document.querySelector("#allstaff").setAttribute("checked","");
			let arrStaff = localStorage.getItem('staff').split(',');
			arrStaff.forEach((e, i) => {
				let val = document.querySelector("#staffCheck" + e);
				if(!val.checked){
					val.setAttribute("checked","");
				}
			});
		}

		if(localStorage.getItem('project')){
			document.querySelector("#allproject").setAttribute("checked","");
			let arrproject = localStorage.getItem('project').split(',');
			arrproject.forEach((e, i) => {
				let val = document.querySelector("#projectCheck" + e);
				if(!val.checked){
					val.setAttribute("checked","");
				}
			});
		}
		setTimeout(() => {
			refreshCalendar();
		}, 50);
	}else{
		document.querySelector("#allstaff").setAttribute("checked","");
		document.querySelector("#allproject").setAttribute("checked","");
		allChecked('staff');
		allChecked('project');
	}

	if(localStorage.getItem('project')){
		let arrProject = localStorage.getItem('project').split(',');
		arrProject.forEach((e, i) => {
			let valu = document.querySelector("#projectCheck" + e);
			if(!valu.checked){
				valu.setAttribute("checked","");
			}
		});
	}
	var calendar;
	var currentTask = 0;
	function refreshCalendar() {
		let f_staff = [];
		document.querySelectorAll("[name='filter_staff[]']:checked").forEach((e, i) => { f_staff.push(e.value); });

		let f_project = [];
		document.querySelectorAll("[name='filter_project[]']:checked").forEach((e, i) => { f_project.push(e.value); });
		let  typeTask = document.getElementById("typeTask").value
		localStorage.setItem('staff',f_staff);
		localStorage.setItem('project',f_project);
		localStorage.setItem('typeTask',typeTask);

		calendar.setOption('events', {url:`tasksCalendar?project=${f_project.join(',')}&staff=${f_staff.join(',')}&completed=${document.getElementById("showCompleted").checked+"&typeTask="+typeTask}`, method:"POST"});
	}

	function allChecked(name){
		let validation = document.getElementById("all"+name+"").checked;
		document.querySelectorAll("[name='filter_"+name+"[]']").forEach((e, i) => { 
			if(validation){
				e.setAttribute("checked","");
			}else{
				e.removeAttribute("checked");
			}
		});
		setTimeout(() => {
			refreshCalendar();
		}, 50);
	}

	var staffModal = new bootstrap.Modal(document.getElementById('modalstaffModal'));
	function modalStaff(id="",name="",user="",email="",type="", status="")  {
		document.getElementById("staffForm").reset()
		staffModal.show()
		 id ?title = "Edit Staff": title = "New staff";
		document.querySelector("#staffModalTitle").innerHTML = title;
		document.querySelector("#staffId").value = id;
		document.querySelector("#staff_name").value = name;
		<?php if($_SESSION[SESSION_SYSTEM."_user_type"]==1){?>
		document.querySelector("#staff_user").value = user;
		document.querySelector("#staff_email").value = email;
		document.querySelector("#staff_type").value = type;
		document.querySelector("#staff_status").value = status;
		(id!="")? valPass = "********" : valPass = "";
		document.querySelector("#staff_pass").value = valPass;
		<?php } ?>
	}

	var projectModal = new bootstrap.Modal(document.getElementById('modalProjectModal'));
	function modalProject(id="",name="", members="") {
		document.getElementById("projectForm").reset()
		projectModal.show()
		 id ?title = "Edit Project": title = "New Project";
		document.querySelector("#projectModalTitle").innerHTML = title;
		document.querySelector("#projectId").value = id;
		document.querySelector("#project_name").value = name;
		if(members){ 
			$('#contact').val(members.split(','));  
		}
		$(".mult-select-tag").remove();
		new MultiSelectTag('contact'); 
	}

	function newTask() {
		document.getElementById("taskForm").reset()
		$('#newTaskModal').modal('show'); 
		$('#divModalDialog').removeClass('modal-fullscreen'); 
		$("#taskModalAction").val("newTask")
		$("#taskModalTitle").html("New Task")
		$(".nav-taps").addClass("d-none");
		$("#divColUpdates").addClass("d-none");
		$("#divColSubtasks").addClass("d-none");
		$("#taskId").val("");
		$(".nav-link").removeClass("active");
		$(".nav-link-task").addClass("active");
		$("#collapseMembers").removeClass("show");
		$("#divColUpdates").removeClass("active show");
		$("#divColSubtasks").removeClass("active show");
		$("#nav-task").addClass("active show");
		currentTask = 0;
		let dateToday = new Date();
		$("#startdate").val(dateToday.toLocaleDateString("en-CA")+" 08:00:00");
		$("#duedate").val(dateToday.toLocaleDateString("en-CA")+" 18:00:00");
		if(!document.getElementById("deleteTask").classList.contains( 'd-none' )){
			document.getElementById("deleteTask").classList.add("d-none");
		}
		if(!document.getElementById("completedTask").classList.contains( 'd-none' )){
			document.getElementById("completedTask").classList.add("d-none");
		}
		$(".mult-select-tag").remove();
		new MultiSelectTag('members');  // id
		getContactProject();
	}
	function editTask(id) {
		currentTask = id
		$('#newTaskModal').modal('show');
		$('#divModalDialog').addClass('modal-fullscreen'); 		
		$("#taskModalAction").val("editTask")
		$("#taskId").val(id)
		$("#taskModalTitle").html("Update Task")
		$(".nav-taps").removeClass("d-none");
		$("#divColUpdates").removeClass("d-none");
		$("#divColSubtasks").removeClass("d-none");
		
		document.getElementById("completedTask").classList.remove("d-none");
		$.ajax({
		  method: "POST",
		  url: "<?php echo RAIZ; ?>tasks",
		  data: { id,action:"getDetails" }
		})
		.done(function( msg ) {
			var event = JSON.parse(msg)
			$("#task").val(event.task_title)
			$("#startdate").val(event.task_startdate)
			$("#duedate").val(event.task_duedate)
			$("#staff").val(event.staff_id)
			$("#project").val(event.project_id)
			if (event.task_completed == "1") document.getElementById("taskCompleted").checked = true; else document.getElementById("taskCompleted").checked = false; 
			if (event.task_visible_in_dashboard == "1") document.getElementById("taskVisible").checked = true; else document.getElementById("taskVisible").checked = false; 
			$("#collapseMembers").removeClass("show");
			
			getContactProject();
			setTimeout(() => {
				if(event.task_notify_to){ 
					$('#notify').val(event.task_notify_to.split(',')); 
					// $("#collapseMembers").addClass("show"); 	 
					// new MultiSelectTag('notify'); 
				}else{ 
					$('#notify').val(); 
				}
				$("#notify ~ .mult-select-tag").remove();
				new MultiSelectTag('notify'); 
			}, 100);
				if(event.task_members){ 
					$('#members').val(event.task_members.split(',')); 
					$("#collapseMembers").addClass("show"); 	 
					// $(".mult-select-tag").remove();
				}else{
					$('#members').val(''); 
				}
			$("#members ~ .mult-select-tag").remove();
			new MultiSelectTag('members'); 
			

			if( event.task_delete ){
				document.querySelector("#deleteTask a").setAttribute("href", "javascript:deleteTasks("+id+")");
				document.getElementById("deleteTask").classList.remove("d-none");
			}
			$(`#badge${currentTask}`).remove();
			getUpdates()
			getSubtasks()
		});				
	}
	function moveTask(id,start,end) {

		$.ajax({
		  method: "POST",
		  url: "<?php echo RAIZ; ?>tasks",
		  data: { id,start,end,action:"move" }
		})
		  .done(function( msg ) {
			calendar.refetchEvents();
		  });		
	}
	function StaffForm(e) {
		e.preventDefault();
		var formData = new FormData(document.forms.namedItem("staffInfo"));
		fetch("dataUser",{method:"POST",body:formData}).then((response)=>response.json()).then(result=>{
			staffModal.toggle()
			document.getElementById("staffForm").reset();
			let staff_id = document.querySelector("#staffId").value;
			if( staff_id == "" ){
				let append = document.querySelector(".list_staff");
				let body = document.createElement("label");
				body.classList.add("list-group-item");
				body.innerHTML =`<input class="form-check-input me-1" type="checkbox" onclick="refreshCalendar()" value="${result.staff_id}" name="filter_staff[]">
								<span id="staff_${result.staff_id}">${result.staff_name}</span>	
								<?php if( $_SESSION[SESSION_SYSTEM."_user_type"] == 1 ){ ?>
								<a href="javascript:modalStaff('${result.staff_id}','${result.staff_name}','${result.staff_user}','${result.staff_email}','${result.staff_type}','${result.staff_status}')" class="float-end text-primary"><i class="fa fa-edit"></i></a>
								<?php } ?>` ;
				append.appendChild(body);

				let append_options1 = document.querySelector("#staff");
				let bodyStaff = document.createElement("option");
				bodyStaff.value = result.staff_id;
				bodyStaff.setAttribute("id","staffOption"+result.staff_id);
				bodyStaff.innerHTML = result.staff_name;
				append_options1.appendChild(bodyStaff);

				let append_options11 = document.querySelector("#staff_s");
				let bodyStaff1 = document.createElement("option");
				bodyStaff1.value = result.staff_id;
				bodyStaff1.setAttribute("id","staffOption1"+result.staff_id);
				bodyStaff1.innerHTML = result.staff_name;
				append_options11.appendChild(bodyStaff1);

				let append_options2 = document.querySelector("#members");
				let bodyStaff2 = document.createElement("option");
				bodyStaff2.value = result.staff_id;
				bodyStaff2.setAttribute("id","staffOption2"+result.staff_id);
				bodyStaff2.innerHTML = result.staff_name;
				append_options2.appendChild(bodyStaff2);
				
			}else{
				document.querySelector("#staffOption"+staff_id).textContent = result.staff_name;
				document.querySelector("#staffOption1"+staff_id).textContent = result.staff_name;
				document.querySelector("#staffOption2"+staff_id).textContent = result.staff_name;
				document.querySelector("#staff_"+staff_id).textContent = result.staff_name;
			}
		});
	}
	function projectForm(e) {
		e.preventDefault();
		var formData = new FormData(document.forms.namedItem("projectInfo"));
		fetch("dataProject",{method:"POST",body:formData}).then((response)=>response.json()).then(result=>{
			projectModal.toggle()
			document.getElementById("projectForm").reset();
			let project_id = document.querySelector("#projectId").value;
			if( project_id == "" ){
				let append = document.querySelector(".list_project");
				let body = document.createElement("label");
				body.classList.add("list-group-item");
				body.innerHTML =`<input class="form-check-input me-1" type="checkbox" onclick="refreshCalendar()" value="${result.project_id}" name="filter_project[]">
								<span id="project_${result.project_id}">${result.project_name}</span>	
								<?php if( $_SESSION[SESSION_SYSTEM."_user_type"] == 1 ){ ?>
								<a href="javascript:modalProject('${result.project_id}','${result.project_name}','${result.contact}')" id="a_${result.project_id}" class="float-end text-primary"><i class="fa fa-edit"></i></a>
								<a href="javascript:deleteProject('${result.project_id}')" class="text-danger"><i class="fa fa-trash-o"></i></a>
								<?php } ?>` ;
				append.appendChild(body);

				let append_options = document.querySelector("#project");
				let bodyProject = document.createElement("option");
				bodyProject.value = result.project_id;
				bodyProject.setAttribute("id","projectOption"+result.project_id);
				bodyProject.innerHTML = result.project_name;
				append_options.appendChild(bodyProject);
			}else{
				document.querySelector("#project_"+project_id).textContent = result.project_name;
				document.querySelector("#projectOption"+project_id).textContent = result.project_name;
				document.querySelector("#a_"+project_id).setAttribute("href", `javascript:modalProject('${project_id}','${result.project_name}','${result.contact}')`);

			}
		});
	}

	function deleteProject(id) {
        if(confirm("¿Are you sure you want to delete?")){
            fetch(`deleteProject?project_id=${id}`,{method:"POST"}).then((response)=>response.json()).then(result=>{
				let elemento = document.getElementById("projectOption" + id).remove();
				let projectLabel = document.getElementById("projectLabel" + id).remove();
            });
        }
    }

	function deleteTasks(id) {
        if(confirm("¿Are you sure you want to delete?")){
            fetch(`deleteTask?task_id=${id}`,{method:"POST"}).then((response)=>response.json()).then(result=>{
				$('#newTaskModal').modal('hide'); 
				calendar.refetchEvents();
            });
        }
    }
	
	// this is the id of the form
	$("#taskForm").submit(function(e) {

		e.preventDefault(); // avoid to execute the actual submit of the form.
		var form = $(this);
		var actionUrl = form.attr('action');
		
		$.ajax({
			type: "POST",
			url: actionUrl,
			data: form.serialize(), // serializes the form's elements.
			success: function(data)
			{
				$('#newTaskModal').modal('hide'); 
				document.getElementById("taskForm").reset()
				calendar.refetchEvents();
			}
		});
		
	});	

	document.addEventListener('DOMContentLoaded', function() {
		let view =  'dayGridWeek';
		if(screen.width <= 768 ){
			 view =  'listDay';
		}
		var calendarEl = document.getElementById('calendar');
		calendar = new FullCalendar.Calendar(calendarEl, {
			themeSystem: 'bootstrap5',
			initialView: view,
			headerToolbar: {
				left: '',
				center: '',
				right: ''
			},
			hiddenDays: [ 0, 6 ], 
			footerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,dayGridWeek,listDay'
			},
			height: "99vh",
			events: {
               url: "tasksCalendar?completed="+document.getElementById("showCompleted").checked+"&typeTask="+document.getElementById("typeTask").value,
			   method: 'POST',
			},
			dateClick: function(info) {
				newTask();
				$("#startdate").val(info.dateStr+" 08:00:00");
				$("#duedate").val(info.dateStr+" 18:00:00");
			},
			editable: true,
			  eventDidMount: function(info) {
				var icon = info.event.extendedProps.icon;
				if (info.event.extendedProps.urgent) {
					var urgent = info.event.extendedProps.urgent;
					( info.event.extendedProps.task_completed == "1" )? icon_ = '<i class="fa fa-check text-success"></i>': icon_ = '<i class="fa fa-circle"  style="color:'+urgent+'"></i>';
					if ( $(info.el).find('.fc-event-title i').length==0 ){
						$(info.el).find('.fc-event-title').prepend(icon_+" ");
						if ( info.event.extendedProps.total_ != 0 ) {
							$(info.el).find('.fc-event-title').append(' <span class="badge rounded-pill bg-secondary" id="badge'+info.event.id+'">'+info.event.extendedProps.total_+'</span>');
						}
					}
				}
			}, eventDrop: function (info) {
				console.log(info.event)
				moveTask(info.event.id,info.event.startStr,info.event.endStr)
				
			}, eventResize: function (info) {
				console.log(info.event)
				moveTask(info.event.id,info.event.startStr,info.event.endStr)
				
			}, eventClick: function (info) {
				console.log(info.event)
				editTask(info.event.id)
			}
		});
		calendar.render();
	});
	$(function() {
		$('#newTaskModal').on('shown.bs.modal', function () {
			$('#task').focus();
		})  
		$('#newUpdate').keydown(function(e) {
			if(e.keyCode == 13){
				e.preventDefault();
				addUpdate();
			} else {
				return e.keyCode
			}
		});
		$('#newSubtask').keydown(function(e) {
			if(e.keyCode == 13){
				e.preventDefault();
				addSubtask();
			} else {
				return e.keyCode
			}
		});
		
	});	
	function addUpdate() {
		update = $("#newUpdate").val()
		if (update) {
			$.ajax({
			  method: "POST",
			  url: "<?php echo RAIZ; ?>tasks",
			  data: { id:currentTask,update,action:"newUpdate" }
			})
			.done(function( msg ) {
				$("#newUpdate").val("");
				getUpdates()
			});		
		} else {
			
			alert("Please type something");
		}
	}
	function addUpdate() {
		update = $("#newUpdate").val()
		if (update) {
			$.ajax({
			  method: "POST",
			  url: "<?php echo RAIZ; ?>tasks",
			  data: { id:currentTask,update,action:"newUpdate" }
			})
			.done(function( msg ) {
				$("#newUpdate").val("");
				getUpdates()
			});		
		} else {
			
			alert("Please type something");
		}
	}
	function getUpdates() {
		$("#updatesDiv").html("");
		$.ajax({
		  method: "POST",
		  url: "<?php echo RAIZ; ?>tasks",
		  data: { id:currentTask,action:"getUpdates" }
		})
		.done(function( msg ) {
			var updates = JSON.parse(msg)
			var salida = "";
			console.log(updates)
			for (var update of updates) 
			{
			  salida += getUpdateLine(update.update_id,update.update_text,update.fechaFormato,update.update_createdby,update.staff_name,update.viewed)
			}			
			
			$("#updatesDiv").html(salida);
		});			
	}
	function getContactProject() {
		$("#notify").html("");
		$.ajax({
		  method: "POST",
		  url: "<?php echo RAIZ; ?>tasks",
		  data: { id:$("#project").val(),action:"getContactP" }
		})
		.done(function( msg ) {
			if(msg.trim()!=""){
				$("#contentNotify").removeClass("d-none");
				$("#notify").html(msg);
				$("#notify ~ .mult-select-tag").remove();
				new MultiSelectTag('notify'); 
			}else{
				$("#contentNotify").addClass("d-none");
			}
		});		
	}
	function getSubtasks() {
		$("#subtasksDiv").html("");
		$.ajax({
		  method: "POST",
		  url: "<?php echo RAIZ; ?>tasks",
		  data: { id:currentTask,action:"getSubtasks" }
		})
		.done(function( msg ) {
			var subtasks = JSON.parse(msg)
			let salida = "";
			if ( subtasks.length > 0 ){
				salida = '<li class="text-end"><i class="fa fa-calendar pb-2 px-3" style="cursor:pointer" onclick="dateSubtask()"></i></li>'
			}
			for (var subtask of subtasks) 
			{
			  salida += getSubtaskLine(subtask.subtask_id,subtask.subtask_text,subtask.subtask_completed,subtask.subtask_startdate,subtask.subtask_duedate,subtask.staff_name,subtask.staff_id)
			}			
			
			$("#subtasksDiv").html('<ul class="list-group">'+salida+'</ul>');
		});			
	}
	
	function deleteUpdate(id) {
		$.ajax({
		  method: "POST",
		  url: "<?php echo RAIZ; ?>tasks",
		  data: { id:id,action:"deleteUpdate" }
		})
		.done(function( msg ) {
			getUpdates()
		});			
	}
	function deleteSubTask(id) {
		$.ajax({
		  method: "POST",
		  url: "<?php echo RAIZ; ?>tasks",
		  data: { id:id,action:"deleteSubTask" }
		})
		.done(function( msg ) {
			getUpdates()
		});			
	}

	function addSubtask() {
		subtask = $("#newSubtask").val()
		if (subtask) {
			$.ajax({
			  method: "POST",
			  url: "<?php echo RAIZ; ?>tasks",
			  data: { id:currentTask,subtask,action:"newSubtask" }
			})
			.done(function( msg ) {
				$("#newSubtask").val("");
				getSubtasks()
			});		
		} else {
			alert("Please type something");
		}
	}	
	function getSubtaskLine(id, text, completed,startdate,duedate,staff_name,staff_s) {
		if ( completed=='1' ) completed = "checked"; else completed = "";
		var task = `<li class="list-group-item">
						<a href="javascript:deleteSubTask(${id})" class="float-end ps-2"><i class="fa fa-times-circle text-dark"></i></a>
						<a href="javascript:dobleClick(${id},${staff_s})" class="float-end" id="divEdit${id}"><i class="fa fa-pencil text-dark"></i></a> 
						<a href="javascript:editSubtask(${id})" class="float-end" id="divSave${id}" style="display:none;" ><i class="fa fa-save text-dark"></i></a> 
						<div ondblclick="dobleClick(${id},${staff_s})" class="tdText tdText${id} form-check">
							<input class="form-check-input" type="checkbox" value="1" id="subtask_${id}" onclick="completarSubTask(${id},this.checked)" ${completed}>
							<label ondblclick="dobleClick(${id},${staff_s})" class="form-check-label d-block" >
							${text}
							${ (staff_name)? '<span class=" float-end mt-1 me-2 badge bg-primary text-wrap">'+staff_name+'</span>' : "" }
							<i class="fa ${( startdate != null && startdate!= "0000-00-00" || duedate != null && duedate!= "0000-00-00")? 'fa-info-circle example-popover': ''} ">
								<div class="popover bs-popover-auto hover-popper" style="position: absolute;inset: 0px auto auto 0px;margin: 0px;top:3vh;left:5vh;">
									<div class="popover-arrow" style="position: absolute; left: 0px; transform: translate3d(59px, 0px, 0px);"></div>
									<div class="popover-body">From: ${( startdate != null )? startdate : " All date"} | Due Date:${( duedate != null )? duedate : " All date"}</div>
								</div>
							</i>
							</label>
						</div>
						<textarea style="display: none;" class="form-control subTask subTask${id}" name="subTask" onchange="editSubtask(${id})">${text}</textarea>
						<div class="col-md-12 d-none " id="responsible${id}">
							<label for="staff_s" class="form-label">Responsible</label>				
							<select class="form-select" name="staff_s" id="staff_s${id}" onchange="editSubtask(${id})">
								<option></option>
								<?php foreach($staff as $s) { ?>
									<option id="staffOption1<?php echo $s["staff_id"]; ?>" value="<?php echo $s["staff_id"]; ?>"><?php echo $s["staff_name"]; ?></option>
								<?php } ?>
							</select>
						</div>	
						<div class="row date-subtask d-none">
							<div class="col-md-6">
								<label for="startdate" class="form-label">From</label>
								<input type="date" name="startdate" id="startdate${id}" class="form-control" placeholder="From" value="${startdate}" onchange="editDateSubtask(${id})">
							</div>		  
							<div class="col-md-6">
								<label for="duedate" class="form-label">Due Date</label>
								<input type="date" name="duedate" id="duedate${id}" class="form-control" placeholder="Due Date" value="${duedate}" onchange="editDateSubtask(${id})">
							</div>
						</div>
					</li>`;

		// var task = '<li class="list-group-item"><a href="javascript:editSubtask('+id+')" class="float-end"><i class="fa fa-pencil text-dark"></i></a> <a href="javascript:deleteSubTask('+id+')" class="float-end"><i class="fa fa-times-circle text-dark"></i></a><div ondblclick="dobleClick('+id+')" class="tdText tdText'+id+' form-check"><input class="form-check-input" type="checkbox" value="1" id="subtask_'+id+'" onclick="completarSubTask('+id+',this.checked)" '+completed+'><label ondblclick="dobleClick('+id+')" class="form-check-label" >'+text+'</label></div><textarea style="display: none;" class="form-control subTask subTask'+id+'" name="subTask" onchange="editSubtask('+id+')" onkeyup="editSubtask('+id+')">'+text+'</textarea></li>';
		return task;
	}
	function dobleClick(id,staff_id=""){
		$(`.tdText`).show(); 
		$(`.subTask`).hide();
		$(`#divEdit${id}`).hide();
		$(`#divSave${id}`).show();
		$(`#responsible${id}`).addClass("d-none");

		if($(`.tdText${id}`).is(":visible")){
			$(`.tdText${id}`).hide();
			$(`.subTask${id}`).show();
			$(`.subTask${id}`).css("height", `${$(`.subTask${id}`).prop("scrollHeight")}px`);
			$(`#responsible${id}`).removeClass("d-none");
			$(`#staff_s${id}`).val(staff_id);

		}
	}
	function dateSubtask() {
		if( $(".date-subtask").hasClass("d-none") ){
			$(".date-subtask").removeClass("d-none");
		}else{
			$(".date-subtask").addClass("d-none");
		}
	}
	function editSubtask(id) {
		subtask = $(".subTask"+id).val();
		staff_s = $("#staff_s"+id).val();
		if (subtask) {
			$.ajax({
			  method: "POST",
			  url: "<?php echo RAIZ; ?>tasks",
			  data: { id:id,subtask,staff_s,action:"updateSubtask" }
			})
			.done(function( msg ) {
				getSubtasks()
			});		
		} else {
			alert("Please type something");
		}
	}
	function editDateSubtask(id) {
		let startdate_ = $("#startdate"+id).val()
		let duedate_ = $("#duedate"+id).val()
		$.post("<?php echo RAIZ; ?>tasks",{id:id,startdate:startdate_,duedate:duedate_,action:"updateDateSubtask"}, function() {});
		
	}
	// function ocultar(id) {
	// 	$(`.tdText`).show(); $(`.tdInput`).hide();
	// 	$(`#divEdit${id}`).show();
	// 	$(`#divSave${id}`).hide();

	// 	var new_value = $(`#tr${id}>td>#t_tarea`).val()
	// 	$(".tdTextTask"+id).html(new_value)

	// 	new_value = $(`#tr${id}>td>#t_from option:selected`).text()

	// 	$(".tdTextFrom"+id).html(new_value)
	// 	new_value = $(`#tr${id}>td>#t_to option:selected`).text()
	// 	$(".tdTextTo"+id).html(new_value)



	// }
	function completarTask(status) {
		if (status) status = 1; else status = 0;
		$.ajax({
		  method: "POST",
		  url: "<?php echo RAIZ; ?>tasks",
		  data: { id:currentTask,status,action:"completeTask" }
		})
		.done(function( msg ) {
			$("#newSubtask").val("");
			getSubtasks()
		});	
	}
	function completarSubTask(id,status) {
		if (status) status = 1; else status = 0;
		$.ajax({
		  method: "POST",
		  url: "<?php echo RAIZ; ?>tasks",
		  data: { id,status,action:"completeSubtask" }
		})
		.done(function( msg ) {
			$("#newSubtask").val("");
			getSubtasks()
		});	
	}
	function getUpdateLine(id,text,date,usuario,staff_name,viewed) {
		var r = "";
		var r2 = "";
		var r3 = "justify-content:start";
		var r4 = "";	
		var eliminar = "";	
		var mostrar_staff = staff_name + " - ";
		let bg = "";
		console.log(viewed == 0);
		if ( viewed == 0 ){
			bg = "bg-success text-white";
			console.log(viewed = 0);
		} 	
		if (usuario == "<?php echo $_SESSION["user_id"]; ?>") {
			r = "arrow-rigt";
			r2 = "align-items-end";
			r3 = "";	
			r4 = "justify-content:end";
			eliminar = '<a href="javascript:deleteUpdate('+id+')"><i class="fa fa-times-circle text-dark"></i></a>';
			mostrar_staff = "";
		}
		var update = `
				<div class="media flex-row-reverse d-flex" style="${r3}">
					<div class="media-body ${r2}">
						<div class="main-msg-wrapper ${r} ${bg}">${text} ${eliminar}</div>
						<div class="date" style="${r4}"><span>${mostrar_staff}${date}</span></div>
					</div>
				</div>
				`;
		return update
	}
</script>