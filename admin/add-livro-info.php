<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title></title>

		<!-- VENDOR less: Bootstrap LESS -->
		<link rel="stylesheet" href="http://localhost/vg/livroDigital/assets/vendor/bootstrap/css/bootstrap.css">

		<!-- VENDOR: Bootstrap LESS -->
		<!-- <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css"> -->

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
			<form class="form-horizontal">
				<fieldset>

					<!-- Form Name -->
					<legend>Informações do livro</legend>

					<input id="action" type="hidden" name="_settings[action]" value='insert'>

					<input type="hidden" name="_settings[select][sku][._.action]" value='{"type":"sku"}'>
					<input type="hidden" name="_settings[select][segmento][._.action]" value='{"type":"md5", "values":["segmento", "grupo"]}'>
					<input type="hidden" name="_settings[select][grupo][._.action]" value='{"type":"relative", "values":[{"autor":{"nome":null}}]}'>
					<input type="hidden" name="_settings[select][classe]" value="info">
					<input type="hidden" name="_settings[select][ordem][._.action]" value='{"type":"sequencia", "ordem":"decrescente"}'>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="livro"></label>  
						<div class="col-md-6">
							<input id="livro" name="livro" type="text" placeholder="Nome do livro" class="form-control input-md" required="">
							<span class="help-block">Nome completo do livro</span>  
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="isbn"></label>  
						<div class="col-md-6">
							<input id="isbn" name="isbn" type="text" placeholder="ISBN" class="form-control input-md">
							<span class="help-block">Insira o isbn do livro</span>  
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="autor[nome]"></label>  
						<div class="col-md-6">
							<input id="autor[nome]" name="autor[nome]" type="text" placeholder="Nome do autor" class="form-control input-md" required="">
							<span class="help-block">Insira o nome completo do autor</span>  
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4 well">

							<!-- Pitpo da titulação-->
							<div class="col-md-12">

								<!-- DOUTOR -->
								<label class="radio-inline" for="autor[titulacao][tipo][doutor]">
									<input type="radio" name="autor[titulacao][tipo]" id="autor[titulacao][tipo][doutor]" value="doutor"> Doutor
								</label>

								<!-- MESTRE -->
								<label class="radio-inline" for="autor[titulacao][tipo][mestre]">
									<input type="radio" name="autor[titulacao][tipo]" id="autor[titulacao][tipo][mestre]" value="mestre" checked="checked"> Mestre
								</label>
							</div>

							<!-- Area da titulação-->
							<div class="col-md-7">
								<input id="autor[titulacao][area]" name="autor[titulacao][area]" type="text" placeholder="Área da formação" class="form-control input-md">
							</div>

							<!-- Instituição da titulação-->
							<div class="col-md-5">
								<input id="autor[titulacao][instituicao]" name="autor[titulacao][instituicao]" type="text" placeholder="Instituição da graduação" class="form-control input-md">
							</div>
						</div>
					</div>

					<!-- Sobre o autor -->
					<div class="form-group">
						<label class="col-md-4 control-label" for="autor[sobre]"></label>
						<div class="col-md-6">
							<textarea class="form-control" id="autor[sobre]" name="autor[sobre]" placeholder="Sobre o autor"></textarea>
						</div>
					</div>

					<!-- Button (Double) -->
					<div class="form-group">
						<label class="col-md-4 control-label" for="send"></label>

						<div class="col-md-8">
							<!-- <button id="send" name="send" class="btn btn-info">Salvar</button> -->
							<a id="send" class="btn btn-info" href="?page=edt-livro-info">Salvar</a>
							<a id="cancel" class="btn btn-danger" href="?page=add-livro-info">Cancelar</a>
						</div>
					</div>
				</fieldset>
			</form>
		</div>

		<!-- VENDOR: jQuery -->
		<script src="http://localhost/vg/livroDigital/assets/vendor/js/jquery.min.js"></script>

		<!-- VENDOR: Latest compiled and minified Bootstrap JavaScript -->
		<script src="http://localhost/vg/livroDigital/assets/vendor/bootstrap/js/bootstrap.min.js"></script>

		<!-- VENDOR: CoffeeScript -->
		<script src="http://coffeescript.org/extras/coffee-script.js"></script>

		<!-- VENDOR: CSS Less-->
		<script src="http://localhost/vg/livroDigital/assets/vendor/js/less.min.js"></script>

		<!-- APP: CoffeeScript -->
		<script type="text/coffeescript" src="scripts/default.coffee"></script>

	</body>
</html>
