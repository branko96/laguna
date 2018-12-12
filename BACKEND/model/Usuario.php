<?php

	Class Usuario{
		protected $id;
		protected $nombre;
		protected $apellido;
		protected $dni;
		protected $telefono;
		protected $email;
		protected $passw;	
		protected $foto;    
		
		public function __construct($id,$nombre,$apellido,$dni,$telefono,$email,$passw,$foto)
		{
			$this->id = sprintf($id);
			$this->nombre = sprintf($nombre);
		    $this->apellido = sprintf($apellido);
		    $this->dni = sprintf($dni);		    
		    $this->telefono = sprintf($telefono);
	    	$this->email = sprintf($email);
	    	$this->passw = sprintf($passw);
	    	$this->foto = sprintf($foto);
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

		public function getDni(){
			return $this->dni;
		}

		public function setDni($dni){
			$this->dni = $dni;
		}	

		public function getTelefono(){
			return $this->telefono;
		}

		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}

		public function getEmail(){
			return $this->email;
		}

		public function setEmail($email){
			$this->email = $email;
		}

		public function getAPassw(){
			return $this->passw;
		}

		public function setPassw($passw){
			$this->passw = $passw;
		}
		public function getFoto(){
			return $this->foto;
		}

		public function setFoto($foto){
			$this->foto = $foto;
		}
		public function getJson(){
          return get_object_vars($this);
    	}

    	

	}	
?>
