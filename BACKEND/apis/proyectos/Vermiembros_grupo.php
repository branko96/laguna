<?php 

//FIJAS
include("../../controller/ProyectController.php");
header('Access-Control-Allow-Origin: *');

//defino controladora

$proyectController= new ProyectController();

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//OBTENGO DATOS ENVIADOS

	  	//Solamente cuando es json
		$body = json_decode(file_get_contents("php://input"), true);
		
		//Cuando son uno o varios parametros
		$body=$_POST; 
	
	//LLAMO A LA FUNCION CON LOS PARAMETROS
	
	$rta=$proyectController->VerMiembros_grupo($body['id_grupo']);

	//IMPRIMO RESPUESTA
	print(json_encode($rta->getJson()));

}

?>

