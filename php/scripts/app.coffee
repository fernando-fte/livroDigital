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
		# return post

	# # # # # # # # # # # # #
	done = {}
	proccess = {}
	erro = false
	temp = {}
	reserve = {'post':post}

	# valida se foi passado um paramero de action
	if post.action
		proccess.action = true

		if post.action.type
			proccess.type = true

		else
			done = false
			erro = {} if !erro
			erro.fatal = 'Declare o "type" da ação a ser executada pelo php'
	else
		done = false
		erro = {} if !erro
		erro.fatal = 'Declare "action" para a ação a ser executada pelo php'

	# valida se os requisitos minimos existem
	if proccess.action is true and proccess.type is true

		done = $.form.send {"ajax":post}

		console.log done
		console.log $.parseJSON(done)

	change = {'done':done, 'proccess':proccess, 'erro':erro, 'temp':temp, 'reserve':reserve}
	return change

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

$.appCtrl.togo = {} if !$.appCtrl.togo

$.appCtrl.login = {} if !$.appCtrl.login

# Inicia globais de tratamentos
$.appCtrl = (post) ->
	#// Requer uma lista $('[data-ctrl]')
	done = {}
	proccess = {}
	erro = false
	temp = {}
	reserve = {'post':post}
	temp.appCtrl = {}

	# # # # # #
	# inicia processo de post como falso
	proccess.post = false

	# valida se post recebeu algo
	if post.length >= 1
		proccess.post = true
	# # # # # #


	# # # # # #
	#== valida se o processo de post é valido
	if proccess.post is true

		#== inicia loop para capiturar cada item do tipo ['data-ctrl']
		i = 0
		while i < post.length

			# cria processo para o item atual
			proccess[i] = {}

			# adiciona content para cada instancia do post
			temp.appCtrl[i] = {}

			# reserva o html
			temp.appCtrl[i].this = $(post)[i]

			# reserva as configurações
			temp.appCtrl[i].app = $($(post)[i]).data().appCtrl

			# TODO: Mudar configuração que os parametros assumen para passar para a função
			#** valida se a solicitação é para tratar o login
			if temp.appCtrl[i].app.login
				proccess[i].login = true

				# valida se os parametros estão inseridos
				proccess[i].login = false if temp.appCtrl[i].app.login.login is undefined # valida se tem ação login
				proccess[i].login = false if temp.appCtrl[i].app.login.password is undefined # valida se existe senha
				proccess[i].login = false if temp.appCtrl[i].app.login.user is undefined # valida se existe user
				proccess[i].login = false if temp.appCtrl[i].app.login.start is undefined # valida se existe botão de login
				proccess[i].login = false if temp.appCtrl[i].app.login.remember is undefined # valida se existe botão de relembrar
				# console.log

				# valida se o processo pode ser válido
				if proccess[i].login is true

					# reserva this
					temp.appCtrl[i].app.login['._.this'] = temp.appCtrl[i].this

					# envia para a função
					temp.done = $.appCtrl.login temp.appCtrl[i].app.login 

					# valida se a função não teve erros
					if temp.done.erro is false
						done[i] = {} if !done[i]
						done[i].login = true

					# valida se a função teve erros
					else
						erro = {} if !erro
						erro[i] = {'login':{'log':temp.done.erro, 'feed':'Houve um erro no na função de login', 'this':temp.appCtrl[i].this}}

				# caso so valor seja incorreto
				else
					erro = {} if !erro
					erro[i] = {'login':{'post':temp.appCtrl[i].app.login, 'feed':'Os requisitos minimos nao foram encontrados veja POST', '._.this':temp.appCtrl[i].this}}
					delete(temp.done)

				# proccess

				# # adiciona dentro da função o this
				# temp.appCtrl[i].app.login.this = temp.appCtrl[i].this

				# # envia para a função
				# console.log $.appCtrl.login

			#// adiciona contador no loop
			i++

	# console.log temp
	change = {'done':done, 'proccess':proccess, 'erro':erro, 'temp':temp, 'reserve':reserve}
	return change

# # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # #


# TODO: Mudar a proposição dos temps

$.appCtrl.login = (post) ->
	done = {}
	proccess = {}
	erro = false
	temp = {}
	reserve = {'post':post}

	# valida funções basicas necessarias
	proccess.functionExistis = true
	proccess.functionExistis = false if typeof(md5) != 'function' and proccess.functionExistis
	# # # #

	# só vai poder ser executado caso exista as funções obrigatórias
	if proccess.functionExistis is true

		# quando o login for verdadeiro deve tratar-se de um acessar
		if post.login is true

			# reserva seletores
			temp.start = $(post['._.this']).find($(post.start))
			temp.user = $(post['._.this']).find($(post.user))
			temp.password = $(post['._.this']).find($(post.password))
			temp.remember = $(post['._.this']).find($(post.remember))

			# valida os seletores
			proccess.node_start = true if temp.start.length > 0
			proccess.node_user = true if temp.user.length > 0
			proccess.node_password = true if temp.password.length > 0
			proccess.node_remember = true if temp.remember.length > 0

			# # Inicia interação para login
			if proccess.node_start is true and proccess.node_user is true and proccess.node_password is true

				# desativa botão caso estejam vazios
				$(temp.start).addClass('disabled') if temp.user.val() == '' or temp.password.val() == ''
				
				# Caso escreva no campo user
				temp.user.bind 'input', ->
					$(temp.start).removeClass('disabled') if $(temp.start).hasClass('disabled') if temp.password.val() != ''
					$(temp.start).addClass('disabled') if $(this).val() == ''

				# Caso escreva no campo senha
				temp.password.bind 'input', ->
					$(temp.start).removeClass('disabled') if $(temp.start).hasClass('disabled') if temp.user.val() != ''
					$(temp.start).addClass('disabled') if $(this).val() == ''

				# envia o formulário
				temp.start.click ->

					# vaso o botão esteja ativo envia as informações para o servidor
					if !$(temp.start).hasClass('disabled')
						temp.client = {'user':(md5 temp.user.val()), 'password':(md5 temp.user.val()), 'remember':temp.remember.is(":checked"), 'client':{'user':(md5 navigator.appVersion), 'navigator':"#{navigator.appVersion}"}}
						done = $.form {'action':{'type':'login', 'content':temp.client}}

						# console.log done

			else
				erro = {} if !erro
				erro.autenticação = {'post':post, 'feed':'Os seletores passados não são válidos'}

	# adiciona erro fatal na função
	else
		erro = {} if !erro
		done = false
		erro.fatal = 'Uma das funções obrigatórias não foram incluidas'
		# # #


	change = {'done':done, 'proccess':proccess, 'erro':erro, 'temp':temp, 'reserve':reserve}

	# console.log change
	return change

# # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # #


$.appCtrl $("[data-app-ctrl]")
# console.log  $.appCtrl $("[data-app-ctrl]")

# # Inicia tratamentos dos controles  # #
# # # # # # # # # # # # # # # # # # # # #
# console.log $('code').text(md5 navigator)
# console.log $('code').text(md5 navigator.appVersion)
# console.log $('code').text(navigator)
# console.log navigator.appVersion
