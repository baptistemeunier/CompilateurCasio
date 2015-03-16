$(init);

/* Fonction d'initialisation */
function init(){

	// L'instruction condition n'est possible que sur les boucles donc pas sur un programme vierge
	$('#condition').hide();

	// Initialisation des variables globales
	var elementSelect = $('.plus').get(0);

	/* Affichage de la structure If Else sur un passage de souris (hover) */
	$('#ifElse').on('mouseenter', function(){
			$(elementSelect).before('<button class="plus">+</button>');
			$(elementSelect).before('<div class="if"></div>');
			$(elementSelect.previousSibling).append('<h3>Si</h3>');
			$(elementSelect.previousSibling).append('<input type="text" name="#" class="si" placeholder="Si ...">');
			$(elementSelect.previousSibling).append('<button class="plus">+</button>');
			$(elementSelect).before('<div class="then"></div>');
			$(elementSelect.previousSibling).append('<h3>Alors</h3>');
			$(elementSelect.previousSibling).append('<button class="plus">+</button>');
			$(elementSelect).before('<div class="else"></div>');
			$(elementSelect.previousSibling).append('<h3>Sinon</h3>');
			$(elementSelect.previousSibling).append('<button class="plus">+</button>');
			$(elementSelect.previousSibling).addClass('mouseOn');
			$(elementSelect.previousSibling.previousSibling).addClass('mouseOn');
			$(elementSelect.previousSibling.previousSibling.previousSibling).addClass('mouseOn');
	});
	/* Affichage de la structure If Else Then sur un click */
	$('#ifElse').on('click', function(){
			$(elementSelect.previousSibling).removeClass('mouseOn');
			$(elementSelect.previousSibling.previousSibling).removeClass('mouseOn');
			$(elementSelect.previousSibling.previousSibling.previousSibling).removeClass('mouseOn');
			elementSelect = "cliquer";
			conditionSi();
	});
	/* Efface la structure If Else si le bouton n'a pas été activé */
	$('#ifElse').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
	});





	/* Affichage de la boucle While sur un passage de souris (hover) */
	$('#while').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<div class="while"></div>');
		$(elementSelect.previousSibling).append('<h3>Tant que</h3>');
		$(elementSelect.previousSibling).append('<input type="text" name="#" class="si" placeholder="Tant que">');
		$(elementSelect.previousSibling).append('<button class="plus">+</button>');
		$(elementSelect).before('<div class="do"></div>');
		$(elementSelect.previousSibling).append('<h3>Faire</h3>');
		$(elementSelect.previousSibling).append('<button class="plus">+</button>');
		$(elementSelect.previousSibling).addClass('mouseOn');
		$(elementSelect.previousSibling.previousSibling).addClass('mouseOn');
	});
	/* Affichage de la structure While sur un click */
	$('#while').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		$(elementSelect.previousSibling.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		conditionSi();
	});
	/* Efface la structure While si le bouton n'a pas été activé */
	$('#while').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
	});





	/* Affichage de la boucle For sur un passage de souris (hover) */
	$('#for').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<div class="for"></div>');
		$(elementSelect.previousSibling).append('<h3>Pour i allant de</h3>');
		$(elementSelect.previousSibling).append('<input type="number" name="#">');
		$(elementSelect.previousSibling).append('<h3>a</h3>');
		$(elementSelect.previousSibling).append('<input type="number" name="#">');
		$(elementSelect).before('<div class="do"></div>');
		$(elementSelect.previousSibling).append('<h3>Faire</h3>');
		$(elementSelect.previousSibling).append('<button class="plus">+</button>');
		$(elementSelect.previousSibling).addClass('mouseOn');
		$(elementSelect.previousSibling.previousSibling).addClass('mouseOn');
	});
	/* Affichage de la structure For sur un click */
	$('#for').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		$(elementSelect.previousSibling.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
	});
	/* Efface la structure For si le bouton n'a pas été activé */
	$('#for').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
	});





	/* Afficher l'instruction Affichage sur un passage de la souris */
	$('#afficher').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<input type="text" name="instruction" class="afficher" placeholder="Afficher ...">');
		$(elementSelect.previousSibling).addClass('mouseOn');
	});
	/* Affichage de l'instrcution Affichage sur un click */
	$('#afficher').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
	});
	/* Efface l'instruction Affichage si le bouton n'a pas été activé */
	$('#afficher').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
	});





	/* Afficher l'instruction Calcul sur un passage de la souris */
	$('#calcul').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<input type="text" name="instruction" class="calcul" placeholder="Caluler ...">');
		$(elementSelect.previousSibling).addClass('mouseOn');
	});
	/* Affichage de l'instrcution Calcul sur un click */
	$('#calcul').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
	});
	/* Efface l'instruction Calcul si le bouton n'a pas été activé */
	$('#calcul').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
	});



	var alphabet = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

	/* Afficher l'instruction Lire sur un passage de la souris */
	$('#lire').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<select name="instruction" class="lire"></select>');
		for(var i=0; i<alphabet.length; i++)
		{
			$(elementSelect.previousSibling).append('<option value="'+alphabet[i]+'">Lire '+alphabet[i]+'</option>');
		}
		$(elementSelect.previousSibling).addClass('mouseOn');
	});
	/* Affichage de l'instrcution Lire sur un click */
	$('#lire').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
	});
	/* Efface l'instruction Lire si le bouton n'a pas été activé */
	$('#lire').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
	});





	/* Afficher l'instruction Condition sur un passage de la souris */
	$('#condition').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<input type="text" name="condition" placeholder="Si ...">');
		$(elementSelect.previousSibling).addClass('mouseOn');
	});
	/* Affichage de l'instrcution Condition sur un click */
	$('#condition').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
	});
	/* Efface l'instruction Condition si le bouton n'a pas été activé */
	$('#condition').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
	});





	/* Afficher la fonction ClearText sur un passage de la souris */
	$('#clearText').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<p>ClearText</p>');
		$(elementSelect).before('<input type="hidden" name="condition" value="CLRTXT">');
		$(elementSelect.previousSibling.previousSibling).addClass('mouseOn');
	});
	/* Affichage de la fonction ClearText sur un click */
	$('#clearText').on('click', function(){
		$(elementSelect.previousSibling.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
	});
	/* Efface la fonction ClearText si le bouton n'a pas été activé */
	$('#clearText').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
	});





	/* Afficher la fonction Set sur un passage de la souris */
	$('#set').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<select name="set" class="set"></select>');
		$(elementSelect.previousSibling).append('<option value="DEG">degres</option>');
		$(elementSelect.previousSibling).append('<option value="RAD">radian</option>');
		$(elementSelect.previousSibling).addClass('mouseOn');
	});
	/* Affichage de la fonction Set sur un click */
	$('#set').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
	});
	/* Efface la fonction Set si le bouton n'a pas été activé */
	$('#set').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
	});
	

	
	


	
	/* On modifie le menu en fonction de l'élément sélectionné */
	$('#navLeft button').on('click', function(){
		
		/* On affiche l'ecran de selection */
		$('#titleMenu').html('Veuillez saisir un element !!!');
		hideButtons();

		/* Evenement du bouton "plus" */
		$('.plus').on('click', function(){
			if(this.parentNode.className == 'if' || this.parentNode.className == 'while'){
				$('#titleMenu').html('Ajouter une condition');
				hideButtons();
				$('#condition').show();
			}else if(this.parentNode.className == 'then'){
				$('#titleMenu').html('Modifier le ALORS');
				hideButtons();
				showButtons()
			}else if(this.parentNode.className == 'else'){
				$('#titleMenu').html('Modifier le SINON');
				hideButtons();
				showButtons()
			}else if(this.parentNode.className == 'do'){
				$('#titleMenu').html('Modifier le FAIRE');
				hideButtons();
				showButtons()
			}else if(this.parentNode.id == 'programme'){
				$('#titleMenu').html('Ajouter au programme');
				hideButtons();
				showButtons()
			}
			elementSelect = this;
			return false;
		});
	});

	$('#submit').on('click', function(){
		$('form').submit();
	})

	
}

