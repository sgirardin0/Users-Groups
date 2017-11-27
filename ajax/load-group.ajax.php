<?php
 	spl_autoload_register(function($class){   
		$file = '../classes/'.$class.'.class.php';
		if (file_exists($file)) 
		{
			require $file;
		}

	});

    $result = array();
    $data = GroupManager::getAllGroups();
    foreach ($data as $value) {
    	$result[] = $value->getName();
    }
    echo json_encode($result);
?>