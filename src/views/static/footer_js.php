<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

<!-- Bootstrap js-->
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Perfect-scrollbar js -->
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<!-- Sidemenu js -->
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/sidemenu/sidemenu.js" id="leftmenu"></script>

<!-- Sidebar js -->
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/sidebar/sidebar.js"></script>

<!-- Select2 js-->
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/select2/js/select2.min.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/js/select2.js"></script>
<!-- Internal Data Table js -->
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/datatable/js/jszip.min.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/datatable/js/buttons.print.min.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/datatable/js/buttons.colVis.min.js"></script>

<!-- InternalFancy uploader js-->
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>

<!-- Modal js-->
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/js/modal.js"></script>

<!-- Sticky js -->
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/js/sticky.js"></script>

<!-- Custom js -->
<script src="<?php echo RAIZ; ?>assets/dashboard/assets/js/custom.js"></script>

<script src="<?php echo RAIZ ?>assets/ckeditorClasic/build/ckeditor.js"></script>
<!-- <script src="<?php echo RAIZ ?>assets/ckeditor/ckeditor.js"></script>
<script>CKEDITOR.config.pasteFromWordRemoveFontStyles = true</script> -->
<?php
  foreach($ARR_MODULES as $module => $module_config){
	  if (file_exists("./src/modules/".$module."/footer.php")) {
		require("./src/modules/".$module."/footer.php");
	  }
  }
