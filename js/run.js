$(init);
var n = 0;
var input;
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
	console.log(liste_instruction[n]['fonction']);
	fn = window[liste_instruction[n]['fonction']];
	fn(liste_instruction[n]['params']);	
	n++;
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