<?php

	Class Establecimiento{
		protected $id;
		protected $nombre;
 

		public function __construct($id,$nombre)
		{
			$this->id = sprintf($id);
			$this->nombre = sprintf($nombre);
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

		public function getJson(){
          return get_object_vars($this);
    	}

    	
	}	
?>
