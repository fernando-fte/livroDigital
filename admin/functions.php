<?php
/*
* Parametros base
* {"._.list":["$val"], "$val":{"._.//":"comment", "._.required":true, "._.type":["boolean","integer","double","string","array","object","resource","NULL","unknown type"]}}
*/


# # # # # # # # # # # # # # # # # # #
# # # # # # IMPORTA PAGINAS # # # # #
function load_pages($post, $return) {
	// {"._.list":["go","pages"],"go":{"._.//":"Apelido da pagina a ser redirecionado \"login\", \"add-usuario\"","._.required":true,"._.type":["string"]},"pages":{"._.//":"Campos vs valores, onde campo é o apelido e o valor é o arquivo","._.required":true,"._.type":["array"]}}

	# verifica se essa pagina foi declarada
	if (array_key_exists($post['go'], $post['pages'])) {

		// TODO: Importar meta dados da pagina do banco de dados
		include $post['pages'][$post['go']];

		$done['success'] = true;
	}

	else {

		$done['success'] = false;
		$done['erro']['declaração'] = 'A pagina "'.$post['go'].'" não foi declarada';
	}

	# valida a condição de retorno da função
	if (gettype($return) == 'boolean') {

		# se o retorno for verdadeiro imprime na tela com print_R
		if ($return == true) {
			print_r($done);
		}
	}
}
# # # # # # IMPORTA PAGINAS # # # # #
# # # # # # # # # # # # # # # # # # #


# # # # # # # # # # # # # # # # # # #
# # # # # # FORMULARIO DE LIVROS # # # # #
function form_livro($post, $return) {

	$temp['._.process'] = false;
	// $temp['._.process']['F_form_serialize'] = false;

	$temp['._.success'] = false;
	$temp['._.erro'] = false;
	$temp['._.warning'] = false;
	$temp['._.reserve'] = false;
	$temp['._.done'] = null;
	$temp['._.backup'] = $post;

	// $temp['._.process']['F_form_serialize']
	// $temp['._.process']['F_form_monta_parametros']

	# valida e prepara os parametros

	$temp['F_form_serialize'] = form_serialize($post['action'], false);

	$temp['._.process']['F_form_serialize'] = $temp['F_form_serialize']['success'];

	# adiciona erro caso não aconteça serialize
	if (!$temp['._.process']['F_form_serialize']) { $temp['._.erro']['F_form_serialize'] = (array_key_exists('valida_post', $temp['F_form_serialize']['erro']) ? $temp['F_form_serialize']['erro']['valida_post'] : $temp['F_form_serialize']['erro']); }


	# #
	if ($temp['._.process']['F_form_serialize']) {
		
		// $temp['F_form_monta_parametros'] = form_monta_parametros($temp['F_form_serialize']['done'], false);
		$temp['._.done'] = form_monta_parametros($temp['F_form_serialize']['done'], 'log');
	}


	// $done = $temp['._.process'];
	$done = retorna_funcao($temp, 'done');

	if (gettype($return) == 'boolean') {

		if ($return) { print_r($done); }
		else{ return $done; }
	}
}
# # # # # # FORMULARIO DE LIVROS  # # # #
# # # # # # # # # # # # # # # # # # # # # 


