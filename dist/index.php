<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title></title>

		<link rel="stylesheet" href="css/app.min.css">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<!-- Contents para capa -->
		<div id="capa" class="app-page app-cover" style="background-image: url(library/cover.book.jpg)">

			<!-- Conteudo da capa (titulo e autores) -->
			<div class="cover-contents col-md-11 col-notspace">
				<span class="cover-fachada app-text-livro">Finanças Empresariais</span>
				<span class="cover-fachada app-text-autor">Marcela Ribeiro de Albuquerque</span>
			</div>

			<!-- Botão iniciar leitura -->
			<span class="col-md-offset-5 col-md-2 cover-btn-iniciar app-ico-iniciar"></span>

			<!-- Contents para "pos" e logo -->
			<div class="cover-logo-group">

				<img  class="cover-logo-item logo-pos" src="img/logo.pos.white.svg">
				<img  class="cover-logo-item logo-instituicao" src="img/logo.white.svg">
			</div>

			<!-- Botão do grupo de botões da navegação -->
			<div class="cover-nav-bar col-md-1 col-notspace row">

				<!-- Botão do menu -->
				<span class="cover-btn-nav btn-nav-menu">
					<span class="app-ico-menu"></span>
				</span>

				<!-- Botão para sumário -->
				<span class="cover-btn-nav">
					<span class="app-ico-sumario"></span>
					<span class="cover-btn-tooltip">Sumário</span>
				</span>

				<!-- Botão para atividades -->
				<span class="cover-btn-nav">
					<span class="app-ico-atividade"></span>
					<span class="cover-btn-tooltip">Atividades</span>
				</span>

				<!-- Botão para continuar leitura -->
				<span class="cover-btn-nav">
					<span class="app-ico-marcador"></span>
					<span class="cover-btn-tooltip">Continuar de onde parei</span>
				</span>

				<!-- Botão para anotações -->
				<span class="cover-btn-nav">
					<span class="app-ico-anotacao"></span>
					<span class="cover-btn-tooltip">Anotações</span>
				</span>

				<!-- Botão para refrerências -->
				<span class="cover-btn-nav">
					<span class="app-ico-referencia"></span>
					<span class="cover-btn-tooltip">Referências</span>
				</span>
			</div>
		</div>

		<!-- Barra de navegação -->
		<div id="bar-nav" class="app-nav-bar clearfix">

			<!-- Content para logo -->
			<div class="app-nav-logo col-md-2 col-sm-3 hidden-ss hidden-xs">
				<img src="img/logo.color.svg">
			</div>

			<!-- Titulo da seção -->
			<div class="app-nav-section col-md-6 col-sm-5 col-ss-6 col-xs-4">

				<!-- Informações do livro -->
				<div class="app-nav-section-info app-font-app">

					<!-- Informações do livro -->
					<div class="app-nav-section-livro app-cor-black-80 font-md-small-2 font-sm-small-2 font-ss-1 hidden-xs">
						<span class="app-nav-section-item app-livro text-uppercase text-bold">Finanças Empresariais</span>
						<span class="app-nav-section-item hidden-ss hidden-xs">•</span>
						<span class="app-nav-section-item app-autor text-italic hidden-ss hidden-xs">Albuquerque M. R</span>
					</div>

					<!-- Informações da seção -->
					<div class="app-nav-section-secao app-cor-pattern-80 font-md-small-5 font-sm-small-4 font-ss-4 font-xs-3">
						<span class="app-nav-section-item app-secao text-uppercase text-bold">Abertura</span>
						<span class="app-nav-section-item hidden-ss hidden-xs">•</span>
						<span class="app-nav-section-item app-titulo hidden-ss hidden-xs">Reitoria</span>
					</div>
				</div>
			</div>

			<!-- Botão do grupo de botões da navegação -->
			<div class="app-nav-btn-group col-md-4 col-sm-4 col-ss-6 col-xs-8 app-cor-pattern text-center font-md-5 font-sm-4 font-ss-4 font-xs-4">

				<!-- Botão para configurar leitura -->
				<div class="app-nav-btn-item nav-btn-sumario col-md-2 col-sm-2 col-ss-2 col-xs-2">
					<span class="app-ico-sumario font-md-6 font-sm-5 font-ss-5 font-xs-small-4"></span>
				</div>

				<span class="col-sm-2 col-xs-2"></span>

				<!-- Botão para configurar leitura -->
				<div class="app-nav-btn-item nav-btn-action text-center col-md-2 col-sm-2 col-ss-2 col-xs-2">
					<span class="app-ico-config_leitura"></span>

					<div class="app-nav-tooltip nav-tooltip-posicao clearfix">

						<div class="app-nav-tooltip-control app-font-app  col-md-12 col-sm-12 col-ss-12 col-xs-12">
							<span class="app-ico-close  font-lg-7 font-sm-6 font-xs-7 app-cor-pattern"></span>

							<div class="app-nav-control-light-density col-xs-12">
								<span class="app-ico-light-off  app-cor-pattern  font-md-4 font-ss-3 font-xs-4"></span>
								<input id="app-nav-light-density" data-slider-id='app-nav-light-density' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14"/>
								<span class="app-ico-light-on  app-cor-pattern  font-md-4 font-ss-3 font-xs-4"></span>
							</div>

							<div class="app-nav-control-background  app-divisor-top  col-xs-12">
								<div class="app-control-background-item app-bg-pattern-40  col-xs-3 col-xs-offset-1"><p class="font-xs-small-6 text-center">T</p></div>
								<div class="app-control-background-item app-bg-black-40  col-xs-3 col-xs-offset-1 active"><p class="font-xs-small-6 text-center">T</p></div>
								<div class="app-control-background-item app-bg-light-40  col-xs-3 col-xs-offset-1"><p class="font-xs-small-6 text-center">T</p></div>
							</div>
						</div>
					</div>
				</div>

				<!-- Botão para anotações -->
				<div class="app-nav-btn-item nav-btn-action col-md-2 col-sm-2 col-ss-2 col-xs-2">
					<span class="app-ico-anotacao"></span>

					<div class="app-nav-tooltip nav-tooltip-posicao clearfix">

						<div class="app-nav-tooltip-control app-font-app  col-md-12 col-sm-12 col-ss-12 col-xs-12">
							<span class="app-ico-close  font-lg-7 font-sm-6 font-xs-7 app-cor-pattern"></span>

							<span class="app-nav-tooltip-more  padding-none-width text-uppercase text-bold text-center app-cor-blue-60  col-md-12 col-sm-12 col-ss-12 col-xs-12  font-md-small-3 font-sm-small-3 font-ss-small-3 font-xs-small-3">Nova anotação</span>
						</div>

						<div class="app-nav-tooltip-contents">

							<span class="app-nav-tooltip-item  app-cor-black-60  col-md-12 col-sm-12 col-ss-12 col-xs-12">
								<span class="app-nav-tooltip-secao  app-font-app  text-uppercase  text-left  col-md-12 col-sm-12 col-ss-12 col-xs-12  font-md-small-2 font-sm-small-2 font-ss-small-2 font-xs-2">
									<span class="tooltip-section-item app-secao">Unidade I</span>
									<span class="tooltip-section-item">•</span>
									<span class="tooltip-section-item app-titulo">Organização da função financeira</span>
								</span>

								<span class="app-nav-tooltip-text  app-font-special  text-justify  col-md-12 col-sm-12 col-ss-12 col-xs-12  font-md-2 font-sm-2 font-ss-2 font-xs-2">A análise horizontal complementa a análise vertical, que nos informa o aumento ou diminuição da proporção</span>

								<span class="app-nav-tooltip-anotacao  app-divisor-top  app-font-app app-cor-pattern-60  text-left col-md-12 col-sm-12 col-ss-12 col-xs-12  font-md-2 font-sm-2 font-ss-2 font-xs-2">Anotação do leitor Anotação do leitor Anotação do leitor Anotação do leitor</span>

								<div class="app-nav-tooltip-control clearfix text-right col-md-12 col-sm-12 col-ss-12 col-xs-12">
									<span class="app-ico-lixo btn btn-xs btn-app"></span>
									<span class="app-ico-editar btn btn-xs btn-app"></span>
								</div>
							</span>
						</div>
					</div>
				</div>

				<!-- Botão para continuar leitura -->
				<div class="app-nav-btn-item nav-btn-action col-md-2 col-sm-2 col-ss-2 col-xs-2">
					<span class="app-ico-marcador"></span>

					<div class="app-nav-tooltip nav-tooltip-posicao clearfix">

						<div class="app-nav-tooltip-control app-font-app  col-md-12 col-sm-12 col-ss-12 col-xs-12">
							<span class="app-ico-close  font-lg-7 font-sm-6 font-xs-7 app-cor-pattern"></span>

							<span class="app-nav-tooltip-header  app-divisor-bottom padding-none-width text-italic text-uppercase app-cor-pattern-60  col-md-12 col-sm-12 col-ss-12 col-xs-12  font-md-3 font-sm-3 font-ss-3 font-xs-3">Condinuar de onde parei</span>
						</div>

						<div class="app-nav-tooltip-contents">

							<span class="app-nav-tooltip-item  app-cor-black-60  col-md-12 col-sm-12 col-ss-12 col-xs-12">
								<span class="app-nav-tooltip-secao  app-font-app  text-uppercase  text-left  col-md-12 col-sm-12 col-ss-12 col-xs-12  font-md-small-2 font-sm-small-2 font-ss-small-2 font-xs-2">
									<span class="tooltip-section-item app-secao">Unidade I</span>
									<span class="tooltip-section-item">•</span>
									<span class="tooltip-section-item app-titulo">Organização da função financeira</span>
								</span>

								<span class="app-nav-tooltip-text  app-font-special  text-justify  col-md-12 col-sm-12 col-ss-12 col-xs-12  font-md-2 font-sm-2 font-ss-2 font-xs-2">A análise horizontal complementa a análise vertical, que nos informa o aumento ou diminuição da proporção</span>
							</span>
						</div>
					</div>
				</div>

				<!-- Botão para continuar leitura -->
				<div class="app-nav-btn-item nav-btn-menu col-md-2 col-sm-2 col-ss-2 col-xs-2">
					<span class="app-ico-menu hidden-ss hidden-xs font-sm-7 font-sm-6"></span>
					<span class="app-ico-menu-short hidden-sm hidden-md hidden-lg font-ss-5"></span>
				</div>
			</div>
		</div>

		<!-- Reservatório de conteúdos -->
		<div class="contents add-scroll">

			<!-- Sumario -->
			<section id="sumario" class="app-sum-contents section-page">

				<!-- GRUPO DOS PRE-TEXTUAIS -->
				<div class="app-sum-section app-sum-section-sections">

					<!-- Titulo do capitulo -->
					<div class="app-sum-section-item app-sum-section-header | app-font-app | padding-none-right | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-2 font-md-small-2 font-sm-small-2 font-ss-small-2 font-xs-small-2">

						<!-- Nome da seção (unidade I|II|III / abertura ...) -->
						<span class="app-sum-section-secao | app-cor-black-80 | text-uppercase text-bold | padding-none-width | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-4 font-md-small-3 font-sm-2 font-ss-small-4 font-xs-small-3">Abertura</span>
					</div>

					<!-- Itens do sumario -->
					<div class="app-sum-section-item | app-font-header | padding-none-width | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-2 font-md-2 font-sm-2 font-ss-2 font-xs-2">

						<!-- Nome da seção -->
						<span class="sum-section-name | app-cor-black-80 | text-uppercase text-bold | col-md-11 col-sm-11 col-ss-11 col-xs-11">Reitoria</span>

					</div>
				</div>

				<!-- GRUPO DOS CAPITULOS -->
				<div class="app-sum-section">

					<!-- Titulo do capitulo -->
					<div class="app-sum-section-item app-sum-section-header | app-font-app | padding-none-right | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-2 font-md-small-2 font-sm-small-2 font-ss-small-2 font-xs-small-2">

						<!-- Nome da seção (unidade I|II|III / abertura ...) -->
						<span class="app-sum-section-secao | app-cor-black-80 | text-uppercase text-bold | padding-none-width | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-4 font-md-small-3 font-sm-2 font-ss-small-4 font-xs-small-3">Capítulo I</span>

						<!-- Nome caso seja titulo -->
						<span class="app-sum-section-titulo | app-cor-black-60 | padding-none-width | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-4 font-md-3 font-sm-3 font-ss-4 font-xs-3">A função financeira, análise das demonstrações financeiras</span>
					</div>

					<!-- Itens do sumario -->
					<div class="app-sum-section-item display-sub | app-font-header | padding-none-width | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-2">

						<!-- Nome da seção -->
						<span class="sum-section-name | app-cor-black-80 | text-uppercase text-bold | col-md-11 col-sm-11 col-ss-11 col-xs-11">Objetivos da administração financeira e seus conflitos</span>

						<!-- Icone do botão -->
						<span class="app-sum-btn-icon-sub | col-md-1 col-sm-1 col-ss-1 col-xs-1 | font-md-4 font-sm-4 font-ss-4 font-xs-4"></span>


						<div class="app-sum-section-sub | col-md-12 col-sm-12 col-ss-12 col-xs-12 |">

							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-2">Introdução</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-2">Objetivos da administração financeira e seus conflitos</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-2">Organização da função financeira</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-2">Análise horizontal e vertical</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-2">Análise por meio de índices</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-2">Fator de insolvência de kanitz</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-2">Fórmula dupont</span>
						</div>
					</div>

					<!-- Itens do sumario -->
					<div class="app-sum-section-item | app-font-header | padding-none-width | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-2 font-md-2 font-sm-2 font-ss-2 font-xs-2">

						<!-- Nome da seção -->
						<span class="sum-section-name | app-cor-black-80 | text-uppercase text-bold | col-md-11 col-sm-11 col-ss-11 col-xs-11">Objetivos da administração financeira e seus conflitos</span>

						<!-- Icone do botão -->
						<span class="app-sum-btn-icon-sub | col-md-1 col-sm-1 col-ss-1 col-xs-1 | font-md-4 font-sm-4 font-ss-4 font-xs-4"></span>


						<div class="app-sum-section-sub | col-md-12 col-sm-12 col-ss-12 col-xs-12 |">

							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Introdução</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Objetivos da administração financeira e seus conflitos</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Organização da função financeira</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Análise horizontal e vertical</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Análise por meio de índices</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Fator de insolvência de kanitz</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Fórmula dupont</span>
						</div>
					</div>

					<!-- Itens do sumario -->
					<div class="app-sum-section-item | app-font-header | padding-none-width | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-2 font-md-2 font-sm-2 font-ss-2 font-xs-2">

						<!-- Nome da seção -->
						<span class="sum-section-name | app-cor-black-80 | text-uppercase text-bold | col-md-11 col-sm-11 col-ss-11 col-xs-11">Objetivos da administração financeira e seus conflitos</span>

						<!-- Icone do botão -->
						<span class="app-sum-btn-icon-sub | col-md-1 col-sm-1 col-ss-1 col-xs-1 | font-md-4 font-sm-4 font-ss-4 font-xs-4"></span>


						<div class="app-sum-section-sub | col-md-12 col-sm-12 col-ss-12 col-xs-12 |">

							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Introdução</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Objetivos da administração financeira e seus conflitos</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Organização da função financeira</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Análise horizontal e vertical</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Análise por meio de índices</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Fator de insolvência de kanitz</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Fórmula dupont</span>
						</div>
					</div>

					<!-- Itens do sumario -->
					<div class="app-sum-section-item  app-sum-marcador | app-font-header | padding-none-width | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-md-2 font-sm-2 font-ss-2 font-xs-2">

						<!-- Nome da seção -->
						<span class="sum-section-name | app-cor-black-80 | text-uppercase text-bold | col-md-11 col-sm-11 col-ss-11 col-xs-11">Objetivos da administração financeira e seus conflitos</span>

						<!-- Icone do botão -->
						<span class="app-sum-btn-icon-sub | col-md-1 col-sm-1 col-ss-1 col-xs-1 | font-md-4 font-sm-4 font-ss-4 font-xs-4"></span>


						<div class="app-sum-section-sub | col-md-12 col-sm-12 col-ss-12 col-xs-12 |">

							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Introdução</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Objetivos da administração financeira e seus conflitos</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Organização da função financeira</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Análise horizontal e vertical</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Análise por meio de índices</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Fator de insolvência de kanitz</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Fórmula dupont</span>
						</div>
					</div>

					<!-- Itens do sumario -->
					<div class="app-sum-section-item | app-font-header | padding-none-width | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-2 font-md-2 font-sm-2 font-ss-2 font-xs-2">

						<!-- Nome da seção -->
						<span class="sum-section-name | app-cor-black-80 | text-uppercase text-bold | col-md-11 col-sm-11 col-ss-11 col-xs-11">Objetivos da administração financeira e seus conflitos</span>

						<!-- Icone do botão -->
						<span class="app-sum-btn-icon-sub | col-md-1 col-sm-1 col-ss-1 col-xs-1 | font-md-4 font-sm-4 font-ss-4 font-xs-4"></span>


						<div class="app-sum-section-sub | col-md-12 col-sm-12 col-ss-12 col-xs-12 |">

							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Introdução</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Objetivos da administração financeira e seus conflitos</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Organização da função financeira</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Análise horizontal e vertical</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Análise por meio de índices</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Fator de insolvência de kanitz</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Fórmula dupont</span>
						</div>
					</div>

					<!-- Itens do sumario -->
					<div class="app-sum-section-item app-sum-item-new | app-font-header | padding-none-width | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-md-2 font-sm-2 font-ss-2 font-xs-2">

						<!-- Nome da seção -->
						<span class="sum-section-name | app-cor-black-80 | text-uppercase text-bold | col-md-11 col-sm-11 col-ss-11 col-xs-11">Objetivos da administração financeira e seus conflitos</span>

						<!-- Icone do botão -->
						<span class="app-sum-btn-icon-sub | col-md-1 col-sm-1 col-ss-1 col-xs-1 | font-md-4 font-sm-4 font-ss-4 font-xs-4"></span>


						<div class="app-sum-section-sub | col-md-12 col-sm-12 col-ss-12 col-xs-12 |">

							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Introdução</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Objetivos da administração financeira e seus conflitos</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Organização da função financeira</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Análise horizontal e vertical</span>
							<!-- Sub seção do livro -->
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Análise por meio de índices</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Fator de insolvência de kanitz</span>
							<span class="app-sum-section-item app-sum-section-sub-item | col-md-12 col-sm-12 col-ss-12 col-xs-12 | font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-small-3">Fórmula dupont</span>
						</div>
					</div>
				</div>
			</section>
		</div>
	</body>

	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/perfect-scrollbar.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.slider.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.slider.min.js"></script>
	<script type="text/javascript" src="js/action.vendor.js"></script>
</html>
