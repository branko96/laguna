<?php

	Class Movimiento{
		protected $id;
		protected $fecha_mov;
		protected $cantidad;
		protected $categoria;
		protected $origen;
		protected $destino;

		public function __construct($id,$fecha_mov,$cantidad,$categoria,$origen,$destino)
		{
			$this->id = sprintf($id);
		    $this->fecha_mov = sprintf($fecha_mov);
		    $this->cantidad = sprintf($cantidad);		    
		    $this->categoria = sprintf($categoria);
		    $this->origen = sprintf($origen);		    
		    $this->destino = sprintf($destino);
		}

		public function getId(){
				return $this->id;
			}

		public function setId($id){
			$this->id = $id;
		}

		public function getId_caravana(){
				return $this->id_caravana;
			}

		public function setId_caravana($id_caravana){
			$this->id_caravana = $id_caravana;
		}

		public function getFecha_mov(){
			return $this->fecha_mov;
		}

		public function setFecha_mov($fecha_mov){
			$this->fecha_mov = $fecha_mov;
		}

		public function getCantidad(){
			return $this->cantidad;
		}

		public function setCantidad($cantidad){
			$this->cantidad = $cantidad;
		}	

		public function getTipo_mov(){
			return $this->categoria;
		}

		public function setTipo_mov($categoria){
			$this->categoria = $categoria;
		}

		public function getOrigen(){
			return $this->origen;
		}

		public function setOrigen($origen){
			$this->origen = $origen;
		}

		public function getDestino(){
			return $this->destino;
		}

		public function setDestino($destino){
			$this->destino = $destino;
		}

		public function getJson(){
          return get_object_vars($this);
    	}

    	
	}	
?>
