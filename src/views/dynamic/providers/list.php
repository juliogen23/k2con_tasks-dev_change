<?php include("./src/views/static/head.php"); ?>
<?php include("./src/views/static/menu.php"); ?>
<style>
    .iti{
        width: 100%;
    }
</style>
<link rel="stylesheet" href="<?php echo RAIZ; ?>assets/intlTelInput/css/intlTelInput.css">
<script src="<?php echo RAIZ ?>assets/intlTelInput/js/intlTelInput.js"></script>

<div class="container" style="max-width: 95%">
    <div class='row p-4'>
        <div class='col-12'>
            <div class="d-flex justify-content-between">
                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="fa fa-bars fa-lg"></i></a> 
                <a href="javascript:modalProviders()" class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
            </div>
            <div class="card shadow rounded-4 mt-4">
                <div class="card-body">
                    <div class="form-group" style="margin-bottom:-45px">
                        <button type="button" class="btn btn-primary btn-sm export" data-type="csv">Export CSV</button>
                        <button type="button" class="btn btn-primary btn-sm export" data-type="excel">Export Excel</button>
                        <button type="button" class="btn btn-primary btn-sm export" data-type="print">Export PRINT</button>
                        <button type="button" class="btn btn-primary btn-sm export" data-type="text">Export TEXT</button>
                    </div>
                    <div id="contentProvidersList" style="overflow-x: auto; overflow-y: auto; max-height: 500px;">
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>


