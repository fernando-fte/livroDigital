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
	$temp['._.success'] = false;
	$temp['._.erro'] = false;
	$temp['._.warning'] = false;
	$temp['._.reserve'] = false;
	$temp['._.done'] = null;
	// $temp['._.backup'] = $post;



	# # trata dalores de done
	if ($post['action']['method'] == 'serialize') {

		parse_str($post['action']['data'], $temp['post']);

		// TODO: Valida se a estrutura corresponde ao esperado
		// $temp['._.erro']['serialize']['type'] = 'Os dados recebidos não estão completos';
		$temp['._.process']['serialize']['success'] = true;

		# # # #
		# # converte actions de _settings->selects em array
		if ($temp['._.process']['serialize']['success']) {

			$temp['select']['chave'] = array_keys($temp['post']['_settings']['select']);


			for ($i=0; $i < count($temp['select']['chave']); $i++) { 

				if (gettype($temp['post']['_settings']['select'][$temp['select']['chave'][$i]]) == 'array') {

					$temp['._.process']['converte json action'][$temp['select']['chave'][$i]] = json_decode($temp['post']['_settings']['select'][$temp['select']['chave'][$i]]['._.action'], true);

					if (gettype($temp['._.process']['converte json action'][$temp['select']['chave'][$i]]) != 'array') {

						$temp['._.erro']['converte json action'] = 'O json "'.$temp['post']['_settings']['select'][$temp['select']['chave'][$i]]['._.action'].'" de "'.$temp['select']['chave'][$i].'" está com a sintax errada';
					}
				}

				else { $temp['._.process']['converte json action'][$temp['select']['chave'][$i]] = $temp['post']['_settings']['select'][$temp['select']['chave'][$i]]; }
			}


			unset($i);
			unset($temp['select']);
		}

		# # FIM: trata cada valor de "settings">"select" e converte actions em array
		# # # #
	}





	// $temp['keys'] = array_keys($temp);
	// $done = $temp['keys'];


	// $done = $temp['._.process'];
	$done = $temp;

	if (gettype($return) == 'boolean') {

		if ($return) { print_r($done); }
		else{ return $done; }
	}
}
# # # # # # FORMULARIO DE LIVROS   # # # #
# # # # # # # # # # # # # # # # # # #

?>
