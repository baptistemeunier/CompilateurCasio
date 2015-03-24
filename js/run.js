/**
 * Fichier JS run.js
 *
 * Permet de simuler la calculette
 *
 * @author Baptiste Meunier baptiste.meunier0@gmail.com
 * @version 0.6.0--alpha
 **/

$(init);
var td = 0;
var n = 0;
var input = "";
var input_value_prev = "";
var input_value = "";
var si=-1;
var si_max;
var listeif;
var n_instruction = liste_instruction.length;
function init(){
	run_instruction(liste_instruction[0]);
	$('#EXE').on('click', function(){
		if(input != ''){
			window[input] = parseFloat(input_value);
			input = '';
		}
		if(td>5){
			$("#"+ calc(td-6)).remove();
		}
		run_instruction();
		return false;
	});
	$('td').on('click', function(){
		var value = $(this).attr('id');
		if(value == "S"){
			instruction("Stop");
			return false
		}
		if(value == "EXE" || input == '')
			return false;
		if(value == "D"){
			$("#"+ calc(td)).empty();
			$("#EXE").hide();
			input_value = "0";
			return false;
		}
		$("#EXE").show();
		if(input_value == ""){
			input_value = value;
			if(td>5){
				$("#"+ calc(td-5)).remove();
			}
			$("#text-console").append("<tr><td id="+ calc(td) +">" + input_value + "</td></tr>");
			return false;
		}else{
			input_value = input_value + value;
			$("#"+ calc(td)).append(value);
			$("#EXE").show();
		}
		return false;
	});
}
function run_instruction(){
	if(n_instruction == n){
		$("#text-console").append("Execution terminée");
		instruction("Stop");
	}
	td++;
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
		$("#text-console").append("<tr><td id="+ td +'>' + params['text'] + "</td></tr>");
		return false;
	}
	if(typeof params['var'] != 'undefined'){
		$("#text-console").append("<tr><td id="+ td +">" + window[params['var']] + "</td></tr>");
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
			$("#EXE").hide();
			$("#text-console").text('                 Done');
		break;
	}
}

function lire(params){
	set(true);
	input = params['var'];
	$("#text-console").append("<tr><td id="+ td +">?</td></tr>");
	td++;
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
		$("#EXE").hide();
		$("#input").show();
		$("#send").show();
	}else{
		$("#input").hide();
		$("#send").hide();
		$("#EXE").show();
	}
}


function calc(calcul) {
  return new Function('return ' + calcul)();
}

function ifelse(params) {
	var conditions = params['conditions'];
	if(typeof conditions['si'] != "undefined"){
		console.log(conditions);
		for (var i = 0; i < conditions.length; i++) {

			console.log(conditions[i]);
		};
	}
  /*
  si = 0;
  n++;
  if(window[condition[0]] == parseFloat(condition[1])){
	listeif = params['if']['instruction'];	
  }else{
  	listeif = params['else'];
  }
  si_max = listeif.length;
  run_instruction();
  */
}

function bouclewhile(params) {

}