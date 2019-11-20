<?php 
//FIJAS
require_once '../../datos/conexion.php';
require_once '../../controller/HectareaController.php';

header('Access-Control-Allow-Origin: *');

//defino controladora

$hectareasController= new HectareaController($basedatos,$servidor,$usuario,$paswd);

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//OBTENGO DATOS ENVIADOS

	  	//Solamente cuando es json
		//$body = json_decode(file_get_contents("php://input"), true);
		
		//Cuando son uno o varios parametros
		$body=$_POST; 
	//var_dump($body);
	//LLAMO A LA FUNCION CON LOS PARAMETROS
	
	$rta=$hectareasController->EditarCaravana($body['id'],$body['codigo'],$body['descripcion'],$body['peso'],$body['sexo'],$body['categoria'], $body['procedencia'],$body['hectarea']);

	//IMPRIMO RESPUESTA
	print(json_encode($rta->getJson()));

}

?>

