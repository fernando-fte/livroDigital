// Generated by CoffeeScript 1.10.0
(function() {
  $.form = function(post) {
    var done;
    $.form.send = function(post) {
      $.ajax({
        type: "post",
        url: "index.php",
        cache: false,
        data: post,
        async: false
      }).done(function(data) {
        return post = data;
      });
      return post;
    };
    done = $.form.send({
      "ajax": post
    });
    return done;
  };

  $('#enviar').bind("click", function() {
    var parte, val;
    parte = $('#lista');
    val = {
      "dado": "ok",
      "valor": {}
    };
    val.valor = parte;
    return console.log($.form(val));
  });

}).call(this);
