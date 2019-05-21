<?php

	Class Categoria{
		protected $id;
		protected $concepto;  

		public function __construct($id,$concepto)
		{
			$this->id = sprintf($id);
			$this->concepto = sprintf($concepto);
		}

		public function getId(){
				return $this->id;
			}

		public function setId($id){
			$this->id = $id;
		}

		public function getConcepto(){
				return $this->concepto;
			}

		public function setConcepto($concepto){
			$this->concepto = $concepto;
		}

		public function getJson(){
          return get_object_vars($this);
    	}

    	
	}	
?>
