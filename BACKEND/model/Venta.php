<?php

	Class Venta{
		protected $id;
		protected $fecha;
		protected $num_fact;
		protected $cabezas;
		protected $kg;
		protected $peso_x_kg;  
		protected $bruto;   
		protected $iva;   
		protected $neto;   
		protected $retencion;   
		
		public function __construct($id,$fecha,$num_fact,$cabezas,$kg,$peso_x_kg,$bruto,$iva,$neto,$retencion)
		{
			$this->id = sprintf($id);
			$this->fecha = sprintf($fecha);
		    $this->num_fact = sprintf($num_fact);
		    $this->cabezas = sprintf($cabezas);		    
		    $this->kg = sprintf($kg);
	    	$this->peso_x_kg = sprintf($peso_x_kg);
	    	$this->bruto = sprintf($bruto);
	    	$this->iva = sprintf($iva);
	    	$this->neto = sprintf($neto);
	    	$this->retencion = sprintf($neto);

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

		public function getNum_fact(){
			return $this->num_fact;
		}

		public function setNum_fact($num_fact){
			$this->num_fact = $num_fact;
		}

		public function getCabezas(){
			return $this->cabezas;
		}

		public function setCabezas($cabezas){
			$this->cabezas = $cabezas;
		}	

		public function getKg(){
			return $this->kg;
		}

		public function setKg($kg){
			$this->kg = $kg;
		}

		public function getPeso_x_kg(){
			return $this->peso_x_kg;
		}

		public function setPeso_x_kg($peso_x_kg){
			$this->peso_x_kg = $peso_x_kg;
		}

		public function getBruto(){
			return $this->bruto;
		}

		public function setBruto($bruto){
			$this->bruto = $bruto;
		}

		public function getIva(){
			return $this->iva;
		}

		public function setIva($iva){
			$this->iva = $iva;
		}

		public function getNeto(){
			return $this->neto;
		}

		public function setNeto($neto){
			$this->neto = $neto;
		}

		public function getRetencion(){
			return $this->retencion;
		}

		public function setRetencion($retencion){
			$this->retencion = $retencion;
		}

		public function getJson(){
          return get_object_vars($this);
    	}

    	
	}	
?>
