<?php
  switch ($_SESSION[SESSION_SYSTEM."_user_type"]) {
    case 1:
      require("./config/general/permissions/admin.php");
    break;
    case 2:
      require("./config/general/permissions/users.php");
    break;
    default:
      require("./config/general/permissions/others.php");
    break;
  }

  foreach($ARR_MODULES as $module => $module_config) {
	  if (file_exists("./src/modules/".$module."/routes.php")) {
		require("./src/modules/".$module."/routes.php");
	  }
  }

  require("./config/general/permissions/all.php");
  //usuario tipo

  if(!empty($_RUTES[URL])){
    $DESTINY = $_RUTES[URL];
  }else{

    $DESTINY = $_RUTES["index"];

    // $DESTINY = ERROR_PAGE;
  }
?>
