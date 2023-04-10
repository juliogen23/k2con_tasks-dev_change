<?php
/**
 * CRUD PDO
 */
class CRUD
{
	function __construct(){}

	function Select($Tabla,$_Condicion=null,$Campos="*"){
		global $Connect;
		$Condicion='';
		$Condicion_array=[];
		if(!empty($_Condicion)){
			$Condicion=' WHERE ';
			$Cont=0;
			foreach ($_Condicion as $key => $value){
				$Condicion.=($Cont>0)?' AND '.$key.'=:'.$key : $key.'=:'.$key;
				$Cont++;
			}
		}
       	$SQL 	= 'SELECT '.$Campos.' FROM '.$Tabla.' '.$Condicion;
        $Result = $Connect->prepare($SQL);
        try {
        	$Result->execute($_Condicion);
 			$rows=[];
			while($row = $Result->fetch(PDO::FETCH_ASSOC)){
			    $rows[]=$row;
			}
        	return $rows;
         } catch (Exception $e) {
         	return false;
         }
    }

	function Insert($Tabla,$_Campos_Valores){
		global $Connect;
		$Cont=0; $Campos=''; $Valores='';
		foreach ($_Campos_Valores as $key => $value){
			$Campos.=($Cont>0)?','.$key : $key;
			$Valores.=($Cont>0)?',:'.$key : ':'.$key;
			$Cont++;
		}
       	$SQL 	= 'INSERT INTO '.$Tabla.'('.$Campos.') VALUES('.$Valores.')';
        $Result = $Connect->prepare($SQL);
        try {
        	$Result->execute($_Campos_Valores);
       		return $Connect->lastInsertId();//Retorno ID
        } catch (Exception $e) {
			print_r($e);
        	return false;
        }
	}

	function Update($Tabla,$_Condicion,$_Campos_Valores){
		global $Connect;
		$Cont=0; $Camp_Val='';
		foreach ($_Campos_Valores as $key => $value){
			$Camp_Val.=($Cont>0)?','.$key.'=:'.$key : $key.'=:'.$key;
			$Cont++;
		}
		$Cont=0; $Condicion='';
		foreach ($_Condicion as $key => $value){
			$Condicion.=($Cont>0)?' AND '.$key.'=:'.$key : $key.'=:'.$key;
			$Cont++;
		}
       	$SQL 	= 'UPDATE '.$Tabla.' SET '.$Camp_Val.' WHERE '.$Condicion;
        $Result = $Connect->prepare($SQL);

        try {
        	$Result->execute(array_merge($_Campos_Valores,$_Condicion));
        	return true;
         } catch (Exception $e) {
         	return false;
         }
	}

  function Delete($Tabla,$_Condicion){
		global $Connect;
		$Cont=0; $Condicion='';
		foreach ($_Condicion as $key => $value){
			$Condicion.=($Cont>0)?' AND '.$key.'=:'.$key : $key.'=:'.$key;
			$Cont++;
		}
       	$SQL 	= 'DELETE FROM '.$Tabla.' WHERE '.$Condicion;
        $Result = $Connect->prepare($SQL);
        try {
        	$Result->execute($_Condicion);
       		return true;
        } catch (Exception $e) {
        	return false;
        }
	}

	function Written($SQL,$_Condicion=null,$getRows=false){
		global $Connect;
      try {
				$Result = $Connect->prepare($SQL);
      	$Result->execute($_Condicion);
				if($getRows){
					$rows=[];
					while($row = $Result->fetch(PDO::FETCH_ASSOC)){
							$rows[]=$row;
					}
					return $rows;
				}
				return $Result;
      } catch (Exception $e) {
      	return false;
      }
	}
}
$CRUD = new CRUD();
?>
