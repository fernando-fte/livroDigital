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
        'display': {},
        'apr': {},
        'atividade': {}
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
        if (temp.appCtrl[i].app.apr) {
          temp._proccess.apr[i] = {};
          temp._proccess.apr[i] = $.appCtrl.apr(temp.appCtrl[i]);
        }
        if (temp.appCtrl[i].app.atividade) {
          temp._proccess.atividade[i] = {};
          temp._proccess.atividade[i] = $.appCtrl.atividade(temp.appCtrl[i]);
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
        '_true': false,
        'volume': {},
        'capa': {},
        'content': {},
        'seletor': {},
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
      }
    };
    $(post["this"]).click(function() {
      if (!post.app.togo.cover !== void 0) {
        temp._proccess.volume = $(post["this"]).closest('.app-volume');
        temp._proccess.capa = $(temp._proccess.volume).find('.app-cover');
        temp._proccess.content = $(temp._proccess.volume).find('.app-contents');
        if (post.app.togo.cover === true) {
          temp._proccess.content.removeClass('app-display').queue(function(next) {
            $(this).addClass('app-no-display').delay(1000).queue(function(next) {
              $(this).removeClass('app-no-display');
              return next();
            });
            temp._proccess.capa.removeClass('app-no-display').queue(function(next) {
              $(this).addClass('app-display');
              return next();
            });
            return next();
          });
        }
        if (post.app.togo.cover === false) {
          temp._proccess.capa.removeClass('app-display').queue(function(next) {
            $(this).addClass('app-no-display').delay(1000).queue(function(next) {
              $(this).removeClass('app-no-display');
              return next();
            });
            temp._proccess.content.removeClass('app-no-display').queue(function(next) {
              $(this).addClass('app-display');
              return next();
            });
            return next();
          });
        }
      }
      if (!post.app.togo.to !== void 0) {
        temp._proccess.seletor = '#' + post.app.togo.to;
        temp._proccess.display = $.appCtrl.section(temp._proccess.seletor, 'app-display');
        if (temp._proccess.display.position.page === 'first') {
          temp.eq = 0;
          if (!temp._proccess.display.item["this"] === false) {
            temp.eq = temp._proccess.display.item.eq;
          }
          $.appCtrl.sectionDisplay([[temp._proccess.display.page["this"], 'in', 'on'], [$(temp._proccess.display.pattern).find(".section-page-item:eq(" + temp.eq + ")"), 'in', 'on']]);
        }
        if (temp._proccess.display.position.page === 'before' || temp._proccess.display.position.page === 'after') {
          temp.eq = 0;
          if (!temp._proccess.display.item["this"] === false) {
            temp.eq = temp._proccess.display.item.eq;
          }
          $.appCtrl.sectionDisplay([[temp._proccess.display.it.page["this"], 'out', temp._proccess.display.position.page], [temp._proccess.display.page["this"], 'in', temp._proccess.display.position.page], [$(temp._proccess.display.pattern).find(".section-page-item:eq(" + temp.eq + ")"), 'in', 'on']]);
        }
        if (temp._proccess.display.position.page === 'this') {
          if (temp._proccess.display.position.item === 'first') {
            $.appCtrl.sectionDisplay([[$(temp._proccess.display.page["this"]).find(".section-page-item:eq(0)"), 'in', 'on']]);
          }
          if (temp._proccess.display.position.item === 'before' || temp._proccess.display.position.item === 'after') {
            $.appCtrl.sectionDisplay([[temp._proccess.display.it.item["this"], 'out', temp._proccess.display.position.item], [temp._proccess.display.item["this"], 'in', temp._proccess.display.position.item]]);
          }
          if (temp._proccess.display.position.item === 'this') {
            $.appCtrl.sectionDisplay([[temp._proccess.display.item["this"], 'in', 'on']]);
          }
        }
        return console.log(temp._proccess.display);
      }
    });
    return temp;
  };

  $.appCtrl.sectionDisplay = function(post) {
    var display, i, position, seletor;
    i = 0;
    while (i < post.length) {
      seletor = post[i][0];
      display = post[i][1];
      position = post[i][2];
      if (display === 'out') {
        $(seletor).removeClass('app-display').addClass(position).queue(function(next) {
          $(this).addClass('app-no-display').delay(700).queue(function(next) {
            $(this).removeClass("app-no-display").delay(1000).queue(function(next) {
              $(this).removeClass("on after before").queue(function(next) {
                return next();
              });
              return next();
            });
            return next();
          });
          return next();
        });
      }
      if (display === 'in') {
        $(seletor).removeClass('app-no-display').addClass(position).delay(700).queue(function(next) {
          $(this).addClass('app-display').delay(1000).queue(function(next) {
            $(this).removeClass("on after before").queue(function(next) {
              return next();
            });
            return next();
          });
          return next();
        });
      }
      i++;
    }
    return i = void 0;
  };

  $.appCtrl.section = function(id, display) {
    var temp;
    temp = {
      'pattern': false,
      'page': {
        'this': false,
        'display': false
      },
      'item': {
        'this': false,
        'display': false
      },
      'it': {
        'page': {
          'this': false
        },
        'item': {
          'this': false
        }
      },
      'position': {
        'page': false,
        'item': false
      }
    };
    temp.pattern = $(id).closest('.app-volume');
    if ($(id).hasClass('section-page')) {
      temp.page["this"] = $(id);
    }
    if ($(id).hasClass('section-page-item')) {
      temp.item["this"] = $(id);
    }
    if (temp.page["this"] === false) {
      if ($(id).closest('.section-page').length) {
        temp.page["this"] = $(id).closest('.section-page');
      }
    }
    if (temp.item["this"] === false) {
      if ($(id).closest('.section-page-item').length) {
        temp.item["this"] = $(id).closest('.section-page-item');
      }
      if (!temp.page["this"] === false && temp.item["this"] === false) {
        if ($(temp.page["this"]).find('.section-page-item.' + display).length) {
          temp.item["this"] = $(temp.page["this"]).find('.section-page-item.' + display);
        }
        if (!$(temp.page["this"]).find('.section-page-item.' + display).length) {
          if ($(temp.page["this"]).find('.section-page-item:eq(0)').length) {
            temp.item["this"] = $(temp.page["this"]).find('.section-page-item:eq(0)');
          }
        }
      }
    }
    if (temp.page["this"]) {
      temp.page.eq = $('#' + $(temp.page["this"])[0].id).index('.section-page');
    }
    if (temp.item["this"]) {
      temp.item.eq = $('#' + $(temp.item["this"])[0].id).index('.section-page-item');
    }
    if (!temp.page["this"] === false) {
      if (temp.page["this"].hasClass(display)) {
        temp.page.display = true;
      }
      if (temp.page.display === false) {
        if ($(temp.pattern).find('.section-page.' + display).length > 0) {
          temp.it.page["this"] = $(temp.pattern).find('.section-page.' + display);
        }
        if (temp.it.page["this"]) {
          temp.it.page.eq = $('#' + $(temp.it.page["this"])[0].id).index('.section-page');
        }
      }
    }
    if (!temp.item["this"] === false) {
      if (temp.item["this"].hasClass(display)) {
        temp.item.display = true;
      }
      if (temp.item.display === false) {
        if ($(temp.pattern).find('.section-page-item.' + display).length > 0) {
          temp.it.item["this"] = $(temp.pattern).find('.section-page-item.' + display);
        }
        if (temp.it.item["this"]) {
          temp.it.item.eq = $('#' + $(temp.it.item["this"])[0].id).index('.section-page-item');
        }
      }
    }
    if (temp.page.display === true) {
      temp.position.page = 'this';
    }
    if (temp.page.display === false && temp.it.page["this"] === false) {
      temp.position.page = 'first';
    }
    if (temp.page.eq < temp.it.page.eq) {
      temp.position.page = 'before';
    }
    if (temp.page.eq > temp.it.page.eq) {
      temp.position.page = 'after';
    }
    if (temp.item.display === true) {
      temp.position.item = 'this';
    }
    if (temp.item.display === false && temp.it.item["this"] === false) {
      temp.position.item = 'first';
    }
    if (temp.item.eq < temp.it.item.eq) {
      temp.position.item = 'before';
    }
    if (temp.item.eq > temp.it.item.eq) {
      temp.position.item = 'after';
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
    $(post["this"]).click(function() {
      var i;
      temp.classe_base = 'app-display';
      if (post.app.display.no) {
        temp.classe_base = 'app-no-display';
      }
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
          temp._done = true;
          break;
        case 'closest':
          $($(post["this"]).closest(post.app.display.put)).addClass(temp.classe_base);
          temp._done = true;
          break;
        case 'child':
          $($(post["this"]).find(post.app.display.put)).addClass(temp.classe_base);
          temp._done = true;
          break;
        case 'all':
          $(post.app.display.put).addClass(temp.classe_base);
          temp._done = true;
      }
      if (post.app.display.inverse) {
        if (!post.app.display.no) {
          return post.app.display.no = true;
        } else if (post.app.display.no) {
          return post.app.display.no = false;
        }
      }
    });
    return temp;
  };

  $.appCtrl.apr = function(post) {
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
    $(post["this"]).click(function() {
      $($(this).closest('.app-apr-item')).toggleClass('app-apr-display-video');
      return temp._done = true;
    });
    return temp;
  };

  $.appCtrl.atividade = function(post) {
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
      },
      'btn': {}
    };
    temp._proccess._true = true;
    if (post.app.atividade.change === true) {
      if (post.app.atividade["true"] === true) {
        $(post["this"]).addClass('true');
      }
      if (post.app.atividade["true"] === false) {
        $(post["this"]).addClass('false');
      }
      temp._proccess.change = true;
    }
    $(post["this"]).click(function() {
      if (!post.app.atividade.avaliar) {
        if (post.app.atividade.change === false) {
          if (post.app.atividade["true"] === true) {
            post.app.atividade.change = true;
            $(this).addClass('true');
            $(this).data("appCtrl", post.app);
          }
          if (post.app.atividade["true"] === false) {
            post.app.atividade.change = true;
            $(this).addClass('false');
            $(this).data("appCtrl", post.app);
          }
        }
      }
      if (post.app.atividade.avaliar) {
        if (post.app.atividade.change === false) {
          $(post["this"]).toggleClass('on');
          return $(this).closest('.app-ati-item').find('.app-ati-item-change').click(function() {
            $(post["this"]).closest('.app-ati-item').find('.app-ati-alternativa-item').addClass('off');
            $(post["this"]).closest('.app-ati-item').find('.app-ati-alternativa-item.on').removeClass('off');
            if (post.app.atividade["true"] === true) {
              post.app.atividade.change = true;
              $(post["this"]).addClass('true');
              $(post["this"]).removeClass('off');
              $(post["this"]).data("appCtrl", post.app);
            }
            if (post.app.atividade["true"] === false) {
              post.app.atividade.change = true;
              $(post["this"]).addClass('false');
              $(post["this"]).removeClass('off');
              return $(post["this"]).data("appCtrl", post.app);
            }
          });
        }
      }
    });
    return temp;
  };

  $.appCtrl($("[data-app-ctrl]"));

}).call(this);
