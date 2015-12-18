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






	// $done = $temp['._.process'];
	$done = $temp['._.done'];

	if (gettype($return) == 'boolean') {

		if ($return) { print_r($done); }
		else{ return $done; }
	}
}
# # # # # # FORMULARIO DE LIVROS   # # # #
# # # # # # # # # # # # # # # # # # #

?>
