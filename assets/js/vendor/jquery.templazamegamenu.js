(function ($) {
   $.fn.TemPlazaMegaMenu = function (options) {

      var contentClass = $(this).data('megamenu-content-class');
      var submenuClass = $(this).data('megamenu-submenu-class');
      var megamenuClass = $(this).data('megamenu-class');
      var animation = $(this).data('animation');
      var dropdownArrows = $(this).data('dropdown-arrow');
      var headerOffset = $(this).data('header-offset');
      var transitionSpeed = parseInt($(this).data('transition-speed'));
      var easing = $(this).data('easing');
      var trigger = $(this).data('megamenu-trigger');

      var settings = $.extend({
         contentClass: contentClass,
         submenuClass: submenuClass,
         megamenuClass: megamenuClass,
         dropdownArrows: dropdownArrows,
         headerOffset: headerOffset,
         transition: transitionSpeed,
         easing: easing,
         animation: animation,
         trigger: trigger
      }, options);

      return this.each(function () {
         var _navbar = $(this);
         _navbar.addClass("megamenu-trigger-" + settings.trigger);
         var _container = _navbar;
         if (_navbar.children('.container').length) {
            _container = _navbar.children('.container');
         }
         var _megamenu = _navbar.find(settings.megamenuClass);
         var _submenus = _megamenu.find(settings.submenuClass);

         var get_menu_item_level = function($menu_item){
            var _mclass  = $menu_item!==undefined?$menu_item.attr("class"):'';
            // var mclass  = "menu-item menu-item-depth-12 menu-item-page menu-item-edit-inactive";
            _mclass = _mclass.length?_mclass.match(/item-level-[0-9]+/):'';
            if(_mclass && !_mclass.length){
               return false;
            }
            _mclass = _mclass[0];
            return parseInt(_mclass.replace("item-level-", ""));
         };

         var init = function () {
            if (!_navbar.is(':visible')) {
               return false;
            }
            var _megamenu = _navbar.find(settings.megamenuClass);
            var _submenus = _megamenu.find(settings.submenuClass);
            _submenus.children('li').each(function () {
               if ($(this).children(settings.submenuClass).length) {
                  if (!$(this).children(settings.submenuClass).hasClass('d-block')) {
                     console.log($(this));

                     $(this).unbind('mouseenter mouseleave').hover(function () {
                        var _submenu = $(this).children(settings.submenuClass);
                        _submenu.removeClass('right');
                        _submenu.stop(true, true).slideDown();
                        if (_submenu.offset().left + _submenu.outerWidth() > $(window).innerWidth()) {
                           _submenu.addClass('right');
                        } else {
                           _submenu.removeClass('right');
                        }
                     }, function () {
                        var _submenu = $(this).children(settings.submenuClass);
                        _submenu.stop(true, true).slideUp();
                     });
                  }
               }
            });

            // console.log(_megamenu);
            // if (settings.dropdownArrows) {
            //    _megamenu.append('<span class="arrow" />');
            // }

            // console.log(settings.megamenuClass);
            // console.log(_megamenu);
            // console.log($(this).children(".megamenu-item-link.item-level-1"));
            _megamenu.each(function () {
               var _content = $(this).find(">" + settings.contentClass);

               // var _width = _content.data('width');
               // if (typeof _width != 'undefined' && _width != '') {
               //    if (_width == 'container') {
               //       _content.addClass('width-container');
               //       _width = _content.closest('.templaza-header').width();
               //       if (_content.closest('.templaza-header').hasClass('astroid-header-sticky')) {
               //          _width = _content.closest('.templaza-header').children('.container').width();
               //          if (_width == 100) {
               //             _width = _content.closest('.templaza-header').removeClass('d-none').addClass('d-flex').children('.container').width();
               //             _content.closest('.templaza-header').addClass('d-none').removeClass('d-flex');
               //          }
               //       }
               //    }
               //    if (_width == '100vw') {
               //       _content.addClass('width-window');
               //       // _boundry = 'window';
               //    }
               //    _content.css('width', _width);
               //    // _content.find('.jddrop-content').css('width', _width);
               // }

               // console.log(get_menu_item_level($(this).find(">.megamenu-item-link")));

               // console.log($(this).data("position"));
               // console.log(!$(this).find(">.megamenu-item-link.item-level-1").length &&
               //     ($(this).data("position") == "right" || $(this).data("position") == "left"));
               if(!$(this).find(">.megamenu-item-link.item-level-1").length &&
                   ($(this).data("position") == "right" || $(this).data("position") == "left")){
                  return true;
               }


               if($(this).data('position') == 'edge') {
                  var _leftoverflow = 0;
                  var _rightoverflow = $(window).innerWidth();
                  _content.css('max-width', '100vw');
               } else {
                  var _leftoverflow = _container.offset().left;
                  var _rightoverflow = _container.offset().left + _container.outerWidth();
                  _content.css('max-width', _container.outerWidth());
               }

               var _top = _container.outerHeight() - $(this).outerHeight();
               var _arrow = $(this).children('.arrow');

               // console.log($(this));
               // console.log($(this).children(".megamenu-item-link"));
               // if($(this).children(".megamenu-item-link.item-level-1").length){
                   _content.css('left', '0px');

                  if (settings.headerOffset) {
                     _arrow.css('margin-bottom', -(_top / 2));
                     var _top = _container.outerHeight() - $(this).outerHeight();
                     _content.css('top', (_top / 2) + $(this).outerHeight());
                  } else {
                     _content.css('top', '100%');
                  }

                  switch ($(this).data('position')) {
                     case 'left':
                        var offsetleft = $(this).offset().left;
                        break;
                     case 'right':
                        var offsetleft = $(this).offset().left - (_content.outerWidth() - $(this).outerWidth());
                        break;
                     case 'center':
                     case 'edge':
                     case 'full':
                        var offsetleft = $(this).offset().left - (_content.outerWidth() / 2 - $(this).outerWidth() / 2);
                        break;
                  }

                  // if()
               // var _left = _content.outerWidth()/2 - $(this).outerWidth()/2;
               //    _content.css('left', -(_left));
               //    _content.css('right', 'inherit');


                  if ((offsetleft + _content.outerWidth()) > _rightoverflow) {
                     var _left = _content.outerWidth() - (_rightoverflow - offsetleft);
                     if ($(this).data('position') == 'center' || $(this).data('position') == 'edge' || $(this).data('position') == 'full') {
                        _left = _left + ((_content.outerWidth() / 2) - ($(this).outerWidth() / 2));
                     }
                     _content.css('left', -(_left));
                     _content.css('right', 'inherit');
                  } else if (offsetleft < _leftoverflow) {
                     var _right = (offsetleft - _leftoverflow);
                     if ($(this).data('position') == 'center' || $(this).data('position') == 'edge' || $(this).data('position') == 'full') {
                        _right = _right - ((_content.outerWidth() / 2) - ($(this).outerWidth() / 2));
                     }
                     _content.css('right', _right);
                     _content.css('left', 'inherit');
                  }else{
                     if ($(this).data('position') == 'center'){
                        var _left = ($(this).outerWidth() - _content.outerWidth()) /2;
                        _content.css('left', _left);
                     }
                  }

               // }

            });
         };

         init();


         var observering = function (_this) {
            var callback = function (mutationsList, observer) {
				mutationsList.forEach(function(mutation) {
					 if (mutation.type == 'attributes' && mutation.attributeName == 'class') {
						 init();
					  }
				});	               
            };
            var observer = new MutationObserver(callback);
            observer.observe(_this, {attributes: true});
         };

         observering($(this)[0]);

         var openMe = function (_this) {
            // _this.addClass('open');
            _this.addClass('mega-open');
            var _content = _this.find(settings.contentClass);
            if (_content.is(':empty')) {
               return false;
            }
            if (settings.dropdownArrows) {
               var _arrow = _this.find('.arrow');
            }

            var _animations = {
               duration: settings.transition,
               easing: settings.easing
            };

            switch (settings.animation) {
               case 'none':
                  _content.stop(true, true).show();
                  if (settings.dropdownArrows) {
                     _arrow.show();
                  }
                  break;
               case 'fade':
                  _content.stop(true, true).fadeIn(_animations);
                  if (settings.dropdownArrows) {
                     _arrow.stop(true, true).fadeIn(_animations);
                  }
                  break;
               default:
                  _content.stop(true, true).slideDown(_animations);
                  if (settings.dropdownArrows) {
                     _arrow.show();
                  }
                  break;
            }
         };

         var closeMe = function (_this) {
            var _content = _this.find(settings.contentClass);
            if (settings.dropdownArrows) {
               var _arrow = _this.find('.arrow');
            }
            var _animations = {
               duration: settings.transition,
               easing: settings.easing
            };
            switch (settings.animation) {
               case 'none':
                  _content.stop(true, true).hide();
                  if (settings.dropdownArrows) {
                     _arrow.hide();
                  }
                  break;
               case 'fade':
                  _content.stop(true, true).fadeOut(_animations);
                  if (settings.dropdownArrows) {
                     _arrow.stop(true, true).fadeOut(_animations);
                  }
                  break;
               default:
                  // _content.stop(true, true).slideUp(_animations);
                  // if (settings.dropdownArrows) {
                  //    setTimeout(function () {
                  //       _arrow.hide();
                  //    }, settings.transition);
                  // }
                  break;
            }
            setTimeout(function () {
               // _this.removeClass('open');
               _this.removeClass('mega-open');
               _this.find(".mega-open").removeClass("mega-open");
            }, settings.transition);
         };

         if (settings.trigger == 'hover') {
            _megamenu.unbind('mouseenter mouseleave').hover(function () {
               openMe($(this));
            }, function () {
               console.log(this);
               closeMe($(this));
            });
         } else {
            _megamenu.find('.megamenu-item-link.has-children').unbind('click').click(function (e) {
            // _megamenu.find('.megamenu-item-link.item-level-1').unbind('click').click(function (e) {
               e.preventDefault();
               e.stopPropagation();
               if ($(this).parent(settings.megamenuClass).hasClass('mega-open')) {
                  closeMe($(this).parent(settings.megamenuClass));
               } else {
                  openMe($(this).parent(settings.megamenuClass));
                  $(this).parent(settings.megamenuClass).siblings(settings.megamenuClass).each(function () {
                     closeMe($(this));
                  });
               }
            });

            $(document).click(function (event) {
               var $trigger = _megamenu;
               if ($trigger !== event.target && !$trigger.has(event.target).length) {
                  closeMe($trigger);
               }
            });
         }
      });
   };
   $(function () {
      $('[data-megamenu]').TemPlazaMegaMenu();
   });
})(jQuery);