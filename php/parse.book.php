<?php ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['settings']['wwwroot'];?>/vendor/bootstrap/css/bootstrap.min.css">
	</head>

	<body>

	<div id="parse">
		<!-- Adiciona book.html -->
		<?php include 'temp/book.html'; ?>
	</div>
	<textarea style="margin-top:10%; height: 500px" id="done" class="form-control"></textarea>

	<!-- Import Scripts -->
	<script src="<?php echo $GLOBALS['settings']['wwwroot'];?>vendor/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $GLOBALS['settings']['wwwroot'];?>vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo $GLOBALS['settings']['wwwroot'];?>vendor/js/coffee-script.js" type="text/javascript"></script>
	<script src="<?php echo $GLOBALS['settings']['wwwroot'];?>vendor/js/phpjs.js" type="text/javascript"></script>
	<script src="php/scripts/parse.coffee" type="text/coffeescript"></script>
	</body>
</html>
