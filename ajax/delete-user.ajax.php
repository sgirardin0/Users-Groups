<?php
	spl_autoload_register(function($class){   
		$file = '../classes/'.$class.'.class.php';
		if (file_exists($file)) 
		{
			require $file;
		}

	});

	$result = '';
    if(isset($_POST['action'])) {
    	switch($_POST['action']) {
    		
    		// Supprimer depuis le bouton d'action
    		case 'UNIQUE' : {
			    if(!UserManager::deleteUser($_POST['id'])) {
			       $result = 'ERROR';
			    }
			    break;
			}

			// Supprimer depuis la sélection checkbox
			case 'MULTIPLE' : {
				if(isset($_POST['post_user_checkbox'])) {
	                foreach ($_POST['post_user_checkbox'] as $key => $value) {
	                	if(is_numeric($value)) {
	                		UserManager::deleteUser($value);
	                	}
	                }
	            }
			}
		}
	}
	echo $result;

?>