<?php 
	if (array_key_exists('ajax', $_POST)) {

		print_r($_POST['ajax']);
	}
	else {
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Título</title>
	</head>
	<body>


	<ul id="lista">
	  <li>list item 1</li>
	  <img src="#">
	  <li>list item 2</li>
	  <li class="third-item">list item 3</li>
	  <li>list item 4</li>
	  <li>list item 5</li>
	</ul>

	<button id="enviar">Enviar</button>

	</body>
	<script type="text/javascript" src="scripts/jquery.min.js"></script>
	<script type="text/javascript" src="scripts/coffee-script.js"></script>
	<script type="text/coffeescript" src="scripts/app.coffee"></script>
</html>

<?php 
	} // FIm do callbak
?>
