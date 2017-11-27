<?php
    class UserManager {

        /**
        *@param $sql_order -> Code sql (ORDER BY)
        *@return Tableau d'objet utilisateur ou false
        */
    	public function getAllUsers($sql_order='') {
    		$user_instance = array();
    		$data = SQL::makeSelect("SELECT * FROM users $sql_order");
            if($data !== false) {
        		foreach ($data as $key => $value) {
        			$user_instance[] = new User($data[$key]);
        		}
            }
    		return count($user_instance) ? $user_instance : false;
    	}

        /**
        *@param $id -> ID SQL de l'utilisateur
        *@return Objet utilisateur ou false
        */
    	public function getUserById($id) {
    		$data = SQL::makeSelect("SELECT * FROM users WHERE u_id=$id LIMIT 1");
    		return $data !== false ? new User($data[0]) : false;
    	}

        /**
        *@param $group_name -> Nom du groupe
        *@param $sql_order -> Code sql (ORDER BY)
        *@return Tableau d'objet utilisateur ou false
        */
    	public function getUsersByGroupName($group_name, $sql_order='') {
    		$user_instance = array();
    		$data = SQL::makeSelect("SELECT * FROM users WHERE u_group='$group_name' $sql_order");
            if($data !== false) {
        		foreach ($data as $key => $value) {
        			$user_instance[] = new User($data[$key]);
        		}
            }
    		return count($user_instance) ? $user_instance : false;
    	}

        /**
        *@param $search -> Mot clé, texte de la recherche
        *@param $sql_order -> Code sql (ORDER BY)
        *@return Tableau d'objet utilisateur ou false
        */
    	public function getUsersBySearch($search, $sql_order='') {
    		$user_instance = array();
    		$data = SQL::makeSelect("SELECT * FROM users WHERE u_firstname LIKE '%$search%' OR u_lastname LIKE '%$search%' OR u_group LIKE '%$search%'");
    		if($data !== false) {
                foreach ($data as $key => $value) {
        			$user_instance[] = new User($data[$key]);
        		}
            }
    		return count($user_instance) ? $user_instance : false;
    	}

        /**
        *@param $data -> Tableau de valeur (u_lastname, u_firstname, u_email, u_birthdate, u_group)
        *@return true si il est créé sinon false
        */
    	public function createUser($data) {
    		if(SQL::makeStatement("INSERT INTO users (u_lastname, u_firstname, u_email, u_birthdate, u_group) VALUES (:u_lastname, :u_firstname, :u_email, :u_birthdate, :u_group)", $data)) {
    			return true;
    		}
    		return false;
    	}

        /**
        *@param $id -> ID SQL de l'utilisateur
        *@return true si il est supprimé sinon false
        */
        public function deleteUser($id) {
            if(SQL::makeStatement("DELETE FROM users WHERE u_id=:id LIMIT 1", array('id'=>$id))) {
                return true;
            }
            return false;
        }
    }
?>