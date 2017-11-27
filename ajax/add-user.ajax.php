<?php
    spl_autoload_register(function($class){   
		$file = '../classes/'.$class.'.class.php';
		if (file_exists($file)) 
		{
			require $file;
		}
	});

    $errors = array();
    if(count($_POST)) {
    	if(empty($_POST['post_add_lastname'])) {
    		$errors[] = "Veuillez insérer un nom de famille.";
    	}
    	if(empty($_POST['post_add_firstname'])) {
    		$errors[] = "Veuillez insérer un prénom.";
    	}
    	if(empty($_POST['post_add_email']) || !IsValidEmail($_POST['post_add_email'])) {
    		$errors[] = "Veuillez insérer un email correct.";
    	}
    	if(empty($_POST['post_add_birthdate'])) {
    		$errors[] = 'Veuillez insérer une date de naissance correct.';
    	}
    	if(empty($_POST['post_add_group'])) {
    		$errors[] = 'Veuillez sélectionner un groupe.';
    	}
    	if(!count($errors)) {
            if(!UserManager::createUser(array('u_lastname'=>$_POST['post_add_lastname'], 'u_firstname'=>$_POST['post_add_firstname'], 'u_email'=>$_POST['post_add_email'], 'u_birthdate'=>$_POST['post_add_birthdate'], 'u_group'=>$_POST['post_add_group']))) {
            	$errors[] = 'Une erreur est survenue.';
            }
    	}
    }
    echo json_encode($errors);

    function IsValidEmail($email) {
    	return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email);
    }
?>