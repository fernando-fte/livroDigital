$.form = (post) ->

	# FUNÇÃO ENVIAR PARA PHP #
	$.form.send = (post) ->
		# # #
		# value = valores para conexao e busca no banco
		# # #

		# Função ajax
		$.ajax(
			type: "post"
			url: "index.php" #local no php
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

	done = $.form.send post

	return done


$('#form-envia').click ->

	# declara estrutura
	# form = {"ajax":{"user":{"nome":null,"log":null},"action":{"type":null,"change":{"segmento":null,"grupo":null,"classe":null,"ordem":null,"valores":{"_.method":null, "serialize":null}}}}}
	form = {"ajax":{"user":{}, "action":{}}}

	# modifica estrutura
	form.ajax.user.nome = 'Fernando Truculo Evangelista'
	form.ajax.user.log = '@log{0001}'

	form.ajax.action.type = $("input[name=input-from-action]").val()
	form.ajax.action.method = 'serialize'

	# form.ajax.action.change.segmento = 'Livro'
	# form.ajax.action.change.grupo = 'Nome do livro'
	# form.ajax.action.change.classe = 'info'
	# form.ajax.action.change.ordem = '0'

	form.ajax.action.serialize = $('form').serialize()

	console.log $.form form

	# pausa o envio do fromulario
	return false
