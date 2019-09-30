<?php 
header('Access-Control-Allow-Origin: *');
require_once '../../datos/conexion.php';
require_once '../../controller/TareasController.php';

//defino controladora

$TareasController= new TareasController($basedatos,$servidor,$usuario,$paswd);

//comprobar metodo

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	//OBTENGO DATOS ENVIADOS
	  	//Solamente cuando es json

		//$body = json_decode(file_get_contents("php://input"), true);

		//Cuando son uno o varios parametros

		$body=$_GET;

	//LLAMO A LA FUNCION CON LOS PARAMETROS
	if(isset($body['fecha'])){
        $fecha=$body['fecha'];
    }else{
        $fecha="";
    }

    if(isset($body['id_establecimiento'])){
        $id_establecimiento=$body['id_establecimiento'];
    }else{
        $id_establecimiento=0;
    }

	$rta=$TareasController->Traer_Tareas($id_establecimiento,$fecha);

	//IMPRIMO RESPUESTA

	print(json_encode($rta->getJson()));

}

?>



