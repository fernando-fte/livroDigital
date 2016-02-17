htmlConstruct = (post) ->
	done = {}
	proccess = {}
	erro = {}
	temp = {}

	# valida o post
	if post.start is 'json'
		proccess.json = true
		
		if !post.dom is false and post.dom.length > 0
			proccess.dom = true

	# valida o post caso seja para construir o html
	if post.start is 'html'
		proccess.html = true

		# converte em json caso seja uma string
		if typeof(post.json) is 'string'
			proccess.parser_json = true
			post.json = JSON.parse(post.json) 

		# valida se o json é um objeto
		if !post.json is false and typeof(post.json) is 'object'
			proccess.object = true

			if !post.json['._.list'] and !post.json[0]
				proccess.object = false
				erro.object = 'A estrutura recebida é incompatível'


	# Declara tipo do processo caso post vedadeiro
	if proccess.json and proccess.dom
		proccess.start = 'constructJSON'

	if proccess.html and proccess.object
		proccess.start = 'constructHTML'

	# # # # 
	# inicia construção do HTML
	if proccess.start is 'constructHTML'

		# seleciona a camada atual
		i = 0
		while i < post.json['._.list'].length

			# # # #
			# valida se a estrutura minima existe      
			erro[i] = []
			erro[i].push 'Não foi declarado NODE' if !post.json[i].node
			erro[i].push 'Não foi declarado Content' if post.json[i].content is undefined
			erro[i].push 'Não foi declarado attr' if post.json[i].attr is undefined
			if !post.json[i].content is undefined
				erro[i].attr = 'Não foi declarada lista de conteudos' if !post.json[i].content['._.list']
			if !post.json[i].attr is undefined
				erro[i].attr = 'Não foi declarada lista de atributos' if !post.json[i].attr['._.list']
			
			proccess.trata = false
			if erro[i].length <= 0
				proccess.trata = true
				delete(erro[i])
			# # # #  

			# caso os dados estejam corretos
			if proccess.trata is true
				temp.html = '' if temp.html is undefined
				temp.content = ''

				# caso o node nao seja de texto puro
				if post.json[i].node != '@text'
					# inicia html
					temp.html = "#{temp.html}<#{post.json[i].node}"

					# post.json[i].attr.class = ["viva", "vai", "ok"]
						
					# caso as classes estejam divididas
					if post.json[i].attr.class
						if typeof(post.json[i].attr.class) is 'object'
							u = 0
							temp.class = ''
							while u < post.json[i].attr.class.length
								temp.class = post.json[i].attr.class[u] if u is 0
								temp.class = "#{temp.class} #{post.json[i].attr.class[u]}" if u > 0
								u++
							post.json[i].attr.class = temp.class
							delete(temp.class)
							u = undefined
					# # # #

					# Configura atributos do html
					if post.json[i].attr['._.list'] != undefined
						u = 0
						while u < post.json[i].attr['._.list'].length

							# caso o atributo seja simples
							if typeof(post.json[i].attr[post.json[i].attr['._.list'][u]]) is 'string'
								temp.html = "#{temp.html} #{post.json[i].attr['._.list'][u]}=\"#{post.json[i].attr[post.json[i].attr['._.list'][u]]}\""
							
							# caso o atributo seja um objeto
							else if typeof(post.json[i].attr[post.json[i].attr['._.list'][u]]) is 'object'
								temp.html = "#{temp.html} #{post.json[i].attr['._.list'][u]}='#{JSON.stringify(post.json[i].attr[post.json[i].attr['._.list'][u]])}'"
							
							# caso o atributo seja mudo
							else if post.json[i].attr[post.json[i].attr['._.list'][u]] is false
								temp.html = "#{temp.html} #{post.json[i].attr['._.list'][u]}"

							u++
						u = undefined
					
					if !post.json[i].content is false
						temp.content = htmlConstruct {'start':'html', 'json':post.json[i].content, 'seletor':'#content'}

						# caso content um sucesso adiciona estrutura
						if !temp.content._erro.length > 0
							temp.content = temp.content._done
						else
							temp.content = ''
							erro[i] = {}
							erro[i].content = 'Erro no conteúdo de contents'
							erro[i].log = temp.content._erro

					if post.json[i].node is 'input' or post.json[i].node is 'img' or post.json[i].node is 'meta' or post.json[i].node is 'br'
						temp.html = "#{temp.html}/>#{temp.content}"
					else
						temp.html = "#{temp.html}>#{temp.content}</#{post.json[i].node}>"

				# caso o node seja texto puro
				else
					temp.html = "#{temp.html}#{post.json[i].content}"

			i++
		
		i = undefined
		
		done = temp.html

	# finaliza construção do HTML
	# # # # 
		

	# # # # 
	# inicia contrução do JSON
	if proccess.start is 'constructJSON'
		# define vetores para ID
		done['._.id'] = {}
		done['._.id']['._.list'] = []

		# define vetor de lista
		done['._.list'] = []

		i = 0
		while i < post.dom.length
			done[i] = {}

			# adiciona o item atual a lista de done

			# adiciona dados do elemento
			done[i].node = post.dom[i].localName if post.dom[i].localName
			done[i].attr = {}
			done[i].content = false
			
			# caso seja um texto simples
			if post.dom[i].nodeName is '#text' 
				done[i].node = '@text'
				done[i].content = {}
				done[i].content = post.dom[i].textContent
				done[i].attr = false

			# adiciona na lista o done
			done['._.list'].push post.dom[i]

			# Adiciona ID nos elementos sem ID
			if post.dom[i].id is '' and !post.dom[i].id and  done[i].node != '@text' and  done[i].node != 'input' and done[i].node != 'meta' and done[i].node != 'img'
				$(post.dom[i]).attr('id', md5(microtime() + $(post.dom[i]).text()))

				if done['._.id'][$(post.dom[i])[0].id] != undefined
					$(post.dom[i]).attr('id', md5(microtime() + $(post.dom[i])[0].id))
				

			if post.dom[i].attributes is undefined
				done[i].attr = false

			# inicia tratamento de atributos      
			if done[i].attr != false and post.dom[i].attributes.length > 0

				done[i].attr['._.list'] = []

				u = 0
				while u < post.dom[i].attributes.length

					# adiciona atributo
					done[i].attr[post.dom[i].attributes[u].name] = post.dom[i].attributes[u].value

					# caso o atributo seja vazio
					done[i].attr[post.dom[i].attributes[u].name] = false if post.dom[i].attributes[u].value is ''

					# caso o atributo seja um data json
					if post.dom[i].attributes[u].name.indexOf('data-') >= 0

						if post.dom[i].attributes[u].value.indexOf('"') >= 0
							# console.log post.dom[i].attributes[u].value
							done[i].attr[post.dom[i].attributes[u].name] = JSON.parse(post.dom[i].attributes[u].value)
						
					# lista os atributos
					done[i].attr['._.list'].push post.dom[i].attributes[u].name

					u++
				# apaga contador
				u = undefined

				# reserva os dados do elemento caso ele tenha id
				if done[i].attr.id
					
					# caso o ID já exista neste nível adiciona (1)
					done[i].attr.id = md5(microtime() + done[i].attr.id) if done['._.id'][done[i].attr.id]

					# adiciona na lista o nome do id
					done['._.id']['._.list'].push done[i].attr.id
					
					# reserva conteudo do elemento id
					done['._.id'][done[i].attr.id] = {}
					done['._.id'][done[i].attr.id]['@text'] = post.dom[i].innerText
					done['._.id'][done[i].attr.id]['dom'] = "#{i}"

			else
				done[i].attr = false
			
			# trata os elementos internos
			if post.dom[i].childNodes.length > 0

				# reserva contents
				temp.content = htmlConstruct {'start':'json', 'dom':post.dom[i].childNodes}

				# caso nao exista erro
				if !temp.content._erro.length

					# incrementa contents
					done[i].content = {}

					# reserva lista de itens
					done[i].content['._.list'] = temp.content._done['._.list']

					# reserva os conteudos
					u = 0
					while u < temp.content._done['._.list'].length

						# seleciona item por item
						done[i].content[u] = temp.content._done[u]

						u++

					# apaga contador
					u = undefined

					# reserva os ids
					if temp.content._done['._.id']['._.list'].length > 0

						u = 0
						while u < temp.content._done['._.id']['._.list'].length

							# trata dom atual
							temp.content._done['._.id'][temp.content._done['._.id']['._.list'][u]].dom = "#{i}>#{temp.content._done['._.id'][temp.content._done['._.id']['._.list'][u]].dom}"

							done['._.id']['._.list'][done['._.id']['._.list'].length] = temp.content._done['._.id']['._.list'][u]
							done['._.id'][temp.content._done['._.id']['._.list'][u]] = temp.content._done['._.id'][temp.content._done['._.id']['._.list'][u]]
							u++

						# apaga contador
						u = undefined

				# caso exista erro
				else
					erro.content = temp.content._erro
					

			i++
		# apaga contador
		i = undefined
	
	# finaliza construção do JSON
	# # # #


	# caso nao tenha iniciado nada
	if !proccess.start
		erro.fatal = 'Nao foi iniciado nem um processos, veja o post'


	# return {'_proccess':proccess, '_done':done, '_erro':erro, '_post':post}
	return {'_proccess':proccess, '_done':done, '_erro':erro}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# element = $('[data-book-livro]')
