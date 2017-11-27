<?php
    class Group {
    	private $name;

    	// Hydrate
    	public function __construct(array $data) {
            foreach ($data as $key => $value) {
		        $method = 'set'.ucfirst(substr($key, 2, strlen($key)));
		        if (is_callable([$this, $method])) {
		            $this->$method($value);
		        }
		    }
    	}

    	/**
    	*@return Nom du groupe
    	*/
    	public function getName(){
			return $this->name;
		}
		
		/**
		*@param $name -> Nouveau nom du groupe
		*/
		public function setName($name){
			$this->name = $name;
		}

    }
?>