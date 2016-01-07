<?php
/*
* Parametros base
* {"._.list":["$val"], "$val":{"._.//":"comment", "._.required":true, "._.type":["boolean","integer","double","string","array","object","resource","NULL","unknown type"]}}
*/


# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # IMPORTA PAGINAS # # # # # # # # # # # # # #
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
# # # # # # # # # # # # # IMPORTA PAGINAS # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #


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
		
		$temp['F_form_monta_parametros'] = form_monta_parametros($temp['F_form_serialize']['done'], false);

		$temp['._.process']['F_form_monta_parametros'] = $temp['F_form_monta_parametros']['success'];

		# adiciona erro caso não aconteça serialize
		if (!$temp['._.process']['F_form_monta_parametros']) { $temp['._.erro']['F_form_monta_parametros'] = (array_key_exists('valida_post', $temp['F_form_monta_parametros']['erro']) ? $temp['F_form_monta_parametros']['erro']['valida_post'] : $temp['F_form_monta_parametros']['erro']); }
	}

	# #
	if ($temp['._.process']['F_form_monta_parametros']) {

		switch ($post['action']['type']) {

			case 'insert':

				$temp['insert']['table'] = 'base';
				$temp['insert']['values'] = $temp['F_form_monta_parametros']['done'];

				// Trata done
				$temp['F_insert'] = insert($temp['insert'], false);
				// TODO: Valida parametros

				$temp['._.done']['sku'] = $temp['F_form_monta_parametros']['done']['0'];
				break;
			
			default:
				# code...
				break;
		}

	}

	// $done = $temp['._.process'];
	$done = retorna_funcao($temp, false);

	if (gettype($return) == 'boolean') {

		if ($return) { print_r($done); }
		else{ return $done; }
	}
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

			# # # #
			# # values
			$temp['valores']['titulo do livro'] = $post['input-livro'];
			$temp['valores']['isbn'] = $post['input-isbn'];

			# # trata autores
			for ($i=0; $i < 1000; $i++) {

				if (array_key_exists('input-autor-'.$i.'-nome', $post)) {
					
					$temp['valores']['autor']['._.list'][$i] = $post['input-autor-'.$i.'-nome'];
					$temp['valores']['autor'][$post['input-autor-'.$i.'-nome']]['nome']['completo'] = $post['input-autor-'.$i.'-nome'];
					// TODO: $temp['valores']['autor'][$post['input-autor-'.$i.'-nome']]['nome']['curto'] = $post['input-autor-'.$i.'-nome'];
					$temp['valores']['autor'][$post['input-autor-'.$i.'-nome']]['sobre'] = $post['input-autor-'.$i.'-sobre'];

					# # trata titulação
					for ($b=0; $b < 1000; $b++) { 

						if (array_key_exists('input-autor-'.$i.'-titulacao-'.$b, $post)) {
							$temp['short']['titulacao']['tipo'] = $post['input-autor-'.$i.'-titulacao-'.$b];
							$temp['short']['titulacao']['area'] = $post['input-autor-'.$i.'-titulacao-'.$b.'-area'];
							$temp['short']['titulacao']['instituicao'] = $post['input-autor-'.$i.'-titulacao-'.$b.'-instituicao'];

							$temp['valores']['autor'][$post['input-autor-'.$i.'-nome']]['titulacao'][$temp['short']['titulacao']['tipo']]['._.list'][$i] = $temp['short']['titulacao']['area'];
							$temp['valores']['autor'][$post['input-autor-'.$i.'-nome']]['titulacao'][$temp['short']['titulacao']['tipo']][$temp['short']['titulacao']['area']]['area'] = $temp['short']['titulacao']['area'];
							$temp['valores']['autor'][$post['input-autor-'.$i.'-nome']]['titulacao'][$temp['short']['titulacao']['tipo']][$temp['short']['titulacao']['area']]['instituicao'] = $temp['short']['titulacao']['instituicao'];

						} 
						else{ $b = 1001; }

					}

					unset($temp['short']['titulacao']);
					unset($b);
				}
				else{ $i = 1001; }
			}
			unset($i);


			# # # #
			# # seletores
			$temp['seletores']['2'] = $post['input-select-segmento'];
			$temp['seletores']['3'] = $post['input-livro']; // Nome do livro
			$temp['seletores']['4'] = $post['input-select-classe'];
			$temp['seletores']['5'] = $post['input-select-ordem']; // Caso a ordem seja 
			$temp['seletores']['0'] = md5($temp['seletores']['2'] + $temp['seletores']['3'] + $temp['seletores']['4'] + $temp['seletores']['5'] + microtime());

			$temp['monta']['values'] = $temp['valores'];
			$temp['monta']['values']['._.settings']['._.selectors'] = $temp['seletores'];
			$temp['short']['date'] = date('c');
			$temp['monta']['values']['._.settings']['._.history']['create'] = $temp['short']['date'];
			$temp['monta']['values']['._.settings']['._.history']['modified'] = null;
			// TODO: Capturar informação do usuario
			// $temp['monta']['values']['._.settings']['._.history'][$temp['short']['date']]['user'] = '#idUSERsku';

			$temp['._.done'] = $temp['seletores'];
			$temp['._.done']['1'] = json_encode($temp['monta']['values']);

			break;
		
		default:
			# code...
			break;
	}

	return retorna_funcao($temp, $return);
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # FUNÇÃO DE TRATAMENTO DOS DADOS VINDOS DE FORMULARIO # # # # # #
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
# # # FUNÇÃO DE TRATAMENTO DOS DADOS VINDOS DE FORMULARIO # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

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

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # FUNÇÃO DE CONSTRUÇÃO DE HTML APARTIR DE JSON  # # # # # # #
function construct_html($post, $return) {
	// {"._.list":["input","pattern"],"input":{"._.//":"Content principal dos parametros para construção do html","._.required":true,"._.type":["string","array"],"._.list":["html","id","css","class","attr","content","data-html","._.action"],"html":{"._.//":"Tipo de elemento que pode [html, p, h1] ou null para texto puro","._.required":true,"._.type":["NULL","string"]},"id":{"._.//":"Identificação do elemento, usado apenas caso o html seja valido","._.required":false,"._.type":["string"]},"content":{"._.//":"Valor a ser inserido dentro do html, podendo ser um texto simples ou uma array contendo todas as regras atuais listadas","._.required":false,"._.type":["string","array"]},"css":{"._.//":"Define um conjunto de regras css inline","._.required":false,"._.type":["string"]},"class":{"._.//":"Define conjunto de classes que deve ser descrito da seguinte forma [.classe .classe2]","._.required":false,"._.type":["array","string"]},"attr":{"._.//":"Adiciona atributos no elemento atual","._.required":false,"._.type":["array","object"]},"data-html":{"._.//":"Adiciona especificamente um atributo do tipo data-html","._.required":false,"._.type":["object","string"]},"._.action":{"._.//":"Adiciona um conjunto de regras para manipulação da estrutura atual","._.required":false,"._.type":["object"]}},"pattern":{"._.//":"Configurações padrão que será repassada para todas as funções, porem nao possui obrigação de ter a mesma estrutura","._.required":true,"._.type":["string","array"],"._.list":["html","id","css","class","attr","content","data-html","._.action"],"html":{"._.//":"Tipo de elemento que pode [html, p, h1] ou null para texto puro","._.required":false,"._.type":["NULL","string"]},"id":{"._.//":"Identificação do elemento, usado apenas caso o html seja valido","._.required":false,"._.type":["string"]},"content":{"._.//":"Valor a ser inserido dentro do html, podendo ser um texto simples ou uma array contendo todas as regras atuais listadas","._.required":false,"._.type":["string","array"]},"css":{"._.//":"Define um conjunto de regras css inline","._.required":false,"._.type":["string"]},"class":{"._.//":"Define conjunto de classes que deve ser descrito da seguinte forma [.classe .classe2]","._.required":false,"._.type":["array","string"]},"attr":{"._.//":"Adiciona atributos no elemento atual","._.required":false,"._.type":["array","object"]},"data-html":{"._.//":"Adiciona especificamente um atributo do tipo data-html","._.required":false,"._.type":["object","string"]},"._.action":{"._.//":"Adiciona um conjunto de regras para manipulação da estrutura atual","._.required":false,"._.type":["object"]}}}
	// TODO: Adiciona validação do post


	$temp['._.process'] = false;
	// $temp['._.process']['json_decode'] = false; // trata a conversão do json
	// $temp['._.process']['html_element'] = false; // trata se o atributo vai ser um html ou texto simples
	// $temp['._.process']['html_style_class'] = false; // COnjunto de classes
	// $temp['._.process']['html_style_css'] = false; // Conjunto de estilo css inline
	// $temp['._.process']['id'] = false;

	$temp['._.success'] = false;
	$temp['._.erro'] = false;
	$temp['._.warning'] = false;
	$temp['._.reserve'] = false;
	$temp['._.done'] = null;
	$temp['._.backup'] = $post;

	# # # Converte post json em array
	$temp['post'] = (gettype($post['input']) == 'array' ? $post['input']:json_decode($post['input'], true));

	# valida processo de conversão do json
	$temp['._.process']['json_decode'] = (gettype($temp['post']) == 'array' ? true:false);

	# # # #
	# # Valida e trata os parametros do tipo PATTERN
	if ($temp['._.process']['json_decode'] == true) {
		
		if (array_key_exists('pattern', $post)) {

			if ($post['pattern'] != false) {
				// print_r($temp['post']);
				// echo "-----";
				// print_r($post['pattern']);
				// echo "-----";
				# valida pattern caso src
				if (array_key_exists('src', $post['pattern']) == true && array_key_exists('src', $temp['post']) == true) {

					# subistitui a estrutura de src para a de pattern
					$temp['post']['src'] = array_replace_recursive($temp['post']['src'], $post['pattern']['src']);
				}
			}
		}
		else { $post['pattern'] = false; }
	}
	# # Valida e trata os parametros do tipo PATTERN
	# # # #

	# inicia tratamento
	if ($temp['._.process']['json_decode'] == true) {

		# verifica se post html é um elemnto ou apenas texto
		$temp['._.process']['html_element'] =  (gettype($temp['post']['html']) == 'string' ? true:null);

		$temp['._.process']['html_content'] = (array_key_exists('content', $temp['post']) ? true:null);

		$temp['._.process']['html_style_class'] = (array_key_exists('class', $temp['post']) ? true:null);

		$temp['._.process']['html_style_inline'] = (array_key_exists('css', $temp['post']) ? true:null);

		$temp['._.process']['html_id'] = (array_key_exists('id', $temp['post']) ? true:null);

		$temp['._.process']['html_data'] = (array_key_exists('data-html', $temp['post']) ? true:null);

		$temp['._.process']['html_attr'] = (array_key_exists('attr', $temp['post']) ? true:null);

		$temp['._.process']['src'] = (array_key_exists('src', $temp['post']) ? true:null);

		$temp['._.process']['href'] = (array_key_exists('href', $temp['post']) ? true:null);

		$temp['._.process']['action'] = (array_key_exists('._.action', $temp['post']) ? true:null);


		# # # # # # # # # # # # # # # # #
		# # # # # TRARA ATRIBUTOS # # # #

		# cria elemento de reserva para os atributos do html
		$temp['._.reserve']['attr_html'] = ($temp['._.process']['html_element'] == true ? '':null);


		# # #
		# # trata data-html

	 	# inicia tratamento dos parametros de data-html

		# inicia tratamento dos parametros do tipo atributo
		if ($temp['._.process']['html_data'] == true) {

			# valida se o formato é do tipo array
			if (gettype($temp['post']['data-html']) == 'array') {

				# define aspas como dupla
				$temp['aspas'] = false;

				# loop para montar cada instancia da classe
				for ($i=0; $i < count($temp['post']['data-html']); $i++) { 

					# Caso o atributo tenha valores
					if (gettype($temp['post']['data-html'][$i]) != 'string') {

						# define aspas como dupla
						$temp['aspas'] = '"';

						# caso o value do atributo seja um array converte em string tipo json
						if (gettype($temp['post']['data-html'][$i]['value']) != 'string') {

							# converte em string=> object
							$temp['post']['data-html'][$i]['value'] = json_encode($temp['post']['data-html'][$i]['value']);
							$temp['._.process']['html_data_value'][$temp['post']['data-html'][$i]['name']][$i] = true;

							# define aspas como simples
							$temp['aspas'] = '\'';
						}

						# adiciona os atributos
						$temp['._.reserve']['attr_html'] .= ' data-'.$temp['post']['data-html'][$i]['name'].'='.$temp['aspas'].$temp['post']['data-html'][$i]['value'].$temp['aspas'];
					}

					# caso o atributo nao tenha valores, adiciona ele sem sinal de "="
					else if (gettype($temp['post']['data-html'][$i]) == 'string'){ $temp['._.reserve']['attr_html'] .= ' data-'.$temp['post']['data-html'][$i]; }
				}

				unset($temp['aspas']);
			}

			# valida se o formato é do tipo string
			else if (gettype($temp['post']['data-html']) == 'string') {

				# adiciona na estrutura o atributo
				$temp['._.reserve']['attr_html'] .= ' data-'.$temp['post']['data-html'];
			}

			# caso o formato não seja o esperado
			else {
				$temp['._.process']['html_data'] = false;
				$temp['._.warning']['html_data'] = 'Foi recebido de data-html "'.gettype($temp['post']['data-html']).'" mas era esperado um array ou string';  
			}
		}
		# remove processo DATA-HTML
		else { unset($temp['._.process']['html_data']);  }

		# # FIM: trata data-html 
		# # # 

		# # #
		# # trata src e href
		// TODO: O tipo de link de acordo com o html

		# # # Trata SRC
		if ($temp['._.process']['src'] == true) {
			// {"._.list":["source", "type", "path"], "source":{"._.required":true, "._.type":["string"]}, "path":{"._.required":false, "._.type":["string"]}}}

			if (array_key_exists('path', $temp['post']['src'])) {

				$temp['short']['input']['name'] = $temp['post']['src']['source'];
				$temp['short']['input']['type'] = $temp['post']['src']['type'];
				$temp['short']['input']['action']['path'] = $temp['post']['src']['path'];

				$temp['short']['F:file_open'] = file_open($temp['short']['input'], true);

				if ($temp['short']['F:file_open']['success'] == true) {
					$temp['._.reserve']['attr_html'] .= ' src="'.$temp['short']['F:file_open']['done'] .'"';
				}
				else { $temp['._.warning']['src'] = 'Não foi encontrado o local definido'; }

				unset($temp['short']);
			}
			else { $temp['._.reserve']['attr_html'] .= ' src="'.$temp['post']['source'] .'"'; }
		}
		# remove processo SRC
		else { unset($temp['._.process']['src']);  }

		# # # Trata HREF
		if ($temp['._.process']['href'] == true) {
			// {"._.list":["source", "path"], "source":{"._.required":true, "._.type":["string"]}, "path":{"._.required":false, "._.type":["string"]}}}

			if (array_key_exists('path', $temp['post']['href'])) {

				$temp['short']['input']['name'] = $temp['post']['href']['source'];
				$temp['short']['input']['type'] = $temp['post']['href']['type'];
				$temp['short']['input']['action']['path'] = $temp['post']['href']['path'];

				$temp['short']['F:file_open'] = file_open($temp['short']['input'], true);

				if ($temp['short']['F:file_open']['success'] == true) {
					$temp['._.reserve']['attr_html'] .= ' href="'.$temp['short']['F:file_open']['done'] .'"';
				}
				else { $temp['._.warning']['href'] = 'Não foi encontrado o local definido'; }

				unset($temp['short']);
			}
			else { $temp['._.reserve']['attr_html'] .= ' href="'.$temp['post']['source'] .'"'; }
		}
		# remove processo href
		else { unset($temp['._.process']['href']);  }

		# # trata src e href
		# # #


		# # #
		# # trata attr

		# inicia tratamento dos parametros do tipo atributo
		if ($temp['._.process']['html_attr'] == true) {

			# valida se o formato é do tipo array
			if (gettype($temp['post']['attr']) == 'array') {

				# define aspas como dupla
				$temp['aspas'] = false;

				# loop para montar cada instancia da classe
				for ($i=0; $i < count($temp['post']['attr']); $i++) { 

					// TODO: Modifica syntax do attr quando for array

					# Caso o atributo tenha valores
					if (gettype($temp['post']['attr'][$i]) == 'array') {

						# define aspas como dupla
						$temp['aspas'] = '"';

						# encurta valores encontrados atualmente
						$temp['short']['name'] = array_keys($temp['post']['attr'][$i])['0'];
						$temp['short']['value'] = array_values($temp['post']['attr'][$i])['0'];

						# caso o value do atributo seja um array converte em string tipo json
						if (gettype($temp['short']['value']) != 'string') {

							# converte em string=> object
							$temp['short']['value'] = json_encode($temp['short']['value']);
							$temp['._.process']['html_attr_value'][$temp['short']['name']][$i] = true;

							# define aspas como simples
							$temp['aspas'] = '\'';
						}

						# adiciona os atributos
						$temp['._.reserve']['attr_html'] .= ' '.$temp['short']['name'].'='.$temp['aspas'].$temp['short']['value'].$temp['aspas'];

						# apaga short
						unset($temp['short']);
					}

					# caso o atributo nao tenha valores, adiciona ele sem sinal de "="
					else { $temp['._.reserve']['attr_html'] .= ' '.$temp['post']['attr'][$i]; }
				}

				unset($temp['aspas'], $i);
			}

			# valida se o formato é do tipo string
			else if (gettype($temp['post']['attr']) == 'string') {

				# adiciona na estrutura o atributo
				$temp['._.reserve']['attr_html'] .= ' '.$temp['post']['attr'];
			}

			# caso o formato não seja o esperado
			else {
				$temp['._.process']['html_attr'] = false;
				$temp['._.warning']['html_attr'] = 'Foi recebido de attr "'.gettype($temp['post']['attr']).'" mas era esperado um array ou string';  
			}
		}
		# remove processo ATTR
		else { unset($temp['._.process']['html_attr']);  }

		# # FIM: trata attr
		# # #


		# # #
		# # trata id 

		# inicia tratamento do parametro do tipo ID
		if ($temp['._.process']['html_id'] == true) {
			
			$temp['._.reserve']['attr_html'] .= ' id="'.$temp['post']['id'].'"';
		}
		# remove processo ID
		else { unset($temp['._.process']['html_id']);  }

		# # FIM: trata id 
		# # #


		# # #
		# # trata style inline 

		# inicia tratamento do parametro do tipo ID
		if ($temp['._.process']['html_style_inline'] == true) {
			
			$temp['._.reserve']['attr_html'] .= ' style="'.$temp['post']['css'].'"';
		}
		# remove processo ID
		else { unset($temp['._.process']['html_style_inline']);  }

		# # FIM: trata style inline 
		# # #


		# # #
		# # trata classes

		# trata os parametros enviados a classe
		if ($temp['._.process']['html_style_class'] == true) {

			# valida se o formato é do tipo array
			if (gettype($temp['post']['class']) == 'array') {

				# loop para montar cada instancia da classe
				for ($i=0; $i < count($temp['post']['class']); $i++) { 

					# se for o inicio adiciona classe se nao for adiciona apenas um espaço
					$temp['._.reserve']['attr_html'] .= ($i == 0 ? ' class="':" ");

					# adiciona a classe
					$temp['._.reserve']['attr_html'] .= $temp['post']['class'][$i];

					# se for o fim fecha aspas e adiciona um espaço se nao, nao faz nada
					$temp['._.reserve']['attr_html'] .= (($i + 1) == count($temp['post']['class']) ? '"':'');
				}
			}

			# valida se o formato é do tipo string
			else if (gettype($temp['post']['class']) == 'string') {

				# se for o inicio adiciona classe se nao for adiciona apenas um espaço
				$temp['._.reserve']['attr_html'] .= ' class="'.$temp['post']['class'].'"';
			}

			# caso o formato não seja o esperado
			else { 
				$temp['._.process']['html_style_class'] = false;
				$temp['._.erro']['html_style_class'] = 'Foi recebido de classe "'.gettype($temp['post']['class']).'" mas era esperado um array ou string';  
			}
		}
		# remove processo classe
		else { unset($temp['._.process']['html_style_class']);  }

		# # FIM: trata classes
		# # #

		# # # FIM: TRARA ATRIBUTOS  # # #
		# # # # # # # # # # # # # # # # #



		# # # # # # # # # # # # # # # # #
		# # # # TRATA CONTEUDO  # # # # #

		# cria elemento de reserva para os conteudos do html
		$temp['._.reserve']['content'] = ($temp['._.process']['html_content'] == true ? '':null);

		# # #
		# # trata conteudo

		# caso seja enviado um parametro do tipo content
		if ($temp['._.process']['html_content'] == true) {
			
			# valida se contents é uma string 
			if (gettype($temp['post']['content']) == 'string') {

				# O contents é um texto simples
				$temp['._.reserve']['content'] .= $temp['post']['content'];
			}

			# valida se contents é uma array
			else if (gettype($temp['post']['content']) == 'array') {

				for ($i=0; $i < count($temp['post']['content']); $i++) { 

					$temp['F:construct_html'][$i] = construct_html(array('input'=>$temp['post']['content'][$i], 'pattern'=>$post['pattern']), true);

					$temp['._.reserve']['content'] .= $temp['F:construct_html'][$i]['done'];
				}
				unset($temp['F:construct_html']);
			}
		}
		else { unset($temp['._.process']['html_content']);  }

		# # trata conteudo
		# # #

		# # # FIM: TRATA CONTEUDO # # # #
		# # # # # # # # # # # # # # # # #

		# # # # # # # # # # # # # # # # #
		# # # # # TRATA AÇÕES # # # # # #

		# # # # 
		# # inicia tratamento de action
		if ($temp['._.process']['action'] == true) {

			// {"._.list":["source","get"],"source":{"._.//":"Nome do arquivo a ser importado, ou uma lista contendo os valores","._.required":true,"._.type":["string","array"],"._.exact":{"array":{"._.type":"string"}}},"content":{"._.//":"Refere-se ao local onde será inserido o valor","._.required":true,"._.type":["string"],"._.exact":{"string":{"._.text":["after","before","replace"]}}}}
			// TODO: Criar função para tratar condições de validação
			// {"._.list":["._.contition"],"condition":{"._.//":"Recebe os parametros de condição como if, while, for em fim","._.required":false,"._.type":["array"],"._.list":["if"],"if":{"._.//":"Valida um ou mais objetos para executar condição","._.required":false,"._.type":["array"],"._.list":["when","==","done"],"when":{"._.//":"Condição para validação","._.required":false,"._.type":["array","string"],"._.list":["ctrl_src"],"ctrl_src":{"._.//":"Seleciona a lista de strings globais, o valor deve ser setado previamente antes da solicitação da função de leitura","._.required":false,"._.type":["string"]}},"is":{"._.//":"Metodo de validação do tipo exatamente, caso array sera contado e selecionado cada um para validação do tipo or","._.required":false,"._.type":["array","string","boolean","null"]},"not":{"._.//":"Metodo de validação do tipo afirmativa negativa, caso array sera contado e selecionado cada um para validação do tipo or","._.required":false,"._.type":["array","string","boolean","null"]},"done":{"._.//":"Ação executada caso o verdadeiro qualquer uma das afirmações, e possui a mesma estrutura de \"._.action\"","._.required":true,"._.type":["array","string","boolean","null"]}}}}

			# # # 
			# # Action import source
			if (array_key_exists('._.import', $temp['post']['._.action'])) {

				// TODO: Valida parametros de "._.import"
				// TODO: Importa arquivos

				$temp['._.process']['._.action']['._.import'] = false;

				# # Trata parametros de importação caso o nome do arquivo seja mais de um
				if (gettype($temp['post']['._.action']['._.import']['source']) == 'array') {

					for ($i=0; $i < count($temp['post']['._.action']['._.import']['source']); $i++) { 

						$temp['short']['input']['name'] =  $temp['post']['._.action']['._.import']['source'][$i];
						$temp['short']['input']['type'] = 'source';
						$temp['short']['input']['action']['open'] = true;

						$temp['short']['F:file_open'] = file_open($temp['short']['input'], false);

						if ($temp['short']['F:file_open']['success'] == true) {

							$temp['._.reserve']['._.action']['._.import'][$i] = $temp['short']['F:file_open']['done'];
							$temp['._.process']['._.action']['._.import'] = true;
						}
						else { $temp['._.warning']['F:file_open'][$i] = $temp['short']['F:file_open'];  }

						unset($temp['short']);
					}
					unset($i);
				}

				# # Trata parametros de importação caso o nome do arquivo seja apenas um
				if (gettype($temp['post']['._.action']['._.import']['source']) == 'string') {

					$temp['short']['input']['name'] =  $temp['post']['._.action']['._.import']['source'];
					$temp['short']['input']['type'] = 'source';
					$temp['short']['input']['action']['open'] = true;

					$temp['short']['F:file_open'] = file_open($temp['short']['input'], false);

					if ($temp['short']['F:file_open']['success'] == true) {

						$temp['._.reserve']['._.action']['._.import'] = $temp['short']['F:file_open']['done'];
						$temp['._.process']['._.action']['._.import'] = true;
					}
					else { $temp['._.warning']['F:file_open'] = $temp['short']['F:file_open'];  }

					unset($temp['short']);
				}

				# # # #
				# # Inicia tratamento dos parametros resgatados de import
				if ($temp['._.process']['._.action']['._.import'] == true) {

					# # # 
					# # Trata cada parametro adicionado na importação
					for ($i=0; $i < count($temp['._.reserve']['._.action']['._.import']); $i++) { 

						# converte o arquivo importados
						$temp['short']['import'] = json_decode($temp['._.reserve']['._.action']['._.import'], true);

						# Valida se os parametros importados estejam estruturados como uma array
						if (gettype($temp['short']['import']) == 'array') {

							# inicia processo como false
							$temp['._.process']['._.action']['converter_._.import'][$i] = false;

							# Reserva parametros de contents já "reservados"
							$temp['short']['content'] = (array_key_exists('content', $temp['._.reserve']) ? $temp['._.reserve']['content']:null);

							# # #
							# Transforma dados recebidos na importação
							$temp['F:construct_html'] = construct_html(array('input' => $temp['short']['import'], 'pattern' => $post['pattern']), false);
							# # #

							# valida se os dados recebudos da função
							if ($temp['F:construct_html']['success'] == true) {

								# inclui dados da função em import
								$temp['short']['import'] = $temp['F:construct_html']['done'];

								# caso seja para adicionar depois
								if ($temp['post']['._.action']['._.import']['content'] == 'after') {

									$temp['._.reserve']['content'] = $temp['short']['content'].$temp['short']['import'];
								}

								# caso seja para adicionar antes
								if ($temp['post']['._.action']['._.import']['content'] == 'before') {

									$temp['._.reserve']['content'] = $temp['short']['import'].$temp['short']['content'];
								}

								# caso seja para subistitir
								if ($temp['post']['._.action']['._.import']['content'] == 'replace') {

									$temp['._.reserve']['content'] = $temp['short']['import'];
								}
							}
							unset($temp['F:construct_html']);
						}
						# Caso os parametros recebidos da importação estajam com a syntax incorretas
						else { $temp['._.process']['._.action']['converter_._.import'][$i] = false; $temp['._.warning']['._.action']['converter_._.import'][$i] = 'Não foi possivel converter a importação'; }
					}
					unset($i);
					# # # 
				}
				# # # #
			}
		}
		else { unset($temp['._.process']['action']);  }

		# # # # FIM: TRATA AÇÕES ## # # #
		# # # # # # # # # # # # # # # # #

		# # # # # # # # # # # # # # # # #
		# # # # # # TRATA HTML  # # # # #

		# Inicia tratamento dos parmetros de html
		if ($temp['._.process']['html_element'] == true) { 

			# inicia a tag do html e adiciona atributos
			$temp['._.done'] = '<'.$temp['post']['html'].$temp['._.reserve']['attr_html'];

			# # define o html como aberto
			$temp['fechado'] = false;

			# # valida condições para html fechado
			$temp['fechado'] = ($temp['post']['html'] == 'img' ? true:$temp['fechado']);
			$temp['fechado'] = ($temp['post']['html'] == 'input' ? true:$temp['fechado']);
			$temp['fechado'] = ($temp['post']['html'] == 'select' ? true:$temp['fechado']);
			$temp['fechado'] = ($temp['post']['html'] == 'button' ? true:$temp['fechado']);
			$temp['fechado'] = ($temp['post']['html'] == 'meta' ? true:$temp['fechado']);
			$temp['fechado'] = ($temp['post']['html'] == 'link' ? true:$temp['fechado']);

			# Finaliza html de acordo com sua estrutura "aberto/fechado"
			$temp['._.done'] .= ($temp['fechado'] == false ? '>'.$temp['._.reserve']['content'].'</'.$temp['post']['html'].'>':'/>'.$temp['._.reserve']['content']);

			$temp['._.process']['html_construc'] = true;
		}

		# caso o parametro solicite apenas contents "pode ser um texto"
		if ($temp['._.process']['html_element'] == null)  {

			# adiciona os valores de contents
			$temp['._.done'] = $temp['._.reserve']['content'];
		}

		# # # # # # TRATA HTML  # # # # #
		# # # # # # # # # # # # # # # # #
	}

	# caso o json tenha sido convertido
	else { $temp['._.erro']['json_decode'] = 'O arquivo está corrompido verifique se a syntax esta correta';  }

	# retorna função
	return retorna_funcao($temp, $return);
}
# # # # # FUNÇÃO DE CONSTRUÇÃO DE HTML APARTIR DE JSON  # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # FUNÇÃO DE IMPORTAÇÃO E ABERTURA DE ARQUIVOS # # # # # # # #
function file_open($post, $return) {
	// TODO: Validar o post
	// {"._.list":["name","type","action","path","source","file"],"name":{"._.//":"Nome do arquivo a ser salvo, caso null será salvo como nome declarado em map, declare \"wwwroot\" para adicionar map a $GLOBALS","._.required":true,"._.type":["string","NULL"]},"type":{"._.//":"Tipo de arquivo a ser selecionado, esse nome é declarado na raiz da estrutura do map","._.required":true,"._.type":["string"]},"action":{"._.//":"Tipo de ação a ser executada","._.required":true,"._.type":["array"],"._.list":["path","open","new"],"path":{"._.//":"\"dist\" define o caminho de distribuição, \"prod\" define os caminhos de projeto, \"wwwpatern\" define o caminho de produção porem relativo ao solicitante","._.required":true,"._.type":["string"],"._.exacly":{"string":["dist","prod","wwwpatern"]}},"open":{"._.//":"Define que será aberto um arquivo da lista de map","._.required":false,"._.type":["boolean"],"._.exacly":{"boolean":true}},"new":{"._.//":"Define que vai ser criado um novo arquivo","._.required":false,"._.type":["array"],"._.list":["file"],"file":{"._.//":"Arquivo a ser criado alocado na string","._.type":["string"],"._.required":false},"source":{"._.//":"Caminho setado pelo cliente","._.required":true,"._.type":["string"],"._.relative":{"action":{"path":null}}}}}}
	/*
	// Requer $GLOBAL: requer a seguinte extrutura $GLOBALS['settings']['wwwmap'] = $"Caminho completo do mapa de arquivos"
	*/

	$temp['._.process'] = false;
	$temp['._.success'] = false;
	$temp['._.erro'] = false;
	$temp['._.warning'] = false;
	$temp['._.reserve'] = false;
	$temp['._.done'] = null;
	$temp['._.backup'] = $post;

	# # #
	# global do nome do mapa
	$temp['file_map']['name'] = 'map.src';
	$temp['file_map']['path'] = '';
	$temp['file_map']['path_map'] = $temp['file_map']['name'].$temp['file_map']['path'];
	$temp['map'] = false;
	# # #

	# # Adiciona processo para maps em globals como false
	$temp['._.process']['globals_map'] = false;

	# # # #
	# # # Valida settings em globais
	if (array_key_exists('settings', $GLOBALS)) {

		# # # Valida se map ja foi adicionado em $globais
		if (array_key_exists('map', $GLOBALS['settings'])) {

			$temp['._.process']['globals_map'] = true;
		}

		# # # valida se local foi definido em settings
		if (array_key_exists('wwwmap', $GLOBALS['settings'])) {

			$temp['file_map']['path_map'] = $GLOBALS['settings']['wwwmap'];
		}
	}
	# # # #

	# # #
	# # Inicia importação caso map não tenha sido adicionado em 
	if ($temp['._.process']['globals_map'] == false) {

		# # #
		# Valida se o arquivo map existe
		$temp['._.process']['exist_map'] = (file_exists($temp['file_map']['path_map']) ? true:false);
		# # #

		# abre o mapa caso ele exista
		if ($temp['._.process']['exist_map'] == true) {

			# importa conteudo do mapa
			$temp['open'] = file_get_contents($temp['file_map']['path_map']);


			# transforma mapa em array
			$GLOBALS['settings']['map'] = json_decode($temp['open'], true);

			# apaga open
			unset($temp['open']);
		}
		# Retorna erro caso o mapa não abra
		else {$temp['._.erro']['exist_map'] = 'O mapa de arquivos nao foi encontrado'; }

		# # FIM: Abre o mapa de arquivos
		# # # #
	}
	else {  unset($temp['._.process']['globals_map']); }

	# # #
	# valida se o mapa foi transformado
	$temp['._.process']['converter_map'] = (gettype($GLOBALS['settings']['map']) == 'array' ? true:false);
	# # #

	# # # # # # # # #
	# # #  inicia tratamentos
	if ($temp['._.process']['converter_map'] == true) {

		# # # Valida se a solicitação esta sendo feita pra wwroot
		if ($post['name'] != 'wwwroot') {


			# # # #
			# # Trata do tipo retorna path, caso o nome tenha sido declarado e não possua a solicitação open
			/* !-- Não retorna os dados de path caso a solicitação seja open --! */
			if (gettype($post['name']) != 'NULL' && array_key_exists('open', $post['action']) == false) {

				$temp['._.process']['return_path'] = false;

				# configrua quando a soliciatação de path for para prod
				if ($post['action']['path'] == 'prod') {

					$temp['._.done'] = $GLOBALS['settings']['wwwroot'].$GLOBALS['settings']['map'][$post['type']][$post['name']]['prod'];
					$temp['._.process']['return_path'] = true;
				}

				# configrua quando a soliciatação de path for para prod
				else if ($post['action']['path'] == 'dist') {

					$temp['._.done'] = $GLOBALS['settings']['map'][$post['type']][$post['name']]['dist'];
					$temp['._.process']['return_path'] = true;
				}

				# configrua quando a soliciatação de path for para prod
				else if ($post['action']['path'] == 'wwwpatern') {

					$temp['._.done'] = $GLOBALS['settings']['wwwpatern'].$GLOBALS['settings']['map'][$post['type']][$post['name']]['prod'];
					$temp['._.process']['return_path'] = true;
				}

				else {$temp['._.erro']['return_path'] = 'O tipo de retorno é invalido, é esperado uma array "(prod) para produção ou (dist) pra distribuição"';}
			}
			// TODO: Validar se a estritura até path existe com "F:array_key_exists"
			# # Trata do tipo retorna path
			# # # #

			# # # #
			# # Trata actions do tipo abrir arquivo
			if (array_key_exists('open', $post['action'])) {

				$temp['._.process']['open'] = false;

				# Inicia o processo caso open seja true
				if ($post['action']['open'] == true) {
			
					// TODO: Validar se a estritura até path existe com "F:array_key_exists"

					# importa conteudo do mapa
					$temp['open'] = file_get_contents($GLOBALS['settings']['wwwroot'].$GLOBALS['settings']['map'][$post['type']][$post['name']]['prod']);

					# Adiciona os dados importados em done caso tenha dado certo
					$temp['._.done'] = ($temp['open'] ? $temp['open']:false);

					if ($temp['._.done'] == false) {  $temp['._.erro']['open'] = 'Não foi possivel abrir o arquivo'; }
					else { $temp['._.process']['open'] = true; }

					# apaga open
					unset($temp['open']);
				}
			}
			# # Trata actions do tipo abrir arquivo
			# # # #

			# # # #
			# # Trata quando for para criar arquivo
			if (array_key_exists('new', $post['action'])) {

				# Delcara temp new como vazio
				$temp['._.reserve']['new'] = null;

				# inicia processo de criação de arquivo como falso
				$temp['._.process']['new'] = false;

				// TODO: Valida a estrutura atual
				# valida se o nome do arquivo e o local a ser salvo
				if ($post['action']['path'] == 'dist' or $post['action']['path'] == 'wwwpatern') {

					# # # #
					# trata se o local a ser salvo é exatamente o 
					if (gettype($post['name']) == 'NULL') {

						# reserva nome do arquivo pre-declarado
						$temp['._.reserve']['new']['path'] = $GLOBALS['settings']['wwwpatern'].'dist/'.$post['action']['new']['source'];

						# declara aviso que o cliente quem definiu o caminho
						$temp['._.warning']['new'][] = 'O local foi definido pelo cliente';
					}
					// reserva path do caminho a ser salvo
					else { $temp['._.reserve']['new']['path'] = $GLOBALS['settings']['wwwpatern'].'dist/'.$temp['._.done']; }
					# # # #

					# # # #
					# valida se o arquivo vai esta sendo recebido pelo cliente e não será uma cópia
					if (array_key_exists('file', $post['action']['new'])) {

						# adiciona o conteudo enviado pelo cliente
						$temp['._.reserve']['new']['file'] = $post['action']['new']['file'];

						# declara aviso que o cliente quem definiu o caminho
						$temp['._.warning']['new'][] = 'O arquivo está sendo enviado pelo client';


						# inicia envido envio do arquivo
						$temp['._.reserve']['new']['fopen'] = fopen($temp['._.reserve']['new']['path'], 'a');

						# valida se foi possivel criar o arquivo
						if ($temp['._.reserve']['new']['fopen'] != false) {

							# Escreve no arquivo
							$temp['._.reserve']['new']['fwrire'] = fwrite($temp['._.reserve']['new']['fopen'], $temp['._.reserve']['new']['file']);
							// $temp['._.reserve']['new']['fwrire'] = fwrite($temp['._.reserve']['new']['fopen'], '{}');

							# Valida se o arquivo foi escrito
							if ($temp['._.reserve']['new']['fwrire'] != false) {

								# Define processo de criar um sucesso
								$temp['._.process']['new'] = true;

								$temp['._.done'] = true;
							}
							else { $temp['._.erro']['new'] = 'Não foi possivel escrever no arquivo'; }

							# fecha o arquivo
							fclose($temp['._.reserve']['new']['fopen']);
						}
						else { $temp['._.erro']['new'] = 'Não foi possivel criar o arquivo "'.$temp['._.reserve']['new']['path'].'"'; }
					}
					# # Valida se o arquivo vai ser apenas copiado
					else {

						# Reserva o oposto do arquivo a ser salvo, ou seja o local onde ele vai ser pego
						$temp['._.reserve']['new']['dist_prod'] = ($post['action']['path'] == 'dist' ? 'dist':'prod');

						# Reserva caminho do arquivo
						$temp['._.reserve']['new']['file'] = $GLOBALS['settings']['wwwpatern'].$GLOBALS['settings']['map'][$post['type']][$post['name']][$temp['._.reserve']['new']['dist_prod']];

						# copia o arquivo
						$temp['._.reserve']['new']['copy'] = copy($temp['._.reserve']['new']['file'], $temp['._.reserve']['new']['path']);

						# valida se o arquivo foi copiado
						if ($temp['._.reserve']['new']['copy'] == true) {

							# Define processo de criar um sucesso
							$temp['._.process']['new'] = true;

							$temp['._.done'] = true;
						}
						else { $temp['._.erro']['new'] = 'O arquivo "'.$post['name'].'" não foi copiado'; }
					}
					# # # #
				}
				else {$temp['._.erro']['new'] = 'A declaração de path "'.$post['action']['path'].'" está incorreta era esperado "dist" ou "prod"'; }

				# apaga arquivos remanecentes
				// unset($temp['._.reserve']['new']);
			}
			# # Trata quando for para criar arquivo
			# # # #
		}

		# # # Caso a solicitação seja pra root
		if ($post['name'] == 'wwwroot') { $temp['._.done'] = $GLOBALS['settings']['wwwroot']; }
	}
	# Retorna erro caso o mapa não abra
	else {$temp['._.erro']['converter_map'] = 'O map é um "'.gettype($GLOBALS['settings']['map']).'" mas era esperado uma array na conversão do json'; }


	return retorna_funcao($temp, $return);
	// return $temp['._.reserve']['new']['file'];
}
# # # # # FUNÇÃO DE IMPORTAÇÃO E ABERTURA DE ARQUIVOS # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

?>
