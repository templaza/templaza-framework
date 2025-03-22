function preloader(){

    var progressBar = jQuery(".progress");
    var percentageText = jQuery(".percentage");

    var tl = gsap.timeline();


    tl.to(progressBar, { height: "100%", duration: 2.5, delay:1, ease: "power1.out" })
        .to(percentageText, { text: "100%", duration: 2 }, "-=2")
        .to("#preloader", {y:'-101%', display: "none", duration: 1,  ease: "Expo.easeInOut" }, "+=0.5");

    var count = { value: 0 };
    gsap.to(count, {
        value: 100,
        duration: 2.5,
        onUpdate: function() {

            if(Math.round(count.value) < 50 && Math.round(count.value) >2){
                jQuery(".percentage").addClass('processing1');
            }
            if(Math.round(count.value) > 50){
                jQuery(".percentage").removeClass('processing1');
                jQuery(".percentage").addClass('processing2');
            }
            if(Math.round(count.value) > 90){
                jQuery(".percentage").removeClass('processing1, processing2');
                jQuery(".percentage").addClass('processing3');
            }
            percentageText.text(Math.round(count.value) + "%");
        },
        delay: 1
    });

}

preloader();


/*----------------------------------------------------*/
/*	SMOOTH SCROLL
/*----------------------------------------------------*/

var elem = document.querySelector("#content-scroll");
var scrollbar = Scrollbar.init(elem,
    {
        renderByPixels: true,
        damping:0.1
    });

scrollbar.setPosition(0, 0);
scrollbar.track.xAxis.element.remove();

ScrollTrigger.scrollerProxy(document.body, {
    scrollTop(value) {
        if (arguments.length) {
            scrollbar.scrollTop = value;
        }
        return scrollbar.scrollTop;
    }
});

scrollbar.addListener(ScrollTrigger.update);
