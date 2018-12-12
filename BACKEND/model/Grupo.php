<?php

	Class Grupo{
		protected $id;
		protected $nombre;
		protected $miembros;
		
		public function __construct($id,$nombre,$miembros=[])
		{
			$this->id = sprintf($id);
		    $this->nombre = sprintf($nombre);
		    $this->miembros = $miembros;
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

		public function getMiembros(){
				return $this->miembros;
			}

		public function setMiembros($miembros){
			$this->miembros = $miembros;
		}

		public function getJson(){
          return get_object_vars($this);
    	}
    	
	}	
?>
