
$(init);
function init(){
	run_instruction();
	//console.log(liste_instruction);
	//console.log(instruction);
	$('#next').on('click', function(){
		run_instruction();
	});
	$('#send').on('click', function(){
		var value = $('#input').val();
		if($.isNumeric(value)){
			window[input] = parseFloat(value);
			console.log(window[input]);
			run_instruction();
		}
		return false;
	});
}
function run_instruction(){
	fn = window[liste_instruction[instruction]['fonction']];
	fn(liste_instruction[instruction]['params']);
	instruction++;
}
function afficher(params){
	$("#input").hide();
	$("#send").hide();
	$("#next").show();
	if(typeof params['text'] != 'undefined'){
		$("#text-console").append(params['text'] + "<br />");
		return false;
	}
	if(typeof params['var'] != 'undefined'){
		$("#text-console").append(window[params['var']] + "<br />");
		return false;
	}		
}
function lire(params){
	$("#next").hide();
	$("#input").show();
	$("#send").show();		
	input = params['var'];
}