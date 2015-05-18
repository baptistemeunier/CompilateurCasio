$(init);

/* Fonction qui initilise le programme */
function init(){


	hideHelps();

	/* Initialisation de la page */
	$('#condition').hide();
	elementSelect = $('.plus').get(0);

	/* Initialisation des fonctions */
	ifThenElse();
	whileDo();
	forDo();
	instructionShow();
	calcul();
	read();
	condition();
	set();
	clearTxt();
	deleteElement();


	$('.plus').on('click', function(){
		if(this.parentNode.className == 'if' || this.parentNode.className == 'while'){
			hideButtons();
			$('#condition').show();
		}else{
			hideButtons();
			showButtons();
		}
		return false;
	});

	/* On enlève le menu lorsqu'un élément a été sélectionné */
	$('#navLeft button').on('click', function(){
		hideButtons();
	});
}


/* Fonction global qui affiche la structure IfThenElse */
function ifThenElse(){
	$('#ifElse').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<div class="ifThenElse"></div>');
			$(elementSelect.previousSibling).append('<div class="if"></div>');
				$(elementSelect.previousSibling.firstChild).append('<h3>Si</h3>');
				$(elementSelect.previousSibling.firstChild).append('<input type="text" name="condition" class="si" placeholder="Si ...">');
				$(elementSelect.previousSibling.firstChild).append('<button class="plus">+</button>');
				$(elementSelect.previousSibling.firstChild).append('<button class="deleteCond">X</button>');
			$(elementSelect.previousSibling).append('<div class="then"></div>');
				$(elementSelect.previousSibling.lastChild).append('<h3>Alors</h3>');
				$(elementSelect.previousSibling.lastChild).append('<button class="plus">+</button>');
			$(elementSelect.previousSibling).append('<div class="else"></div>');
				$(elementSelect.previousSibling.lastChild).append('<h3>Sinon</h3>');
				$(elementSelect.previousSibling.lastChild).append('<button class="plus">+</button>');
		$(elementSelect.previousSibling).addClass('mouseOn');
		$('#aideIf').show();
	});
	/* Affichage de la structure If Else Then sur un click */
	$('#ifElse').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		$(elementSelect.previousSibling).css("width", "auto");
		elementSelect = "cliquer";
		formatageProgramme();
		deleteElement();
	});
	/* Efface la structure If Else si le bouton n'a pas été activé */
	$('#ifElse').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
		getElement();
		$('#aideIf').hide();
	});
}

/* Fonction global qui affiche la strucutre while */
function whileDo(){
	$('#while').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<div class="whileDo"></div>');
			$(elementSelect.previousSibling).append('<div class="while"></div>');
				$(elementSelect.previousSibling.firstChild).append('<h3>Tant que</h3>');
				$(elementSelect.previousSibling.firstChild).append('<input type="text" name="condition" class="tantque" placeholder="Tant que">');
				$(elementSelect.previousSibling.firstChild).append('<button class="plus">+</button>');
				$(elementSelect.previousSibling.firstChild).append('<button class="deleteCond">X</button>');
			$(elementSelect.previousSibling).append('<div class="do"></div>');
				$(elementSelect.previousSibling.lastChild).append('<h3>Faire</h3>');
				$(elementSelect.previousSibling.lastChild).append('<button class="plus">+</button>');
		$(elementSelect.previousSibling).addClass('mouseOn');
		$('#aideWhile').show();
	});
	/* Affichage de la structure While sur un click */
	$('#while').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
		deleteElement();
	});
	/* Efface la structure While si le bouton n'a pas été activé */
	$('#while').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
		getElement();
		$('#aideWhile').hide();
	});
}

function forDo(){
	$('#for').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<div class="for"></div>');
		$(elementSelect.previousSibling).append('<h3>Pour i allant de</h3>');
		$(elementSelect.previousSibling).append('<input type="number" class="de" name="#">');
		$(elementSelect.previousSibling).append('<h3>a</h3>');
		$(elementSelect.previousSibling).append('<input type="number" class="a" name="#">');
		$(elementSelect).before('<div class="do"></div>');
		$(elementSelect.previousSibling).append('<h3>Faire</h3>');
		$(elementSelect.previousSibling).append('<button class="plus">+</button>');
		$(elementSelect.previousSibling).addClass('mouseOn');
		$(elementSelect.previousSibling.previousSibling).addClass('mouseOn');
		$('#aideFor').show();
	});
	/* Affichage de la structure For sur un click */
	$('#for').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		$(elementSelect.previousSibling.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
		deleteElement();
	});
	/* Efface la structure For si le bouton n'a pas été activé */
	$('#for').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
		getElement();
		$('#aideFor').hide();
	});
}

