<?php function agregarCampoTelefono($id, $campo_in, $texto_out, $campo_hidden, $etiqueta=true) { ?>
	<?php echo ($etiqueta)?"<script>":"" ?>
		var input_<?php echo $id; ?> = document.querySelector("#<?php echo $campo_in; ?>"),
			output_<?php echo $id; ?> = document.querySelector("#<?php echo $texto_out; ?>");

		var iti_<?php echo $id; ?> = window.intlTelInput(input_<?php echo $id; ?>, {
		  nationalMode: true,
		  utilsScript: "<?php echo RAIZ; ?>assets/intlTelInput/js/utils.js", // just for formatting/placeholders etc
			onlyCountries : ["us","bm","ky","pr","do","jm","aw","co","th","za","ve"],//"us","bm","ky","pr","do","jm","aw","co","th","za"], // "aw","bm","jm","es","ve","co","cw"
		  preferredCountries: [<?php switch($_REQUEST["p"]){
													  	case 'aruba': ?>
																"aw"
															<?php break;
															case 'curacao': ?>
																"cw"
															<?php break;
															case 'bermuda': ?>
																"bm"
															<?php break;
													  	default: ?>
																"us"
															<?php break;
													  } ?>]
		});

		var handleChange_<?php echo $id; ?> = function() {
		  var text_<?php echo $id; ?> = (iti_<?php echo $id; ?>.isValidNumber()) ? "International: " + iti_<?php echo $id; ?>.getNumber() : "Please enter a valid number";
		  if(iti_<?php echo $id; ?>.isValidNumber()) {
			document.getElementById("<?php echo $campo_hidden; ?>").value = iti_<?php echo $id; ?>.getNumber();
		  } else {
			document.getElementById("<?php echo $campo_hidden; ?>").value = "error";
		  }
		  var textNode_<?php echo $id; ?> = document.createTextNode(text_<?php echo $id; ?>);
		  output_<?php echo $id; ?>.innerHTML = "";
		  output_<?php echo $id; ?>.appendChild(textNode_<?php echo $id; ?>);
		};

		// listen to "keyup", but also "change" to update when the user selects a country
		input_<?php echo $id; ?>.addEventListener('change', handleChange_<?php echo $id; ?>);
		input_<?php echo $id; ?>.addEventListener('keyup', handleChange_<?php echo $id; ?>);


	<?php echo ($etiqueta)?"</script>":"" ?>
<?php } ?>
