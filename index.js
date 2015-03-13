$(init);

/* Fonction d'initialisation */
function init(){

	$('#condition').hide();

	/* Initialisation des variables globales */
	var elementSelect = $('.plus').get(0);



	/* Affichage de la structure If Else */
	$('#ifElse').on('click', function(){
			$(elementSelect.previousSibling).removeClass('mouseOn');
			$(elementSelect.previousSibling.previousSibling).removeClass('mouseOn');
			$(elementSelect.previousSibling.previousSibling.previousSibling).removeClass('mouseOn');
			elementSelect = "cliquer";
	});
	/* Affichage de la structure If Else */
	$('#ifElse').on('mouseenter', function(){
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
			$(elementSelect.previousSibling).addClass('mouseOn');
			$(elementSelect.previousSibling.previousSibling).addClass('mouseOn');
			$(elementSelect.previousSibling.previousSibling.previousSibling).addClass('mouseOn');
	});
	/* Affichage de la structure If Else */
	$('#ifElse').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
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





	/* Instrcution Affichage */
	$('#afficher').on('click', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<input type="text" name="instruction" class="afficher" placeholder="Afficher ...">');
		formatageProgramme();
	});

	/* Instruction Calcul */
	$('#calcul').on('click', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<input type="text" name="instruction" class="calcul" placeholder="Caluler ...">');
		formatageProgramme();
	});

	/* Instruction Lire */
	$('#lire').on('click', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<input type="text" name="instruction" class="lire" placeholder="Lire ...">');
		formatageProgramme();
	});


	/* Affichage d'une condition */
	$('#condition').on('click', function(){
			$(elementSelect).before('<button class="plus">+</button>');
			$(elementSelect).before('<input type="text" name="condition" placeholder="Si ...">');
		
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
			if(valeurForm.elements[i].className != "plus")
			{
				test += valeurForm.elements[i].className.toUpperCase()+' '+valeurForm.elements[i].value;
				if(i < valeurForm.length-2)
				{
					test += '#';
				}
			}
		}
		$('#data').val(test);
	});
}