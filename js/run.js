$(init);
var n = 0;
var input;
var si=-1;
var si_max;
var listeif;
var n_instruction = liste_instruction.length;
function init(){
	run_instruction(liste_instruction[0]);
	$('#next').on('click', function(){
		run_instruction();
		return false;
	});
	$('#send').on('click', function(){
		var value = $('#input').val();
		if($.isNumeric(value)){
			$("#text-console").append(value + "<br />");
			window[input] = parseFloat(value);
			run_instruction();
		}
		return false;
	});
}

function run_instruction(){
	var k;
	var liste = liste_instruction;
	if(si == -1){
		k=n;
	}else{
		k=si;
		liste = listeif;
	}
	console.log(k);
	if(liste[k]['fonction'] != "set"){
		console.log(liste);
		console.log(liste[k]['fonction']);
		console.log(liste[k]['params']);
		fn = window[liste[k]['fonction']];
		fn(liste[k]['params']);
	}else{
		set();
	}
	if(si ==-1){
		n++;
	}else{
		si++;
	}
	if(n_instruction == n){
		$("#text-console").append("Execution terminée");
		instruction("Stop");
	}
	if(si_max == si){
		listeif = null;
		si = -1;
		si_max = 0;
		run_instruction();
	}
}

function afficher(params){
	set();
	if(typeof params['text'] != 'undefined'){
		$("#text-console").append(params['text'] + "<br />");
		return false;
	}
	if(typeof params['var'] != 'undefined'){
		$("#text-console").append(window[params['var']] + "<br />");
		return false;
	}		
}

function instruction(params){
	set();
	switch(params){
		case "Clrtxt":
			$("#text-console").empty();
		break;
		case "Stop":
			$("#next").hide();
			$("#input").hide();
			$("#send").hide();
		break;
	}
}

function lire(params){
	set(true);
	input = params['var'];
	$("#text-console").append("> ");
}

function calcul(params) { 
	set();
	var calcul = params['calcul'];
	for (var i = 0; i < params['calcul'].length; i++) {
		if (/[A-Z]/.test(params['calcul'][i])){
			calcul = calcul.replace(params['calcul'][i], window[params['calcul'][i]]);
		}
	};
	window[params['var']] = calc(calcul);
}

function set(write){
	if(write){
		$("#next").hide();
		$("#input").show();
		$("#send").show();
	}else{
		$("#input").hide();
		$("#send").hide();
		$("#next").show();
	}
}


function calc(calcul) {
  return new Function('return ' + calcul)();
}

function ifelse(params) {
  var condition = params['if']['condition'].split("=");
  si = 0;
  n++;
  if(window[condition[0]] == parseFloat(condition[1])){
	listeif = params['if']['instruction'];	
  }else{
  	listeif = params['else'];
  }
  si_max = listeif.length;
  run_instruction();
}

function bouclewhile(params) {
  //var condition = params['condition'].split("==");
  //si = 0;
 // n++;
  /*while(window[condition[0]] == parseFloat(condition[1])){
	listeif = params['if']['instruction'];	
  }
  si_max = listeif.length;
  run_instruction();*/
}