# json = htmlConstruct {'start':'json', 'dom':element}
# console.log json._done
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

### envia valores para o servidor
$('#load_php').click ->
	temp.select = {"where":{"segmento":"autor", "grupo":$('[data-book-autor-nome]').text()}, "return":"._.sku", "type":"select", "limit":0}

	$.form {"action":{"type":"add livro", "content":temp.select}}
###

temp = {}


trata_html_basico = (seletor) ->

	# # # # # #
	# reconfigura todos os elementos do tipo seção
	sections = $(seletor).find '[data-book-section]'
		# console.log this

	i = 0
	while i < $(seletor).find('[src]').length
		
		$($(seletor).find('[src]')[i]).attr('src', "library/#{(md5 $($('#parse').find('[data-book-livro]')).text())}/#{$($(seletor).find('[src]')[i]).attr('src')}")
		i++
	i = undefined

	$(seletor).find('a').attr('target', '_blank')

	# # # 
	# Configura labels

	temp.label = $(seletor).find '[data-book-section-label]'
	u = 0
	while u < temp.label.length

		$(temp.label[u]).replaceWith($.parseHTML "<p class=\"h1-sub\"><b>#{$(temp.label[u]).data().bookSectionLabel}:</b> #{$(temp.label[u]).html()}</p>")
		u++
	delete(temp.label)
	delete(temp.section)


	i = 0
	while i < sections.length

		if $(sections[i]).find('[data-book-fonte]').length > 0
			$(sections[i]).append($.parseHTML "<span class=\"app-fonte\"><span class=\"label\">Fonte</span>#{$(sections[i]).find('[data-book-fonte]').html()}</span>")
			$(sections[i]).find('[data-book-fonte]').remove()

		switch $(sections[i]).data().bookSection
			when 1
				head = 'Fique por dentro'
				classe = 'app-box-section'
				content = $(sections[i]).html()

			when 2
				head = 'Reflita'
				classe = 'app-box-section'
				content = $(sections[i]).html()

			when 3
				head = 'Indicação de leitura'
				classe = 'app-box-leitura'
				$(sections[i]).find('[data-book-section-content]').replaceWith("<p>#{$(sections[i]).find('[data-book-section-content]').html()}</p>")
				content = $(sections[i]).html()

			when 4
				head = 'Indicação de filme'
				classe = 'app-box-filme'
				$(sections[i]).find('[data-book-section-content]').replaceWith("<p>#{$(sections[i]).find('[data-book-section-content]').html()}</p>")
				content = $(sections[i]).html()

			else
				console.log $(sections[i])[0]

		val = "
		<div class=\"app-box #{classe}\">
			<div class=\"app-box-head\">#{head}</div>
			<div class=\"app-box-content\">#{content}</div>
		</div>
		"
		$(sections[i]).replaceWith($.parseHTML val)

		i++
	i = undefined
	# reconfigura todos os elementos do tipo seção
	# # # # # #

	# # # # # #
	# reconfigura todos os elementos graficos

	unidade = $(seletor).find '[data-book-unidade]'

	u = 0

	while u < unidade.length

		# reconfigura todos os elementos graficos
		graphic = $(unidade[u]).find '[data-book-graphic=1]'
		temp.graphic = {}
		i = 0
		while i < graphic.length

			temp.graphic.classe = 'app-graphic-table'
			temp.graphic.content = "<table class=\"app-graphic-item on tb\">#{$(graphic[i]).find('[data-book-graphic-item]').html()}</table>"
			temp.graphic.legenda = "#{$(graphic[i]).find('[data-book-legenda]').html()}"
			temp.graphic.ctrl = false
			temp.graphic.fonte = $(graphic[i]).find('[data-book-fonte]')

			if $(temp.graphic.fonte).length > 0
				temp.graphic.fonte_content = ''
				x = 0
				while x < $(temp.graphic.fonte).length

					temp.graphic.fonte_label = 'Fonte' if $(temp.graphic.fonte[x]).data().bookFonte is 'fonte'
					temp.graphic.fonte_label = 'Último acesso' if $(temp.graphic.fonte[x]).data().bookFonte is 'acesso'
					temp.graphic.fonte_content = temp.graphic.fonte_content+"<span class=\"app-fonte\"><span class=\"label\">#{temp.graphic.fonte_label}</span>#{$(temp.graphic.fonte[x]).html()}</span>"
					x++
				x = undefined 

			val = "
			<div class=\"app-graphic-content #{temp.graphic.classe}\">
				#{
			if temp.graphic.ctrl is true
				'<div class=\"app-graphic-ctrl\"><span class=\"app-graphic-previous\"></span><span class=\"app-graphic-show\"></span><span class=\"app-graphic-next\"></span></div>'
			else
				''
				}

				<div class=\"app-graphic-content-nav\">#{temp.graphic.content}</div>

				<div class=\"app-grapc-content-caption\">
					<span class=\"app-legenda\">
						<span class=\"label\"><span class=\"app-sequence-this\">#{(i+1)}</span><span class=\"app-sequence-all\">#{graphic.length}</span></span>#{temp.graphic.legenda}
					</span>

					#{temp.graphic.fonte_content}
				</div>
			</div>
			"
			$(graphic[i]).replaceWith($.parseHTML val)

			i++

		i = undefined

		# reconfigura todos os elementos graficos
		graphic = $(unidade[u]).find '[data-book-graphic=2]'
		temp.graphic = {}
		i = 0

		while i < graphic.length
			temp.graphic.classe = 'app-graphic-figure'
			temp.graphic.content = "<img src=\"#{$(graphic[i]).find('[data-book-graphic-item]').attr('src')}\" class=\"app-graphic-item on\"/>"
			temp.graphic.legenda = "#{$(graphic[i]).find('[data-book-legenda]').html()}"

			# TODO: Valida todas as figruas
			temp.graphic.ctrl = false

			temp.graphic.fonte = $(graphic[i]).find('[data-book-fonte]')

			if $(temp.graphic.fonte).length > 0

				temp.graphic.fonte_content = ''
				x = 0
				while x < $(temp.graphic.fonte).length

					temp.graphic.fonte_label = 'Fonte' if $(temp.graphic.fonte[x]).data().bookFonte is 'fonte'
					temp.graphic.fonte_label = 'Último acesso' if $(temp.graphic.fonte[x]).data().bookFonte is 'acesso'
					temp.graphic.fonte_content = temp.graphic.fonte_content+"<span class=\"app-fonte\"><span class=\"label\">#{temp.graphic.fonte_label}</span>#{$(temp.graphic.fonte[x]).html()}</span>"
					x++
				x = undefined

			val = "
			<div class=\"app-graphic-content #{temp.graphic.classe}\">
				#{
			if temp.graphic.ctrl is true
				'<div class=\"app-graphic-ctrl\"><span class=\"app-graphic-previous\"></span><span class=\"app-graphic-show\"></span><span class=\"app-graphic-next\"></span></div>'
			else
				''
				}

				<div class=\"app-graphic-content-nav\">#{temp.graphic.content}</div>

				<div class=\"app-grapc-content-caption\">
					<span class=\"app-legenda\">
						<span class=\"label\"><span class=\"app-sequence-this\">#{(i+1)}</span><span class=\"app-sequence-all\">#{graphic.length}</span></span>#{temp.graphic.legenda}
					</span>

					#{temp.graphic.fonte_content}
				</div>
			</div>
			"
			$(graphic[i]).replaceWith($.parseHTML val)

			i++

		i = undefined

		# reconfigura todos os elementos graficos
		graphic = $(unidade[u]).find '[data-book-graphic=3]'
		temp.graphic = {}
		i = 0
		while i < graphic.length

			temp.graphic.classe = 'app-graphic-video'

			temp.graphic.content = "<iframe width=\"100%\" height=\"100%\" data-video-src=\"https://drive.google.com/file/d/#{$($(graphic[i]).find('[data-book-graphic-item]')).text()}/preview\"></iframe>"

			temp.graphic.legenda = "#{$(graphic[i]).find('[data-book-legenda]').html()}"

			# TODO: Valida todas as figruas
			temp.graphic.ctrl = false

			temp.graphic.fonte_content = ''

			val = "
			<div class=\"app-graphic-content #{temp.graphic.classe}\">
				#{
			if temp.graphic.ctrl is true
				'<div class=\"app-graphic-ctrl\"><span class=\"app-graphic-previous\"></span><span class=\"app-graphic-show\"></span><span class=\"app-graphic-next\"></span></div>'
			else
				''
				}

				<div class=\"app-graphic-content-nav\">#{temp.graphic.content}</div>

				<div class=\"app-grapc-content-caption\">
					<span class=\"app-legenda\">
						<span class=\"label\"><span class=\"app-sequence-this\">#{(i+1)}</span><span class=\"app-sequence-all\">#{graphic.length}</span></span>#{temp.graphic.legenda}
					</span>

					#{temp.graphic.fonte_content}
				</div>
			</div>
			"
			$(graphic[i]).replaceWith($.parseHTML val)

			i++

		i = undefined

		u++

	u = undefined
	# reconfigura todos os elementos graficos


	# configura atividades
	atividade = $(seletor).find '[data-book-atividade]'
	temp.atividade = {}
	i = 0
	while i < atividade.length

		temp.atividade.item = $(atividade[i]).find('[data-book-atividade-item]')

		temp.atividade.content = ''
		u = 0
		while u < temp.atividade.item.length

			$(temp.atividade.item[u]).data().bookAtividadeItem = null if $(temp.atividade.item[u]).data().bookAtividadeItem is ''

			temp.atividade.content += "<li data-app-ctrl=\'{\"atividade\":{\"avaliar\":false,\"change\":false,\"true\":#{$(temp.atividade.item[u]).data().bookAtividadeItem}}}\' class=\"app-ati-alternativa-item\">
				<span class=\"alternativa\">#{$(temp.atividade.item[u]).find('[data-book-atividade-alternativa]').html()}</span>
				<span class=\"feedback\">#{$(temp.atividade.item[u]).find('[data-book-atividade-feed]').html()}</span>
			</li>"

			u++
		u = undefined


		# console.log atividade[i]
		val = "<div class=\"app-box app-box-atividade\">
			<div class=\"app-box-head\">Atividades</div>
			<div class=\"app-box-content app-ati-item\">
				<p class=\"app-ati-enunciado\">#{$(atividade[i]).find('[data-book-atividade-questao]').html()}</p>
				<ul class=\"app-ati-alternativa-content\">
					#{temp.atividade.content}
				</ul>
			</div>
		</div>"

		$(atividade[i]).replaceWith($.parseHTML val)
		i++
	i = undefined



	# configura atividades
	referencias = $(seletor).find '[data-book-referencias-item]'
	temp.referencias = {}
	i = 0
	while i < referencias.length

		temp.referencias.item = referencias[i]

		if $(referencias[i]).data().bookReferenciasItem is ''

			$(referencias[i]).replaceWith($.parseHTML "<p>#{$(referencias[i]).html()}</p>")

		else
			$(referencias[i]).replaceWith($.parseHTML "<p class=\"app-ref-link\"><a href=\"#{$(referencias[i]).data().bookReferenciasItem}\">#{$(referencias[i]).html()}</a></p>")
		i++
	i = undefined


	articles = $(seletor).find 'article>h1'
	i = 0
	while i < articles.length

		$(articles[i].closest('article')).attr('data-app-ctrl', "{\"navigation\":{\"section\":\"Unidade #{$(articles[i].closest('[data-book-unidade]')).data('book-unidade')}\", \"page\":\"#{$(articles[i]).text()}\"}}")
		$(articles[i].closest('article')).addClass('section-page-item')

		i++
	i = undefined


	articles = $(seletor).find 'article>h2'
	i = 0
	while i < articles.length

		$(articles[i].closest('article')).attr('data-app-ctrl', "{\"navigation\":{\"section\":\"Unidade #{$(articles[i].closest('[data-book-unidade]')).data('book-unidade')}\", \"page\":\"#{$(articles[i]).text()}\"}}")
		$(articles[i].closest('article')).addClass('section-page-item-sub')

		i++
	i = undefined


	blockquote = $(seletor).find 'blockquote'
	temp.blockquote = {}
	i = 0
	while i < blockquote.length

		
		if $($(blockquote[i])[0]).find('[data-book-fonte]').length > 0
			$(blockquote[i]).append("<span class=\"app-fonte\">#{$($(blockquote[i])[0]).find('[data-book-fonte]').html()}</span>")
			
			$($(blockquote[i])[0]).find('[data-book-fonte]').remove()

		
		i++
	i = undefined


	fontes = $(seletor).find '[data-book-fonte]'
	temp.fontes = {}
	i = 0
	while i < fontes.length
		
		$(fontes[i]).replaceWith($.parseHTML "<span class=\"app-fonte\">#{$(fontes[i]).html()}</span>")
		i++
	i = undefined

	# console.log fontes.text()
	# console.log $(".oo").text()

