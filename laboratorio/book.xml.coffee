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


# # # # # # # # # # # # # # #
# # # # # # # # # # # # # # #
