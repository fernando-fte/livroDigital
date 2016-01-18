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
	temp = {'_proccess':{'_true':false, 'togo':{}, 'display':{}, 'apr':{}, 'atividade':{}}, '_erro':{'_true':false}, '_warning':{'_true':false}, '_done':{'_true':false}, 'appCtrl':{}}


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

				# declara processo atual
				temp._proccess.apr[i] = {}

				# define processo togo atual falso
				temp._proccess.apr[i] = $.appCtrl.apr temp.appCtrl[i]

			#** valida se a solicitação é para tratar as atividades
			if temp.appCtrl[i].app.atividade

				# declara processo atual
				temp._proccess.atividade[i] = {}

				# define processo togo atual falso
				temp._proccess.atividade[i] = $.appCtrl.atividade temp.appCtrl[i]

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

			$('.app-page').removeClass('app-display').queue ->

				$(this).addClass('app-no-display') # Adicioan oculta

			temp._proccess.cover = true # define processo como um sucesso

	return temp

$.appCtrl.display = (post) ->
	# {"display":{"._.required":false,"._.list":["put","who","toogle"],"._.type":["array"],"put":{"._.//":"Define o seletor a receber os parametros app-display, pode receber um #ID ou .class","._.required":true,"._.type":["string"]},"who":{"._.//":"Define onde sera encontrado o seletor de @{put} para aplicar os parametros","._.required":false,"._.type":["boolean"],"._.exacly":{"string":["closset","child","this"]}},"toogle":{"._.//":"Define um grupo para ser removido os parametros app-display, deve receber um #ID ou .class","._.required":false,"._.type":["array"],"._.exacly":{"array":"string"}},"no":{"._.//":"Define o parametro app-no-display no seletor de @{put}","._.required":false,"._.type":["bolean"],"._.exacly":{"bolean":"true"}},"inverse":{"._.//":"Define uma ação de ativar/desativar nos parametros de app-display, no mesmo acionador @_{this}","._.required":false,"._.type":["bolean"],"._.exacly":{"bolean":"true"}}}}
	temp = {'_proccess':{'classe_base':null, '_true':false}, '_erro':{'_true':false}, '_warning':{'_true':false}, '_done':{'_true':false}}

	# console.log post
	$(post.this).click ->

		# define classe base
		temp.classe_base = 'app-display';

		# caso o display seja removido
		if post.app.display.no
			# muda classe base
			temp.classe_base = 'app-no-display';

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

		# configrua inversão altomática da ação do botão
		if post.app.display.inverse
			
			# caso o display não esteja imprimindo
			if !post.app.display.no
				post.app.display.no = true

			# caso o display esteja imprimindo
			else if post.app.display.no
				post.app.display.no = false

	return temp

$.appCtrl.apr = (post) ->
	# {"apr":{"._.required":false,"._.list":["method"],"._.type":["array"],"method":{"._.//":"Parametro para toogle de video e texto da apresentão","._.required":true,"._.type":["string"],"._.exacly":["video","texto"]}}}
	temp = {'_proccess':{'_true':false}, '_erro':{'_true':false}, '_warning':{'_true':false}, '_done':{'_true':false}}

	# console.log post
	$(post.this).click ->
		$($(this).closest('.app-apr-item')).toggleClass('app-apr-display-video')
		temp._done = true

	return temp

$.appCtrl.atividade = (post) ->
	# {"atividade":{"._.required":true,"._.list":["change","true","avaliar"],"._.type":["array"],"change":{"._.//":"Valida se a altarnativa é valida","._.required":true,"._.type":["boolean"]},"true":{"._.//":"Valida se a alternativa é valida","._.required":true,"._.type":["boolean"]},"avaliar":{"._.//":"Ativa botão de avaliação mais próximo","._.required":false,"._.type":["boolean"],"._.exacly":{"boolean":"true"}}}}
	# post.app.atividade
	# post.this
	temp = {'_proccess':{'_true':false}, '_erro':{'_true':false}, '_warning':{'_true':false}, '_done':{'_true':false}, 'btn':{}}

	temp._proccess._true = true
	# adiciona configruação caso a atividade esteja ativa
	if post.app.atividade.change is true
		$(post.this).addClass('true') if post.app.atividade.true is true
		$(post.this).addClass('false') if post.app.atividade.true is false
		temp._proccess.change = true
	
	# ao clicar
	$(post.this).click ->

		# caso a resposta seja automatica
		if !post.app.atividade.avaliar

			if post.app.atividade.change is false

				# caso a atividade seja verdadeira
				if post.app.atividade.true is true
					post.app.atividade.change = true
					$(this).addClass('true')
					$(this).data("appCtrl", post.app)
					# TODO: Salva dados do cliente

				# caso a atividade seja  falsa
				if post.app.atividade.true is false
					post.app.atividade.change = true
					$(this).addClass('false') 
					$(this).data("appCtrl", post.app)
					# TODO: Salva dados do cliente

		# caso a resposta seja por confirmação
		if post.app.atividade.avaliar

			if post.app.atividade.change is false

				$(post.this).toggleClass('on')

				$(this).closest('.app-ati-item').find('.app-ati-item-change').click ->

					$(post.this).closest('.app-ati-item').find('.app-ati-alternativa-item').addClass('off')
					$(post.this).closest('.app-ati-item').find('.app-ati-alternativa-item.on').removeClass('off')

					# caso a atividade seja verdadeira
					if post.app.atividade.true is true
						post.app.atividade.change = true
						$(post.this).addClass('true')
						$(post.this).removeClass('off')
						$(post.this).data("appCtrl", post.app)
						# TODO: Salva dados do cliente

					# caso a atividade seja  falsa
					if post.app.atividade.true is false
						post.app.atividade.change = true
						$(post.this).addClass('false') 
						$(post.this).removeClass('off')
						$(post.this).data("appCtrl", post.app)
						# TODO: Salva dados do cliente


	return temp


$.appCtrl $("[data-app-ctrl]")


# # Inicia tratamentos dos controles  # #
# # # # # # # # # # # # # # # # # # # # #
