$(init);
var n = 0;
var liste = [];
var write = false;
var wait = false;
var input;
var input_value = 0;
var count_td = 0;


function init(){
	run_instruction();
	$('td.input').on('click', function(){
		var value = $(this).attr('id');
		if(value == "AC"){
			instruction("Stop");
			return false;
		}
		if(value == "EXE" && wait){
			wait = false;
			run_instruction();
			return false;
		}
		if(write){
			if(value == "DEL"){
				if(input_value.length == 1 || input_value == 0)
					input_value=0;
				else
					input_value = input_value.substr(0, input_value.length-1);
				$("#a"+(count_td+1)).text(parseFloat(input_value));
				return false;
			}
			if(value == "EXE" && input_value!=0){
				write = false;
				window[input] = parseFloat(input_value);
				ecran(input_value);
				input_value = 0;
				run_instruction();
				return false;
			}
			if(input_value==0 && value!="POINT")
				input_value = value;
			else if(value=="POINT" && parseFloat(input_value) == parseInt(input_value))
				input_value = input_value + ".";
			else if(value!="POINT")
				input_value = input_value + value;
			
			(count_td==0)?ecran(parseFloat(input_value)):count_td;
			$("#a"+(count_td+1)).text(parseFloat(input_value));
		}
	});
}
function ecran(value){
	$(check_td()).text(value);
}
function run_instruction(){
	if(liste.length==0){
		for (var i = n; i < liste_instruction.length; i++) {
			if(!(write || wait)){
				fn = window[liste_instruction[i]['fonction']];
				fn(liste_instruction[i]['params']);
				n++;
			}else{
				break;
			}
		};
	}
}
function check_td(){
	count_td++;
	if(count_td == 1){
		$('.ligne').text("");
		return "#a1";
	}
	if(count_td == 7){
		count_td=0;
		return "#a7";
	}
	return "#a"+count_td;
}


function afficher(params){
	if(typeof params['text'] != 'undefined'){
		for (var i = 0; i < params['text'].length; i+=21)
			ecran(params['text'].substr(i, 21));
	}
	if(typeof params['var'] != 'undefined'){
		var value = 0;
		console.log(window[params['var']]);
		if(typeof window[params['var']] != 'undefined')
			value = window[params['var']];
		ecran(value);
		wait = true;
	}
	return true;
}

function lire(params){
	write =true;
	input = params['var'];
	if(typeof params['text'] != 'undefined'){
		params['text'] = params['text'] + "?";
		for (var i = 0; i < params['text'].length; i+=21)
			ecran(params['text'].substr(i, 21));
	}else
		ecran("?");
	return true;
}

function instruction(params){
	switch(params){
		case "Clrtxt":
			$('.ligne').text("");
			count_td=0;
		break;
		case "Stop":
			$('.ligne').text("");
			$("#a1").addClass('right');
			$("#a1").text('Done');
			$("#EXE").hide();
			$("#DEL").hide();
			$("#AC").hide();
			$("#POINT").hide();
			for (var i = 0; i < 10; i++) {
				$("#"+i).hide();
			};
			$("#POINT").hide();
		break;
	}
}
function calcul(params) { 
	var calcul = params['calcul'];
	for (var i = 0; i < params['calcul'].length; i++) {
		if (/[A-Z]/.test(params['calcul'][i])){
			calcul = calcul.replace(params['calcul'][i], window[params['calcul'][i]]);
		}
	};
	window[params['var']] = calc(calcul);
}


function calc(calcul) {
  return new Function('return ' + calcul)();
}
/*function init_old(){
//	run_instruction(liste_instruction[0]);
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
  //while(window[condition[0]] == parseFloat(condition[1])){
//	listeif = params['if']['instruction'];	
 // }
  //si_max = listeif.length;
  //run_instruction();
}*/