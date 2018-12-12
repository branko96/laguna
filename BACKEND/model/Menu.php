<?php

	Class Menu{
		protected $idmenu_modulos;
		protected $id_permiso;
		protected $nombre;
		protected $ruta;
		protected $icono;
		
		public function __construct($idmenu_modulos,$id_permiso,$nombre,$ruta,$icono)
		{
			$this->idmenu_modulos = sprintf($idmenu_modulos);
			$this->id_permiso = sprintf($id_permiso);
		    $this->nombre = sprintf($nombre);
		    $this->ruta = sprintf($ruta);		    
		    $this->icono = sprintf($icono);
		}
		public function setIdmenu_modulos($idmenu_modulos){
			$this->idmenu_modulos = $idmenu_modulos;
		}
		public function getIdmenu_modulos(){
				return $this->idmenu_modulos;
		}
		public function setId_permiso($id_permiso){
				$this->id_permiso = $id_permiso;
		}

		public function getId_permiso(){
				return $this->id_permiso;
		}

		public function getNombre(){
			return $this->nombre;
		}

		public function setNombre($nombre){
			$this->apellido = $nombre;
		}

		public function getRuta(){
			return $this->ruta;
		}

		public function setRuta($ruta){
			$this->dni = $ruta;
		}	

		public function getIcono(){
			return $this->icono;
		}

		public function setIcono($icono){
			$this->icono = $icono;
		}

		public function getJson(){
          return get_object_vars($this);
    	}
    	
	}	
?>
