console.log $($('#less:vg-livroDigital-style-app'))

# # #
# Envia css compilado para o php
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
		# return eval(post)
		return post


	done = $.form.send {"ajax":post}

	return done

$('div').click ->

	# declara eestrutura do objeto
	style = {"result":"null","seletor":null,"ajax":{"action":{"content":{},"type":null},"license":{}}}

	# define seletor do estilo less compilado
	style.seletor = $('style')['0']

	# adiciona o contéúdo compilado do style
	style.ajax.action.content.less = $($(style.seletor)).text()
	style.ajax.action.type = 'less to css'

	style.result = $.form style.ajax

	console.log style.result

	return false