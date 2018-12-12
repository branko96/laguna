<?php

	Class Respuesta{
		protected $id_respuesta;
		protected $mensaje;
  
		
		public function __construct($id_respuesta,$mensaje)
		{
			$this->id_respuesta = sprintf($id_respuesta);

			if(!is_object($mensaje) && !is_array($mensaje)){

            $this->mensaje = sprintf("%s", $mensaje);
        	}else{
            $this->mensaje = $mensaje;
            	 }	    
		}

		public function getId_respuesta(){
				return $this->id_respuesta;
			}

		public function setId_respuesta($id_respuesta){
			$this->id_respuesta = $id_respuesta;
		}

		public function getMensaje(){
				return $this->mensaje;
			}

		public function setMensaje($mensaje){
			$this->mensaje = $mensaje;
		}

		public function getJson(){
      $mensaje = $this->mensaje;
      if(is_array($mensaje)){
        $rta = [];
        foreach ($mensaje as $key => $value) {
          if(is_object($value))
            array_push($rta, $value->getJson());
          elseif (is_array($value)) {
              foreach ($value as $k => $v) {
                if(is_object($v))
                array_push($rta, $v->getJson());
              else
                array_push($rta, $v);
            }
          }
         else
            array_push($rta, $value);
        } 
          $this->mensaje = $rta;
      }
      if(is_object($this->mensaje)){
        $this->mensaje= $this->mensaje->getJson();
      }
      
      //var_dump($rta);die();
      return get_object_vars($this);
    }

	}	
?>
