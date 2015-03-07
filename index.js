$(init);

/* Fonction d'initialisation */
function init(){

	$('#condition').hide();

	/* Initialisation des variables globales */
	var elementSelect = $('form').get(0);

	/* Affichage de la condition If */
	$('#ifElse').on('click', function(){
		$(elementSelect).append('<div class="if"></div>');
		$(elementSelect.lastChild).append('<h3>Si</h3>');
		$(elementSelect.lastChild).append('<input type="text" name="#" placeholder="Si ...">');
		$(elementSelect.lastChild).append('<button class="plus">+</button>');
		$(elementSelect).append('<div class="then"></div>');
		$(elementSelect.lastChild).append('<h3>Alors</h3>');
		$(elementSelect.lastChild).append('<button class="plus">+</button>');
		$(elementSelect).append('<div class="else"></div>');
		$(elementSelect.lastChild).append('<h3>Sinon</h3>');
		$(elementSelect.lastChild).append('<button class="plus">+</button>');
		$(elementSelect).append('<button class="plus">+</button>');
	});


	/* On modifie le menu en fonction de l'élément sélectionné */
	$('nav button').on('click', function(){
		
		/* On affiche l'ecran de selection */
		$('#titleMenu').html('Veuillez saisir un element !!!');
		hideButtons();

		/* Evenement du bouton "plus" */
		$('.plus').on('click', function(){
			if(this.parentNode.className == 'if'){
				$('#titleMenu').html('Ajouter une condition');
				hideButtons();
				$('#condition').show();
				elementSelect = this.parentNode;
			}else if(this.parentNode.className == 'then'){
				$('#titleMenu').html('Modifier le ALORS');
				hideButtons();
				$('#afficher').show();
				$('#instruction').show();
				$('#ifElse').show();
				$('#while').show();
				$('#for').show();
				elementSelect = this.parentNode;
			}else if(this.parentNode.className == 'else'){
				$('#titleMenu').html('Modifier le SINON');
				hideButtons();
				$('#afficher').show();
				$('#instruction').show();
				$('#ifElse').show();
				$('#while').show();
				$('#for').show();
				elementSelect = this.parentNode;
			}
			return false;
		});
	});
}

/* Fonction pour masquer tout les buttons */
function hideButtons(){
	$('#afficher').hide();
	$('#instruction').hide();
	$('#ifElse').hide();
	$('#while').hide();
	$('#for').hide();
	$('#condition').hide();
}
