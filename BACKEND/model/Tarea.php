<?php

	Class Tarea{
		protected $id;
		protected $nombre;
		protected $descrip;
		protected $fecha;
		protected $id_establecimiento;
		
		public function __construct($id,$nombre,$descrip,$fecha,$id_establecimiento)
		{
			$this->id = sprintf($id);
			$this->nombre = sprintf($nombre);
		    $this->descrip = sprintf($descrip);
		    $this->fecha = sprintf($fecha);		    
		    $this->id_establecimiento = sprintf($id_establecimiento);

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

		public function getDescrip(){
			return $this->descrip;
		}

		public function setDescrip($descrip){
			$this->descrip = $descrip;
		}

		public function getFecha(){
			return $this->fecha;
		}

		public function setFecha($fecha){
			$this->fecha = $fecha;
		}	

		public function getId_establecimiento(){
			return $this->id_establecimiento;
		}

		public function setId_establecimiento($id_establecimiento){
			$this->id_establecimiento = $id_establecimiento;
		}	

		public function getJson(){
          return get_object_vars($this);
    	}

    	
	}	
?>
