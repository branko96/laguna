<?php 
//FIJAS
require_once '../../datos/conexion.php';
require_once '../../controller/TareasController.php';

header('Access-Control-Allow-Origin: *');

//defino controladora

$TareasController= new TareasController($basedatos,$servidor,$usuario,$paswd);

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//OBTENGO DATOS ENVIADOS

	  	//Solamente cuando es json
		//$body = json_decode(file_get_contents("php://input"), true);
		
		//Cuando son uno o varios parametros
		$body=$_POST; 
	//var_dump($body);

	//LLAMO A LA FUNCION CON LOS PARAMETROS
	
	$rta=$TareasController->EditarTarea($body['id'],$body['nombre'],$body['descrip'],$body['id_establecimiento']);

	//IMPRIMO RESPUESTA
	print(json_encode($rta->getJson()));

}

?>

