<?php
/*GENERA SELECTORES CON LAS OPCIONES DE UNA TABLA*/
function Generar_Selector($SQL,$name_id,$option_selected=false,$is_required=false,$option_init=false){
    $CRUD = new CRUD();
    //Crear head del selector
    $required =($is_required)?'required':'';
		$combo = '<select  id="'.$name_id.'" name="'.$name_id.'" class="form-control" '.$required.'>';
		$combo .= (!empty($option_init))?'<option></option>':'';
    //Ejecuta la peticion a la bd
    $Result=$CRUD->written($SQL);
    while($row = $Result->fetch(PDO::FETCH_ASSOC)){
			$key = $row["_id"];
			$value = $row["_titulo"];
      //Crear body del selector
			$combo .= (!empty($option_selected) && $key == $option_selected)?'<option value="'.$key.'" selected>'.$value.'</option>':'<option value="'.$key.'">'.$value.'</option>';
		}
    //Crear footer del selector
		$combo .= '</select>';
		echo $combo;
}
function Generar_Selector_number($init=0,$end,$name_id,$option_selected=false,$is_required=false,$option_init=false){
  $required =($is_required)?'required':'';
  $combo = '<select  id="'.$name_id.'" name="'.$name_id.'" class="form-control" '.$required.'>';
  $combo .= (!empty($option_init))?'<option></option>':'';
  for ($init=0; $init < $end; $init++){
    $combo .= (!empty($option_selected) && $init == $option_selected)?'<option value="'.$init.'" selected>'.$init.'</option>':'<option value="'.$init.'">'.$init.'</option>';
  }
  //Crear footer del selector
  $combo .= '</select>';
  echo $combo;
}
?>
