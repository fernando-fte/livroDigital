<?php 
	include 'admin/._.config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title></title>

		<!-- STYLE Bootstrap: Bootstrap LESS -->
		<link rel="stylesheet/less" href="<?php echo $settings['wwwroot']?>/style/bootstrap.less">

		<!-- STYLE app: app LESS -->
		<link rel="stylesheet/less" href="<?php echo $settings['wwwroot']?>/style/app.less">

		<!-- VENDOR CSS: Fontawesome -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> -->

		<!-- <link rel="stylesheet" href="animate.css"> -->

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<div class="container">
			<?php 
				if (array_key_exists('page', $get)) {

					if (array_key_exists($get['page'], $settings['pages'])) { include 'estrutura/'.$settings['pages'][$get['page']]; }
					else { echo 'A pagina '.$get['page'].'não foi declarada'; }
				}
			?>
		</div>

		<!-- VENDOR: jQuery -->
		<script src="<?php echo $settings['wwwroot']?>/vendor/js/jquery.min.js"></script>

		<!-- VENDOR: Latest compiled and minified Bootstrap JavaScript -->
		<script src="<?php echo $settings['wwwroot']?>/vendor/bootstrap/js/bootstrap.min.js"></script>

		<!-- VENDOR: CoffeeScript -->
		<script src="http://coffeescript.org/extras/coffee-script.js"></script>

		<!-- VENDOR: CSS Less-->
		<script src="<?php echo $settings['wwwroot']?>/vendor/js/less.min.js"></script>

		<!-- APP: CoffeeScript 
		<script type="text/coffeescript" src="scripts/default.coffee"></script>
		-->

	</body>
</html>
