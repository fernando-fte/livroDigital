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

# # declara eestrutura do objeto
# $.style = {"result":"null","seletor":null,"ajax":{"action":{"content":{}, "type":null}, "license":{}}}

# # define seletor do estilo less compilado
# $.style.seletor = $('style')['0']

# # adiciona o contéúdo compilado do style
# $.style.ajax.action.content.less = $($($.style.seletor)).text()
# $.style.ajax.action.type = 'less to css'

# $.style.result = $.form $.style.ajax

# console.log $.style.result

#  Cria arquivo compilado do less
# # # #

# # # # # # # # # # # # # # # # # # # # #
# # Inicia tratamentos dos controles  # #

$.appCtrl = {} if !$.appCtrl

$.appCtrl.goto = {} if !$.appCtrl.goto

# Inicia globais de tratamentos
$.appCtrl = (post) ->
	#// Requer uma lista $('[data-ctrl]')
	temp = {"proccess":{},"erro":{},"wharning":{}, "count":{}}

	temp.proccess.post = false

	if post.length >= 1
		temp.proccess.post = true

	if temp.proccess.post is true

		temp.count.i = 0
		while temp.count.i < post.length

			console.log post[temp.count.i]

			temp.count.i++

	
	console.log post


	# # # Inicia tratamento para selecionar os movimentos
	# $.appCtrl.goto = (post) ->

	# 	if post.id 
	# 		console.log post.id

	# 	else if post.css
	# 		console.log post.css

	# 	else if post.data
	# 		console.log post.data

	# 	if post.id 
	# 		console.log 'oi'

$.appCtrl $("[data-app-ctrl]")


# # Inicia tratamentos dos controles  # #
# # # # # # # # # # # # # # # # # # # # #
