document.addEventListener("DOMContentLoaded", function(event) {

	// Affichage du contenu de la page par défault
	updateUserContent();

	// Envoi du formulaire de la barre de recherche
	let formSearch = document.querySelector('#form-search-user');
	formSearch.addEventListener("submit", function(event) {
		 updateUserContent(formSearch);
         event.preventDefault();
	});

	// Action clique sur le boutton 'Supprimer la sélection'
	let btnDel = document.querySelector('#btn-del-users');
	btnDel.addEventListener("click", function() {
		let data = new FormData();
		data.append('action', 'MULTIPLE');
		let check = document.getElementsByClassName('checkbox-del');
		for(let key=0; key<check.length; key++) {
			if(check[key].checked === true) {
			    data.append('post_user_checkbox[]', check[key].getAttribute('value'));
			}
		}
	    ajax('./ajax/delete-user.ajax.php', data, function(response) {
	    	if(response != 'ERROR') {
	    		updateUserContent();
	    	}
	    });
	});

	// Action clique sur le bouton 'Ajouter un utilisateur'
	let btnAdd = document.querySelector('#btn-add-user');
	btnAdd.addEventListener("click", function() {
		ajax('./ajax/load-group.ajax.php', '', function(response) {
			let group = '<option value="">-- Selectionnez un groupe --</option>';
            let parse = JSON.parse(response);
            for(value of parse) {
            	group += '<option value="'+value+'">'+value+'</option>';
            }
            let content = '<form method="POST" action="" id="form-add-user">Identitée :<hr /><input type="text" placeholder="Nom" name="post_add_lastname" /><input type="text" placeholder="Prénom" name="post_add_firstname" /><br /><br />Coordonées :<hr /><input type="email" placeholder="Email" name="post_add_email" /><br /><br />Date de naissance : <hr /><input type="date" name="post_add_birthdate" /><br /><br /><hr /><select name="post_add_group">'+group+'</select><input class="clear" type="submit" name="post_add_submit" value="Ajouter"/><div style="clear:both"></div><div id="msg-content"></div></form>';
			showModal('Ajouter un utilisateur', content);

			let formAdd = document.querySelector('#form-add-user');
			formAdd.addEventListener("submit", function(event) {
                let data = new FormData(this);
                ajax('./ajax/add-user.ajax.php', data, function(response) {
                	let parse = JSON.parse(response);
                	let html = '';
                	if(parse.length > 0) {
                		for(value of parse) {
                		    html += '<p class="msg-error">'+value+'</p>';
                		}
                	}
                	else {
                		html = '<p class="msg-success">Utilisateur ajouté avec succés.</p>';
                		updateUserContent(formSearch);
                	}
                	document.querySelector('#msg-content').innerHTML = html;
  
                });
                event.preventDefault();
		    });
		});
		
	});

	// Action clique pour fermer la fenêtre modal
	let closeModal = document.querySelector('#close-modal');
	closeModal.addEventListener("click", function() {
		let popup = document.querySelector('#modal-popup');
	    popup.style.display='none';
	});	

	// Action clique pour sélectionner tout les utilsateurs
	let btnSelect = document.querySelector('#btn-select');
	btnSelect.addEventListener("click", function() {
        let checkbox = document.getElementsByClassName('checkbox-del');
        for(let i=0; i<checkbox.length; i++) {
        	checkbox[i].checked = true;
        }
	});

    // Action clique pour désélectionner tout les utilsateurs
	let btnUnSelect = document.querySelector('#btn-unselect');
	btnUnSelect.addEventListener("click", function() {
        let checkbox = document.getElementsByClassName('checkbox-del');
        for(let i=0; i<checkbox.length; i++) {
        	checkbox[i].checked = false;
        }
	});
});





// Fonction Ajax 
function ajax(file, data, callback) {
	var xhr = new XMLHttpRequest(); 
	xhr.onreadystatechange = function() {
	    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
	        callback(xhr.responseText);
	    }
	};
	xhr.open("POST", file, true);
	xhr.send(data);
}

// Afficher une fenêtre modal
function showModal(title, content) {
	let popup = document.querySelector('#modal-popup');
	let popupMain = document.querySelector('#modal-main');
    let popupTitle = document.querySelector('#modal-title');
	popupTitle.innerHTML = title;
	popupMain.innerHTML = content;
	popup.style.display = 'block';
}

// Mettre à jour le contenu des utilisateurs
function updateUserContent(formData) {
	let data = new FormData(formData);
    ajax('./ajax/load-user-html.ajax.php', data, function(response) {
        let content = document.querySelector('tbody');
        content.innerHTML = response;

        var btnDetail = document.getElementsByClassName('btn-details');
        var btnDelete = document.getElementsByClassName('btn-del-user');
        for(let i = 0; i<btnDetail.length; i++) {
            btnDetail[i].addEventListener('click', function(){
                showModal('Détails de l\'utilisateur', '<ul><li><b>Nom Prénom :</b> '+(this.getAttribute('data-name'))+'</li><li><b>Age :</b> '+(this.getAttribute('data-age'))+' an(s)</li></ul>');
            });

            btnDelete[i].addEventListener('click', function(){
            	let data = new FormData();
            	data.append('id', this.getAttribute('data-id'));
            	data.append('action', 'UNIQUE');
            	ajax('./ajax/delete-user.ajax.php', data, function(response) {
                    if(response != "ERROR") {
                    	let formSearch = document.querySelector('#form-search-user');
                    	updateUserContent();
                    }
            	});
            });
        }
    });
}