/* Fonction pour masquer tout les buttons */
function hideButtons(){
	$('#clearText').hide();
	$('#set').hide();
	$('#afficher').hide();
	$('#calcul').hide();
	$('#lire').hide();
	$('#ifElse').hide();
	$('#while').hide();
	$('#for').hide();
	$('#condition').hide();
}

/* Fonction pour afficher les buttons récurents */
function showButtons(){
	$('#clearText').show();
	$('#set').show();
	$('#afficher').show();
	$('#calcul').show();
	$('#lire').show();
	$('#ifElse').show();
	$('#while').show();
	$('#for').show();
}

function formatageProgramme(){
	$('input').on('keyup', function(){
		var test = "";
		var valeurForm = document.getElementById('programme');
		for(var i=0; i<valeurForm.length; i++)
		{
			if(valeurForm.elements[i].className != "plus" && valeurForm.elements[i].id != "data" && valeurForm.elements[i].id != "title" && valeurForm.elements[i].className != "checkbox")
			{
				test += valeurForm.elements[i].className.toUpperCase()
				if(valeurForm.elements[i].value != "CLRTXT") test += ' ';
				test += valeurForm.elements[i].value;
				if(i < valeurForm.length-8)
				{
					test += '#';
				}
			}
		}
		$('#data').val(test);
	});
}

function conditionSi(){
	$('.si').on('focus', function(){
		var valeur = this.value;
		if(!valeur.match(/^ *([a-zA-Z]+|[0-9]+) *(<|>|==|<=|>=|!=) *([a-zA-Z]+|[0-9]+) *$/) || !valeur.match(/^ *(".+"|[a-zA-Z]+) *(==|!=) *(".+"|[a-zA-Z]+) *$/)){
			this.style.boxShadow = '0 0 30px red';
		}
	});
	$('.si').on('keyup', function(){
		var valeur = this.value;
		if(valeur.match(/^ *([a-zA-Z]+|[0-9]+) *(<|>|==|<=|>=|!=) *([a-zA-Z]+|[0-9]+) *$/) || valeur.match(/^ *(".+"|[a-zA-Z]+) *(==|!=) *(".+"|[a-zA-Z]+) *$/)){
			this.style.boxShadow = '0 0 15px lime';
		}else{
			this.style.boxShadow = '0 0 30px red';
		}
	});
	$('.si').on('blur', function(){
		var valeur = this.value;
		if(valeur.match(/^ *([a-zA-Z]+|[0-9]+) *(<|>|==|<=|>=|!=) *([a-zA-Z]+|[0-9]+) *$/) || valeur.match(/^ *(".+"|[a-zA-Z]+) *(==|!=) *(".+"|[a-zA-Z]+) *$/)){
			this.style.boxShadow = '0 0 0 white';
		}
	});
}