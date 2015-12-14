<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# Inclui funções e regras pre-determinadas
#

# inclui classe de conexão ao banco de dados
# include 'sql.connect.php';

# inclui funções de tratamento e manipulação para conexão do banco de dados
include 'phpSelectSQL.php';

#
# Fim de "Inclui funções e regras pre-determinadas"
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #


# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # #  SELECT # # # # # # # # # # # # # # # 



// $post['table'] = 'base';
// $post['values']['0'] = 'a123456789';
// $post['values']['1'] = '{"titulo":"A linda estrada","autor":"Alfredo Gustavo"}';
// $post['values']['2'] = 'livro';
// $post['values']['3'] = 'livro';
// $post['values']['4'] = 'Nome do livro';
// $post['values']['5'] = '0';

// $done = insert($post, false);

// print_r($done);

$post['table'] = 'base';

$post['where']['2'] = 'livro';
$post['where']['4'] = 'Nome do livro';

$post['return'] = '1';

$done = select($post, false);

print_r($done);




?>
