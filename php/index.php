<?php

	# # # # # # # # # # # # # # # # # 
	# # # # INCLUDES  # # # # # # # #

	# Adiciona conjunto de regras globais
	include '._.config.php';

	# Adiciona conjunto de regras para select
	include $settings['wwwpatern'].'vendor\php\phpSelectSQL.php';

	# Adiciona conjunto de funções
	include 'functions.php';

	# # # # INCLUDES  # # # # # # # #
	# # # # # # # # # # # # # # # # # 

	# # # # # # # # # # # # # # # # # 
	# # # CONFIGURA MAP-FILES # # # #
	file_open(array('name'=>'wwwroot'), true);
	# # # CONFIGURA MAP-FILES # # # #
	# # # # # # # # # # # # # # # # # 

	# # # Quando receber uma solicitação ajax
	if (array_key_exists('ajax', $post)) {
		// {"._.list":["ajax"], "ajax":{"._.type":["array"], "._.required":true, "._.list":["user", "action", "method", "values"], [TODO:]}}

		// TODO: Validar $post
		// TODO: Validar usuario e retornar o sku + o grupo de permissoes

		# define done como null
		$ajax = null;
		error_reporting(0);
		ini_set('display_errors', 0 );

		# # # 
		# valida se o parametro é de selção ou de inserção
		if ($post['ajax']['action']['type'] == 'select' or $post['ajax']['action']['type'] == 'insert' or $post['ajax']['action']['type'] == 'update' or $post['ajax']['action']['type'] == 'delete') {

			$ajax = form_livro($post['ajax'], false);

			// TODO: Validar os erros antes de retornar em $ajax
		}

		if ($post['ajax']['action']['type'] == 'less to css') {

			// $ajax = $post['ajax']['action']['content']['less'];

			# cria temporario para o tratamento de less
			$temp['less'] = null;

			# define nome e tipo do arquivo
			$temp['less']['F:file_open']['name'] = 'app';
			$temp['less']['F:file_open']['type'] = 'style';
			$temp['less']['F:file_open']['action']['path'] = 'dist';

			# adiciona arquivo enviado pelo servidor
			$temp['less']['F:file_open']['action']['new']['file'] = $post['ajax']['action']['content']['less'];

			# envia dados para a função de arquivos
			$temp['less']['success'] = file_open($temp['less']['F:file_open'], false);

			# codifica o array e retorna em ajax os dados solicitados
			$ajax = json_encode($temp['less']['success']);

			# apaga temp=>less
			unset($temp['less']);
		}

		$ajax = 'oi';
		$b = $a;
		if ($ajax == null or gettype($ajax) != 'object') {

			$ajax = '{"done":false, "erro":{"post":'.json_encode($post['ajax']).', "feed":"Os parametros recebidos ainda nao podem ser tratados"}}';
		}

		# imprime valores para o ajax
		print_r($ajax);
	}



	# # # # # # # # # # # # # # # # #
	# # # # LOAD PAGES  # # # # # # #

	// {"._.list":["page"], "page":{"._.required":true, "._.type":"string", "._.//":"Apelido da pagina para importar o formilário"}}
	if (array_key_exists('page', $get)) { 

		# define parametros para a função F_load_pages
		$temp['nav']['go'] = $get['page'];
	 	$temp['nav']['pages'] = $settings['pages'];

	 	# Importa pagina
		load_pages($temp['nav'], false);

		# apaga dados temporarios
		unset($temp['nav']);
	}

	# # # # LOAD PAGES  # # # # # # #
	# # # # # # # # # # # # # # # # #
?>
