/* ::::::::::::::  * A_SETTINGS loader
:::::::::::::::::    add loaded and set timeout loader */
$(function () {
    setTimeout(function () {
        /* init loader effect */
        $('body').addClass('loaded');
    }, 1500);
});

$(document).ready(function () {
    /* setting link disable and set timout at link fot transition loader */
    $('a').click(function () {
        if (($(this).is(':not([href^="tel:"]):not([href^="mailto:"])'))) {
            if (!$(this).hasClass("item-img-gallery")) {
                if (!$(this).is('[data-lightbox-gallery]')) {

                    $('body').removeClass('loaded');

                    setTimeout(function (url) {
                        window.location = url
                    }, 1000, this.href);
                }
            }
        }
    });
});


/* ::::::::::::::  * A_SETTINGS animate */
$(document).ready(function () {
    var viewportchecker_active = document.getElementById("viewportchecker-js");
    if (viewportchecker_active) {
        /* init animate and add visibile item in viewport after with offset */
        jQuery('.in__animate').addClass("hidden").viewportChecker({
            classToAdd: 'visible animate__animated animate__fadeIn animate__slow ',
            offset: 300,
            repeat: true,
        });
    }
});

/* ::::::::::::::  * A_SETTINGS sticky */
$(function () {
    //caches a jQuery object containing the header element
    var header = $(".sticky");
    var lastScrollTop = 0;
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        var scrolltop = $(this).scrollTop();
        if (scrolltop > lastScrollTop) {
            // downscroll code
            if (scroll >= 500) {
                header.removeClass('sticky').addClass("sticky-in");
            } else {
                header.removeClass("sticky-in").addClass('sticky');
            }
        } else {
            header.removeClass("sticky-in").addClass('sticky');
        }
        lastScrollTop = scrolltop;
    });
});


/* ::::::::::::::  * A_SETTINGS magicMouse */
var magicmouse_active = document.getElementById("magic-mouse-js");
$(document).ready(function () {
    if (magicmouse_active) {
        $(".main").addClass("magicmouse_active");
        // Attivo su tutte le immagini
        $("img").addClass("magic-hover", "magic-hover__square");
        // $("a").addClass("magic-hover","magic-hover__square");

        document.body.style.cursor = 'none!important';
        //cursorOuter	Default: "circle-basic", other options : "disable"
        // hoverEffect	default: "circle-move", other options : "pointer-blur", "pointer-overlay"
        options = {
            "cursorOuter": "circle-basic",
            "hoverEffect": "pointer-overlay",
            "hoverItemMove": false,
            "defaultCursor": false,
            "outerWidth": 30,
            "outerHeight": 30
        };
        magicMouse(options);
    }
});

/* ::::::::::::::  * A_SETTINGS butter-js  */
var butter_active = document.getElementById("butter-js");
$(document).ready(function () {
    if (butter_active) {
        document.body.setAttribute('id', 'butter');
        $(".main").attr("id", "butter-active");
        /* inizializzazione butter-js standard */
        // butter.init({cancelOnTouch: true});
        /* impostazione opzioni quando si attiva butter-js */
        var options = {
            /* impostare custom id per attivare butter-js */
            wrapperId: 'butter-active',
            /* impostare velocita butter-js  */
            wrapperDamper: 0.10,
            /* impostare attivazione butter-js in responsive */
            cancelOnTouch: true,
        };
        butter.init(options);
    }
});


/* ::::::::::::::  * A_SETTINGS menu showing  */
$(document).ready(function () {
    $(".menu-icon").on("click", function () {
        $("nav ul").toggleClass("showing");
        // alert('showing menu-icon');
    });
});


/* ::::::::::::::  * A_SETTINGS jarallax-js  */
owl_carousel_active = document.getElementById('owl_carousel-js')
if (owl_carousel_active) {
    /* init jarallax-js with original class */
    $('.jarallax').jarallax({
        keepImg: true,
    });
    /* init jarallax-js with class .jarallax-keep-img */
    $('.jarallax-keep-img').jarallax({
        keepImg: true,
    });

    /* init jarallax-js  with class  con una class .jarallax-overlay */
    $('.jarallax-overlay').jarallax({
        keepImg: true,
    });
}


/* ::::::::::::::  * A_SETTINGS NProgress-js */
nprogress_active = document.getElementById('nprogress-js')
if (nprogress_active) {
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function () {
        NProgress.done();
        $('.fade').removeClass('out');
    }, 1000);
    $("#b-0").click(function () {
        NProgress.start();
    });
    $("#b-40").click(function () {
        NProgress.set(0.4);
    });
    $("#b-inc").click(function () {
        NProgress.inc();
    });
    $("#b-100").click(function () {
        NProgress.done();
    });
}



