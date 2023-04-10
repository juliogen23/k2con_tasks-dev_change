<?php include("./src/views/static/head.php"); ?>
<?php include("./src/views/static/menu.php"); ?>
<div class="container" style="max-width:100%">
    <div class='row p-4'>
        <div class='col-12'>
            <div class="d-flex justify-content-between">
                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="fa fa-bars fa-lg"></i></a> 
                <a href="javascript:modalUser()" class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
            </div>
            <div class="card shadow rounded-4 mt-4">
                <div class="card-body">
                    <div id="contentUserList">
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

<!-- Modal staff -->
<form method="post" onsubmit="userForm(event)" id="userForm" class="needs-validation" enctype="multipart/form-data" name="staffInfo">
    <div class="modal fade" id="modalUserModal" tabindex="-1" aria-labelledby="modalUserModalLabel" aria-hidden="true">
    <div id="divModalDialog" class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="userModalTitle">New staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="row" style="height:100%">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="name"  id="staff_name" class="form-control" placeholder="Name" required>
                            <label for="name" class="form-label  py-2"><i class="fa fa-address-card text-secondary"></i> Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                            <option value="2">User</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <select name="status" id="staff_status" class="form-select py-2 required">
                            <option value="">Status</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>	  
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <input type="hidden" name="staff_id" id="userId" value="">
            
        </div>
    </div>
    </div>
</form>
<!-- End Modal staff -->

<?php include("./src/views/static/footer.php"); ?>
<script type="text/javascript">
  const contentList = document.getElementById('contentUserList');
  let dataUser = "";
  function getList(){
    fetch(`usersList`,{method:"POST"}).then(resp=>resp.json()).then(text=>{
        let array = [];
        text.forEach(element => {
            ( element.staff_status === '1' )? staff_status = "<span class='text-success'>Active</span>": staff_status = "<span class='text-danger'>Inactive</span>";
            if(element.staff_type === "1"){
                staff_type = "Admin";
            }else{
                staff_type = "User";
            }
            ( element.staff_status === '1' )? status='2' : status='1';
            let button = `<div class="dropdown hover-dropdown">
                            <button class="border py-1 btn btn-link text-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i></button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-success" href="javascript:modalUser('${element.staff_id}','${element.staff_name}','${element.staff_user}','${element.staff_email}','${element.staff_type}','${element.staff_status}')"><i class="fa fa-edit"></i> Edit</a></li>
                                <li><a class="dropdown-item" href="javascript:statusRegister('${element.staff_id}', '${status}')"><i class="fa fa-sliders ${( element.staff_status === '1' )?`text-warning`:`text-success`}"></i> ${( element.staff_status === '1' )? `<span class='text-warning'>Inactive</span>`: `<span class='text-success'>Active</span>`}</a></li>
                                <li><a class="dropdown-item text-danger" href="javascript:deleteRegister('${element.staff_id}')"><i class="fa fa-edit"></i> Delete</a></li>
                            </ul>
                          </div>`;
            array.push([element.staff_name, element.staff_user, element.staff_email, staff_type ,staff_status, button]);
        });
        const t = document.createElement("table")
        const data = {
            "headings": ["Name", "Use", "Email", "Type", "Status.",""],
            "data": array
        }
        contentList.appendChild(t)
        window.dt = new DataTable(t, {
            data
        });
    });
  }
  getList();

  var userModal = new bootstrap.Modal(document.getElementById('modalUserModal'));
	function modalUser(id="",name="",user="",email="",type="", status="") {
		document.getElementById("userForm").reset()
		userModal.show()
		 id ?title = "Edit User": title = "New User";
		document.querySelector("#userModalTitle").innerHTML = title;
		document.querySelector("#userId").value = id;
		document.querySelector("#staff_name").value = name;
		document.querySelector("#staff_user").value = ( user!='null' )? user : "";
		document.querySelector("#staff_email").value = ( email!='null' )? email : "";
		document.querySelector("#staff_type").value = type;
		document.querySelector("#staff_status").value = status;
		document.querySelector("#staff_pass").value = "********";
	}

    function userForm(e) {
		e.preventDefault();
		var formData = new FormData(document.forms.namedItem("staffInfo"));
		fetch(`dataUser`,{method:"POST",body:formData}).then((response)=>response.json()).then(result=>{
			userModal.toggle()
			document.getElementById("userForm").reset();
            contentList.innerHTML = "";
            getList();
		});
	}

    function deleteRegister(id) {
        if(confirm("Are you sure you want to delete?")){
            fetch(`deleteUser?staff_id=${id}`,{method:"POST"}).then((response)=>response.json()).then(result=>{
                contentList.innerHTML = "";
                getList();
            });
        }
    }

    function statusRegister(id,status) {
        if(confirm("¿Are you sure you want to change the status?")){
            fetch(`statusUser?staff_id=${id}&status=${status}`,{method:"POST"}).then((response)=>response.json()).then(result=>{
                contentList.innerHTML = "";
                getList();
            });
        }
    }
</script>