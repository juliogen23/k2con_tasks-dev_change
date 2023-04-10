<?php
  require_once("./variables.php");
  require_once("./config/others/funtion_getCookie.php");
  require_once("./config/others/function_security.php");
  require_once("./config/others/funciones_fechas.php");
  require_once("./src/functions/funciones_tasks.php");
  require_once("./src/functions/inicial_nombres.php");
  require_once("./src/functions/intl-tel-input-master.php");
  require_once("./config/general/security.php");
  require_once("./config/bd/connect.php");
  require_once("./config/bd/CRUD.php");
  require_once("./config/plugins/sendgrid-php/vendor/autoload.php");
  require_once("./config/others/funciones_email.php");
  require("./config/general/bitacora.php");
  foreach($ARR_MODULES as $module => $module_config) {
	  if (file_exists("./src/modules/".$module."/functions.php")) {
		require("./src/modules/".$module."/functions.php");
	  } else {
	  }
  }  
?>