trata_html_basico $('#parse')


compila_html_basico = (seletor) ->
	unidade = $(seletor).find('[data-book-unidade]')
	render = {}
	render.unidade = []
	render.sumario = []
	temp = {}
	temp.unidade = {}
	temp.unidade.numero = ['I', 'II', 'III', 'IV']
	temp.sumario = {}
	i= 0
	while i < unidade.length

		u = 0
		temp.unidade.autor = ''
		while u < $(unidade[i]).find('[data-book-unidade-autor]').length
			temp.unidade.autor += "<span class=\"app-cap-abertura-autor text-italic font-lg-4 font-md-small-3 font-sm-3 font-ss-small-3 font-xs-2 col-lg-9 col-md-8 col-sm-9 col-ss-10 col-xs-11 col-lg-offset-3 col-md-offset-4 col-sm-offset-3 col-ss-offset-2 col-xs-offset-1\">#{$($(unidade[i]).find('[data-book-unidade-autor]')[u]).html()}</span>"
			u++
		u = undefined

		# console.log htmlConstruct {'start':'json', 'dom':$(unidade[i]).find('[data-book-unidade-content]')}

		temp.unidade.content = (htmlConstruct {'start':'json', 'dom':$.parseHTML $(unidade[i]).find('[data-book-unidade-content]').html()})['_done']
		temp.unidade.id = md5 "#{$(seletor).find('[data-book-livro]').text()} - Unidade #{temp.unidade.numero[($(unidade[i]).data('book-unidade') - 1)]}"

		# console.log md5 "#{$(seletor).find('[data-book-livro]').text()} - Unidade #{temp.unidade.numero[($(unidade[i]).data('book-unidade') - 1)]}"
		render.unidade.push "
		<div id=\"#{temp.unidade.id}\" class=\"app-cap-section section-page\">
			<div data-app-ctrl='{\"navigation\":{\"section\":\"Unidade #{temp.unidade.numero[($(unidade[i]).data('book-unidade') - 1)]}\",\"page\":\"Introdução\"}}' class=\"app-cap-abertura section-page-item clearfix app-cor-white app-font-app\">
				<div class=\"app-cap-capa\" style=\"background-image: url(#{$(unidade[i]).find('[data-book-unidade-capa]').attr('src')})\">
					<span class=\"app-cap-abertura-topo text-bold text-uppercase padding-none-width font-lg-6 font-md-5 font-sm-5 font-ss-4 font-xs-4 col-lg-12 col-md-12 col-sm-12 col-ss-12 col-xs-12\"><span class=\"col-lg-2 col-md-2 col-sm-2 col-ss-2 col-xs-1\"></span>Unidade #{temp.unidade.numero[($(unidade[i]).data('book-unidade') - 1)]}</span>
					<span class=\"app-cap-abertura-titulo text-bold font-lg-12 font-md-10 font-sm-8 font-ss-7 font-xs-6 col-lg-9 col-md-8 col-sm-10 col-ss-10 col-xs-11 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-ss-offset-2 col-xs-offset-1\">#{$(unidade[i]).find('[data-book-unidade-titulo]').html()}</span>
					#{temp.unidade.autor}
				</div>
				<div id=\"#{md5 microtime() + $(unidade[i]).find('[data-book-unidade-introducao]').html()}\" class=\"app-cap-introducao col-lg-9 col-md-8 col-sm-9 col-ss-10 col-xs-11 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-ss-offset-2 col-xs-offset-1\">#{$(unidade[i]).find('[data-book-unidade-introducao]').html()}</div>
			</div>
			<div class=\"app-cap-content\">
				#{(htmlConstruct {'start':'html', 'json':temp.unidade.content})['_done']}
			</div>
		</div>
		"
		# console.log $($.parseHTML render.unidade[i])[0]



		temp.sumario.content = ''
		temp.sumario.content += "
			<div class=\"app-sum-section\">
				<div class=\"app-sum-section-item app-sum-section-header app-font-app padding-none-right col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-2 font-md-small-2 font-sm-small-2 font-ss-small-2 font-xs-small-2\">
					<span data-app-ctrl='{\"togo\":{\"to\":\"#{temp.unidade.id}\"}}' class=\"app-sum-section-secao app-cor-black-80 text-uppercase text-bold padding-none-width col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-small-4 font-md-small-3 font-sm-2 font-ss-small-4 font-xs-small-3\">Unidade #{temp.unidade.numero[($(unidade[i]).data('book-unidade') - 1)]}</span>
					<span data-app-ctrl='{\"togo\":{\"to\":\"#{temp.unidade.id}\"}}' class=\"app-sum-section-titulo app-cor-black-60 padding-none-width col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-4 font-md-3 font-sm-3 font-ss-4 font-xs-3\">#{$(unidade[i]).find('[data-book-unidade-titulo]').html()}</span>
				</div>
		"

		temp.sumario.undiades =  $.parseHTML "<div>#{(htmlConstruct {'start':'html', 'json':temp.unidade.content})['_done']}</div>"

		u = 0
		temp.sumario.h1 = ''
		while u < $(temp.sumario.undiades).find('article>h1').length

			temp.sumario.content += "
				<div class=\"app-sum-section-item app-font-header padding-none-width col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-2\">
					<span data-app-ctrl='{\"togo\":{\"to\":\"#{$(temp.sumario.undiades).find('article>h1')[u].id}\"}}' class=\"sum-section-name app-cor-black-80 text-uppercase text-bold col-md-11 col-sm-11 col-ss-11 col-xs-11\">#{$($(temp.sumario.undiades).find('article>h1')[u]).text()}</span>
					<span data-app-ctrl='{\"display\":{\"put\":\".app-sum-section-item\",\"who\":\"closest\",\"toogle\":[\".app-sum-section-item\"],\"inverse\":true}}' class=\"app-sum-btn-icon-sub col-md-1 col-sm-1 col-ss-1 col-xs-1 font-md-4 font-sm-4 font-ss-4 font-xs-4\"></span>
					<div class=\"app-sum-section-sub col-md-12 col-sm-12 col-ss-12 col-xs-12\">
			"

			x = 0
			while x < $($(temp.sumario.undiades).find('article>h1')[u]).closest('article').find('.section-page-item-sub').length

				temp.sumario.content += "
							<span data-app-ctrl='{\"togo\":{\"to\":\"#{$($(temp.sumario.undiades).find('article>h1')[u]).closest('article').find('.section-page-item-sub')[x].id}\"}}' class=\"app-sum-section-item app-sum-section-sub-item col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-small-3 font-md-2 font-sm-2 font-ss-small-3 font-xs-2\">#{$($($(temp.sumario.undiades).find('article>h1')[u]).closest('article').find('.section-page-item-sub')[x]).find('h2').text()}</span>
				"
				x++
			x = undefined

			temp.sumario.content += "
					</div>
				</div>
			"
			u++
		u = undefined

		temp.sumario.content += "
			</div>
		"
		render.sumario.push temp.sumario.content

		i++
	i = undefined

	temp.capa = {}
	temp.capa.autor = ''

	i = 0
	while i < $($(seletor).find '[data-book-autor-nome]').length
		temp.capa.autor += "<span class=\"cover-fachada app-text-autor\">#{$($($(seletor).find '[data-book-autor-nome]')[i]).text()}</span>"
		i++
	i = undefined

	temp.capa.unidade = ''
	if $(seletor).find('[data-book-unidade]').length is 1
		temp.capa.unidade = "<br><span class=\"small\">Unidade #{temp.unidade.numero[($(seletor).find('[data-book-unidade]').data('book-unidade') - 1)]}</span>"

	render.capa = "
	<div id=\"app-capa\" style=\"background-image: url(#{$($(seletor).find '[data-book-capa]').attr('src')})\" class=\"app-page app-cover app-display\">
		<div class=\"cover-contents col-md-11 col-notspace\">
			<span class=\"cover-fachada app-text-livro\">#{$($(seletor).find '[data-book-livro]').text()}#{temp.capa.unidade}</span>
			#{temp.capa.autor}
		</div>
		<span data-app-ctrl='{\"togo\":{\"to\":\"sumario\",\"cover\":false}}' class=\"cover-btn-iniciar app-ico-iniciar col-lg-2 col-md-3 col-sm-4 col-ss-4 col-lg-offset-5 col-md-offset-4 col-sm-offset-3 col-ss-offset-3\">
		</span>
		<div class=\"cover-logo-group\">
			<img src=\"img/logo.pos.white.svg\" class=\"cover-logo-item logo-pos\">
			<img src=\"img/logo.white.svg\" class=\"cover-logo-item logo-instituicao\">
		</div>
		<div class=\"cover-nav-bar col-md-1 col-notspace row\">
			<span class=\"cover-btn-nav btn-nav-menu\">
				<span class=\"app-ico-menu\"></span>
			</span>
			<span data-app-ctrl='{\"togo\":{\"to\":\"sumario\",\"cover\":false}}' class=\"cover-btn-nav\">
				<span class=\"app-ico-sumario\"></span>
				<span class=\"cover-btn-tooltip\">Sumário</span>
			</span>
			<span data-app-ctrl='{\"togo\":{\"to\":\"atividades\",\"cover\":false}}' class=\"cover-btn-nav\">
				<span class=\"app-ico-atividade\"></span>
				<span class=\"cover-btn-tooltip\">Atividades</span>
			</span>
			<span data-app-ctrl='{\"togo\":{\"to\":\"autor\",\"cover\":false}}' class=\"cover-btn-nav\">
				<span class=\"app-ico-autor\"></span>
				<span class=\"cover-btn-tooltip\">Autores</span>
			</span>
			<span data-app-ctrl='{\"togo\":{\"to\":\"referencias\",\"cover\":false}}' class=\"cover-btn-nav\">
				<span class=\"app-ico-referencia\"></span>
				<span class=\"cover-btn-tooltip\">Referências</span>
			</span>
		</div>
	</div>
	"

	# console.log $(render.capa)[0]

	temp.sum_header = ''

	temp.autores = {}
	temp.autores.content = ''

	i = 0
	while i < ($(seletor).find('[data-book-autor]')).length

		temp.autores.titulacao = ''
		u = 0
		while u < $(($(seletor).find('[data-book-autor]'))[i]).find('[data-book-autor-titulacao-item]').length
			temp.autores.titulacao += "<span class=\"h1-sub app-titulacao sub\">#{$($(($(seletor).find('[data-book-autor]'))[i]).find('[data-book-autor-titulacao-item]')[u]).html()}</span>"

			u++
		u = undefined

		temp.autores.content += "
		<div id=\"#{md5 $(($(seletor).find('[data-book-autor]'))[i]).find('[data-book-autor-nome]').text()}\" data-app-ctrl='{\"navigation\":{\"section\":\"Autores\",\"page\":\"#{$(($(seletor).find('[data-book-autor]'))[i]).find('[data-book-autor-nome]').text()}\"}}' class=\"app-apr-item section-page-item app-apr-display-texto\">
			<h1 class=\"app-apr-item-titulo\">#{$(($(seletor).find('[data-book-autor]'))[i]).find('[data-book-autor-nome]').text()}</h1>
			#{temp.autores.titulacao}
			<div class=\"app-apr-item-content\">
				<div class=\"app-apr-item-texto\">
					<img src=\"#{$(($(seletor).find('[data-book-autor]'))[i]).find('[data-book-autor-img]').attr('src')}\" class=\"app-apr-item-avatar\">
					#{$($(($(seletor).find('[data-book-autor]'))[i]).find('[data-book-autor-info]')).html()}
				</div>
			</div>
		</div>
		"

		temp.sum_header += "
		<div class=\"app-sum-section-item app-font-header padding-none-width col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-2 font-md-2 font-sm-2 font-ss-2 font-xs-2\">
			<span data-app-ctrl='{\"togo\":{\"to\":\"#{md5 $(($(seletor).find('[data-book-autor]'))[i]).find('[data-book-autor-nome]').text()}\"}}' class=\"sum-section-name app-cor-black-80 text-uppercase text-bold col-md-11 col-sm-11 col-ss-11 col-xs-11\">#{$(($(seletor).find('[data-book-autor]'))[i]).find('[data-book-autor-nome]').text()}</span>
		</div>
		"

		i++
	i = undefined

	render.autor = "
	<div id=\"autor\" class=\"app-apr-contents section-page\">
		#{temp.autores.content}
	</div>
	"
	render.sumario.unshift "
	<div class=\"app-sum-section app-sum-section-sections\">
		<div class=\"app-sum-section-item app-sum-section-header app-font-app padding-none-right col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-2 font-md-small-2 font-sm-small-2 font-ss-small-2 font-xs-small-2\">
			<span  data-app-ctrl='{\"togo\":{\"to\":\"autor\"}}' class=\"app-sum-section-secao app-cor-black-80 text-uppercase text-bold padding-none-width col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-small-4 font-md-small-3 font-sm-2 font-ss-small-4 font-xs-small-3\">Autores</span>
		</div>

		#{temp.sum_header}

		<div class=\"app-sum-section-item app-sum-section-header app-font-app padding-none-right col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-2 font-md-small-2 font-sm-small-2 font-ss-small-2 font-xs-small-2\">
			<span  data-app-ctrl='{\"togo\":{\"to\":\"introducao\"}}' class=\"app-sum-section-secao app-cor-black-80 text-uppercase text-bold padding-none-width col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-small-4 font-md-small-3 font-sm-2 font-ss-small-4 font-xs-small-3\">Introdução</span>
		</div>

		<div class=\"app-sum-section-item app-sum-section-header app-font-app padding-none-right col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-2 font-md-small-2 font-sm-small-2 font-ss-small-2 font-xs-small-2\">
			<span  data-app-ctrl='{\"togo\":{\"to\":\"conclusao\"}}' class=\"app-sum-section-secao app-cor-black-80 text-uppercase text-bold padding-none-width col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-small-4 font-md-small-3 font-sm-2 font-ss-small-4 font-xs-small-3\">Conclusão</span>
		</div>

		<div class=\"app-sum-section-item app-sum-section-header app-font-app padding-none-right col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-2 font-md-small-2 font-sm-small-2 font-ss-small-2 font-xs-small-2\">
			<span  data-app-ctrl='{\"togo\":{\"to\":\"referencias\"}}' class=\"app-sum-section-secao app-cor-black-80 text-uppercase text-bold padding-none-width col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-small-4 font-md-small-3 font-sm-2 font-ss-small-4 font-xs-small-3\">Referências</span>
		</div>

		<div class=\"app-sum-section-item app-sum-section-header app-font-app padding-none-right col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-2 font-md-small-2 font-sm-small-2 font-ss-small-2 font-xs-small-2\">
			<span  data-app-ctrl='{\"togo\":{\"to\":\"atividades\"}}' class=\"app-sum-section-secao app-cor-black-80 text-uppercase text-bold padding-none-width col-md-12 col-sm-12 col-ss-12 col-xs-12 font-lg-small-4 font-md-small-3 font-sm-2 font-ss-small-4 font-xs-small-3\">Atividades</span>
		</div>
	</div>
	"
	# console.log $(render.autor)[0]

	render.referencias = "
	<div id=\"referencias\" class=\"section-page app-ref\">
		<h1 class=\"app-ref-head\">Referências</h1>
		<div id=\"referencias_item\" data-app-ctrl='{\"navigation\":{\"section\":\"Referências\",\"page\":false}}' class=\"app-ref-content section-page-item\">
			#{$($(seletor).find '[data-book-referencias]').html()}
		</div>
	</div>
	"
	# console.log $(render.referencias)[0]

	render.introducao = "
	<div id=\"introducao\" class=\"app-apr-contents section-page\">

		<div id=\"#{md5 $($(seletor).find('[data-book-introducao-text]')).html()}\" data-app-ctrl='{\"navigation\":{\"section\":\"Introdução\",\"page\":false}}' class=\"app-apr-item section-page-item app-apr-display-texto\">
			<div data-app-ctrl='{\"apr\":true}' class=\"app-apr-item-ctrl app-cor-pattern font-lg-6 font-md-6 font-sm-5 font-ss-4 font-xs-3\">
				<span class=\"app-ico-video\"></span>
				<span class=\"app-ico-texto\"></span>
			</div>
			<h1 class=\"app-apr-item-titulo\">Introdução</h1>
			<div class=\"app-apr-item-content\">
				<div class=\"app-apr-item-texto\">
					#{$($(seletor).find('[data-book-introducao-text]')).html()}
				</div>
				<div class=\"app-apr-item-video\">
					<span class=\"app-bg-pattern\">
						<iframe width=\"100%\" height=\"100%\" data-video-src=\"https://drive.google.com/file/d/#{$(seletor).find('[data-book-introducao-video]').data().bookIntroducaoVideo}/preview\"></iframe>
					</span>
				</div>
			</div>
		</div>
	</div>
	"
	# console.log $(render.introducao)[0]
	render.conclusao = "
	<div id=\"conclusao\" class=\"app-apr-contents section-page\">
		<div id=\"#{md5 $($(seletor).find('[data-book-conclusao-text]')).html()}\" data-app-ctrl='{\"navigation\":{\"section\":\"Conclusão\",\"page\":false}}' class=\"app-apr-item section-page-item app-apr-display-texto\">
			<div data-app-ctrl='{\"apr\":true}' class=\"app-apr-item-ctrl app-cor-pattern font-lg-6 font-md-6 font-sm-5 font-ss-4 font-xs-3\">
				<span class=\"app-ico-video\"></span>
				<span class=\"app-ico-texto\"></span>
			</div>
			<h1 class=\"app-apr-item-titulo\">Conclusão</h1>
			<div class=\"app-apr-item-content\">
				<div class=\"app-apr-item-texto\">
					#{$($(seletor).find('[data-book-conclusao-text]')).html()}
				</div>
				<div class=\"app-apr-item-video\">
					<span class=\"app-bg-pattern\">
						<iframe width=\"100%\" height=\"100%\" data-video-src=\"https://drive.google.com/file/d/#{$(seletor).find('[data-book-conclusao-video]').data('book-conclusao-video')}/preview\"></iframe>
					</span>
				</div>
			</div>
		</div>
	</div>
	"
	# console.log $(render.introducao)[0]

	# console.log $(seletor).find('[data-book-unidade]').length

	render.atividades = "
	<div id=\"atividades\" class=\"section-page app-ati\">
		<h1 class=\"app-ati-head\">Atividades</h1>
		<div id=\"atividades_item\" data-app-ctrl='{\"navigation\":{\"section\":\"Atividades\",\"page\":false}}' class=\"app-ref-content section-page-item\">
	"
	i = 0
	while i < $(seletor).find('[data-book-unidade]').length
		render.atividades += "
		<div class=\"app-box app-box-atividade\">
			<div class=\"app-box-head\">Atividades - Unidade #{temp.unidade.numero[($(unidade[i]).data('book-unidade') - 1)]}</div>
		"
		u = 0
		while u < $($(seletor).find('[data-book-unidade]')[i]).find('.app-box.app-box-atividade').length
	
			render.atividades += "
			<div class=\"app-box-content app-ati-item\">
				#{$($($($($(seletor).find('[data-book-unidade]')[i]).find('.app-box.app-box-atividade')[u]).find('.app-ati-item'))[0]).html()}
			</div>
			"
			u++
		u = undefined

		render.atividades += "
		</div>
		"
		i++
	i = undefined

	render.atividades += "
		</div>
	</div>
	"

	render.download = "<a href=\"#{$($(seletor).find('[data-book-pdf]')).attr('src')}\" target=\"_blank\" class=\"app-ico-download hidden-ss hidden-xs font-sm-7 font-sm-6\"></a><a href=\"#{$($(seletor).find('[data-book-pdf]')).attr('src')}\" target=\"_blank\" class=\"app-ico-download-short hidden-sm hidden-md hidden-lg font-ss-5\"></a>" if $($(seletor).find('[data-book-pdf]')).attr('src') != undefined
	render.download = "<span class=\"app-ico-download hidden-ss hidden-xs font-sm-7 font-sm-6\"></span><span class=\"app-ico-download-short hidden-sm hidden-md hidden-lg font-ss-5\"></span>" if $($(seletor).find('[data-book-pdf]')).attr('src') is undefined

	return render

