<?php
if(empty($_SESSION[SESSION_SYSTEM]) && !empty($_COOKIE[PROJECT_NAME_HASH])){
  $cookies=json_decode($_COOKIE[PROJECT_NAME_HASH]);
  if ( !empty($cookies) ) {
    foreach ($cookies as $key => $value){
      $_SESSION[$key]=$value;
    }
  }

}
 ?>
