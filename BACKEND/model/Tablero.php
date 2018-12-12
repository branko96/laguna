<?php

	Class Tablero{
		protected $id;
		protected $id_proyecto;
		protected $idusuario_creador;
		protected $nombre_tablero;
		protected $fecha_creacion;
		protected $tipo_periodo;
		protected $cant_periodos;	 
		protected $estado;
		protected $visible;   
		
		public function __construct($id,$id_proyecto,$idusuario_creador,$nombre_tablero,$fecha_creacion,$tipo_periodo,$cant_periodos,$estado,$visible)
		{
			$this->id = sprintf($id);
			$this->id_proyecto = sprintf($id_proyecto);
		    $this->idusuario_creador = sprintf($idusuario_creador);
		    $this->nombre_tablero = sprintf($nombre_tablero);		    
		    $this->fecha_creacion = sprintf($fecha_creacion);
	    	$this->tipo_periodo = sprintf($tipo_periodo);
	    	$this->cant_periodos = sprintf($cant_periodos);
	    	$this->estado = sprintf($estado);
	    	$this->visible = sprintf($visible);
		}

		public function getId(){
				return $this->id;
			}

		public function setId($id){
			$this->id = $id;
		}

		public function getId_proyecto(){
				return $this->id_proyecto;
			}

		public function setId_proyecto($id_proyecto){
			$this->id_proyecto = $id_proyecto;
		}

		public function getIdusuario_creador(){
			return $this->idusuario_creador;
		}

		public function setIdusuario_creador($idusuario_creador){
			$this->idusuario_creador = $idusuario_creador;
		}

		public function getNombre_tablero(){
			return $this->nombre_tablero;
		}

		public function setNombre_tablero($nombre_tablero){
			$this->nombre_tablero = $nombre_tablero;
		}	

		public function getFecha(){
			return $this->fecha_creacion;
		}

		public function setFecha($fecha_creacion){
			$this->fecha_creacion = $fecha_creacion;
		}

		public function getTipo_periodo(){
			return $this->tipo_periodo;
		}

		public function setTipo_periodo($tipo_periodo){
			$this->tipo_periodo = $tipo_periodo;
		}

		public function getCant_periodos(){
			return $this->cant_periodos;
		}

		public function setCant_periodos($cant_periodos){
			$this->cant_periodos = $cant_periodos;
		}

		
		public function getEstado(){
			return $this->estado;
		}

		public function setEstado($estado){
			$this->estado = $estado;
		}
		public function getVisible(){
			return $this->visible;
		}

		public function setVisible($visible){
			$this->visible = $visible;
		}
		public function getJson(){
          return get_object_vars($this);
    	}

    	
	}	
?>
