<?php include("./src/views/static/head.php"); ?>
<?php include("./src/views/static/menu.php"); ?>
<style>
    .iti{
        width: 100%;
    }
</style>
<link rel="stylesheet" href="<?php echo RAIZ; ?>assets/intlTelInput/css/intlTelInput.css">
<script src="<?php echo RAIZ ?>assets/intlTelInput/js/intlTelInput.js"></script>

<div class="container" style="max-width:100%">
    <div class='row p-4'>
        <div class='col-12'>
            <div class="d-flex justify-content-between">
                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="fa fa-bars fa-lg"></i></a> 
                <a href="javascript:modalContact()" class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
            </div>
            <div class="card shadow rounded-4 mt-4">
                <div class="card-body">
                    <div class="form-group" style="margin-bottom:-45px">
                        <button type="button" class="btn btn-primary btn-sm export" data-type="csv">Export CSV</button>
                        <button type="button" class="btn btn-primary btn-sm export" data-type="excel">Export Excel</button>
                        <button type="button" class="btn btn-primary btn-sm export" data-type="print">Export PRINT</button>
                        <button type="button" class="btn btn-primary btn-sm export" data-type="text">Export TEXT</button>
                    </div>
                    <div id="contentContactList">
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

<!-- Modal Contact -->
<form method="post" onsubmit="contactForm(event)" id="contactForm" class="needs-validation" enctype="multipart/form-data" name="ContactInfo">
    <div class="modal fade" id="modalContactModal" tabindex="-1" aria-labelledby="modalContactModalLabel" aria-hidden="true">
    <div id="divModalDialog" class="modal-dialog modal-md">
        <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="contactModalTitle">New Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="row" style="height:100%">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" name="contact_name"  id="contact_name" class="form-control" placeholder="Name" required>
                            <label for="contact_name" class="form-label  py-2"><i class="fa fa-pencil text-secondary"></i> Name</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" name="contact_company"  id="contact_company" class="form-control" placeholder="Company" required>
                            <label for="contact_company" class="form-label p-2"><i class="fa fa-address-card text-secondary"></i> Company</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="email" name="contact_email"  id="contact_email" class="form-control" placeholder="Email">
                            <label for="contact_email" class="form-label p-2"><i class="fa fa-envelope text-secondary"></i> Email</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="form-floating mb-3">
                            <input type="text" name="contact_phone"  id="contact_phone" class="form-control" placeholder="Phone">
                            <label for="contact_phone" class="form-label p-2"><i class="fa fa-phone text-secondary"></i> Phone</label>
                        </div> -->
                        <div class="form-group mb-3">
                            <!-- <label for="contact_phone">Phone</label> -->
                            <input class="form-control" type="text" name="contact_phone" id="contact_phone" placeholder="(000) 000 0000">
                            <input type="hidden" name="cmp_contact_phone" id="cmp_contact_phone">
                            <small class="uk-text-meta" id="mensaje_salida_up" ></small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea name="contact_notes"  id="contact_notes" class="form-control" placeholder="Notes" style="height: 100px"></textarea>
                            <label for="contact_notes" class="form-label p-2"><i class="fa fa-edit text-secondary"></i> Notes</label>
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <input type="hidden" name="contact_id" id="contactId" value="">
            
        </div>
    </div>
    </div>
