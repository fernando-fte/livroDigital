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
		<div id="contents" class="container">

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

				<!-- Seção do tipo apresentação -->
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

				<!-- Seção do tipo capitulo -->
				<section id="capitulos" class="page-capitulo">

					<!-- Capitulo $[1-5] -->
					<div id="capitulo-#{$capitulo[ordem]}">

						<!-- Informações da seção -->
						<div id="capitulo-#{$capitulo[ordem]}-abertura" class="capitulo-introducao">

							<div class="capitulo-introducao-capa">

								<!-- Nome da seção (UNIDADE I / II / III / ...) -->
								<span class="label"></span>

								<!-- Tpitulo da unidade -->
								<span class="titulo"></span>

								<!-- Titulo da unidade -->
								<span class="autor"></span>
							</div>

							<div class="capitulo-introducao-texto">
								<h1 class="hidden">Introdução</h1>

								<p id="#{sku-do-paragrafo}">[text]</p>
							</div>
						</div>

						<article>
							<h1 id="#{sku-do-paragrafo}"></h1>
							<p id="#{sku-do-paragrafo}"></p>
							<p id="#{sku-do-paragrafo}"></p>
							<p id="#{sku-do-paragrafo}"></p>

							<article>
								<h2 id="#{sku-do-paragrafo}"></h2>
								<p id="#{sku-do-paragrafo}"></p>
								<p id="#{sku-do-paragrafo}"></p>
								<p id="#{sku-do-paragrafo}"></p>
							</article>

							<div class="grapc-content grapc-content-figure">

								<div class="grapc-content-bkp hidden">
	
									<!-- recebe assim e anipula para caber dentro do html 
									<img src="#{figure-name}" data-grapc-caption='{"label":"", "font":""}'>				
									-->
								</div>

								<div class="grapc-content-nav">
									<span class="before"><i class="fa angle-left"></i></span>
									<span class="next"><i class="fa angle-right"></i></span>

									<img class="show" src="#{figure-name}">
									<img class="hidden" src="#{figure-name}">
								</div>

								<div class="grapc-content-caption">
									<span class="sequence">
										<span class="sequence-this"></span> / 
										<span class="sequence-all"></span>
									</span>
									<span class="label"></span>
									<span class="font"></span>
								</div>
							</div>

							<div class="grapc-content grapc-content-table">

								<div class="grapc-content-bkp hidden">

								<!-- VINDO
								<table data-grapc-caption='{"label":"", "font":""}'>

									<thead>
										<td></td>
										<td></td>
										<td></td>
									</thead>

									<tbody>

										<tr>
											<td data-tb-col-title></td>
											<td data-tb-col-title></td>
											<td data-tb-col-title></td>
										</tr>

										<tr data-tb-row-dad="#{titulo-da-linha}">
											<td data-tb-row-title></td>
											<td></td>
											<td></td>
										</tr>

										<tr data-tb-row-child="#{titulo-da-linha}">
											<td data-tb-row-title></td>
											<td></td>
											<td></td>
										</tr>

										<tr data-tb-row-child="#{titulo-da-linha}">
											<td data-tb-row-title></td>
											<td></td>
											<td></td>
										</tr>

										<tr data-tb-row-child="#{titulo-da-linha}">
											<td data-tb-row-title></td>
											<td></td>
											<td></td>
										</tr>

										<tr>
											<td data-tb-row-title></td>
											<td></td>
											<td></td>
										</tr>

										<tr data-tb-row-result>
											<td data-tb-row-title></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
								</table>
								-->
								</div>

								<div class="grapc-content-nav">
									<span class="before"><i class="fa angle-left"></i></span>
									<span class="next"><i class="fa angle-right"></i></span>

									<table class="table table-bordered">
										
										<thead>
											<td class="tb-control-display-row"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-1x"></i><i class="fa fa-check fa-stack-1x"></i></span></td>
											<td class="tb-content tb-title"></td>
											<td class="tb-control-slide"><i class="fa fa-chevron-down"></i></td>
											<td class="tb-content tb-title"></td>
											<td class="tb-content tb-title"></td>
											<td class="tb-content tb-title"></td>
											<td class="tb-content tb-title"></td>
										</thead>

										<tbody>
											<tr class="tb-title-row-group">
												<td class="tb-control-display-row"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-1x"></i><i class="fa fa-check fa-stack-1x"></i></span></td>
												<td class="tb-content tb-title-col"></td>
												<td class="tb-control-slide"><i class="fa fa-chevron-down"></i></td>
												<td class="tb-content tb-title-col"></td>
												<td class="tb-content tb-title-col"></td>
												<td class="tb-content tb-title-col"></td>
												<td class="tb-content tb-title-col"></td>
											</tr>

											<tr class="tb-contents">
												<td class="tb-control-display-row"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-1x"></i><i class="fa fa-check fa-stack-1x"></i></span></td>
												<td class="tb-content tb-title-row"></td>
												<td class="tb-control-slide"><i class="fa fa-chevron-down"></i></td>
												<td class="tb-content"></td>
												<td class="tb-content"></td>
												<td class="tb-content"></td>
												<td class="tb-content"></td>
											</tr>

											<tr class="tb-contents">
												<td class="tb-control-display-row"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-1x"></i><i class="fa fa-check fa-stack-1x"></i></span></td>
												<td class="tb-content tb-title-row"></td>
												<td class="tb-control-slide"><i class="fa fa-chevron-down"></i></td>
												<td class="tb-content"></td>
												<td class="tb-content"></td>
												<td class="tb-content"></td>
												<td class="tb-content"></td>
											</tr>

											<tr class="tb-contents">
												<td class="tb-control-display-row"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-1x"></i><i class="fa fa-check fa-stack-1x"></i></span></td>
												<td class="tb-content tb-title-row"></td>
												<td class="tb-control-slide"><i class="fa fa-chevron-down"></i></td>
												<td class="tb-content"></td>
												<td class="tb-content"></td>
												<td class="tb-content"></td>
												<td class="tb-content"></td>
											</tr>

											<tr class="tb-result">
												<td class="tb-control-display-row"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-1x"></i><i class="fa fa-check fa-stack-1x"></i></span></td>
												<td class="tb-content tb-title-result"></td>
												<td class="tb-control-slide"><i class="fa fa-chevron-down"></i></td>
												<td class="tb-content tb-result"></td>
												<td class="tb-content tb-result"></td>
												<td class="tb-content tb-result"></td>
												<td class="tb-content tb-result"></td>
											</tr>

											<tr class="tb-control-display">
												<td class="tb-empty"></td>
												<td class="tb-control-display-col"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-1x"></i><i class="fa fa-check fa-stack-1x"></i></span></td>
												<td class="tb-control-slide"><i class="fa fa-chevron-down"></i></td>
												<td class="tb-control-display-col"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-1x"></i><i class="fa fa-check fa-stack-1x"></i></span></td>
												<td class="tb-control-display-col"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-1x"></i><i class="fa fa-check fa-stack-1x"></i></span></td>
												<td class="tb-control-display-col"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-1x"></i><i class="fa fa-check fa-stack-1x"></i></span></td>
												<td class="tb-control-display-col"><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-1x"></i><i class="fa fa-check fa-stack-1x"></i></span></td>
											</tr>
										</tbody>
									</table>

									<div class="grapc-content-control">
										<span class="btn btn-danger grapc-content-control-active"><i class="fa fa-pencil"></i></span>
										<span class="btn btn-danger grapc-content-control-change">Ocultar</span>
									</div>
								</div>

								<div class="grapc-content-caption">
									<span class="sequence">
										<span class="sequence-this"></span>
										<span class="sequence-all"></span>
									</span>
									<span class="label"></span>
									<span class="font"></span>
								</div>
							</div>

							<blockquote id="#{sku-do-paragrafo}" cite="fonte">
								<p id="#{sku-do-paragrafo}"></p>
								<p id="#{sku-do-paragrafo}"></p>
								<p id="#{sku-do-paragrafo}"></p>
							</blockquote>

							<p id="#{sku-do-paragrafo}"></p>
							<p id="#{sku-do-paragrafo}"></p>
							<p id="#{sku-do-paragrafo}"></p>
							<p id="#{sku-do-paragrafo}"></p>

							<div class="box-section">

								<div class="grapc-section-head">
									<span class="grapc-section-head-icon"><i class="fa fa-paragraph"></i></span>
									<span class="grapc-section-head-title"></span>
								</div>

								<div class="grapc-section-content">
									<h1 id="#{sku-do-paragrafo}"></h1>
									<p id="#{sku-do-paragrafo}"></p>
									<p id="#{sku-do-paragrafo}"></p>
									<p id="#{sku-do-paragrafo}"></p>
									<p id="#{sku-do-paragrafo}"></p>
								</div>
							</div>

							<div class="box-atividade">

								<div class="box-section-head">
									<span class="box-section-head-icon"><i class="fa fa-pencil"></i></span>
									<span class="box-section-head-title"></span>
								</div>

								<div class="atividade-content-group">

									<div class="atividade-content-item">
										<p class="atividade-enunciado"></p>

										<ul class="atividade-alternativa-group">

											<li class="atividade-alternativa-item" data-atividade-correct>
												<span class="atividade-alternativa-text"></span>
												<span class="atividade-alternativa-feedback"></span>
											</li>

											<li class="atividade-alternativa-item">
												<span class="atividade-alternativa-text"></span>
												<span class="atividade-alternativa-feedback"></span>
											</li>

											<li class="atividade-alternativa-item" data-atividade-correct>
												<span class="atividade-alternativa-text"></span>
												<span class="atividade-alternativa-feedback"></span>
											</li>

											<li class="atividade-alternativa-item">
												<span class="atividade-alternativa-text"></span>
												<span class="atividade-alternativa-feedback"></span>
											</li>
										</ul>
									</div>

									<div class="atividade-content-item">
										<p class="atividade-enunciado"></p>

										<ul class="atividade-alternativa-group">

											<li class="atividade-alternativa-item" data-atividade-correct>
												<span class="atividade-alternativa-text"></span>
												<span class="atividade-alternativa-feedback"></span>
											</li>

											<li class="atividade-alternativa-item">
												<span class="atividade-alternativa-text"></span>
												<span class="atividade-alternativa-feedback"></span>
											</li>

											<li class="atividade-alternativa-item" data-atividade-correct>
												<span class="atividade-alternativa-text"></span>
												<span class="atividade-alternativa-feedback"></span>
											</li>

											<li class="atividade-alternativa-item">
												<span class="atividade-alternativa-text"></span>
												<span class="atividade-alternativa-feedback"></span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</article>
					</div>
				</section>

				<!-- Seção do tipo atividade -->
				<section id="atividade" class="page-atividades">

					<!-- Informações da seção -->
					<div class="section-info hidden">

						<!-- Nome da seção (Atividade) -->
						<h1 class="section-label">Atividades</h1>
					</div>

					<!-- texto da seção -->
					<div id="atividade-capitulo-#{$capitulo[ordem]}" class="atividade-section">

						<div class="atividade-section-head">
							<span class="box-section-head-icon"><i class="fa fa-pencil"></i></span>
							<span class="box-section-head-title"></span>
						</div>

						<div class="atividade-content-group">

							<div class="atividade-content-item">
								<p class="atividade-enunciado"></p>

								<ul class="atividade-alternativa-group">

									<li class="atividade-alternativa-item" data-atividade-correct>
										<span class="atividade-alternativa-text"></span>
										<span class="atividade-alternativa-feedback"></span>
									</li>

									<li class="atividade-alternativa-item">
										<span class="atividade-alternativa-text"></span>
										<span class="atividade-alternativa-feedback"></span>
									</li>

									<li class="atividade-alternativa-item" data-atividade-correct>
										<span class="atividade-alternativa-text"></span>
										<span class="atividade-alternativa-feedback"></span>
									</li>

									<li class="atividade-alternativa-item">
										<span class="atividade-alternativa-text"></span>
										<span class="atividade-alternativa-feedback"></span>
									</li>
								</ul>
							</div>

							<div class="atividade-content-item">
								<p class="atividade-enunciado"></p>

								<ul class="atividade-alternativa-group">

									<li class="atividade-alternativa-item" data-atividade-correct>
										<span class="atividade-alternativa-text"></span>
										<span class="atividade-alternativa-feedback"></span>
									</li>

									<li class="atividade-alternativa-item">
										<span class="atividade-alternativa-text"></span>
										<span class="atividade-alternativa-feedback"></span>
									</li>

									<li class="atividade-alternativa-item" data-atividade-correct>
										<span class="atividade-alternativa-text"></span>
										<span class="atividade-alternativa-feedback"></span>
									</li>

									<li class="atividade-alternativa-item">
										<span class="atividade-alternativa-text"></span>
										<span class="atividade-alternativa-feedback"></span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<!-- Seção do tipo apresentação -->
				<section id="referencias" class="page-referencias">

					<!-- Informações da seção -->
					<div class="section-info">

						<!-- Nome da seção (professores / abertura ...) -->
						<h1 class="section-label">Referências</h1>
					</div>

					<!-- texto da seção -->
					<article id="#{$apresentacao[Seção][titulo]}-texto" class="referencias-group">
						<p class="referencias-item"></p>
						<p class="referencias-item"></p>
						<p class="referencias-item"></p>
						<p class="referencias-item"></p>
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
