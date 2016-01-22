<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['settings']['wwwroot'];?>/vendor/bootstrap/css/bootstrap.min.css">
	</head>

	<body>
	<code></code>
	<div class="container jumbotrom">
		<br>
		<br>
		<br>
		<div class="form-horizontal" data-app-ctrl='{"login":{"login":true, "user":"#loginuser", "password":"#loginpassword", "start":"#login", "remember":"#remember"}}'>

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label " for="loginuser"></label>
				<div class="col-md-4">
					<input id="loginuser" name="loginuser" type="text" placeholder="seu@email.com" class="form-control input-md" required="" value="fernando.fte@gmail.com">
				</div>
			</div>

			<!-- Password input-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="loginpassword"></label>
				<div class="col-md-4">
					<input id="loginpassword" name="loginpassword" type="password" placeholder="Senha" class="form-control input-md" required="" value="master753">
				</div>
			</div>

			<!-- Remember -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="remember"></label>
				<div class="col-md-4">
					<label class="checkbox-inline" for="remember">
						<input type="checkbox" name="remember" id="remember" value="remember"> Continuar logado
					</label>
				</div>
			</div>

			<!-- Button -->
			<div class="form-group">
				<label class="col-md-4 control-label" for="login"></label>
				<div class="col-md-4">
					<span id="login" name="login" class="btn btn-success">Entrar</span>
				</div>
			</div>
		</div>

	</div>


	<!-- Import Scripts -->
	<script src="<?php echo $GLOBALS['settings']['wwwroot'];?>vendor/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $GLOBALS['settings']['wwwroot'];?>/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo $GLOBALS['settings']['wwwroot'];?>vendor/js/coffee-script.js" type="text/javascript"></script>
	<script src="<?php echo $GLOBALS['settings']['wwwroot'];?>vendor/js/phpjs.js" type="text/javascript"></script>
	<script src="scripts/app.coffee" type="text/coffeescript"></script>
	</body>
</html>