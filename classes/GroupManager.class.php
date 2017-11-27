<?php
    class GroupManager {
        
        /**
        *@param $sql_order -> Code sql (ORDER BY)
        *@return Tableau d'objet groupe ou false
        */
    	public function getAllGroups($sql_order='') {
    		$group_instance = array();
    		$data = SQL::makeSelect("SELECT * FROM groups $sql_order");
            if($data !== false) {
        		foreach ($data as $key => $value) {
        			$group_instance[] = new Group($data[$key]);
        		}
            }
    		return count($group_instance) ? $group_instance : false;
    	
    	}

        /**
        *@param $group_name -> Nom du groupe
        *@return Objet groupe ou false
        */
    	public function getGroupByName($group_name) {
    		$data = SQL::makeSelect("SELECT * FROM groups WHERE g_name='$name' LIMIT 1");
    		return $data !== false ? new Group($data[0]) : false;
    	}

    }
?>