# $("img").next($(".third-item"))
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
		# return $.parseJSON(post)
		return post


	done = $.form.send {"ajax":post}

	return done

$('#enviar').bind "click", ->

	html = $('#lista').html()

	console.log $.form html
