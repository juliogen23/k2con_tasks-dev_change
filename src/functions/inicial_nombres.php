<?php 
function getIniciales($nombre){
    $name = '';
    $explode = explode(' ',$nombre);
    foreach($explode as $x){
        $name .=  $x[0];
    }
    return $name;    
}
?>