(function ($) {
$(document).ready(function() {
    var headerAnimation = gsap.timeline({yoyo: false, reversed: true});
    headerAnimation.pause();

    headerAnimation.from($('.overlay-menu'), {autoAlpha: 0});
    headerAnimation.from($('.overlay-menu .left-area'), {y: '100vh'}, 0.1);
    headerAnimation.from($('.overlay-menu .right-area'), {y: '-100vh'}, 0.1);
    headerAnimation.from($('.overlay-menu .right-area .block-sidebar'), {autoAlpha: 0, stagger: .1}, 0.5);
    headerAnimation.from($('.overlay-menu nav li:not(.overlay-menu nav ul li ul li)'), {
        stagger: .05,
        y: 30,
        autoAlpha: 0,
        ease: "power1.inOut",
    }, 0.5);

    $('header .burger-menu, .overlay-menu .close').on('click', function(){
        headerAnimation.reversed() ? headerAnimation.play(): headerAnimation.reverse();
    });
    $('.overlay-menu .menu-item-has-children').each(function(){
        $(this).find('.menu-go-back').hide();
        $(this).children('ul').prepend('<li class="menu-item"><a class="back" href="#">back <i class="fa-solid fa-arrow-left"></i></a></li>');
    });
    $('.overlay-menu .menu-item-has-children > span').each(function(){
        var overlay_animation = gsap.timeline({yoyo: false,reversed: true});
        overlay_animation.pause();
        overlay_animation.to( $(this).closest('ul').children('li').children('a, span'), { stagger:.1, autoAlpha:0, y:-50, ease: "power1.inOut"  } )
        overlay_animation.to($(this).next('ul'),{ 'z-index':'10', 'pointer-events': 'all' })
        overlay_animation.from($(this).next('ul').children('li').children('a'), {stagger:.1, autoAlpha:0, y:30,  ease: "power1.inOut" });

        this.animation = overlay_animation;
        $(".overlay-menu .back, .overlay-menu .close").on('click', function() {
            overlay_animation.reverse();
            overlay_animation.eventCallback('onReverseComplete', function() {
                $('.menu-item-has-children').removeClass('parent_active');
            });
        });

    });

    $(".overlay-menu .menu-item-has-children > .menu-indicator").on('click', function() {
        this.animation.reversed() ? this.animation.play(): this.animation.reverse();
    })


})
})(jQuery);