<?php
/* Appel des fonction de developement */
require "fonctionsdev.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Run Console Test</title>
	<meta charset="UTF-8">
</head>
<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<?php require "jsonrun.php"; ?>
<script type="text/javascript" src="js/run.js"></script>
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