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

    # valida se o seletor ser inserido o html existe
    if !post.seletor is false
      proccess.seletor = true

      # caso seja uma string pega o primeiro item
      post.seletor = $(post.seletor)[0] if typeof(post.seletor) is 'string' and $(post.seletor).length

      # Valida se o seletor é valido
      if !$(post.seletor).length > 0
          erro.seletor = 'O seletor "'+post.seletor+'" passado não existe'
          proccess.seletor = false



  # Declara tipo do processo caso post vedadeiro
  if proccess.json and proccess.dom
    proccess.start = 'constructJSON'

  if proccess.html and proccess.parser_json and proccess.object and proccess.seletor
    proccess.start = 'constructHTML'

  # # # # 
  # inicia tratamento para montagem da contrução do html do js
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

        # caso o node nao seja de texto puro
        if post.json[i].node != '@text'
          # inicia html
          done.html = "<#{post.json[i].node}"

          u = 0
          while u < post.json[i].attr['._.list'].length
#             console.log post.json[i].attr[post.json[i].attr['._.list'][u]]
            if typeof(post.json[i].attr[post.json[i].attr['._.list'][u]]) != 'object'
              done.html = "#{done.html} #{post.json[i].attr['._.list'][u]}=\"#{post.json[i].attr[post.json[i].attr['._.list'][u]]}\""
            else
              done.html = "#{done.html} #{post.json[i].attr['._.list'][u]}='#{JSON.stringify(post.json[i].attr[post.json[i].attr['._.list'][u]])}'"

              console.log done.html

            u++
          u = undefined

        # caso o node seja texto puro
        else
          done.html = post.json[i].content
        
        

      i++
    
    i = undefined
#     done = post.json
    
  # finaliza tratamento para montagem da contrução do html do js
  # # # # 
    

  # # # # 
  # inicia tratamento para montagem da contrução do json do html
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
      done['._.list'].push done[i].node

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
          done[i].attr.id = done[i].attr.id+'1' if done['._.id'][done[i].attr.id]

          # adiciona na lista o nome do id
          done['._.id']['._.list'].push done[i].attr.id
          
          # reserva conteudo do elemento id
          done['._.id'][done[i].attr.id] = post.dom[i].innerText
        
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
  
  # finaliza
  # # # #


  # caso nao tenha iniciado nada
  if !proccess.start
    erro.fatal = 'Nao foi iniciado nem um processos, veja o post'


  # return {'_proccess':proccess, '_done':done, '_erro':erro, '_post':post}
  return {'_proccess':proccess, '_done':done, '_erro':erro}

#*****#
element = $('#vaila')

# console.log JSON.stringify(htmlConstruct {'start':'json', 'dom':element})
# console.log htmlConstruct {'start':'json', 'dom':element}
json = JSON.stringify((htmlConstruct {'start':'json', 'dom':element})._done)
# console.log htmlConstruct {'start':'html', json, 'seletor':'#content'}
htmlConstruct {'start':'html', json, 'seletor':'#content'}
# console.log htmlConstruct {'start':'html', 'json':{'ok':true}, 'seletor':'#content'}

# a = {"ok":true, "vai":true}

# delete(a.ok)
# console.log a

# http://jsbin.com/setubupuqe/2/edit?js,console



###
<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
</head>
<body>
  <div id='vaila' data-teste data-ma=false data-app-json='{"ok":false}'>
    <input type="text" value="ok" name="i"/>
    <p id="u">dentro do "p" <b id="u">dentro do "b"</b> <i ID="outro">dentro do i</i> depois do i</p>fora da div</div>
  <code id="content"></code>
</body>
</html>
###
