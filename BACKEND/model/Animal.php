<?php
/**
 * Created by PhpStorm.
 * User: Lucas Escritorio
 * Date: 26/11/2019
 * Time: 15:29
 */

class Animal
{
    protected $id_animal;
    protected $tipo;

public function __construct($id_animal,$tipo)
{
    $this->id_animal = sprintf($id_animal);
    $this->tipo = sprintf($tipo);


}

public function getId_animal(){
    return $this->id_animal;
}

public function setId_animal($id_animal){
    $this->id_animal = $id_animal;
}

public function getTipo(){
    return $this->tipo;
}

public function setTipo($tipo){
    $this->tipo = $tipo;
}
public function getJson(){
    return get_object_vars($this);
}


}