// !
// * Conjunto de funções do LivroDigital
// * FTE Developer - VG COnsultoria
// * LivroDigital Beta V.0.1.0
// *
// * Generated by CoffeeScript 1.10.0
// !
(function(){$.form=function(e){var a;return $.form.send=function(e){return $.ajax({type:"post",url:"php/index.php",cache:!1,data:e,async:!1}).done(function(a){return e=a}),$.parseJSON(e)},a=$.form.send({ajax:e})},$.appCtrl||($.appCtrl={}),$.appCtrl.togo||($.appCtrl.togo={}),$.appCtrl=function(e){var a,p;if(p={_proccess:{_true:!1,togo:{},display:{},apr:{},atividade:{}},_erro:{_true:!1},_warning:{_true:!1},_done:{_true:!1},appCtrl:{}},p._proccess.post=!1,e.length>=1&&(p._proccess.post=!0),p._proccess.post===!0)for(a=0;a<e.length;)p.appCtrl[a]={},p.appCtrl[a]["this"]=$(e)[a],p.appCtrl[a].app=$($(e)[a]).data().appCtrl,p.appCtrl[a].app.togo&&(p._proccess.togo[a]={},p._proccess.togo[a]=$.appCtrl.togo(p.appCtrl[a])),p.appCtrl[a].app.display&&(p._proccess.display[a]=$.appCtrl.display(p.appCtrl[a])),p.appCtrl[a].app.apr&&(p._proccess.apr[a]={},p._proccess.apr[a]=$.appCtrl.apr(p.appCtrl[a])),p.appCtrl[a].app.atividade&&(p._proccess.atividade[a]={},p._proccess.atividade[a]=$.appCtrl.atividade(p.appCtrl[a])),a++;return console.log(p)},$.appCtrl.togo=function(e){var a;return a={_proccess:{_true:!1,volume:{},capa:{},content:{},seletor:{},display:{}},_erro:{_true:!1},_warning:{_true:!1},_done:{_true:!1}},$(e["this"]).click(function(){return void 0!==!e.app.togo.cover&&(a._proccess.volume=$(e["this"]).closest(".app-volume"),a._proccess.capa=$(a._proccess.volume).find(".app-cover"),a._proccess.content=$(a._proccess.volume).find(".app-contents"),e.app.togo.cover===!0&&a._proccess.content.removeClass("app-display").queue(function(e){return $(this).addClass("app-no-display").delay(1e3).queue(function(e){return $(this).removeClass("app-no-display"),e()}),a._proccess.capa.removeClass("app-no-display").queue(function(e){return $(this).addClass("app-display"),e()}),e()}),e.app.togo.cover===!1&&a._proccess.capa.removeClass("app-display").queue(function(e){return $(this).addClass("app-no-display").delay(1e3).queue(function(e){return $(this).removeClass("app-no-display"),e()}),a._proccess.content.removeClass("app-no-display").queue(function(e){return $(this).addClass("app-display"),e()}),e()})),void 0!==!e.app.togo.to&&(a._proccess.seletor="#"+e.app.togo.to,a._proccess.display=$.appCtrl.section(a._proccess.seletor,"app-display"),"first"===a._proccess.display.position.page&&(a.eq=0,!a._proccess.display.item["this"]==!1&&(a.eq=a._proccess.display.item.eq),$.appCtrl.sectionDisplay([[a._proccess.display.page["this"],"in","on"],[$(a._proccess.display.pattern).find(".section-page-item:eq("+a.eq+")"),"in","on"]])),("before"===a._proccess.display.position.page||"after"===a._proccess.display.position.page)&&(a.eq=0,!a._proccess.display.item["this"]==!1&&(a.eq=a._proccess.display.item.eq),$.appCtrl.sectionDisplay([[a._proccess.display.it.page["this"],"out",a._proccess.display.position.page],[a._proccess.display.it.item["this"],"out",a._proccess.display.position.page],[a._proccess.display.page["this"],"in",a._proccess.display.position.page],[$(a._proccess.display.page["this"]).find(".section-page-item:eq("+a.eq+")"),"in","on"]])),"this"===a._proccess.display.position.page&&("first"===a._proccess.display.position.item&&$.appCtrl.sectionDisplay([[$(a._proccess.display.page["this"]).find(".section-page-item:eq(0)"),"in","on"]]),("before"===a._proccess.display.position.item||"after"===a._proccess.display.position.item)&&$.appCtrl.sectionDisplay([[a._proccess.display.it.item["this"],"out",a._proccess.display.position.item],[a._proccess.display.item["this"],"in",a._proccess.display.position.item]]),"this"===a._proccess.display.position.item))?$.appCtrl.sectionDisplay([[a._proccess.display.item["this"],"in","on"]]):void 0}),a},$.appCtrl.sectionDisplay=function(e){var a,p,s,t;for(p=0;p<e.length;)t=e[p][0],a=e[p][1],s=e[p][2],"out"===a&&$(t).removeClass("app-display").addClass(s).queue(function(e){return $(this).addClass("app-no-display").delay(700).queue(function(e){return $(this).removeClass("app-no-display").delay(1e3).queue(function(e){return $(this).removeClass("on after before").queue(function(e){return e()}),e()}),e()}),e()}),"in"===a&&$(t).removeClass("app-no-display").addClass(s).delay(700).queue(function(e){return $(this).addClass("app-display").delay(1e3).queue(function(e){return $(this).removeClass("on after before").queue(function(e){return e()}),e()}),e()}),p++;return p=void 0},$.appCtrl.section=function(e,a){var p;return p={pattern:!1,page:{"this":!1,display:!1},item:{"this":!1,display:!1},it:{page:{"this":!1},item:{"this":!1}},position:{page:!1,item:!1}},p.pattern=$(e).closest(".app-volume"),$(e).hasClass("section-page")&&(p.page["this"]=$(e)),$(e).hasClass("section-page-item")&&(p.item["this"]=$(e)),p.page["this"]===!1&&$(e).closest(".section-page").length&&(p.page["this"]=$(e).closest(".section-page")),p.item["this"]===!1&&$(e).closest(".section-page-item").length&&(p.item["this"]=$(e).closest(".section-page-item")),p.page["this"]&&(p.page.eq=$("#"+$(p.page["this"])[0].id).index(".section-page")),p.item["this"]&&p.page["this"]&&(p.item.eq=$("#"+$(p.item["this"])[0].id).index("#"+$(p.page["this"])[0].id+" .section-page-item")),!p.page["this"]==!1&&(p.page["this"].hasClass(a)&&(p.page.display=!0),p.page.display===!1&&($(p.pattern).find(".section-page."+a).length>0&&(p.it.page["this"]=$(p.pattern).find(".section-page."+a)),p.it.page["this"]&&(p.it.page.eq=$("#"+$(p.it.page["this"])[0].id).index(".section-page")))),!p.item["this"]==!1&&(p.item["this"].hasClass(a)&&(p.item.display=!0),p.item.display===!1&&($(p.pattern).find(".section-page-item."+a).length>0&&(p.it.item["this"]=$(p.pattern).find(".section-page-item."+a)),p.it.item["this"]&&p.it.page["this"]&&(p.it.item.eq=$("#"+$(p.it.item["this"])[0].id).index("#"+$(p.it.page["this"])[0].id+" .section-page-item")))),p.page.display===!0&&(p.position.page="this"),p.page.display===!1&&p.it.page["this"]===!1&&(p.position.page="first"),p.page.eq<p.it.page.eq&&(p.position.page="before"),p.page.eq>p.it.page.eq&&(p.position.page="after"),p.item.display===!0&&(p.position.item="this"),p.item.display===!1&&p.it.item["this"]===!1&&(p.position.item="first"),p.item.eq<p.it.item.eq&&(p.position.item="before"),p.item.eq>p.it.item.eq&&(p.position.item="after"),p},$.appCtrl.display=function(e){var a;return a={_proccess:{classe_base:null,_true:!1},_erro:{_true:!1},_warning:{_true:!1},_done:{_true:!1}},$(e["this"]).click(function(){var p;if(a.classe_base="app-display",e.app.display.no&&(a.classe_base="app-no-display"),e.app.display.toogle)for(p=0;p<e.app.display.toogle.length;)$(e.app.display.toogle[p]).removeClass("app-no-display"),$(e.app.display.toogle[p]).removeClass("app-display"),p++;switch(e.app.display.who){case"this":$(e["this"]).addClass(a.classe_base),a._done=!0;break;case"closest":$($(e["this"]).closest(e.app.display.put)).addClass(a.classe_base),a._done=!0;break;case"child":$($(e["this"]).find(e.app.display.put)).addClass(a.classe_base),a._done=!0;break;case"all":$(e.app.display.put).addClass(a.classe_base),a._done=!0}if(e.app.display.inverse){if(!e.app.display.no)return e.app.display.no=!0;if(e.app.display.no)return e.app.display.no=!1}}),a},$.appCtrl.apr=function(e){var a;return a={_proccess:{_true:!1},_erro:{_true:!1},_warning:{_true:!1},_done:{_true:!1}},$(e["this"]).click(function(){return $($(this).closest(".app-apr-item")).toggleClass("app-apr-display-video"),a._done=!0}),a},$.appCtrl.atividade=function(e){var a;return a={_proccess:{_true:!1},_erro:{_true:!1},_warning:{_true:!1},_done:{_true:!1},btn:{}},a._proccess._true=!0,e.app.atividade.change===!0&&(e.app.atividade["true"]===!0&&$(e["this"]).addClass("true"),e.app.atividade["true"]===!1&&$(e["this"]).addClass("false"),a._proccess.change=!0),$(e["this"]).click(function(){return e.app.atividade.avaliar||e.app.atividade.change===!1&&(e.app.atividade["true"]===!0&&(e.app.atividade.change=!0,$(this).addClass("true"),$(this).data("appCtrl",e.app)),e.app.atividade["true"]===!1&&(e.app.atividade.change=!0,$(this).addClass("false"),$(this).data("appCtrl",e.app))),e.app.atividade.avaliar&&e.app.atividade.change===!1?($(e["this"]).toggleClass("on"),$(this).closest(".app-ati-item").find(".app-ati-item-change").click(function(){return $(e["this"]).closest(".app-ati-item").find(".app-ati-alternativa-item").addClass("off"),$(e["this"]).closest(".app-ati-item").find(".app-ati-alternativa-item.on").removeClass("off"),e.app.atividade["true"]===!0&&(e.app.atividade.change=!0,$(e["this"]).addClass("true"),$(e["this"]).removeClass("off"),$(e["this"]).data("appCtrl",e.app)),e.app.atividade["true"]===!1?(e.app.atividade.change=!0,$(e["this"]).addClass("false"),$(e["this"]).removeClass("off"),$(e["this"]).data("appCtrl",e.app)):void 0})):void 0}),a},$.appCtrl($("[data-app-ctrl]"))}).call(this);
