$(function() {
    setTimeout(function() {
        $('body').addClass('loaded');





        /* TODO impostare */





        options = {
            "cursorOuter": "circle-basic",
            "hoverEffect": "circle-move",
            "hoverItemMove": false,
            "defaultCursor": false,
            "outerWidth": 30,
            "outerHeight": 30
        };
        magicMouse(options);





    }, 1000);

});

$(document).ready(function() {

    $(".menu-icon").on("click", function() {
        $("nav ul").toggleClass("showing");
    });


});





/* TODO attivazione butter-js  */

/* inizializzazione butter-js standard */
/*butter.init({cancelOnTouch: true});*/

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







$('body').show();
$('.version').text(NProgress.version);
NProgress.start();
setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

$("#b-0").click(function() { NProgress.start(); });
$("#b-40").click(function() { NProgress.set(0.4); });
$("#b-inc").click(function() { NProgress.inc(); });
$("#b-100").click(function() { NProgress.done(); });