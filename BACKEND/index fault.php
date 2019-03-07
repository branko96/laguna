<?php 
	 $basedatos='lagunacampo';
	 $servidor='localhost';
	 $usuario='root';
	 $paswd='';
	include("datos/DbConfig.php");
	include("controller/EmpleadosController.php");
	
	$uc = new EmpleadosController($basedatos,$servidor,$usuario,$paswd);
	//$rta=$uc->traer_cant_hijos(202);

	//$id_padre_actual=202;
	//$id_usuario=122;

	$rta= $uc->DevolverEmpleados();
	var_dump($rta);
	//if(count($rta)>0){
		//var_dump($rta);
	


?>