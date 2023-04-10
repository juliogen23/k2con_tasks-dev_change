<?php
  if( !empty($_REQUEST["email"]) && !empty($_REQUEST["password"]) ){
    $Condicion["staff_user"]   = mb_strtoupper($_REQUEST["email"]);
    $Condicion["staff_status"] = 1;
    $dataUser = $CRUD->Select("staff",$Condicion)[0];
    
    if(empty($dataUser["staff_id"]) || $dataUser["staff_pass"] != md5($_REQUEST["password"])){
      $_SESSION["notification"] = array(0 => array("mesaje"=>"User not found.","type"=>"danger"));
    }else if($dataUser["staff_status"] != 1){
      $_SESSION["notification"] = array(0 => array("mesaje"=>"The user is restricted.","type"=>"danger"));
    }else{
      $_SESSION["user_id"]     = $dataUser["staff_id"];
      $_SESSION[SESSION_SYSTEM] = SESSION_SYSTEM;
      $_SESSION["userf_name"]  = $dataUser["staff_name"];
      $_SESSION["user_email"]  = $dataUser["staff_email"];
      $_SESSION["user_type"]   = $dataUser["staff_type"];
      $_SESSION[SESSION_SYSTEM."_user_type"]   = $dataUser["staff_type"];
      $_SESSION["user_lang"]   = $dataUser["staff_lang"];
      // Bitacora
          //Cookie.
        foreach ($_SESSION as $key => $value) {
          $cookies[$key]=$value;
        }
        setcookie(PROJECT_NAME_HASH, json_encode($cookies) , time() + 100 * 24 * 60 * 60, "/");
          
      $_SESSION["notification"] = array(0 => array("mesaje"=>"Welcome.","type"=>"success"));
    }
  }
  if( $_REQUEST["next"] ){
    $rediret = $_REQUEST["next"];
  }else{
    $rediret = RAIZ;
  }
  header("location: ".$rediret);//Ir a esta url
?>