monta = compila_html_basico $('#parse')

# console.log monta
construct_book = (monta) ->
	temp = {}
	temp.unidade = ''
	temp.unidade_short = ''
	temp.algarismos = ['I', 'II', 'III', 'IV']
	if $('#parse').find('[data-book-unidade]').length is 1
		temp.unidade = " - Unidade #{temp.algarismos[($('[data-book-unidade]').data('book-unidade') - 1)]}"
		temp.unidade_short = " - #{temp.algarismos[($('[data-book-unidade]').data('book-unidade') - 1)]}"
		
	livro = "
<!-- 
-- * Estrutura do LivroDigital
-- * FTE Developer - VG Consultoria
-- * LivroDigital Beta V.0.1.1
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset=\"utf-8\">
		<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
		<title>#{$('[data-book-livro]').text()}#{temp.unidade}</title>
		<link href=\"css/app.css\" rel=\"stylesheet\">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
			<script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
		<![endif]-->
	</head>
	<body cz-shortcut-listen=\"true\">

			<div id=\"#{md5 $('#parse').find('[data-book-livro]').text()}\" class=\"app-volume\">
				#{monta.capa}
				<div style=\"background-color: rgba(251, 250, 186, 0.18);\" class=\"app-contents add-scroll\">

					<div id=\"bar-nav\" class=\"app-nav-bar clearfix\">
						<div data-app-ctrl='{\"togo\":{\"cover\":true}}' class=\"app-nav-logo col-md-2 col-sm-3 hidden-ss hidden-xs\">
							<img src=\"img/logo.color.svg\">
						</div>
						<div data-app-ctrl='{\"togo\":{\"to\":\"sumario\"}}' class=\"app-nav-section col-md-6 col-sm-5 col-ss-6 col-xs-4\">
							<div class=\"app-nav-section-info app-font-app\">
								<div class=\"app-nav-section-livro app-cor-black-80 font-md-small-2 font-sm-small-2 font-ss-1 hidden-xs\">
									<span class=\"app-nav-section-item app-livro text-uppercase text-bold\">#{$($('#parse').find('[data-book-livro]')).text()}#{temp.unidade_short}</span>
									<span class=\"app-nav-section-item hidden-ss hidden-xs\">•</span>
									<span class=\"app-nav-section-item app-autor text-italic hidden-ss hidden-xs\">#{$($('#parse').find('[data-book-autor-nome]')).text()}</span>
								</div>
								<div class=\"app-nav-section-secao app-cor-pattern-80 font-md-small-5 font-sm-small-4 font-ss-4 font-xs-3\">
									<span class=\"app-nav-section-item app-secao text-uppercase text-bold\">Bem Vindo</span>
									<span class=\"app-nav-section-item app-marker hidden-ss hidden-xs\"></span>
									<span class=\"app-nav-section-item app-titulo hidden-ss hidden-xs\"></span>
								</div>
							</div>
						</div>
						<div class=\"app-nav-btn-group app-cor-pattern text-center col-md-4 col-sm-4 col-ss-6 col-xs-8 font-md-5 font-sm-4 font-ss-4 font-xs-4\">

							<div data-app-ctrl='{\"togo\":{\"to\":\"sumario\"}}' class=\"app-nav-btn-item nav-btn-sumario col-md-2 col-sm-2 col-ss-2 col-xs-2\">
								<span class=\"app-ico-sumario font-md-6 font-sm-5 font-ss-5 font-xs-small-4\"></span>
							</div>
							<span class=\"col-md-6 col-sm-6 col-ss-6 col-xs-6\"></span>

							<div class=\"app-nav-btn-item nav-btn-menu col-md-2 col-sm-2 col-ss-2 col-xs-2\">#{monta.download}</div>

							<div data-app-ctrl='{\"togo\":{\"cover\":true}}' class=\"app-nav-btn-item nav-btn-menu col-md-2 col-sm-2 col-ss-2 col-xs-2\">
								<span class=\"app-ico-capa font-md-6 font-sm-5 font-ss-5 font-xs-small-4\"></span>
							</div>
						</div>
					</div>

					<section id=\"sumario\" class=\"app-sum-scroll section-page\">
						<div id=\"sumario\" class=\"app-sum-contents\">
	"
	i = 0
	while i < monta.sumario.length
		livro += "#{monta.sumario[i]}"
		i++
	i = undefined

	livro += "
						</div>
					</section>
					#{monta.autor}
					#{monta.introducao}
	"
	i = 0
	while i < monta.unidade.length
		livro += "#{monta.unidade[i]}"
		i++
	i = undefined

	livro += "
					#{monta.conclusao}
					#{monta.referencias}
					#{monta.atividades}
				</div>
			</div>

		<script src=\"js/jquery.min.js\" type=\"text/javascript\"></script>
		<script src=\"js/bootstrap.min.js\" type=\"text/javascript\"></script>
		<script src=\"js/bootstrap.slider.min.js\" type=\"text/javascript\"></script>
		<script src=\"js/app.js\" type=\"text/javascript\"></script>
		<script src=\"js/vendors.js\" type=\"text/javascript\"></script>
	</body>
</html>

	"

	return livro


links = construct_book compila_html_basico $('#parse')
$('#parse').addClass('hidden')
$('#done').text(links)


# $(links).find('img').length
# console.log livro
