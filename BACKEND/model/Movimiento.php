<?php

	Class Movimiento{
		protected $id;
		protected $id_caravana;
		protected $fecha_mov;
		protected $cantidad;
		protected $tipo_mov;
 
		
		public function __construct($id,$id_caravana,$fecha_mov,$cantidad,$tipo_mov)
		{
			$this->id = sprintf($id);
			$this->id_caravana = sprintf($id_caravana);
		    $this->fecha_mov = sprintf($fecha_mov);
		    $this->cantidad = sprintf($cantidad);		    
		    $this->tipo_mov = sprintf($tipo_mov);
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
			return $this->tipo_mov;
		}

		public function setTipo_mov($tipo_mov){
			$this->tipo_mov = $tipo_mov;
		}

		public function getJson(){
          return get_object_vars($this);
    	}

    	
	}	
?>
