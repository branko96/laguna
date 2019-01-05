<?php

	Class Empleado{
		protected $id;
		protected $nombre;
		protected $apellido;
		protected $puesto;
		protected $fecha_inicio;
		protected $sueldo;
		protected $dni;	
		protected $cuil;
		protected $cod_posta;
		protected $fecha_fin;    
		
		public function __construct($id,$nombre,$apellido,$puesto,$fecha_inicio,$sueldo,$dni,$cuil,$cod_postal,$fecha_fin)
		{
			$this->id = sprintf($id);
			$this->nombre = sprintf($nombre);
		    $this->apellido = sprintf($apellido);
		    $this->puesto = sprintf($puesto);		    
		    $this->fecha_inicio = sprintf($fecha_inicio);
	    	$this->sueldo = sprintf($sueldo);
	    	$this->dni = sprintf($dni);
	    	$this->cuil = sprintf($cuil);
	    	$this->cod_postal = sprintf($cod_postal);
	    	$this->fecha_fin = sprintf($fecha_fin);
		}

		public function getId(){
				return $this->id;
			}

		public function setId($id){
			$this->id = $id;
		}

		public function getNombre(){
				return $this->nombre;
			}

		public function setNombre($nombre){
			$this->nombre = $nombre;
		}

		public function getApellido(){
			return $this->apellido;
		}

		public function setApellido($apellido){
			$this->apellido = $apellido;
		}

		public function getPuesto(){
			return $this->puesto;
		}

		public function setPuesto($puesto){
			$this->puesto = $puesto;
		}	

		public function getFecha_inicio(){
			return $this->fecha_inicio;
		}

		public function setFecha_inicio($fecha_inicio){
			$this->fecha_inicio = $fecha_inicio;
		}

		public function getSueldo(){
			return $this->sueldo;
		}

		public function setSueldo($sueldo){
			$this->sueldo = $sueldo;
		}

		public function getDni(){
			return $this->dni;
		}

		public function setDni($dni){
			$this->dni = $dni;
		}
		public function getCuil(){
			return $this->cuil;
		}

		public function setCuil($cuil){
			$this->cuil = $cuil;
		}
		public function getCod_postal(){
			return $this->cod_postal;
		}

		public function setCod_postal($cod_postal){
			$this->cod_postal = $cod_postal;
		}
		public function getFecha_fin(){
			return $this->Fecha_fin;
		}

		public function setFecha_fin($cuil){
			$this->Fecha_fin = $Fecha_fin;
		}
		public function getJson(){
          return get_object_vars($this);
    	}

    	

	}	
?>
