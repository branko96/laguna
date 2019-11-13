<?php

	Class Hectarea{
		protected $id;
		protected $idestablecimiento;
		protected $numero;
		protected $total_toros;
		protected $total_vacas;
		protected $total_terneros;
		protected $total_terneras;
		protected $total_novillos;
		protected $total_vaca_vieja;
		protected $total_vaquillona;
		protected $total_caballos;
		
		public function __construct($id,$idestablecimiento,$numero,$total_toros,$total_vacas,$total_terneros,$total_terneras
			,$total_novillos,$total_vaca_vieja,$total_vaquillona,$total_caballos)
		{
			$this->id = sprintf($id);
			$this->idestablecimiento = sprintf($idestablecimiento);
		    $this->numero = sprintf($numero);
		    $this->total_toros = sprintf($total_toros);
		    $this->total_vacas = sprintf($total_vacas);
		    $this->total_terneros = sprintf($total_terneros);
	    	$this->total_terneras = sprintf($total_terneras);
	    	$this->total_novillos = sprintf($total_novillos);
	    	$this->total_vaca_vieja = sprintf($total_vaca_vieja);
			$this->total_vaquillona = sprintf($total_vaquillona);
			$this->total_caballos = sprintf($total_caballos);

		}

		public function getId(){
				return $this->id;
			}

		public function setId($id){
			$this->id = $id;
		}

		public function getIdestablecimiento(){
				return $this->idestablecimiento;
			}

		public function setIdestablecimiento($idestablecimiento){
			$this->idestablecimiento = $idestablecimiento;
		}

		public function getNumero(){
			return $this->numero;
		}

		public function setNumero($Numero){
			$this->Numero = $Numero;
		}

		public function getTotaltoros(){
			return $this->total_toros;
		}

		public function setTotaltoros($total_toros){
			$this->total_toros = $total_toros;
		}	

		public function getTotalvacas(){
			return $this->total_vacas;
		}

		public function setTotalvacas($total_vacas){
			$this->total_vacas = $total_vacas;
		}

		public function getTotalterneros(){
			return $this->total_terneros;
		}

		public function setTotalterneros($total_terneros){
			$this->total_terneros = $total_terneros;
		}

		public function getTotalterneras(){
			return $this->total_terneras;
		}

		public function setTotalterneras($total_terneras){
			$this->total_terneras = $total_terneras;
		}

		public function getTotalnovillos(){
			return $this->total_novillos;
		}

		public function setTotalnovillos($total_novillos){
			$this->total_novillos = $total_novillos;
		}

		public function getTotalvacavieja(){
			return $this->total_vaca_vieja;
		}

		public function setTotalvacavieja($total_vaca_vieja){
			$this->total_vaca_vieja = $total_vaca_vieja;
		}
		public function getTotalvaquillona(){
			return $this->total_vaquillona;
		}

		public function setTotalvaquillona($total_vaquillona){
			$this->total_vaquillona = $total_vaquillona;
		}
		public function getTotalcaballos(){
			return $this->total_caballos;
		}

		public function setTotalcaballos($total_caballos){
			$this->total_caballos = $total_caballos;
		}

		public function getJson(){
          return get_object_vars($this);
    	}

    	
	}	
?>
