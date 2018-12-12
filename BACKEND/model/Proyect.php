<?php

	Class Proyect{
		protected $id;
		protected $nombre;
		protected $pais;
		protected $ciudad;
		protected $fecha_creacion;
		protected $descripcion;
		protected $id_group;	
		protected $id_creador;
		protected $estado;    
		protected $imagen;    
		
		public function __construct($id,$nombre,$pais,$ciudad,$fecha_creacion,$descripcion,$id_group,$id_creador,$estado,$imagen="")
		{
			$this->id = sprintf($id);
			$this->nombre = sprintf($nombre);
		    $this->pais = sprintf($pais);
		    $this->ciudad = sprintf($ciudad);		    
		    $this->fecha_creacion = sprintf($fecha_creacion);
	    	$this->descripcion = sprintf($descripcion);
	    	$this->id_group = sprintf($id_group);
	    	$this->id_creador = sprintf($id_creador);
	    	$this->estado = sprintf($estado);
	    	$this->imagen = sprintf($imagen);
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

		public function getPais(){
			return $this->pais;
		}

		public function setPais($pais){
			$this->pais = $pais;
		}

		public function getCiudad(){
			return $this->ciudad;
		}

		public function setCiudad($ciudad){
			$this->ciudad = $ciudad;
		}	

		public function getFecha(){
			return $this->fecha_creacion;
		}

		public function setFecha($fecha_creacion){
			$this->fecha_creacion = $fecha_creacion;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}

		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function getId_group(){
			return $this->id_group;
		}

		public function setId_group($id_group){
			$this->id_group = $id_group;
		}

		public function getId_creador(){
			return $this->id_creador;	
		}

		public function setId_creador($id_creador){
			$this->id_creador = $id_creador;
		}
		public function getEstado(){
			return $this->estado;
		}

		public function setEstado($estado){
			$this->estado = $estado;
		}

		public function getFotoProyecto(){
			return $this->imagen;
		}

		public function setFotoProyecto($imagen){
			$this->imagen = $imagen;
		}
		public function getJson(){
          return get_object_vars($this);
    	}

    	
	}	
?>