</form>
<!-- End Modal contact -->
<?php  agregarCampoTelefono("contact_phone", "contact_phone", "mensaje_salida_up", "cmp_contact_phone"); ?>
<?php include("./src/views/static/footer.php"); ?>
<script type="text/javascript">
  const contentList = document.getElementById('contentContactList');
  let dataContact = "";
  function getList(){
    fetch(`contactList`,{method:"POST"}).then(resp=>resp.json()).then(text=>{
        let array = [];
        text.forEach(element => {
            let button = `<a class="text-success position-relative" href="javascript:modalContact('${element.contact_id}','${element.contact_name}','${element.contact_company}','${element.contact_phone}','${element.contact_email}','${element.contact_notes}')"><i class="fa fa-pencil"></i></a>
                            <a class="text-danger ps-1" href="javascript:deleteRegister('${element.contact_id}')"><i class="fa fa-trash"></i></a>`;
            array.push([element.contact_name, element.contact_company, element.contact_phone, element.contact_email , button]);
        });
        const t = document.createElement("table")
        const data = {
            "headings": ["<b>Name<b>", "<b>Company<b>", "<b>Phone<b>", "<b>Email<b>",""],
            "data": array
        }
        contentList.appendChild(t)
        datatable = new DataTable(t, {
            data,
            perPage: array.length,
            perPageSelect:false,
            columns: [
                // Sort the second column in ascending order
                { select: 0, sort: "desc" },

                // Set the third column as datetime string matching the format "DD/MM/YYY"
                // { select: 2, type: "date", format: "DD/MM/YYYY" },

                // Disable sorting on the fourth and fifth columns
                // { select: [3,4], sortable: false },

                // Hide the sixth column
                // { select: 5, hidden: true },
            ]
        });
    });
  }
  document.querySelectorAll(".export").forEach(function(el) {
	el.addEventListener("click", function(e) {
        let type = el.dataset.type;
        console.log(datatable);
		if ( type === "csv" || type === "text" ) {
            
            let data = {
                type: type,
                filename: "my-" + type,
            };

            if ( type === "csv" ) {
                data.columnDelimiter = ";";
            }
            
            datatable.export(data);
        }else if( type === "print" ) {
            datatable.print();
        }else if ( type === "excel" ) {
            let array = datatable.data;
            let table;
            array.forEach((element,key) => {
                table += '<tr>'+element.innerHTML+'</tr>';
            });
            let location = 'data:application/vnd.ms-excel;base64,';
	        let excelTemplate = '<html> ' +
            '<head> ' +
            '<meta http-equiv="content-type" content="text/plain; charset=UTF-8"/> ' +
            '</head> ' +
            '<body> <table border="1"><tr><th><b>Name</b></th><th><b>Company</b></th><th><b>Phone</b></th><th><b>Email</b></th><th></th></tr>' +
           table +
            '</table></body> ' +
            '</html>'
            window.location.href = location + window.btoa(unescape(encodeURIComponent(excelTemplate)));

        }
		
	});
});
  getList();

  let contactModal = new bootstrap.Modal(document.getElementById('modalContactModal'));
	function modalContact( id="", name="", company="", phone="", email="", notes="" ) {
		document.getElementById("contactForm").reset()
		contactModal.show()
		 id ?title = "Edit Contact": title = "New User";
		document.querySelector("#contactModalTitle").innerHTML = title;
		document.querySelector("#contactId").value = id;
		document.querySelector("#contact_name").value = name;
		document.querySelector("#contact_company").value = company;
		document.querySelector("#contact_email").value = ( email || email!="" )? email : "";
		document.querySelector("#contact_phone").value = ( phone || phone!="" )? phone : "";
        document.querySelector("#mensaje_salida_up").innerHTML = "";
        iti_contact_phone.setNumber(( phone || phone!="" )? phone : "");
		document.querySelector("#cmp_contact_phone").value = ( phone || phone!="" )? phone : "";
		document.querySelector("#contact_notes").value = ( notes || notes!="" )? notes : "";
	}
    

    function contactForm(e) {
		e.preventDefault();
		var formData = new FormData(document.forms.namedItem("ContactInfo"));
		fetch(`dataContact`,{method:"POST",body:formData}).then((response)=>response.json()).then(result=>{
			contactModal.toggle()
			document.getElementById("contactForm").reset();
            contentList.innerHTML = "";
            getList();
		});
	}

    function deleteRegister(id) {
        if(confirm("Are you sure you want to delete?")){
            fetch(`deleteContact?contact_id=${id}`,{method:"POST"}).then((response)=>response.json()).then(result=>{
                contentList.innerHTML = "";
                getList();
            });
        }
    }
</script>