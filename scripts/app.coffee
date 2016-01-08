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
	temp = {'_proccess':{'_true':false, 'goto':{}}, '_erro':{'_true':false}, '_warning':{'_true':false}, '_done':{'_true':false}, 'appCtrl':{}}


	# # # # # #
	# inicia processo de post como falso
	temp._proccess.post = false

	# valida se post recebeu algo
	if post.length >= 1
		temp._proccess.post = true
	# # # # # #


	# # # # # #
	#== valida se o processo de post é valido
	if temp._proccess.post is true

		#== inicia loop para capiturar cada item do tipo ['data-ctrl']
		i = 0
		while i < post.length

			# adiciona content para cada instancia do post
			temp.appCtrl[i] = {}

			# reserva o html
			temp.appCtrl[i].this = $(post)[i]

			# reserva as configurações
			temp.appCtrl[i].app = $(post).data().appCtrl

			#** valida se a solicitação de controle é para navegação
			if temp.appCtrl[i].app.goto

				# define processo goto atual falso
				temp._proccess.goto[i] = {}

				#// envia os parametros para a função
				temp._proccess.goto[i] = $.appCtrl.goto temp.appCtrl[i]

			#// adiciona contador no loop
			i++

	console.log temp




$.appCtrl.goto = (post) ->
	#// Requer um parametro array
	#// {"._.list":["id", "css", "cover"], "css":{"._.//":"O parametro rece uma id como referencia da navegação", "._.required":false, "._.type":["string"]}, "css":{"._.//":"O parametro recebe uma ou mais classes como referencia da navegação", "._.required":false, "._.type":["string"]}, "cover":{"._.//":"O parametro recebe o id  como referencia da navegação, e define que a capa deve ser ocultada", "._.required":false, "._.type":["array"]}}}

	#// Requer uma lista $('[data-ctrl]')
	temp = {'_proccess':{'_true':false}, '_erro':{'_true':false}, '_warning':{'_true':false}, '_done':{'_true':false}}

	if post.app.goto.id 
		#// TODO: trata quando a solicitação for id
		temp._done = 'Ainda nao existe tratamento em ID'

	else if post.app.goto.css
		#// TODO: trata quando a solicitação for class
		temp._done = 'Ainda nao existe tratamento em CLASS'

	else if post.app.goto.cover
		temp._proccess.cover = false

		# ao clicar no botão oculta a capa
		$(post.this).click ->
			$('#app-capa').addClass('page-out') # adiciona classe hidden
			temp._proccess.cover = true # define processo como um sucesso

	return temp

$.appCtrl $("[data-app-ctrl]")



# # Inicia tratamentos dos controles  # #
# # # # # # # # # # # # # # # # # # # # #
