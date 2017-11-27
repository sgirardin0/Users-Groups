<?php
    spl_autoload_register(function($class){   
		$file = '../classes/'.$class.'.class.php';
		if (file_exists($file)) 
		{
			require $file;
		}

	});

    if(!empty($_POST['post_search_content'])) {
        $user = UserManager::getUsersBySearch($_POST['post_search_content'], 'ORDER BY u_group, u_lastname ASC');  // Recherche de tout les utilisateurs par mot clé
    }
    else {
    	$user = UserManager::getAllUsers('ORDER BY u_group, u_lastname ASC');   // Recherche de tout les utilisateurs
    }

    if($user !== false) {
    	echo '<form method="POST" action="" id="form-list-user"';
     	foreach ($user as $key_user => $value_user) {	// On parcours la liste des utilisateurs 
     		echo '
     		    <tr>
     		        <td>'.$value_user->getGroup().'</td>
     		        <td>'.$value_user->getLastname().' '.$value_user->getFirstname().'</td>
     		        <td>'.$value_user->getEmail().'</td>
     		        <td><input class="btn-details" type="button" value="Détails" data-name="'.$value_user->getLastname().' '.$value_user->getFirstname().'" data-age="'.$value_user->getAge().'"/> <input type="button" value="Supprimer" class="btn-del-user" data-id="'.$value_user->getId().'"/></td>
     		    	<td><input class="checkbox-del" type="checkbox" name="post_users_checkbox[]" value="'.$value_user->getId().'"></td>
     		    </tr>
     		';
     	}
     	echo '</form>';

    }