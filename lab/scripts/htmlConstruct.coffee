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

          post.json[i].attr.class = ["viva", "vai", "ok"]
            
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
        $(post.dom[i]).attr('id', md5(microtime() + post.dom[i]))

      # inicia tratamento de atributos      
      if !done[i].attr is false and post.dom[i].attributes.length > 0

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
             done[i].attr[post.dom[i].attributes[u].name] = JSON.parse(post.dom[i].attributes[u].value)
            
          # lista os atributos
          done[i].attr['._.list'].push post.dom[i].attributes[u].name

          u++
        # apaga contador
        u = undefined

        # reserva os dados do elemento caso ele tenha id
        if done[i].attr.id
          
          # caso o ID já exista neste nível adiciona (1)
          done[i].attr.id = done[i].attr.id+'_' if done['._.id'][done[i].attr.id]

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
element = $('#vaila')

json = htmlConstruct {'start':'json', 'dom':element}
html =  htmlConstruct {'start':'html', 'json':JSON.stringify(json._done)}
# console.log $.parseHTML(html._done)
$('#content').append($.parseHTML(html._done))
# console.log $('#content')[0]
console.log json._done
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
