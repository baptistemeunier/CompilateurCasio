$(init);
var n = 0;
var input;
var n_instruction = liste_instruction.length;
function init(){
	run_instruction();
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
	if(liste_instruction[n]['fonction'] != "set"){
		fn = window[liste_instruction[n]['fonction']];
		fn(liste_instruction[n]['params']);
	}else{
		set();
	}
	n++;
	if(n_instruction == n){
		$("#text-console").append("Execution terminée");
		instruction("Stop");
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