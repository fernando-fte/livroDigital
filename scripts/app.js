// Generated by CoffeeScript 1.10.0
(function() {
  $.form = function(post) {
    var done;
    $.form.send = function(post) {
      $.ajax({
        type: "post",
        url: "php/index.php",
        cache: false,
        data: post,
        async: false
      }).done(function(data) {
        return post = data;
      });
      return $.parseJSON(post);
    };
    done = $.form.send({
      "ajax": post
    });
    return done;
  };

  if (!$.appCtrl) {
    $.appCtrl = {};
  }

  if (!$.appCtrl.togo) {
    $.appCtrl.togo = {};
  }

  $.appCtrl = function(post) {
    var i, temp;
    temp = {
      '_proccess': {
        '_true': false,
        'togo': {},
        'display': {}
      },
      '_erro': {
        '_true': false
      },
      '_warning': {
        '_true': false
      },
      '_done': {
        '_true': false
      },
      'appCtrl': {}
    };
    temp._proccess.post = false;
    if (post.length >= 1) {
      temp._proccess.post = true;
    }
    if (temp._proccess.post === true) {
      i = 0;
      while (i < post.length) {
        temp.appCtrl[i] = {};
        temp.appCtrl[i]["this"] = $(post)[i];
        temp.appCtrl[i].app = $($(post)[i]).data().appCtrl;
        if (temp.appCtrl[i].app.togo) {
          temp._proccess.togo[i] = {};
          temp._proccess.togo[i] = $.appCtrl.togo(temp.appCtrl[i]);
        }
        if (temp.appCtrl[i].app.display) {
          temp._proccess.display[i] = $.appCtrl.display(temp.appCtrl[i]);
        }
        i++;
      }
    }
    return console.log(temp);
  };

  $.appCtrl.togo = function(post) {
    var temp;
    temp = {
      '_proccess': {
        '_true': false
      },
      '_erro': {
        '_true': false
      },
      '_warning': {
        '_true': false
      },
      '_done': {
        '_true': false
      }
    };
    if (post.app.togo.id) {
      temp._done = 'Ainda nao existe tratamento em ID';
    } else if (post.app.togo.css) {
      temp._done = 'Ainda nao existe tratamento em CLASS';
    } else if (post.app.togo.cover) {
      temp._proccess.cover = false;
      $(post["this"]).click(function() {
        $('#app-capa').addClass('page-out');
        return temp._proccess.cover = true;
      });
    }
    return temp;
  };

  $.appCtrl.display = function(post) {
    var temp;
    temp = {
      '_proccess': {
        'classe_base': null,
        '_true': false
      },
      '_erro': {
        '_true': false
      },
      '_warning': {
        '_true': false
      },
      '_done': {
        '_true': false
      }
    };
    temp.classe_base = 'app-display';
    if (post.app.display.no) {
      temp.classe_base = 'app-no-display';
    }
    $(post["this"]).click(function() {
      var i;
      if (post.app.display.toogle) {
        i = 0;
        while (i < post.app.display.toogle.length) {
          $(post.app.display.toogle[i]).removeClass('app-no-display');
          $(post.app.display.toogle[i]).removeClass('app-display');
          i++;
        }
      }
      switch (post.app.display.who) {
        case 'this':
          $(post["this"]).addClass(temp.classe_base);
          return temp._done = true;
        case 'closest':
          $($(post["this"]).closest(post.app.display.put)).addClass(temp.classe_base);
          return temp._done = true;
        case 'child':
          $($(post["this"]).find(post.app.display.put)).addClass(temp.classe_base);
          return temp._done = true;
        case 'all':
          $(post.app.display.put).addClass(temp.classe_base);
          return temp._done = true;
      }
    });
    return temp;
  };

  $.appCtrl($("[data-app-ctrl]"));

}).call(this);
