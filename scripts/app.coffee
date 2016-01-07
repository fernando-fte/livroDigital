# # #
# Função de tratamento de post para o php
$.form = (post) ->

	# FUNÇÃO ENVIAR PARA PHP #
	$.form.send = (post) ->
		# # #
		# value = valores para conexao e busca no banco
		# # #

		# Função ajax
		$.ajax(
			type: "post"
			url: "php/index.php" #local no php
			cache: false
			data: post
			async: false
		)

		# resultado de retorno
		.done (data) -> 
			# console.log data # exibe valor de data
			post = data
			# console.log post
		# retorna post a solicitação com 'eval()'
		return $.parseJSON(post)
		# return post


	done = $.form.send {"ajax":post}

	return done

# # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # #

# # # #
#  Cria arquivo compilado do less

# declara eestrutura do objeto
$.style = {"result":"null","seletor":null,"ajax":{"action":{"content":{}, "type":null}, "license":{}}}

# define seletor do estilo less compilado
$.style.seletor = $('style')['0']

# adiciona o contéúdo compilado do style
$.style.ajax.action.content.less = $($($.style.seletor)).text()
$.style.ajax.action.type = 'less to css'

$.style.result = $.form $.style.ajax

console.log $.style.result

#  Cria arquivo compilado do less
# # # #