<!-- Modal providers -->
<form method="post" onsubmit="providersForm(event)" id="providersForm" class="needs-validation" enctype="multipart/form-data" name="ProvidersInfo">
    <div class="modal fade" id="modalProvidersModal" tabindex="-1" aria-labelledby="modalProvidersModalLabel" aria-hidden="true">
    <div id="divModalDialog" class="modal-dialog modal-md">
        <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="providersModalTitle">New Providers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="row" style="height: 100%;">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="providers_name_company"  id="providers_name_company" class="form-control" placeholder="Name" required>
                            <label for="providers_name_company" class="form-label  py-2"><i class="fa fa-pencil text-secondary"></i> Name company</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="providers_category"  id="providers_category" class="form-control" placeholder="Category" required>
                            <label for="providers_category" class="form-label p-2"><i class="fa fa-address-card text-secondary"></i> Category</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <!-- <input type="text" name="providers_country"  id="providers_country" class="form-control" placeholder="country"> -->
                            <!-- <label for="providers_country" class="form-label p-2"><i class="fa fa-envelope text-secondary"></i> country</label> -->
                            
              <select name="providers_country[]" id= 'providers_country' multiple class="form-select form-select" size="2" required>
                <option>Seleccione Pais</option>
                <option value="Afganistán">Afganistán</option>
                <option value="Albania">Albania</option>
                <option value="Alemania">Alemania</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Antigua y Barbuda">Antigua y Barbuda</option>
                <option value="Arabia Saudita">Arabia Saudita</option>
                <option value="Argelia">Argelia</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaiyán">Azerbaiyán</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bangladés">Bangladés</option>
                <option value="Barbados">Barbados</option>
                <option value="Baréin">Baréin</option>
                <option value="Bélgica">Bélgica</option>
                <option value="Belice">Belice</option>
                <option value="Benín">Benín</option>
                <option value="Bielorrusia">Bielorrusia</option>
                <option value="Birmania/Myanmar">Birmania/Myanmar</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
                <option value="Botsuana">Botsuana</option>
                <option value="Brasil">Brasil</option>
                <option value="Brunéi">Brunéi</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Bután">Bután</option>
                <option value="Cabo Verde">Cabo Verde</option>
                <option value="Camboya">Camboya</option>
                <option value="Camerún">Camerún</option>
                <option value="Canadá">Canadá</option>
                <option value="Catar">Catar</option>
                <option value="Chad">Chad</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Chipre">Chipre</option>
                <option value="Ciudad del Vaticano">Ciudad del Vaticano</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoras">Comoras</option>
                <option value="Corea del Norte">Corea del Norte</option>
                <option value="Corea del Sur">Corea del Sur</option>
                <option value="Costa de Marfil">Costa de Marfil</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Croacia">Croacia</option>
                <option value="Cuba">Cuba</option>
                <option value="Dinamarca">Dinamarca</option>
                <option value="Dominica">Dominica</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egipto">Egipto</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Eslovaquia">Eslovaquia</option>
                <option value="Eslovenia">Eslovenia</option>
                <option value="España">España</option>
                <option value="Estados Unidos">Estados Unidos</option>
                <option value="Estonia">Estonia</option>
                <option value="Etiopía">Etiopía</option>
                <option value="Filipinas">Filipinas</option>
                <option value="Finlandia">Finlandia</option>
                <option value="Fiyi">Fiyi</option>
                <option value="Francia">Francia</option>
                <option value="Gabón">Gabón</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Ghana">Ghana</option>
                <option value="Granada">Granada</option>
                <option value="Grecia">Grecia</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guyana">Guyana</option>
                <option value="Guinea">Guinea</option>
                <option value="Guinea ecuatorial">Guinea ecuatorial</option>
                <option value="Guinea-Bisáu">Guinea-Bisáu</option>
                <option value="Haití">Haití</option>
                <option value="Honduras">Honduras</option>
                <option value="Hungría">Hungría</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Irak">Irak</option>
                <option value="Irán">Irán</option>
                <option value="Irlanda">Irlanda</option>
                <option value="Islandia">Islandia</option>
                <option value="Islas Marshall">Islas Marshall</option>
                <option value="Islas Salomón">Islas Salomón</option>
                <option value="Israel">Israel</option>
                <option value="Italia">Italia</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japón">Japón</option>
                <option value="Jordania">Jordania</option>
                <option value="Kazajistán">Kazajistán</option>
                <option value="Kenia">Kenia</option>
                <option value="Kirguistán">Kirguistán</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Laos">Laos</option>
                <option value="Lesoto">Lesoto</option>
                <option value="Letonia">Letonia</option>
                <option value="Líbano">Líbano</option>
                <option value="Liberia">Liberia</option>
                <option value="Libia">Libia</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lituania">Lituania</option>
                <option value="Luxemburgo">Luxemburgo</option>
                <option value="Macedonia del Norte">Macedonia del Norte</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malasia">Malasia</option>
                <option value="Malaui">Malaui</option>
                <option value="Maldivas">Maldivas</option>
                <option value="Malí">Malí</option>
                <option value="Malta">Malta</option>
                <option value="Marruecos">Marruecos</option>
                <option value="Mauricio">Mauricio</option>
                <option value="Mauritania">Mauritania</option>
                <option value="México">México</option>
                <option value="Micronesia">Micronesia</option>
                <option value="Moldavia">Moldavia</option>
                <option value="Mónaco">Mónaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montenegro">Montenegro</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Namibia">Namibia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Níger">Níger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Noruega">Noruega</option>
                <option value="Nueva Zelanda">Nueva Zelanda</option>
                <option value="Omán">Omán</option>
                <option value="Países Bajos">Países Bajos</option>
                <option value="Pakistán">Pakistán</option>
                <option value="Palaos">Palaos</option>
                <option value="Panamá">Panamá</option>
                <option value="Papúa Nueva Guinea">Papúa Nueva Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Perú">Perú</option>
                <option value="Polonia">Polonia</option>
                <option value="Portugal">Portugal</option>
                <option value="Reino Unido">Reino Unido</option>
                <option value="República Centroafricana">República Centroafricana</option>
                <option value="República Checa">República Checa</option>
                <option value="República del Congo">República del Congo</option>
                <option value="República Democrática del Congo">República Democrática del Congo</option>
                <option value="República Dominicana">República Dominicana</option>
                <option value="República Sudafricana">República Sudafricana</option>
                <option value="Ruanda">Ruanda</option>
                <option value="Rumanía">Rumanía</option>
                <option value="Rusia">Rusia</option>
                <option value="Samoa">Samoa</option>
                <option value="San Cristóbal y Nieves">San Cristóbal y Nieves</option>
                <option value="San Marino">San Marino</option>
                <option value="San Vicente y las Granadinas">San Vicente y las Granadinas</option>
                <option value="Santa Lucía">Santa Lucía</option>
                <option value="Santo Tomé y Príncipe">Santo Tomé y Príncipe</option>
                <option value="Senegal">Senegal</option>
                <option value="Serbia">Serbia</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leona">Sierra Leona</option>
                <option value="Singapur">Singapur</option>
                <option value="Siria">Siria</option>
                <option value="Somalia">Somalia</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Suazilandia">Suazilandia</option>
                <option value="Sudán">Sudán</option>
                <option value="Sudán del Sur">Sudán del Sur</option>
                <option value="Suecia">Suecia</option>
                <option value="Suiza">Suiza</option>
                <option value="Surinam">Surinam</option>
                <option value="Tailandia">Tailandia</option>
                <option value="Tanzania">Tanzania</option>
                <option value="Tayikistán">Tayikistán</option>
                <option value="Timor Oriental">Timor Oriental</option>
                <option value="Togo">Togo</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad y Tobago">Trinidad y Tobago</option>
                <option value="Túnez">Túnez</option>
                <option value="Turkmenistán">Turkmenistán</option>
                <option value="Turquía">Turquía</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Ucrania">Ucrania</option>
                <option value="Uganda">Uganda</option>
                <option value="Uruguay">Uruguay</option>
                <option value="Uzbekistán">Uzbekistán</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Yemen">Yemen</option>
                <option value="Yibuti">Yibuti</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabue">Zimbabue</option>
              </select>
             </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="email" name="providers_email"  id="providers_email" class="form-control" placeholder="Email">
                            <label for="providers_email" class="form-label p-2"><i class="fa fa-envelope text-secondary"></i> Email</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" name="providers_name_contact"  id="providers_name_contact" class="form-control" placeholder="Name contact">
                            <label for="providers_name_contact" class="form-label p-2"><i class="fa fa-address-card text-secondary"></i> Name contact</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- <div class="form-floating mb-3">
                            <input type="text" name="providers_phone"  id="providers_phone" class="form-control" placeholder="Phone">
                            <label for="providers_phone" class="form-label p-2"><i class="fa fa-phone text-secondary"></i> Phone</label>
                        </div> -->
                        <div class="form-group mb-3">
                            <!-- <label for="providers_phone">Phone</label> -->
                            <input class="form-control" type="text" name="providers_phone" id="providers_phone" placeholder="(000) 000 0000">
                            <input type="hidden" name="cmp_providers_phone" id="cmp_providers_phone">
                            <small class="uk-text-meta" id="mensaje_salida_up" ></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- <div class="form-floating mb-3">
                            <input type="text" name="providers_phone"  id="providers_phone" class="form-control" placeholder="Phone">
                            <label for="providers_phone" class="form-label p-2"><i class="fa fa-phone text-secondary"></i> Phone</label>
                        </div> -->
                        <div class="form-group mb-3">
                            <!-- <label for="providers_phone">Phone</label> -->
                            <input class="form-control" type="text" name="providers_phone2" id="providers_phone2" placeholder="(000) 000 0000">
                            <input type="hidden" name="cmp_providers_phone2" id="cmp_providers_phone2">
                            <small class="uk-text-meta" id="mensaje_salida_up2" ></small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" name="providers_link"  id="providers_link" class="form-control" placeholder="Link page">
                            <label for="providers_link" class="form-label p-2"><i class="fa fa-link text-secondary"></i> Link page</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea name="providers_address"  id="providers_address" class="form-control" placeholder="Address" style="height: 50px"></textarea>
                            <label for="providers_address" class="form-label p-2"><i class="fa fa-address-book text-secondary"></i> Address</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <textarea name="providers_notes"  id="providers_notes" class="form-control" placeholder="Notes" style="height: 100px"></textarea>
                            <label for="providers_notes" class="form-label p-2"><i class="fa fa-edit text-secondary"></i> Notes</label>
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <input type="hidden" name="providers_id" id="providersId" value="">
            
        </div>
    </div>
    </div>
