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

$.appCtrl.togo = {} if !$.appCtrl.togo

# Inicia globais de tratamentos
$.appCtrl = (post) ->
	#// Requer uma lista $('[data-ctrl]')
	temp = {'_proccess':{'_true':false, 'togo':{}, 'display':{}}, '_erro':{'_true':false}, '_warning':{'_true':false}, '_done':{'_true':false}, 'appCtrl':{}}


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
			temp.appCtrl[i].app = $($(post)[i]).data().appCtrl

			#** valida se a solicitação de controle é para navegação
			if temp.appCtrl[i].app.togo

				# define processo togo atual falso
				temp._proccess.togo[i] = {}

				#// envia os parametros para a função
				temp._proccess.togo[i] = $.appCtrl.togo temp.appCtrl[i]

			#** valida se a solicitação é para exibir alguma caixa de dialogo
			if temp.appCtrl[i].app.display

				# define processo togo atual falso
				temp._proccess.display[i] = $.appCtrl.display temp.appCtrl[i]

			#** valida se a solicitação é para tratar a apresentação
			if temp.appCtrl[i].app.apr

				# define processo togo atual falso
				temp._proccess.apr[i] = $.appCtrl.apr temp.appCtrl[i]

			#// adiciona contador no loop
			i++

	console.log temp


$.appCtrl.togo = (post) ->
	#// Requer um parametro array
	#// {"display":{"._.required":false,"._.list":["id","css","closset"],"._.type":["array"],"id":{"._.//":"O parametro rece uma id como referencia da navegação","._.required":false,"._.type":["string"]},"css":{"._.//":"O parametro recebe uma ou mais classes como referencia da navegação","._.required":false,"._.type":["string"]},"closset":{"._.//":"O parametro define quando \"false\" procura nos filhos e quando \"true\" procura acima, e só e valido no caso de css","._.required":false,"._.type":["boolean"],"._.relative":{"css":true}},"toogle":{"._.//":"Parametro para alternar o display caso esse esteja ativo, pode ser classe ou ID","._.required":false,"._.type":["array"]}}}

	#// Requer uma lista $('[data-ctrl]')
	temp = {'_proccess':{'_true':false}, '_erro':{'_true':false}, '_warning':{'_true':false}, '_done':{'_true':false}}

	if post.app.togo.id 
		#// TODO: trata quando a solicitação for id
		temp._done = 'Ainda nao existe tratamento em ID'

	else if post.app.togo.css
		#// TODO: trata quando a solicitação for class
		temp._done = 'Ainda nao existe tratamento em CLASS'

	else if post.app.togo.cover
		temp._proccess.cover = false

		# ao clicar no botão oculta a capa
		$(post.this).click ->
			$('#app-capa').addClass('page-out') # adiciona classe hidden
			temp._proccess.cover = true # define processo como um sucesso

	return temp

$.appCtrl.display = (post) ->
	#// {{"display":{"._.required":false,"._.list":["put","who","toogle"],"._.type":["array"],"put":{"._.//":"O parametro rebe uma ID ou uma classe a ser aplicado o display","._.required":true,"._.type":["string"]},"who":{"._.//":"Define onde sera aplicado o parametro","._.required":false,"._.type":["boolean"],"._.exacly":{"string":["closset","child","this"]}},"toogle":{"._.//":"Parametro para alternar o display caso esse esteja ativo, pode ser classe ou ID","._.required":false,"._.type":["array"]}}}
	temp = {'_proccess':{'classe_base':null, '_true':false}, '_erro':{'_true':false}, '_warning':{'_true':false}, '_done':{'_true':false}}

	# define classe base
	temp.classe_base = 'app-display';

	# caso o display seja removido
	if post.app.display.no
		# muda classe base
		temp.classe_base = 'app-no-display';

	# console.log post
	$(post.this).click ->
		# caso o item deva ser o unico a ser exibido, valida se existe uma lista a ser oculta
		if post.app.display.toogle
			i = 0
			while i < post.app.display.toogle.length
				# remove a classe 
				$(post.app.display.toogle[i]).removeClass('app-no-display')
				$(post.app.display.toogle[i]).removeClass('app-display')
				i++

		# valida onde sera aplicado o display
		switch post.app.display.who

			when 'this'
				$(post.this).addClass(temp.classe_base)
				temp._done = true

			when 'closest'
				$($(post.this).closest(post.app.display.put)).addClass(temp.classe_base)
				temp._done = true

			when 'child'
				$($(post.this).find(post.app.display.put)).addClass(temp.classe_base)
				temp._done = true

			when 'all'
				$(post.app.display.put).addClass(temp.classe_base)
				temp._done = true

	return temp

$.appCtrl.apr = (post) ->
	# {"apr":{"._.required":false,"._.list":["method"],"._.type":["array"],"method":{"._.//":"Parametro para toogle de video e texto da apresentão","._.required":true,"._.type":["string"],"._.exacly":["video","texto"]}}}
	temp = {'_proccess':{'_true':false}, '_erro':{'_true':false}, '_warning':{'_true':false}, '_done':{'_true':false}}

	# console.log post
	$(post.this).click ->
		$($(this).closest('.app-apr-item')).toggleClass('app-apr-display-video')
		temp._done = true

	return temp




$.appCtrl $("[data-app-ctrl]")



# # Inicia tratamentos dos controles  # #
# # # # # # # # # # # # # # # # # # # # #
