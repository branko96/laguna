<?php

	Class Gasto{
		protected $id;
		protected $fecha;
		protected $id_categoria;
		protected $detalle;
		protected $valor;
		protected $id_proveedor;  
		protected $tipo_recibo;   

		public function __construct($id,$fecha,$id_categoria,$detalle,$valor,$id_proveedor,$tipo_recibo)
		{
			$this->id = sprintf($id);
			$this->fecha = sprintf($fecha);
		    $this->id_categoria = sprintf($id_categoria);
		    $this->detalle = sprintf($detalle);		    
		    $this->valor = sprintf($valor);
	    	$this->id_proveedor = sprintf($id_proveedor);
	    	$this->tipo_recibo = sprintf($tipo_recibo);

		}

		public function getId(){
				return $this->id;
			}

		public function setId($id){
			$this->id = $id;
		}

		public function getFecha(){
				return $this->fecha;
			}

		public function setFecha($fecha){
			$this->fecha = $fecha;
		}

		public function getCategoria(){
			return $this->id_categoria;
		}

		public function setCategoria($id_categoria){
			$this->id_categoria = $id_categoria;
		}

		public function getDetalle(){
			return $this->detalle;
		}

		public function setDetalle($detalle){
			$this->detalle = $detalle;
		}	

		public function getValor(){
			return $this->valor;
		}

		public function setValor($valor){
			$this->valor = $valor;
		}

		public function getProveedor(){
			return $this->id_proveedor;
		}

		public function setProveedor($id_proveedor){
			$this->id_proveedor = $id_proveedor;
		}

		public function getTipo_recibo(){
			return $this->tipo_recibo;
		}

		public function setTipo_recibo($tipo_recibo){
			$this->tipo_recibo = $tipo_recibo;
		}

		public function getJson(){
          return get_object_vars($this);
    	}

    	
	}	
?>
