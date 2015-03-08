$(init);

/* Fonction d'initialisation */
function init(){

	$('#condition').hide();

	/* Initialisation des variables globales */
	var elementSelect = $('.plus').get(0);

	/* Affichage de la structure If Else */
	$('#ifElse').on('click', function(){
			$(elementSelect).before('<button class="plus">+</button>');
			$(elementSelect).before('<div class="if"></div>');
			$(elementSelect.previousSibling).append('<h3>Si</h3>');
			$(elementSelect.previousSibling).append('<input type="text" name="#" placeholder="Si ...">');
			$(elementSelect.previousSibling).append('<button class="plus">+</button>');
			$(elementSelect).before('<div class="then"></div>');
			$(elementSelect.previousSibling).append('<h3>Alors</h3>');
			$(elementSelect.previousSibling).append('<button class="plus">+</button>');
			$(elementSelect).before('<div class="else"></div>');
			$(elementSelect.previousSibling).append('<h3>Sinon</h3>');
			$(elementSelect.previousSibling).append('<button class="plus">+</button>');
	});

	/* Affichage de la boucle while */
	$('#while').on('click', function(){
			$(elementSelect).before('<button class="plus">+</button>');
			$(elementSelect).before('<div class="while"></div>');
			$(elementSelect.previousSibling).append('<h3>Tant que</h3>');
			$(elementSelect.previousSibling).append('<input type="text" name="#" placeholder="Tant que">');
			$(elementSelect.previousSibling).append('<button class="plus">+</button>');
			$(elementSelect).before('<div class="do"></div>');
			$(elementSelect.previousSibling).append('<h3>Faire</h3>');
			$(elementSelect.previousSibling).append('<button class="plus">+</button>');
		
	});

	/* Affichage de la boucle while */
	$('#for').on('click', function(){
			$(elementSelect).before('<button class="plus">+</button>');
			$(elementSelect).before('<div class="for"></div>');
			$(elementSelect.previousSibling).append('<h3>Pour i allant de</h3>');
			$(elementSelect.previousSibling).append('<input type="number" name="#">');
			$(elementSelect.previousSibling).append('<h3>a</h3>');
			$(elementSelect.previousSibling).append('<input type="number" name="#">');
			$(elementSelect).before('<div class="do"></div>');
			$(elementSelect.previousSibling).append('<h3>Faire</h3>');
			$(elementSelect.previousSibling).append('<button class="plus">+</button>');
		
	});

	/* Affichage de l'instruction afficher */
	$('#write').on('click', function(){
			$(elementSelect).before('<button class="plus">+</button>');
			$(elementSelect).before('<input type="text" name="#" placeholder="Afficher ...">');
		
	});

	/* Affichage d'une instruction */
	$('#instruction').on('click', function(){
			$(elementSelect).before('<button class="plus">+</button>');
			$(elementSelect).before('<input type="text" name="#" placeholder="Faire ...">');
		
	});

	/* Affichage d'une condition */
	$('#condition').on('click', function(){
			$(elementSelect).before('<button class="plus">+</button>');
			$(elementSelect).before('<input type="text" name="#" placeholder="Si ...">');
		
	});

	/* On modifie le menu en fonction de l'élément sélectionné */
	$('nav button').on('click', function(){
		
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
				$('#write').show();
				$('#instruction').show();
				$('#ifElse').show();
				$('#while').show();
				$('#for').show();
			}else if(this.parentNode.className == 'else'){
				$('#titleMenu').html('Modifier le SINON');
				hideButtons();
				$('#write').show();
				$('#instruction').show();
				$('#ifElse').show();
				$('#while').show();
				$('#for').show();
			}else if(this.parentNode.className == 'do'){
				$('#titleMenu').html('Modifier le FAIRE');
				hideButtons();
				$('#write').show();
				$('#instruction').show();
				$('#ifElse').show();
				$('#while').show();
				$('#for').show();
			}else if(this.parentNode.id == 'programme'){
				$('#titleMenu').html('Ajouter au programme');
				hideButtons();
				$('#write').show();
				$('#instruction').show();
				$('#ifElse').show();
				$('#while').show();
				$('#for').show();
			}
			elementSelect = this;
			return false;
		});
	});
}

/* Fonction pour masquer tout les buttons */
function hideButtons(){
	$('#write').hide();
	$('#instruction').hide();
	$('#ifElse').hide();
	$('#while').hide();
	$('#for').hide();
	$('#condition').hide();
}
