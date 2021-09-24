/* A_SETTINGS sticky */
$(function () {
    setTimeout(function () {
        /* inizializzazione loader effect */
        $('body').addClass('loaded');

    }, 1500);
});



$(document).ready(function() {


    $('a').click(function(e) {
        e.preventDefault();
        if (($(this).is(':not([href^="tel:"]):not([href^="mailto:"])'))) {
            if (!$(this).hasClass("item-img-gallery")) {


                setTimeout(function(url) { window.location = url }, 1000, this.href);
            }
        }
    });


    $('a').click(function () {
        if (($(this).is(':not([href^="tel:"]):not([href^="mailto:"])'))) {
            if (!$(this).hasClass("item-img-gallery")) {


                $('body').removeClass('loaded');
            }
        }
    });


    jQuery('.in__animate') .addClass("hidden") .viewportChecker({
        classToAdd: 'visible animate__animated animate__fadeIn animate__slow ',
        offset: 300,
        repeat:true,
    });
});

/* A_SETTINGS sticky */
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


$(document).ready(function () {


    $(".menu-icon").on("click", function () {
        $("nav ul").toggleClass("showing");
    });


    /* A_SETTINGS attivazione magicMouse */
    // Attivo su tutte le immagini
    $("img").addClass("magic-hover","magic-hover__square");
    $("a").addClass("magic-hover","magic-hover__square");

    var magicmouse_active = document.getElementsByClassName("magicmouse_active");
    if (magicmouse_active != null) {
        document.body.style.cursor = 'none';

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

    /* A_SETTINGS attivazione butter-js  */
    var butter_active = document.getElementById("butter");
    if (butter_active != null) {
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


/* inizializzazione jarallax-js con una classe originale */
$('.jarallax').jarallax({
    keepImg: true,
});

/* inizializzazione jarallax-js con una classe specifica */
$('.jarallax-keep-img').jarallax({
    keepImg: true,
});


/* inizializzazione NProgress-js standard */
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