<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include_once dirname(__FILE__). '/../../controller/UsuariosController.php';

$ConsultasUsuarios = new ConsultasUsuarios();

    if (!empty($_POST["us"]) && (!empty($_POST["pass"]))) {
        $usu = $_POST["us"];
        $pass = $_POST["pass"];
        $rta=$ConsultasUsuarios->login($usu,$pass);
    }else{
        $rta["codigo"] = -1;
        $rta["mensaje"] = "Debe completar todos los campos";
    }
echo json_encode($rta);
?>