$(init);

function init(){

	/* Focus du title */
	$('#title').on('focus', function(){
		if(this.value == 'Nom du programme ?')
		{
			this.value = '';
		}
	});
	$('#title').on('blur', function(){
		if(this.value.match(/^ *$/))
		{
			this.value = 'Nom du programme ?';
		}
	});

	/* CSS des checkbox */
	$('label').on('click', function(){
		var checkbox = this.nextSibling.nextSibling;
		if(checkbox.checked == false)
		{
			checkbox.checked = true;
			this.style.color = '#00CED1';
		}else
		{
			checkbox.checked = false;
			this.style.color = '#555';
		}
	});

	$('.checkbox').on('mouseenter', function(){
		this.previousSibling.previousSibling.style.color = "#00CED1";
	});
	$('.checkbox').on('mouseleave', function(){
		if(this.checked == true){
			this.previousSibling.previousSibling.style.color = "#00CED1";
		}else{
			this.previousSibling.previousSibling.style.color = "#555";
		}
	});
	$('label').on('mouseenter', function(){
		this.style.color = "#00CED1";
	});
	$('label').on('mouseleave', function(){
		if(this.nextSibling.nextSibling.checked == true){
			this.style.color = "#00CED1";
		}else{
			this.style.color = "#555";
		}
	});
}