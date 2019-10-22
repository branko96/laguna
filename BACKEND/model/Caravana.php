<?php

	Class Caravana{
		protected $id;
		protected $codigo;
		protected $descripcion;
		protected $peso;
		protected $sexo;
		protected $categoria;  
		protected $procedencia;   
		protected $hectarea; 
		protected $cantidad; 
		
		public function __construct($id,$codigo,$descripcion,$peso,$sexo,$categoria,$procedencia,$hectarea,$cantidad)
		{
			$this->id = sprintf($id);
			$this->codigo = sprintf($codigo);
		    $this->descripcion = sprintf($descripcion);
		    $this->peso = sprintf($peso);		    
		    $this->sexo = sprintf($sexo);
		    $this->categoria = sprintf($categoria);
	    	$this->procedencia = sprintf($procedencia);
	    	$this->hectarea = sprintf($hectarea);
	    	$this->cantidad = sprintf($cantidad);

		}

		public function getId(){
				return $this->id;
			}

		public function setId($id){
			$this->id = $id;
		}

		public function getCodigo(){
				return $this->codigo;
			}

		public function setCodigo($codigo){
			$this->codigo = $codigo;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}

		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function getPeso(){
			return $this->peso;
		}

		public function setPeso($peso){
			$this->peso = $peso;
		}	

		public function getSexo(){
			return $this->sexo;
		}

		public function setSexo($sexo){
			$this->sexo = $sexo;
		}

		public function getCategoria(){
			return $this->categoria;
		}

		public function setCategoria($categoria){
			$this->categoria = $categoria;
		}

		public function getProcedencia(){
			return $this->procedencia;
		}

		public function setProcedencia($procedencia){
			$this->procedencia = $procedencia;
		}

		public function getHectarea(){
			return $this->hectarea;
		}

		public function setHectarea($hectarea){
			$this->hectarea = $hectarea;
		}

		public function getCantidad(){
			return $this->cantidad;
		}

		public function setCantidad($cantidad){
			$this->cantidad = $cantidad;
		}

		public function getJson(){
          return get_object_vars($this);
    	}

    	
	}	
?>
