<?php include '../admin/._.config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title></title>

		<!-- VENDOR less: Bootstrap LESS -->
		<link rel="stylesheet" href="<?php echo $settings['wwwroot']?>/assets/vendor/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

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

		<!-- Contents para capa -->
		<div id="capa" class="page page-cover">

			<!-- Conteudo da capa (titulo e autores) -->
			<div class="capa-contents">
				<span class="capa-titulo"></span>
				<span class="capa-autor"></span>
			</div>

			<!-- MOBILE: Content logo para  -->
			<div class="capa-logo-top">
				<img src="#{url}/logo.white.svg">
			</div>

			<!-- Botão do menu -->
			<div class="capa-menu bnt-menu">
				<span class="fa fa-bars"></span>
			</div>

			<!-- Botão do grupo de botões da navegação -->
			<div class="capa-btn-group">

				<!-- Botão para sumário -->
				<div class="btn-nav-item">
					<span class="fa fa-list"></span>
					<span class="label">Sumário</span>
				</div>

				<!-- Botão para atividades -->
				<div class="btn-nav-item">
					<span class="fa fa-pencil"></span>
					<span class="label">Atividades</span>
				</div>

				<!-- Botão para continuar leitura -->
				<div class="btn-nav-item">
					<span class="fa fa-map-marker"></span>
					<span class="label">Continuar de onde parei</span>
				</div>

				<!-- Botão para anotações -->
				<div class="btn-nav-item">
					<span class="fa fa-bookmark-o"></span>
					<span class="label">Anotações</span>
				</div>

				<!-- Botão para refrerências -->
				<div class="btn-nav-item">
					<span class="fa fa-connectdevelop"></span>
					<span class="label">Referências</span>
				</div>
			</div>

			<!-- Botão iniciar leitura -->
			<div class="capa-btn-iniciar">
				<span class="label">Inicar leitura</span>

				<div class="btn-iniciar">
					<span class="fa fa-angle-right"></span>
				</div>
			</div>

			<!-- Contents para "pos" e logo -->
			<div class="capa-logo">
				<img src="#{url}/logo.white.svg">
				<img src="#{url}/pos.white.svg">
			</div>
		</div>

		<!-- Contents para  -->
		<!-- TODO SUBSTITUIR NOME -->
		<div id="contents" class="contents">

			<!-- Barra de navegação -->
			<div id="bar-nav" class="contents-nav">

				<!-- Content para logo -->
				<div class="nav-logo">
					<img src="#{url}/logo.color.svg">
				</div>

				<!-- Titulo da seção -->
				<div class="nav-section">

					<!-- Informações do livro -->
					<div class="nav-section-livro">
						<span class="section-livro"></span>
						<span class="section-autor"></span>
					</div>

					<!-- Informações da seção atual -->
					<div class="nav-section-actual">
						<span class="section-label"></span>
						<span class="section-name"></span>
					</div>

					<!-- Botão para sumário -->
					<div class="btn-nav-section">
						<span class="fa fa-list"></span>
						<span class="label">Sumário</span>
					</div>
				</div>

				<!-- Botão do grupo de botões da navegação -->
				<div class="nav-btn-group">

					<!-- Botão para configurar leitura -->
					<div class="btn-nav-item">
						<span class="fa fa-sliders"></span>
						<span class="label">Configurar leitura</span>
					</div>

					<!-- Botão para anotações -->
					<div class="btn-nav-item">
						<span class="fa fa-bookmark-o"></span>
						<span class="label">Anotações</span>
					</div>

					<!-- Botão para continuar leitura -->
					<div class="btn-nav-item">
						<span class="fa fa-map-marker"></span>
						<span class="label">Continuar de onde parei</span>
					</div>
				</div>

				<!-- Botão do menu -->
				<div class="nav-menu bnt-menu">
					<span class="fa fa-bars"></span>
				</div>
			</div>

			<!-- TODO SUBSTITUIR NOME PARA REFERENTE A CONTEUDO -->
			<div id="sections" class="sections">

				<!-- Sumario -->
				<section id="sumario" class="page-sumario">

					<!-- Gruop para cada capitulo -->
					<ul class="sum-section">

						<!-- Titulo do capitulo -->
						<li class="sum-section-title">

							<!-- Icone do botão // after "F61" -->
							<span class="sum-section-icon"></span>

							<!-- Nome da seção (unidade I|II|III / abertura ...) -->
							<span class="sum-section-label"></span>

							<!-- Nome caso seja titulo -->
							<span class="sum-section-name"></span>
						</li>

						<!-- Itens do sumario -->
						<li class="sum-section-item">

							<!-- Icone do botão // after "F61" -->
							<span class="sum-section-icon"></span>

							<!-- Nome da seção -->
							<span class="sum-section-name"></span>

							<!-- Icone do botão // after "F61" -->
							<span class="sum-section-more show"></span>

							<!-- Gruop para cada capitulo -->
							<ul class="sum-section-sub">

								<!-- Sub-itens do sumario -->
								<li class="sum-section-item">

									<!-- Icone do botão // after "F106|F107" -->
									<span class="sum-section-icon"></span>

									<!-- Nome da seção -->
									<span class="sum-section-name"></span>
								</li>
							</ul>
						</li>
					</ul>
				</section>

				<!-- Seção do tipo abertura -->
				<section id="#{$apresentacao[Tipo]}" class="page-apresentacao">

					<!-- Informações da seção -->
					<div class="section-info">

						<!-- Nome da seção (professores / abertura ...) -->
						<h1 class="section-label"></h1>

						<!-- Nome caso seja titulo -->
						<h1 class="section-name small"></h1>

						<!-- Controle da seção -->
						<div class="controler controler-read">
							<span class="get-video"><i class="fa fa-paragraph"></i></span>
							<span class="get-texto"><i class="fa fa-paragraph"></i></span>
						</div>
					</div>

					<!-- Video da seção -->
					<video id="#{$apresentacao[Seção][titulo]}-video" controls class="apresentacao-video">
						<source src="movie.mp4" type="video/mp4">
						<source src="movie.ogg" type="video/ogg">
					</video>

					<!-- texto da seção -->
					<article id="#{$apresentacao[Seção][titulo]}-texto" class="apresentacao-texto">
						<p id="#{sku-do-paragrafo}">[text]</p>
					</article>
				</section>
			</div>

			<!-- TODO: Controles de navegação -->

			<!-- Barra de navegação do rodapé -->
			<div id="footer-bar" class="contents-footer">

				<!-- Titulo da seção -->
				<div class="nav-section">

					<!-- Informações da seção atual -->
					<div class="nav-section-actual">
						<span class="section-label"></span>
						<span class="section-name"></span>
					</div>

					<!-- Contador de seções -->
					<div class="nav-section-count">
						<span class="section-number-this"></span>
						<span class="section-number-all"></span>
					</div>
				</div>
			</div>
		</div>

		<!-- VENDOR: jQuery -->
		<script src="<?php echo $settings['wwwroot']?>/assets/vendor/js/jquery.min.js"></script>

		<!-- VENDOR: Latest compiled and minified Bootstrap JavaScript -->
		<script src="<?php echo $settings['wwwroot']?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>

		<!-- VENDOR: CoffeeScript -->
		<script src="http://coffeescript.org/extras/coffee-script.js"></script>

		<!-- VENDOR: CSS Less-->
		<script src="<?php echo $settings['wwwroot']?>/assets/vendor/js/less.min.js"></script>

	</body>
</html>
