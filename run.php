<?php
/* Appel des fonction de developement */
require "fonctionsdev.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Run Console Test</title>
</head>
<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script type="text/javascript">
	//itemActions = { click: clickedOnItem, rightClick: rightClickedOnItem /* etc */ };
	var instruction = 0;
	var input = "";
	<?php  $test =array(
					array('fonction' => 'lire', 
						  'params' => array('var' => 'B')
					),
					array('fonction' => 'afficher', 
						  'params' => array('text' => '1er instruction')
					),
					array('fonction' => 'afficher', 
						  'params' => array('text' => 'test')
					),
					array('fonction' => 'afficher', 
						  'params' => array('text' => 'instruction')
					),
					array('fonction' => 'lire', 
						  'params' => array('var' => 'A')
					),
					array('fonction' => 'afficher', 
						  'params' => array('var' => 'A')
					)
				);
		echo "var liste_instruction = ".json_encode($test).";";
		?>
	var A = 0;
	var B = 0;
	var C = 0;
</script>
<script type="text/javascript" src="js/run.js"></script>
<script type="text/javascript" src="test.php"></script>
<body>
	<div class="console">
		<p id="text-console"></p>
	</div>
	<div class="input">
		<form>
			<input type="number" id="input">
			<button id="send">Send</button>
		</form>
		<button id="next">Next</button>
	</div>
</body>
</html>