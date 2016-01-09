<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# Inclui funções e regras pre-determinadas
#

# inclui classe de conexão ao banco de dados
# include 'sql.connect.php';

# inclui funções de tratamento e manipulação para conexão do banco de dados
include 'phpSelectSQL.php';

/*
MAPA SELECT
{"._.list":["table","where","return","regra"],"table":{"._.//":"Dados para tabela a ser selecionada","._.required":true,"._.type":["string"]},"where":{"._.//":"Campos vs valores dos campos da tabela","._.required":true,"._.type":["array"]},"return":{"._.//":"Campos a ser retornado, caso todos use um asterisco \"*\"","._.required":true,"._.type":["string","array"]},"regra":{"._.//":"Conjunto de regras para solicitação do sql","._.required":false,"._.type":["array"],"._.list":["order","limit"],"order":{"._.//":"Ordena as respostas recebidas a partir de array(\"to\", \"by\")","._.required":false,"._.type":["array"],"._.list":["to","by"],"to":{"._.//":"Define o campo a ser ordenado","._.required":false,"._.type":["string"]},"by":{"._.//":"Define a ordem ASC (crescente) ou DESC (decrecente)","._.required":false,"._.type":["string"]}},"limit":{"._.//":"Por default o limite é \"1\", para exibir todos defina como \"0\" ou o numero de respostas que deseja","._.required":false,"._.type":["integer"]}}}

MAPA INSERT
{"._.list":["table","values"],"table":{"._.//":"Dados para tabela a ser selecionada","._.required":true,"._.type":["string"]},"values":{"._.//":"Campos vs valores, relativos aos dados a serem inseridos","._.required":true,"._.type":["array"]}}

MAPA UPDATE
{"._.list":["table","where","values","return","regra"],"table":{"._.//":"Dados para tabela a ser selecionada","._.required":true,"._.type":["string"]},"where":{"._.//":"Campos vs valores dos campos da tabela","._.required":true,"._.type":["array"]},"values":{"._.//":"Campos vs valores, relativos aos dados a serem inseridos","._.required":true,"._.type":["array"]},"regra":{"._.//":"Conjunto de regras para solicitação do sql","._.required":false,"._.type":["array"],"._.list":["order","limit"],"order":{"._.//":"Ordena as respostas recebidas a partir de array(\"to\", \"by\")","._.required":false,"._.type":["array"],"._.list":["to","by"],"to":{"._.//":"Define o campo a ser ordenado","._.required":false,"._.type":["string"]},"by":{"._.//":"Define a ordem ASC (crescente) ou DESC (decrecente)","._.required":false,"._.type":["string"]}},"limit":{"._.//":"Por default o limite é \"1\", para exibir todos defina como \"0\" ou o numero de respostas que deseja","._.required":false,"._.type":["integer"]}}}

MAPA DELETE
{"._.list":["table","where","regra"],"table":{"._.//":"Dados para tabela a ser selecionada","._.required":true,"._.type":["string"]},"where":{"._.//":"Campos vs valores dos campos da tabela","._.required":true,"._.type":["array"]},"regra":{"._.//":"Conjunto de regras para solicitação do sql","._.required":false,"._.type":["array"],"._.list":["order","limit"],"order":{"._.//":"Ordena as respostas recebidas a partir de array(\"to\", \"by\")","._.required":false,"._.type":["array"],"._.list":["to","by"],"to":{"._.//":"Define o campo a ser ordenado","._.required":false,"._.type":["string"]},"by":{"._.//":"Define a ordem ASC (crescente) ou DESC (decrecente)","._.required":false,"._.type":["string"]}},"limit":{"._.//":"Por default o limite é \"1\", para exibir todos defina como \"0\" ou o numero de respostas que deseja","._.required":false,"._.type":["integer"]}}}
*/

#
# Fim de "Inclui funções e regras pre-determinadas"
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #




?>
