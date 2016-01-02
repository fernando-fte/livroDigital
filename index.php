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


	<?php 
		if (array_key_exists('page', $get)) {

			if (array_key_exists($get['page'], $settings['pages'])) { include 'estrutura/'.$settings['pages'][$get['page']]; }
			else { echo 'A pagina '.$get['page'].'não foi declarada'; }
		}
	?>


		<!-- VENDOR: jQuery -->
		<script src="<?php echo $settings['wwwroot']?>/vendor/js/jquery.min.js"></script>

		<!-- VENDOR: ScollBar -->
		<script src="<?php echo $settings['wwwroot']?>/vendor/js/perfect-scrollbar.min.js"></script>
		<script type="text/javascript">
			function changeSize() {
				var width = parseInt($("#Width").val());
				var height = parseInt($("#Height").val());

				$(".add-scroll").width(width).height(height);

				// update scrollbars
				$('.add-scroll').perfectScrollbar('update');

				// or even with vanilla JS!
				Ps.update(document.getElementById('add-scroll'));
			}

			$(function() {
				$('.add-scroll').perfectScrollbar();

				// with vanilla JS!
				Ps.initialize(document.getElementById('add-scroll'));
			});
		</script>


		<!-- VENDOR: Latest compiled and minified Bootstrap JavaScript -->
		<script src="<?php echo $settings['wwwroot']?>/vendor/bootstrap/js/bootstrap.min.js"></script>


		<!-- VENDOR: http://seiyria.com/bootstrap-slider/ Bootstrap Slider -->
		<script src="<?php echo $settings['wwwroot']?>/vendor/bootstrap/js/bootstrap.slider.min.js"></script>
		<script type="text/javascript">
			// Adiciona slider na barra do menu
			$('#app-nav-light-density').slider({ formatter: function(value) { return 'Densidade da luz: ' + value; } });
		</script>

		<!-- VENDOR: CoffeeScript -->
		<script src="http://coffeescript.org/extras/coffee-script.js"></script>

		<!-- VENDOR: CSS Less-->
		<script src="<?php echo $settings['wwwroot']?>/vendor/js/less.min.js"></script>

		<!-- APP: CoffeeScript 
		<script type="text/coffeescript" src="scripts/default.coffee"></script>
		-->
	</body>
</html>
