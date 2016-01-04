<?php

  //== Especificações da estrutura de comando para contrução do html
  //{"._.list":["html","id","content","after","before","style","attr","html-data","._.action"],"html":{"._.//":"Tipo de elemento que pode [html, p, h1] ou null para texto puro","._.required":true,"._.type":["NULL","string"]},"id":{"._.//":"Identificação do elemento, usado apenas caso o html seja valido","._.required":false,"._.type":["string"]},"content":{"._.//":"Valor tipo texto para ser inserido no elemento","._.required":false,"._.type":["string"]},"after":{"._.//":"Adiciona antes deste contexto um novo indice","._.required":false,"._.type":["array","string"]},"before":{"._.//":"Adiciona após este contexto um novo indice","._.required":false,"._.type":["array","string"]},"style":{"._.//":"Conjunto de estilos inline","._.required":false,"._.type":["object"],"._.list":["class","inline"],"class":{"._.//":"Define conjunto de classes que deve ser descrito da seguinte forma [.classe .classe2]","._.required":false,"._.type":["array","string"]},"inline":{"._.//":"Define um conjunto de regras css inline","._.required":false,"._.type":["string"]}},"attr":{"._.//":"Adiciona atributos no elemento atual","._.required":false,"._.type":["array","object"]},"html-data":{"._.//":"Adiciona especificamente um atributo do tipo data-html","._.required":false,"._.type":["object","string"]},"._.action":{"._.//":"Adiciona um conjunto de regras para manipulação da estrutura atual","._.required":false,"._.type":["object"]}}

  $post = '
{
  "html": "div",
  "class": [
    ".app-tipo-div",
    ".text-bold"
  ],
  "attr":[{"name":"name", "value":{"v":"ob"}}, {"name":"name", "value":{"v":"ob"}}, {"name":"name", "value":"oi"}],
  "data-html":[{"name":"htmlgetsql", "value":true}],
  "after": [
    {
      "html": "span",
      "content": "Esse é um texto simples",
      "class": "app-tipo-span"
    },
    {
      "html": null,
      "content": "Esse é um texto depois do elemento atual"
    },
    {
      "html": "span",
      "class": ".fa .fa-ico",
      "id": "btn"
    }
  ]
}
  ';


function construct_html ($post, $return) {

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

	// $temp['._.process']['F_form_serialize']
	// $temp['._.process']['F_form_monta_parametros']

	# # # Converte post json em array
	$temp['post'] = (gettype($temp['post']) == 'array' ? $temp['post']:json_decode($post, true);

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
				$temp['._.erro']['html_data'] = 'Foi recebido de data-html "'.gettype($temp['post']['data-html']).'" mas era esperado um array ou string';  
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
				$temp['._.erro']['html_attr'] = 'Foi recebido de attr "'.gettype($temp['post']['attr']).'" mas era esperado um array ou string';  
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
					$temp['._.reserve']['attr_html'] .= (($i + 1) == count($temp['post']['class']) ? '" ':'');
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
		# # # # TRARA CONTEUDO  # # # # #


		# cria elemento de reserva para os conteudos do html
		$temp['._.reserve']['content'] = ($temp['._.process']['html_content'] == true ? '':null);

		# # #
		# # trata conteudo
			
		if ($temp['._.process']['html_content'] == true) {
			
			# valida se contents é uma string 
			if (gettype($temp['._.reserve']['content']) == 'string') {

				# O contents é um texto simples
				$temp['._.reserve']['content'] .= $temp['._.process']['html_content'];
			}

			else if (gettype($temp['._.reserve']['content']) == 'array') {

				for ($i=0; $i < count($temp['._.reserve']['content']); $i++) { 
					
					//TODO loop da função
				}
			}
		}

		# # trata conteudo
		# # #

		# # # FIM: TRARA CONTEUDO # # # #
		# # # # # # # # # # # # # # # # #


		# # #
		# # trata after

		if ($temp['._.process']['html_style_class'] == true) { 

		}

		# # FIM: trata after
		# # #
	}

	# caso o json tenha sido convertido
	else { $temp['._.erro']['json_decode'] = 'O arquivo está corrompido verifique se a syntax esta correta';  }


	retorna_funcao($temp, $return);
}


construct_html($post, 'print');

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
