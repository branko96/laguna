<?php 

//FIJAS
require_once '../../datos/conexion.php';
require_once '../../controller/VentasController.php';

header('Access-Control-Allow-Origin: *');

//defino controladora

$ventasController= new VentasController($basedatos,$servidor,$usuario,$paswd);

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//OBTENGO DATOS ENVIADOS

	   	//Solamente cuando es json
		//$body = json_decode(file_get_contents("php://input"), true);

		//Cuando son uno o varios parametros
		$body=$_POST; 
		//var_dump($body);
		//var_dump($_FILES);
		
	//LLAMO A LA FUNCION CON LOS PARAMETROS
		//$fecha_inicio= date('Y-m-d H:i:s');
		$rta=$ventasController->AltaVenta($body['codigo'], $body['descripcion'], $body['peso'], $body['sexo'], $body['categoria'], $body['procedencia']);

	//IMPRIMO RESPUESTA

		print(json_encode($rta->getJson()));
}

?>

