<?php

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # FUNÇÃO DE CONSTRUÇÃO DE HTML APARTIR DE JSON  # # # # # # #
function construct_html($post, $return) {
	// {"._.list":["input"],"input":{"._.//":"Content principal dos parametros para construção do html","._.required":true,"._.type":["string","array"],"._.list":["html","id","css","class","attr","content","data-html","._.action"],"html":{"._.//":"Tipo de elemento que pode [html, p, h1] ou null para texto puro","._.required":true,"._.type":["NULL","string"]},"id":{"._.//":"Identificação do elemento, usado apenas caso o html seja valido","._.required":false,"._.type":["string"]},"content":{"._.//":"Valor a ser inserido dentro do html, podendo ser um texto simples ou uma array contendo todas as regras atuais listadas","._.required":false,"._.type":["string","array"]},"css":{"._.//":"Define um conjunto de regras css inline","._.required":false,"._.type":["string"]},"class":{"._.//":"Define conjunto de classes que deve ser descrito da seguinte forma [.classe .classe2]","._.required":false,"._.type":["array","string"]},"attr":{"._.//":"Adiciona atributos no elemento atual","._.required":false,"._.type":["array","object"]},"data-html":{"._.//":"Adiciona especificamente um atributo do tipo data-html","._.required":false,"._.type":["object","string"]},"._.action":{"._.//":"Adiciona um conjunto de regras para manipulação da estrutura atual","._.required":false,"._.type":["object"]}}}
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
					if (gettype($temp['post']['attr'][$i]) != 'string') {

						# define aspas como dupla
						$temp['aspas'] = '"';

						# caso o value do atributo seja um array converte em string tipo json
						if (gettype($temp['post']['attr'][$i]['value']) != 'string') {

							# converte em string=> object
							$temp['post']['attr'][$i]['value'] = json_encode($temp['post']['attr'][$i]['value']);
							$temp['._.process']['html_attr_value'][$temp['post']['attr'][$i]['name']][$i] = true;

							# define aspas como simples
							$temp['aspas'] = '\'';
						}

						# adiciona os atributos
						$temp['._.reserve']['attr_html'] .= ' '.$temp['post']['attr'][$i]['name'].'='.$temp['aspas'].$temp['post']['attr'][$i]['value'].$temp['aspas'];
					}

					# caso o atributo nao tenha valores, adiciona ele sem sinal de "="
					else { $temp['._.reserve']['attr_html'] .= ' '.$temp['post']['attr'][$i]; }
				}

				unset($temp['aspas']);
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

					$temp['F:construct_html'][$i] = construct_html(array('input'=>$temp['post']['content'][$i]), true);

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
							$temp['F:construct_html'] = construct_html(array('input' => $temp['short']['import']), false);
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
	//{"._.list":["name", "type", "action"], "name":{"._.required":true, "._.type":["syting"]}}
	// TODO: Validar o post

	$temp['._.process'] = false;
	$temp['._.success'] = false;
	$temp['._.erro'] = false;
	$temp['._.warning'] = false;
	$temp['._.reserve'] = false;
	$temp['._.done'] = null;
	$temp['._.backup'] = $post;

	# # #
	# global do nome do mapa
	$global['name']['map'] = 'map.src';
	$global['path']['map'] = '';
	$global['path_map'] = $global['name']['map'].$global['path']['map'];
	$global['map'] = false;
	# # #

	# # # #
	# # Abre o mapa de arquivos

	# # #
	# Valida se o arquivo map existe
	$temp['._.process']['exist_map'] = (file_exists($global['path_map']) ? true:false);
	# # #

	# abre o mapa caso ele exista
	if ($temp['._.process']['exist_map'] == true) {
		
		# importa conteudo do mapa
		$temp['open'] = file_get_contents($global['path_map']);

		# transforma mapa em array
		$global['map'] = json_decode($temp['open'], true);

		# apaga open
		unset($temp['open']);
	}
	# Retorna erro caso o mapa não abra
	else {$temp['._.erro']['exist_map'] = 'O mapa de arquivos nao foi encontrado'; }

	# # FIM: Abre o mapa de arquivos
	# # # #

	# # #
	# valida se o mapa foi transformado
	$temp['._.process']['converter_map'] = (gettype($global['map']) == 'array' ? true:false);
	# # #

	# # # # # # # # #
	# # #  inicia tratamentos
	if ($temp['._.process']['converter_map'] == true) {

		# # # #
		# # Trata do tipo retorna patch
		if (array_key_exists('path', $post['action'])) {

			$temp['._.process']['return_path'] = false;

			# configrua quando a soliciatação de patch for para prod
			if ($post['action']['path'] == 'prod') {

				$temp['._.done'] = $global['map']['wwwroot'].$global['map'][$post['type']][$post['name']]['prod'];
				$temp['._.process']['return_path'] = true;
			}

			# configrua quando a soliciatação de patch for para prod
			else if ($post['action']['path'] == 'dist') {

				$temp['._.done'] = $global['map'][$post['type']][$post['name']]['dist'];
				$temp['._.process']['return_path'] = true;
			}

			else {$temp['._.erro']['return_path'] = 'O tipo de retorno é invalido, é esperado uma array "(prod) para produção ou (dist) pra distribuição"';}
		}
		// TODO: Validar se a estritura até path existe com "F:array_key_exists"
		# # Trata do tipo retorna patch
		# # # #

		# # # #
		# # Trata actions do tipo abrir arquivo
		if (array_key_exists('open', $post['action'])) {

			$temp['._.process']['open'] = false;

			if (gettype($post['action']['open']) == 'boolean' && $post['action']['open'] == true) {
		
				// TODO: Validar se a estritura até path existe com "F:array_key_exists"

				# importa conteudo do mapa
				$temp['open'] = file_get_contents($global['map']['wwwroot'].$global['map'][$post['type']][$post['name']]['prod']);

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

	}
	# Retorna erro caso o mapa não abra
	else {$temp['._.erro']['converter_map'] = 'O map é um "'.gettype($global['map']).'" mas era esperado uma array na conversão do json'; }


	return retorna_funcao($temp, $return);
}
# # # # # FUNÇÃO DE IMPORTAÇÃO E ABERTURA DE ARQUIVOS # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #


// $temp['file'] = json_decode('{"name":"jquery", "type":"js", "action":{"path":"dist"}}', true);
$temp['file'] = json_decode('{"name":"jquery", "type":"js", "action":{"open":true}}', true);
// $temp['file']['output'] = file_open($temp['file'], 'done');

# # # #
# chama função de contrução html
$temp['html']['input'] = '{"html":"div","class":[".app-tipo-div",".text-bold"],"attr":[{"name":"name","value":{"v":"ob"}},{"name":"name","value":{"v":"ob"}},{"name":"name","value":"oi"}],"data-html":[{"name":"htmlgetsql","value":true}],"content":[{"html":"span","content":"Esse é um texto simples","class":"app-tipo-span"},{"html":null,"content":"Esse é um texto depois do elemento atual"},{"html":"span","class":".fa .fa-ico","id":"btn"}],"._.action":{"._.import":{"source":"Barra do menu","content":"after"}}}';
// $temp['html']['input'] = '{"html":"div","class":[".app-tipo-div",".text-bold"],"attr":[{"name":"name","value":{"v":"ob"}},{"name":"name","value":{"v":"ob"}},{"name":"name","value":"oi"}],"data-html":[{"name":"htmlgetsql","value":true}],"content":[{"html":"span","content":"Esse é um texto simples","class":"app-tipo-span"},{"html":null,"content":"Esse é um texto depois do elemento atual"},{"html":"span","class":".fa .fa-ico","id":"btn"}],"._.action":{}}';
// $temp['html']['output'] = construct_html($temp['html'], true);
$temp['html']['output'] = construct_html($temp['html'], 'print');

?>


<?php 

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
