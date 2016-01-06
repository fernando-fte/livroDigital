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


	if (array_key_exists('ajax', $post)) {
		// {"._.list":["ajax"], "ajax":{"._.type":["array"], "._.required":true, "._.list":["user", "action", "method", "values"], [TODO:]}}

		// TODO: Validar $post
		// TODO: Validar usuario e retornar o sku + o grupo de permissoes

		# # # 
		# valida se o parametro é de selção ou de inserção
		if ($post['ajax']['action']['type'] == 'select' or $post['ajax']['action']['type'] == 'insert' or $post['ajax']['action']['type'] == 'update' or $post['ajax']['action']['type'] == 'delete') {

			$done = form_livro($post['ajax'], false);

			// TODO: Validar os erros antes de retornar em $done
		}

		# imprime valores para o ajax
		print_r($done);
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
