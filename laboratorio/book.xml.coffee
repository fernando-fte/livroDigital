temp = {}

# # # # # # # # # # # # # # #
# # # # # # # # # # # # # # #
#// Define livro
$.book = {}

# função para importação
$.book.importa = (post) ->
    # Função ajax
    $.ajax
        type: 'GET'
        url: post
        dataType: 'xml'
        cache: false
        async: false

    # resultado de retorno
    .done (data) -> 
        post = data

    return post

#// importa livro
$.book.library = $.book.importa 'book.xml'
# # # # # # # # # # # # # # #
# # # # # # # # # # # # # # #


# # # # # # # # # # # # # # #
# # # # # # # # # # # # # # #

$.book.data = {}

temp.info = $($.book.library).find('informacoes')
temp.autores = $(temp.info).find('autor_list').find('autor_item')

$.book.data['nome do livro'] = $(temp.info).find('titulo').text()


console.log temp

temp.list = temp.autores





# console.log $.book.data

# # # # # # # # # # # # # # #
# # # # # # # # # # # # # # #
