<?php
include_once dirname(__FILE__). '/../datos/conexion_pdo.php';

class ConsultasUsuarios{

    public function login($us,$pass)
    {
        $rows = null;
        $modelo = new Conexion();
        $conexion = $modelo->get_conexion();
        $sql = "select id,nombre,apellido,usuario from usuarios where usuario=:us and pass=:pass";
        $statement = $conexion->prepare($sql);
        $statement->bindParam(':us', $us);
        $statement->bindParam(':pass', $pass);
        $statement->execute();
        //Con la funcion "fetch()" se guardan en la variable el resultado de la consulta."
        $respuesta = false;
        if (($statement->rowCount())>0) {
            while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
                $respuesta["codigo"] = 1;
                $respuesta["mensaje"] = $result;
            }
        }else{
            $respuesta["codigo"] = -1;
            $respuesta["mensaje"] = "Usuario y/o contraseña incorrecta";
        }
        return $respuesta;
    }
}