?>
<script>
let traduccion_ckeditor = {
					"processing": "Procesando...",
					"lengthMenu": "Mostrar _MENU_ registros",
					"zeroRecords": "No se encontraron resultados",
					"emptyTable": "Ningún dato disponible en esta tabla",
					"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
					"infoFiltered": "(filtrado de un total de _MAX_ registros)",
					"search": "Buscar:",
					"infoThousands": ",",
					"loadingRecords": "Cargando...",
					"paginate": {
						"first": "Primero",
						"last": "Último",
						"next": "Siguiente",
						"previous": "Anterior"
					},
					"aria": {
						"sortAscending": ": Activar para ordenar la columna de manera ascendente",
						"sortDescending": ": Activar para ordenar la columna de manera descendente"
					},
					"buttons": {
						"copy": "Copiar",
						"colvis": "Visibilidad",
						"collection": "Colección",
						"colvisRestore": "Restaurar visibilidad",
						"copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
						"copySuccess": {
							"1": "Copiada 1 fila al portapapeles",
							"_": "Copiadas %ds fila al portapapeles"
						},
						"copyTitle": "Copiar al portapapeles",
						"csv": "CSV",
						"excel": "Excel",
						"pageLength": {
							"-1": "Mostrar todas las filas",
							"_": "Mostrar %d filas"
						},
						"pdf": "PDF",
						"print": "Imprimir",
						"renameState": "Cambiar nombre",
						"updateState": "Actualizar",
						"createState": "Crear Estado",
						"removeAllStates": "Remover Estados",
						"removeState": "Remover",
						"savedStates": "Estados Guardados",
						"stateRestore": "Estado %d"
					},
					"autoFill": {
						"cancel": "Cancelar",
						"fill": "Rellene todas las celdas con <i>%d<\/i>",
						"fillHorizontal": "Rellenar celdas horizontalmente",
						"fillVertical": "Rellenar celdas verticalmentemente"
					},
					"decimal": ",",
					"searchBuilder": {
						"add": "Añadir condición",
						"button": {
							"0": "Constructor de búsqueda",
							"_": "Constructor de búsqueda (%d)"
						},
						"clearAll": "Borrar todo",
						"condition": "Condición",
						"conditions": {
							"date": {
								"after": "Despues",
								"before": "Antes",
								"between": "Entre",
								"empty": "Vacío",
								"equals": "Igual a",
								"notBetween": "No entre",
								"notEmpty": "No Vacio",
								"not": "Diferente de"
							},
							"number": {
								"between": "Entre",
								"empty": "Vacio",
								"equals": "Igual a",
								"gt": "Mayor a",
								"gte": "Mayor o igual a",
								"lt": "Menor que",
								"lte": "Menor o igual que",
								"notBetween": "No entre",
								"notEmpty": "No vacío",
								"not": "Diferente de"
							},
							"string": {
								"contains": "Contiene",
								"empty": "Vacío",
								"endsWith": "Termina en",
								"equals": "Igual a",
								"notEmpty": "No Vacio",
								"startsWith": "Empieza con",
								"not": "Diferente de",
								"notContains": "No Contiene",
								"notStarts": "No empieza con",
								"notEnds": "No termina con"
							},
							"array": {
								"not": "Diferente de",
								"equals": "Igual",
								"empty": "Vacío",
								"contains": "Contiene",
								"notEmpty": "No Vacío",
								"without": "Sin"
							}
						},
						"data": "Data",
						"deleteTitle": "Eliminar regla de filtrado",
						"leftTitle": "Criterios anulados",
						"logicAnd": "Y",
						"logicOr": "O",
						"rightTitle": "Criterios de sangría",
						"title": {
							"0": "Constructor de búsqueda",
							"_": "Constructor de búsqueda (%d)"
						},
						"value": "Valor"
					},
					"searchPanes": {
						"clearMessage": "Borrar todo",
						"collapse": {
							"0": "Paneles de búsqueda",
							"_": "Paneles de búsqueda (%d)"
						},
						"count": "{total}",
						"countFiltered": "{shown} ({total})",
						"emptyPanes": "Sin paneles de búsqueda",
						"loadMessage": "Cargando paneles de búsqueda",
						"title": "Filtros Activos - %d",
						"showMessage": "Mostrar Todo",
						"collapseMessage": "Colapsar Todo"
					},
					"select": {
						"cells": {
							"1": "1 celda seleccionada",
							"_": "%d celdas seleccionadas"
						},
						"columns": {
							"1": "1 columna seleccionada",
							"_": "%d columnas seleccionadas"
						},
						"rows": {
							"1": "1 fila seleccionada",
							"_": "%d filas seleccionadas"
						}
					},
					"thousands": ".",
					"datetime": {
						"previous": "Anterior",
						"next": "Proximo",
						"hours": "Horas",
						"minutes": "Minutos",
						"seconds": "Segundos",
						"unknown": "-",
						"amPm": [
							"AM",
							"PM"
						],
						"months": {
							"0": "Enero",
							"1": "Febrero",
							"10": "Noviembre",
							"11": "Diciembre",
							"2": "Marzo",
							"3": "Abril",
							"4": "Mayo",
							"5": "Junio",
							"6": "Julio",
							"7": "Agosto",
							"8": "Septiembre",
							"9": "Octubre"
						},
						"weekdays": [
							"Dom",
							"Lun",
							"Mar",
							"Mie",
							"Jue",
							"Vie",
							"Sab"
						]
					},
					"editor": {
						"close": "Cerrar",
						"create": {
							"button": "Nuevo",
							"title": "Crear Nuevo Registro",
							"submit": "Crear"
						},
						"edit": {
							"button": "Editar",
							"title": "Editar Registro",
							"submit": "Actualizar"
						},
						"remove": {
							"button": "Eliminar",
							"title": "Eliminar Registro",
							"submit": "Eliminar",
							"confirm": {
								"_": "¿Está seguro que desea eliminar %d filas?",
								"1": "¿Está seguro que desea eliminar 1 fila?"
							}
						},
						"error": {
							"system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
						},
						"multi": {
							"title": "Múltiples Valores",
							"info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
							"restore": "Deshacer Cambios",
							"noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
						}
					},
					"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
					"stateRestore": {
						"creationModal": {
							"button": "Crear",
							"name": "Nombre:",
							"order": "Clasificación",
							"paging": "Paginación",
							"search": "Busqueda",
							"select": "Seleccionar",
							"columns": {
								"search": "Búsqueda de Columna",
								"visible": "Visibilidad de Columna"
							},
							"title": "Crear Nuevo Estado",
							"toggleLabel": "Incluir:"
						},
						"emptyError": "El nombre no puede estar vacio",
						"removeConfirm": "¿Seguro que quiere eliminar este %s?",
						"removeError": "Error al eliminar el registro",
						"removeJoiner": "y",
						"removeSubmit": "Eliminar",
						"renameButton": "Cambiar Nombre",
						"renameLabel": "Nuevo nombre para %s",
						"duplicateError": "Ya existe un Estado con este nombre.",
						"emptyStates": "No hay Estados guardados",
						"removeTitle": "Remover Estado",
						"renameTitle": "Cambiar Nombre Estado"
					}
				}
</script>