function form_serialize($post, $return) {
	// $post => {"._.list":["serialize"], "serialize":{"._.type":["string"], "._.required":true}}

	$temp['._.process'] = false;
	// $temp['._.process']['F_trata_post'] = false;
	// $temp['._.process']['serialize'] = false;
	// $temp['._.process']['input-from-id'] = false;
	// $temp['._.process']['valida_post'] = false;


	$temp['._.success'] = false;
	$temp['._.erro'] = false;
	$temp['._.warning'] = false;
	$temp['._.reserve'] = false;
	$temp['._.done'] = null;
	$temp['._.backup'] = $post;

	// TODO: Trata parametros de post
	// $temp['._.process']['F_trata_post'] = false;
	// $temp['._.erro']['F_trata_post'] = trata_post($post);

	$temp['._.process']['F_trata_post'] = true;

	if ($temp['._.process']['F_trata_post']) {

		# transforma em array
		parse_str($post['serialize'], $temp['post']);

		# valida se os dados se o serialize funcionou
		$temp['._.process']['serialize'] = (gettype($temp['post']) == 'array' ? true:false);


		if ($temp['._.process']['serialize']) {

			if (array_key_exists('input-from-id', $temp['post']) == true) {
				
				if (gettype($temp['post']['input-from-id']) == 'string' && $temp['post']['input-from-id'] != '') {

					# finaliza validação do tipo do formulario
					$temp['._.process']['input-from-id'] = true;

					switch ($temp['post']['input-from-id']) {
						case '@insert#livro':

							// {"._.list":["input-from-action","input-select-segmento","input-select-classe","input-livro","input-isbn","input-autor-nome","input-autor-titulacao","input-autor-titulacao-area","input-autor-titulacao-instituicao","input-autor-sobre"],"input-from-action":{"._.required":true,"._.type":["string","integer"]},"input-select-segmento":{"._.required":true,"._.type":["string","integer"]},"input-select-classe":{"._.required":true,"._.type":["string","integer"]},"input-livro":{"._.required":true,"._.type":["string","integer"]},"input-isbn":{"._.required":true,"._.type":["string","integer"]},"input-autor-nome":{"._.required":true,"._.type":["string","integer"]},"input-autor-titulacao":{"._.required":true,"._.type":["string","integer"]},"input-autor-titulacao-area":{"._.required":true,"._.type":["string","integer"]},"input-autor-titulacao-instituicao":{"._.required":true,"._.type":["string","integer"]},"input-autor-sobre":{"._.required":true,"._.type":["string","integer"]}}
							// TODO: Trata parametros de $temp['post']
							// $temp['._.process']['valida_post'] = false;
							// $temp['._.erro']['valida_post'] = trata_post($post);
							// TODO: criar lista com os itens que estavam ausentes
							$temp['._.process']['valida_post'] = true;

							# adiciona em ._.done o $temp['post']
							$temp['._.done'] = ($temp['._.process']['valida_post'] ? $temp['post'] : false);
							break;

						# valida se o formulario declarado existe
						default:

							$temp['._.process']['input-from-id'] = false;
							$temp['._.erro']['input-from-id'] = 'O fromulario "'.$temp['post']['input-from-id'].'" enviado em "input-from-id" não está declarado';
							break;
					}

				} else { $temp['._.erro']['input-from-id'] = 'O parametro recebido em "input-from-id" não corresponde ao esperado'; }

			} else { $temp['._.erro']['input-from-id'] = 'Não foi recebido o parametro que indica o formulario "input-form-id"'; }
		}

		# adiciona erro caso não aconteça serialize
		if (!$temp['._.process']['serialize']) { $temp['._.erro']['serialize'] = 'Era esperado que os dados do tipo "array" e foi recebido "'.$temp['post'].'"'; }
	}

	return retorna_funcao($temp, $return);
}


function form_monta_parametros($post, $return) {

	$temp['._.process'] = false;
	$temp['._.success'] = false;
	$temp['._.erro'] = false;
	$temp['._.warning'] = false;
	$temp['._.reserve'] = false;
	$temp['._.done'] = null;
	$temp['._.backup'] = $post;

	// {"._.list":["serialize"]}

	switch ($post['input-from-id']) {

		case '@insert#livro':

			// values
				$temp['values']['titulo do livro'] = $post['input-livro'];
				$temp['values']['isbn'] = $post['input-isbn'];

				# # # #
				# # trata autores
				for ($i=0; $i < 1000; $i++) {

					if (array_key_exists('input-autor-'.$i.'-nome', $post)) {
						
						$temp['values']['autor']['._.list'][$i] = $post['input-autor-'.$i.'-nome'];
						$temp['values']['autor'][$post['input-autor-'.$i.'-nome']]['nome']['completo'] = $post['input-autor-'.$i.'-nome'];
						// TODO: $temp['values']['autor'][$post['input-autor-'.$i.'-nome']]['nome']['curto'] = $post['input-autor-'.$i.'-nome'];
						$temp['values']['autor'][$post['input-autor-'.$i.'-nome']]['sobre'] = $post['input-autor-'.$i.'-sobre'];

						for ($b=0; $b < 1000; $b++) { 

							if (array_key_exists('input-autor-'.$i.'-titulacao-'.$b, $post)) {
								$temp['sort']['titulacao']['tipo'] = $post['input-autor-'.$i.'-titulacao-'.$b];
								$temp['sort']['titulacao']['area'] = $post['input-autor-'.$i.'-titulacao-'.$b.'-area'];
								$temp['sort']['titulacao']['instituicao'] = $post['input-autor-'.$i.'-titulacao-'.$b.'-instituicao'];

								$temp['values']['autor'][$post['input-autor-'.$i.'-nome']]['titulacao'][$temp['sort']['titulacao']['tipo']]['._.list'][$i] = $temp['sort']['titulacao']['area'];
								$temp['values']['autor'][$post['input-autor-'.$i.'-nome']]['titulacao'][$temp['sort']['titulacao']['tipo']][$temp['sort']['titulacao']['area']]['area'] = $temp['sort']['titulacao']['area'];
								$temp['values']['autor'][$post['input-autor-'.$i.'-nome']]['titulacao'][$temp['sort']['titulacao']['tipo']][$temp['sort']['titulacao']['area']]['instituicao'] = $temp['sort']['titulacao']['instituicao'];

							} 
							else{ $b = 1001; }

						}
						unset($b);

					}

					else{ $i = 1001; }
				}
				unset($i);
				# # trata autores
				# # # #

			// seletores
			// $temp['monta']['']

                    // $post['input-from-id'];
                    // $post['input-from-action'];

                    // $post['input-select-segmento'];
                    // $post['input-select-classe'];

                    // $post['input-livro'];
                    // $post['input-isbn'];

                    // $post['input-autor-0-nome'];
                    // $post['input-autor-0-titulacao-0'];
                    // $post['input-autor-titulacao-area'];
                    // $post['input-autor-titulacao-instituicao'];
                    // $post['input-autor-sobre'];
			break;
		
		default:
			# code...
			break;
	}

	return retorna_funcao($temp, $return);
}


# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # FUNÇÃO DE TRATAMENTO DO RETORNO DE OUTRAS FUNÇÕES # # # # # # #
function retorna_funcao($post, $return) {
	# $post => {"._.list":["._.success","._.erro","._.warning","._.reserve","._.done","._.backup"],"._.success":{"._.required":true,"._.type":["boolean"]},"._.erro":{"._.required":true,"._.type":["array","boolean"]},"._.warning":{"._.required":true,"._.type":["array","boolean"]},"._.reserve":{"._.required":true,"._.type":["array","null"]},"._.done":{"._.required":true,"._.type":["array","boolean","null","string","integer"]},"._.backup":{"._.required":true,"._.type":["array",null]}}
	// TODO: Validar o post

	$temp['._.process'] = false;
	$temp['._.success'] = false;
	$temp['._.erro'] = false;
	$temp['._.warning'] = false;
	$temp['._.reserve'] = false;
	$temp['._.done'] = null;
	$temp['._.backup'] = $post;


	# Configura os dados de post
	$post['._.erro']['length'] = ( $post['._.erro'] ? count($post['._.erro']):0);
	$post['._.warning']['length'] = ( $post['._.warning'] ? count($post['._.erro']):0);
	$post['._.success'] = ($post['._.erro']['length'] == 0 ? true:false);

	// $temp['log'] = $post;
	// $temp['success'] = $post['._.success'];
	// $temp['erro'] = $post['._.erro'];
	// $temp['warning'] = $post['._.warning'];
	// $temp['temp'] = $post['._.temp'];
	// $temp['backup'] = $post['._.backup'];

	if (gettype($return) == 'boolean') {

		if ($return == false) {

			$done['success'] = $post['._.success'];
			$done['done'] = $post['._.done'];

			if ($post['._.erro']['length'] > 0) { $done['erro'] = $post['._.erro']; }
			if ($post['._.warning']['length'] > 0) { $done['warning'] = $post['._.warning']; }
		}

		if ($return == true) {

			$done['success'] = $post['._.success'];
			$done['erro'] = $post['._.erro'];
			$done['warning'] = $post['._.warning'];
			$done['process'] = $post['._.process'];
			$done['done'] = $post['._.done'];
		}
	}

	else {
		switch ($return) {

			case 'log':

				$done = $post;
			break;

			case 'success':

				$done['success'] = $post['._.success'];
			break;

			case 'erro':

				$done['erro'] = $post['._.erro'];
			break;

			case 'warning':

				$done['warning'] = $post['._.warning'];
			break;

			case 'backup':

				$done['backup'] = $post['._.backup'];
			break;

			case 'process':

				$done['process'] = $post['._.process'];
			break;

			case 'done':

				$done['done'] = $post['._.done'];
			break;

			case 'echo':

				echo $post;
				$done = $post;
			break;

			case 'print':

				print_r($post);
				$done = $post;
			break;
		}
	}

	// return $done;
	return $done;
}
# # # FUNÇÃO DE TRATAMENTO DO RETORNO DE OUTRAS FUNÇÕES # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #



?>