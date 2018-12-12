<?php

	Class Permiso{
		protected $id_permiso;
		protected $id_usuario;
		protected $fk_permiso;
		protected $valor;   
		
		public function __construct($id_permiso,$id_usuario,$fk_permiso,$valor)
		{
			$this->id_permiso = sprintf($id_permiso);
			$this->id_usuario = sprintf($id_usuario);
		    $this->fk_permiso = sprintf($fk_permiso);
		    $this->valor = sprintf($valor);		    
		}

		public function getId_permiso(){
				return $this->id_permiso;
			}

		public function setId_permiso($id_permiso){
			$this->id = $id_permiso;
		}

		public function getId_usuario(){
				return $this->id_usuario;
			}

		public function setId_usuario($id_usuario){
			$this->nombre = $id_usuario;
		}

		public function getPermiso(){
			return $this->fk_permiso;
		}

		public function setPermiso($fk_permiso){
			$this->fk_permiso = $fk_permiso;
		}

		public function getValor(){
			return $this->valor;
		}

		public function setValor($valor){
			$this->dni = $valor;
		}	

		public function getJson(){
          return get_object_vars($this);
    	}

	}	
?>