</form>
<!-- End Modal providers -->
<?php  agregarCampoTelefono("providers_phone", "providers_phone", "mensaje_salida_up", "cmp_providers_phone"); ?>
<?php  agregarCampoTelefono("providers_phone2", "providers_phone2", "mensaje_salida_up2", "cmp_providers_phone2"); ?>

<?php include("./src/views/static/footer.php"); ?>
<script type="text/javascript">
new MultiSelectTag('providers_country');
  const contentList = document.getElementById('contentProvidersList');
  let dataProviders = "";
  function getList(){
    fetch(`providersList`,{method:"POST"}).then(resp=>resp.json()).then(text=>{
        let array = [];
        text.forEach(element => {
            let button = `<a class="text-success position-relative" href="javascript:modalProviders('${element.providers_id}','${element.providers_name_company}','${element.providers_category}','${element.providers_name_contact}','${element.providers_phone}','${element.providers_phone2}','${element.providers_email}','${element.providers_country}','${element.providers_link}','${element.providers_address}','${element.providers_notes}')"><i class="fa fa-pencil"></i></a>
                            <a class="text-danger ps-1" href="javascript:deleteRegister('${element.providers_id}')"><i class="fa fa-trash"></i></a>`;
            // let country = ( element.providers_country.length > 15)? element.providers_country.substring(0,15) + "..." : element.providers_country;
            let country = element.providers_country.replaceAll(',','<br>');
            // let email = ( element.providers_email.length > 30)? element.providers_email.substring(0,30) + "..." : element.providers_email;
             // console.log(country);
            let email = element.providers_email;
            array.push([country, element.providers_category, element.providers_name_company, element.providers_name_contact, element.providers_phone, element.providers_phone2, email, element.providers_link, element.providers_address, element.providers_notes, button]);
        });
        const t = document.createElement("table")
        const data = {
            "headings": ["<b>Country<b>", "<b>Category<b>", "<b>Company name<b>", "<b>Contact<b>", "<b>Phone 1<b>", "<b>Phone 2<b>", "<b>Email<b>", "<b>Link<b>", "<b>Address<b>", "<b>Note<b>",  ""],
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
            let locations = 'data:application/vnd.ms-excel;base64,';
	        let excelTemplate = '<html> ' +
            '<head> ' +
            '<meta http-equiv="content-type" content="text/plain; charset=UTF-8"/> ' +
            '</head> ' +
            '<body> <table border="1"><tr><th><b>Country</b></th><th><b>Category</b></th><th><b>Companyname</b></th><th><b>Contact</b></th><th><b>Phone</b></th><th><b>Phone2</b></th><th><b>Email</b></th><th><b>Linkpage</b></th><th><b>Address</b></th><th><b>Notes</b></th><th></th></tr>'+
           table +
            '</table></body> ' +
            '</html>';
            window.location.href = locations + window.btoa(unescape(encodeURIComponent(excelTemplate)));

        }
		
	});
});
  getList();
  let providersModal = new bootstrap.Modal(document.getElementById('modalProvidersModal'));
	function modalProviders( id="", name="", category="", name_contact="", phone="", phone2="", email="", country="",  link="", address="", notes="" ) {
		document.getElementById("providersForm").reset()
		providersModal.show()
		 id ?title = "Edit Providers": title = "New User";
		document.getElementById("providersModalTitle").innerHTML = title;
		document.getElementById("providersId").value = id;
		document.getElementById("providers_name_company").value =  ( name || name!="null" )? name : "";
		document.getElementById("providers_category").value =  ( category || category!="null" )? category : "";
		document.getElementById("providers_name_contact").value =  ( name_contact || name_contact!="null" )? name_contact : "";
		document.getElementById("providers_email").value = ( email || email!="" )? email : "";
		document.getElementById("providers_phone").value = ( phone || phone!="" )? phone : "";
        document.getElementById("mensaje_salida_up").innerHTML = "";
        iti_providers_phone.setNumber(( phone || phone!="" )? phone : "");
		document.getElementById("cmp_providers_phone").value = ( phone || phone!="" )? phone : "";
        
        document.getElementById("providers_phone2").value = ( phone2 || phone2!="" )? phone2 : "";
        document.getElementById("mensaje_salida_up2").innerHTML = "";
        iti_providers_phone2.setNumber(( phone2 || phone2!="" )? phone2 : "");
		document.getElementById("cmp_providers_phone2").value = ( phone2 || phone2!="" )? phone2 : "";
        $('#providers_country').val(country.split(','));
        $(".mult-select-tag").remove();
		new MultiSelectTag('providers_country');
        
        //let array = country.split(',');
       // array.forEach(element => {
       //     document.querySelector("#providers_country option[value='"+element+"']").selected=true;
            
       // });
        // console.log( country.split(','));
		document.getElementById("providers_address").value = address;
		document.getElementById("providers_link").value = link;



		document.getElementById("providers_notes").value = ( notes || notes!="" )? notes : "";
	}
    


    function providersForm(e) {
		e.preventDefault();
		var formData = new FormData(document.forms.namedItem("ProvidersInfo"));
		fetch(`dataProviders`,{method:"POST",body:formData}).then((response)=>response.json()).then(result=>{
			providersModal.toggle()
			document.getElementById("providersForm").reset();
            contentList.innerHTML = "";
            getList();
		});
	}

    function deleteRegister(id) {
        if(confirm("Are you sure you want to delete?")){
            fetch(`deleteProviders?providers_id=${id}`,{method:"POST"}).then((response)=>response.json()).then(result=>{
                contentList.innerHTML = "";
                getList();
            });
        }
    }
</script>