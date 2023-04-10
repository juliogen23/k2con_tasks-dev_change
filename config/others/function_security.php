<?php
  $_RUTES = array();
  $_MENU = array();

  function addRute($url,$archiveName,$menuTitle=null,$menuIcon=null,$inside=null){
    global $_RUTES,$_MENU;
    $myEval='$_MENU';

    if(!empty($_RUTES[$url])){//la entrada se duplico
      echo "Duplicate Path '".$url."'";
    }else{
      $_RUTES[$url]=$archiveName;//cargo los permisos

      foreach(explode(",",$inside) as $key => $value){$myEval.='["'.$value.'"]["hijos"]';}//creo el acceso al array
      if($menuTitle){//Muestra en el menu
        if(!empty($inside)){//esta dentro de otro menu
          eval($myEval.'[$url]=[$menuTitle,$menuIcon];');
        }else{
          $_MENU[$url]=[$menuTitle,$menuIcon];
        }
      }

    }
  }
?>
