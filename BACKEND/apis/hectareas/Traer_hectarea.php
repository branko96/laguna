<?php 
header('Access-Control-Allow-Origin: *');
require_once '../../datos/conexion.php';
require_once '../../controller/HectareaController.php';

//defino controladora

$CaravanasController= new HectareaController($basedatos,$servidor,$usuario,$paswd);

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	//OBTENGO DATOS ENVIADOS
	  	//Solamente cuando es json

		//$body = json_decode(file_get_contents("php://input"), true);

		//Cuando son uno o varios parametros

		//$body=$_GET; 

	//LLAMO A LA FUNCION CON LOS PARAMETROS

	$rta=$CaravanasController->Traer_Caravanas();

	//IMPRIMO RESPUESTA

	print(json_encode($rta));

}

?>