function instructionShow(){
	/* Afficher l'instruction Affichage sur un passage de la souris */
	$('#afficher').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<input type="text" name="instruction" class="afficher" placeholder="Afficher ...">');
		$(elementSelect.previousSibling).before('<button class="deleteInst">X</button>');
		$(elementSelect.previousSibling).addClass('mouseOn');
		$('#aideAfficher').show();
	});
	/* Affichage de l'instrcution Affichage sur un click */
	$('#afficher').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
		deleteElement();
	});
	/* Efface l'instruction Affichage si le bouton n'a pas été activé */
	$('#afficher').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
		getElement();
		$('#aideAfficher').hide();
	});
}

function calcul(){
	/* Afficher l'instruction Calcul sur un passage de la souris */
	$('#calcul').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<input type="text" name="instruction" class="calcul" placeholder="Caluler ...">');
		$(elementSelect.previousSibling).before('<button class="deleteInst">X</button>');
		$(elementSelect.previousSibling).addClass('mouseOn');
		$('#aideCalcul').show();
	});
	/* Affichage de l'instrcution Calcul sur un click */
	$('#calcul').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
		deleteElement();
	});
	/* Efface l'instruction Calcul si le bouton n'a pas été activé */
	$('#calcul').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
		getElement();
		$('#aideCalcul').hide();
	});
}

function read(){
	var alphabet = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

	/* Afficher l'instruction Lire sur un passage de la souris */
	$('#lire').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<select name="instruction" class="lire"></select>');
		for(var i=0; i<alphabet.length; i++)
		{
			$(elementSelect.previousSibling).append('<option value="'+alphabet[i]+'">Lire '+alphabet[i]+'</option>');
		}
		$(elementSelect.previousSibling).before('<button class="deleteInst">X</button>');
		$(elementSelect.previousSibling).addClass('mouseOn');
		$('#aideLire').show();
	});
	/* Affichage de l'instrcution Lire sur un click */
	$('#lire').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
		deleteElement();
	});
	/* Efface l'instruction Lire si le bouton n'a pas été activé */
	$('#lire').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
		getElement();
		$('#aideLire').hide();
	});
}

function condition(){
	/* Afficher l'instruction Condition sur un passage de la souris */
	$('#condition').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<input type="text" name="condition" placeholder="Si ...">');
		$(elementSelect.previousSibling).before('<button class="deleteInst">X</button>');
		$(elementSelect.previousSibling).addClass('mouseOn');
		$('#aideCondition').show();
	});
	/* Affichage de l'instrcution Condition sur un click */
	$('#condition').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		conditionSi();
		formatageProgramme();
		deleteElement();
	});
	/* Efface l'instruction Condition si le bouton n'a pas été activé */
	$('#condition').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
		getElement();
		$('#aideCondition').hide();
	});
}

function clearTxt(){
	/* Afficher la fonction ClearText sur un passage de la souris */
	$('#clearText').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<p>ClearText</p>');
		$(elementSelect).before('<input type="hidden" name="condition" value="CLRTXT">');
		$(elementSelect.previousSibling.previousSibling).before('<button class="deleteInst">X</button>');
		$(elementSelect.previousSibling.previousSibling).addClass('mouseOn');
		$('#aideClearText').show();
	});
	/* Affichage de la fonction ClearText sur un click */
	$('#clearText').on('click', function(){
		$(elementSelect.previousSibling.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
		deleteElement();
	});
	/* Efface la fonction ClearText si le bouton n'a pas été activé */
	$('#clearText').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
		getElement();
		$('#aideClearText').hide();
	});
}

