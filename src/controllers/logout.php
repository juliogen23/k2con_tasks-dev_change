<?php
unset($_SESSION);
session_destroy();
setcookie("crm1", "",0, "/");
setcookie(PROJECT_NAME_HASH, "",0, "/");
header("location: ".RAIZ)

 ?>
