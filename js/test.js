/* $(init);

function init(){
	// Mise en forme du text pour la condition if 
	$('#ifElseButton').on('click', function(e){
		e.preventDefault(); // annule l'action pas défault (le clic sur un bouton peut recharger la page)
		// On créer la ligne du if 
		$('#programme').append('<div id="ifThenElse"></div>');
		$('#ifThenElse').append('<p id="si"></p>');
		$('#si').append('Si<br /><textarea class="if" rows="1" cols="30"></textarea><br />');
		$('#si').append('<button id="condition">+ 1 condition</button><br />Fin Si');
		$('#condition').on('click', function(ev){
			ev.preventDefault;
			$(this).before('<textarea class="if" rows="1" cols="30"></textarea><button class="delete">X</button><br />');
			$('.delete').on('click', function(eve){
				eve.preventDefault;
				$(this).prev().remove();
				$(this).next().remove();
				$(this).remove();
			});
		});
		// On créer la/les lignes du then 
		$('#ifThenElse').append('<p id="alors"></p>');
		$('#alors').append('Alors<br /><textarea class="then" rows="1" cols="30"></textarea><button class="delete">X</button><br />');
		$('#alors').append('<button id="instruction1">+ 1 instruction</button><br />Fin Alors');
		$('#instruction1').on('click', function(ev){
			ev.preventDefault;
			$(this).before('<textarea class="then" rows="1" cols="30"></textarea><button class="delete">X</button><br />');
			$('.delete').on('click', function(eve){
				eve.preventDefault;
				$(this).prev().remove();
				$(this).next().remove();
				$(this).remove();
			});
		});
		// On créer la/les lignes du else 
		$('#ifThenElse').append('<p id="sinon"></>');
		$('#sinon').append('Sinon<br /><textarea class="else" rows="1" cols="30"></textarea><button class="delete">X</button><br />');
		$('#sinon').append('<button id="instruction2">+ 1 instruction</button><br />Fin Sinon');
		$('#instruction2').on('click', function(ev){
			ev.preventDefault;
			$(this).before('<textarea class="else" rows="1" cols="30"></textarea><button class="delete">X</button><br />');
			$('.delete').on('click', function(eve){
				eve.preventDefault;
				$(this).prev().remove();
				$(this).next().remove();
				$(this).remove();
			});
		});
		//Bouton pour valider ou annuler
		$('#ifThenElse').append('<button id="valider">Valider</button>');
		$('#ifThenElse').append('<button id="annuler">Annuler</button>');
		$('#annuler').on('click', function(){
			$(this).parent().remove();
			$('#ifElseButton').prop('disabled', false);
		});
		$('#ifElseButton').prop('disabled', true);
		$('.delete').on('click', function(eve){
				eve.preventDefault;
				$(this).prev().remove();
				$(this).next().remove();
				$(this).remove();
			});
	});		
}

function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    '"': '&quot;',
    "'": '&#039;'
  };

}
*/

$(conditionSi);

function conditionSi(){
	$('#si').on('focus', function(){
		var valeur = this.value;
		if(valeur.match(/^Si +([a-zA-Z]+|[0-9]+) *(<|>|==|<=|>=|!=) *([a-zA-Z]+|[0-9]+) *$/) || valeur.match(/^Si +(".+"|[a-zA-Z]+) *(==|!=) *(".+"|[a-zA-Z]+) *$/)){
			this.value = valeur.slice(3);
			this.style.boxShadow = '0 0 15px lime';
		}
	});
	$('#si').on('keyup', function(){
		var valeur = this.value;
		if(valeur.match(/^ *([a-zA-Z]+|[0-9]+) *(<|>|==|<=|>=|!=) *([a-zA-Z]+|[0-9]+) *$/) || valeur.match(/^ *(".+"|[a-zA-Z]+) *(==|!=) *(".+"|[a-zA-Z]+) *$/)){
			this.style.boxShadow = '0 0 15px lime';
		}else{
			this.style.boxShadow = '0 0 15px red';
		}
	});
	$('#si').on('blur', function(){
		var valeur = this.value;
		if(valeur.match(/^ *([a-zA-Z]+|[0-9]+) *(<|>|==|<=|>=|!=) *([a-zA-Z]+|[0-9]+) *$/) || valeur.match(/^ *(".+"|[a-zA-Z]+) *(==|!=) *(".+"|[a-zA-Z]+) *$/)){
			this.style.boxShadow = '0 0 0 white';
			this.value = 'Si '+valeur;
		}else{
			this.style.boxShadow = '0 0 15px red';
		}
	});
}