function set(){
	/* Afficher la fonction Set sur un passage de la souris */
	$('#set').on('mouseenter', function(){
		$(elementSelect).before('<button class="plus">+</button>');
		$(elementSelect).before('<select name="set" class="set"></select>');
		$(elementSelect.previousSibling).append('<option value="DEG">degres</option>');
		$(elementSelect.previousSibling).append('<option value="RAD">radian</option>');
		$(elementSelect.previousSibling).before('<button class="deleteInst">X</button>');
		$(elementSelect.previousSibling).addClass('mouseOn');
		$('#aideSet').show();
	});
	/* Affichage de la fonction Set sur un click */
	$('#set').on('click', function(){
		$(elementSelect.previousSibling).removeClass('mouseOn');
		elementSelect = "cliquer";
		formatageProgramme();
		deleteElement();
	});
	/* Efface la fonction Set si le bouton n'a pas été activé */
	$('#set').on('mouseleave', function(){
		if(elementSelect != "cliquer"){
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
			$(elementSelect.previousSibling).remove();
		}
		getElement();
		$('#aideSet').hide();
	});
}

/* Fonction pour masquer tout les buttons */
function hideButtons(){
	$('#clearText').hide();
	$('#label').hide();
	$('#goTo').hide();
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
	$('#label').show();
	$('#goTo').show();
	$('#set').show();
	$('#afficher').show();
	$('#calcul').show();
	$('#lire').show();
	$('#ifElse').show();
	$('#while').show();
	$('#for').show();
}

/* Fonction pour masquer toutes les aides */
function hideHelps(){
	$('#aideCondition').hide();
	$('#aideClearText').hide();
	$('#aideLabel').hide();
	$('#aideGoTo').hide();
	$('#aideSet').hide();
	$('#aideAfficher').hide();
	$('#aideCalcul').hide();
	$('#aideLire').hide();
	$('#aideIf').hide();
	$('#aideWhile').hide();
	$('#aideFor').hide();
}

/* Evenement du bouton "plus" */
function getElement(){
	$('.plus').on('click', function(){
		if(this.parentNode.className == 'if' || this.parentNode.className == 'while'){
			hideButtons();
			$('#condition').show();
		}else{
			hideButtons();
			showButtons();
		}
		elementSelect = this;
		return false;
	});
}

function validateForm(){
	if(document.forms["form"]["data"].value == '' || document.forms["form"]["data"].value == NULL){
		alert("Votre programme est vide !!!");
		return false;
	}else {
		return true;
	}
}

function formatageProgramme(){
	$('input').on('keyup', function(){
		var test = "";
		var valeurForm = document.getElementById('formulaire');
		for(var i=0; i<valeurForm.length; i++)
		{
			if(	valeurForm.elements[i].className != "plus" && valeurForm.elements[i].id != "data" && valeurForm.elements[i].id != "title" &&
				valeurForm.elements[i].className != "checkbox" && valeurForm.elements[i].className != "delete" && valeurForm.elements[i].className != "deleteInst" && valeurForm.elements[i].className != "deleteCond")
			{
				test += valeurForm.elements[i].className.toUpperCase()
				if(valeurForm.elements[i].value != "CLRTXT") test += ' ';
				test += valeurForm.elements[i].value;
				if(i < valeurForm.length-7)
				{
					if(	valeurForm.elements[i].parentNode.className == "if" || valeurForm.elements[i].parentNode.className == "then" ||
						valeurForm.elements[i].parentNode.className == "else")
					{
						test += '~';
					}else
					{
						test += '#';
					}
				}
			}
		}
		$('#data').val(test);
	});
}

function deleteElement(){

	/* Fonction pour supprimer les instructions à conditions */
	$('.deleteCond').mouseenter(function(){
		this.style.backgroundColor = "rgba(250,0,0,0.0.6)";
		this.parentNode.parentNode.style.backgroundColor = "rgba(250,0,0,0.6)";
	});
	$('.deleteCond').mouseleave(function(){
		this.style.backgroundColor = "rgba(0,0,0,0)";
		this.parentNode.parentNode.style.backgroundColor = "rgba(0,0,0,0)";
	});
	$('.deleteCond').on('click', function(){
		this.parentNode.parentNode.previousSibling.remove();
		this.parentNode.parentNode.remove();
	});

	/* Fonction pour supprimer les instructions seules */
	$('.deleteInst').on('click', function(){
		this.nextSibling.remove();
		this.previousSibling.remove();
		this.remove();
	});
}