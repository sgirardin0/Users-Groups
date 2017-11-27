<?php

    class User {

    	private $id;
    	private $firstname;
    	private $lastname;
    	private $email;
    	private $birthdate;
    	private $group;

    	// Hydrate
    	public function __construct(array $data) {
            foreach ($data as $key => $value) {
		        $method = 'set'.ucfirst(substr($key, 2, strlen($key)));
		        if (is_callable([$this, $method])) {
		            $this->$method($value);
		        }
		    }
    	}

    	public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getFirstname(){
			return $this->firstname;
		}

		public function setFirstname($firstname){
			$this->firstname = $firstname;
		}

		public function getLastname(){
			return $this->lastname;
		}

		public function setLastname($lastname){
			$this->lastname = $lastname;
		}

		public function getEmail(){
			return $this->email;
		}

		public function setEmail($email){
			$this->email = $email;
		}

		public function getBirthdate(){
			return $this->birthdate;
		}

		public function setBirthdate($birthdate){
			$this->birthdate = $birthdate;
		}

		public function getGroup(){
			return $this->group;
		}

		public function setGroup($group){
			$this->group = $group;
		}

		public function getAge() {
			$T = explode('-', $this->getBirthdate());
			$age = (int) date('Y') - (int) $T[0] ;
			if ( date('md') < $T[1].$T[2] ) $age-- ;
			return $age;
		}
    }

?>