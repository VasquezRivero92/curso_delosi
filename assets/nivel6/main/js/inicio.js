/*******************************************************************************/
var sClick = [true, false, false, false, false];
var lAudio = [null, '', '', '', ''];
var sID = 0;
var completo = false;
/*******************************************************************************/
function showInicio() {
    redimensionarJuego();
    $('.instrucciones').stop().hide();
    $('#instruccion_1').fadeIn(1000);
    playSound(window.nivelBG);
    setTimeout(function () {
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#instruccion_3').stop().fadeIn(500);
        playBGMusic(window.menuBG);
        //playTexto(window.txti2);
    }, 4000);
}
function redimensionarJuego() {
    scale1 = (window.innerWidth / 1350);
    scale2 = (window.innerHeight / 700);
    if (scale1 <= scale2) {// cuando sobra height
        $('.resizeWindow').css({'left': '0px', 'transform': 'scale(' + scale1 + ')'});
        $scaleActual = scale1;
    } else {// cuando sobra width
        var left = (window.innerWidth - (1350 * scale2)) / 2;
        $('.resizeWindow').css({'left': left + 'px', 'transform': 'scale(' + scale2 + ')'});
        $scaleActual = scale2;
    }
    $('body, html').css('height', window.innerHeight);
}
function initSonidos() {
    audios.forEach(function (itm, i) {
        loadSound(itm[0], itm[1]);
    });
}
/*******************************************************************************/
$(document).ready(function (e) {
    initSonidos();
    redimensionarJuego();
    $(window).resize(redimensionarJuego);
    $('#qLoverlay').show();
    $('#historia').queryLoader2({
        barColor: '#000000',
        backgroundColor: '#333333',
        percentage: true,
        minimumTime: 100,
        barHeight: 0,
        onComplete: showInicio
    });
    $('.i3btn').click(function () {
        playSound(window.playBTN);
        sID = parseInt($(this).attr('id').split('_')[1], 10);
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#sliderPage_' + sID).stop().fadeIn(500);
        if (lAudio[sID]) {
            playTexto(window[lAudio[sID]]);
        } else {
            playTexto(window['s' + sID + 'i1']);
        }
    });
    $('.btnVolver').click(function () {
        stopTexto();
        playSound(window.playBTN);
        $('.instrucciones').stop().delay(10).fadeOut(500);
        $('#instruccion_3').stop().fadeIn(10);
        var comp1 = sClick.every(function (itm) {
                return itm === true;
            });
            if (comp1) {//cambiar aqui, sin la exclamacion                
                playTexto(window.test);
            }
    });
    $('.owl-carousel').owlCarousel({
        dots: false,
        items: 1,
        loop: false,
        margin: 0,
        nav: true,
        mouseDrag: false,
        touchDrag: false
    }).on('translated.owl.carousel', function (e) {
        //console.log(e.item);
        var id = e.item.index + 1;
        lAudio[sID] = 's' + sID + 'i' + id;
        playTexto(window[lAudio[sID]]);
        console.log(lAudio[sID]);
        if (!completo && id === e.item.count) {
            $('#sliderPage_' + sID + ' .btnVolver').show();
            $('#i3btn_' + sID).addClass('disable');
            sClick[sID] = true;
            var comp = sClick.every(function (itm) {
                return itm === true;
            });
            if (comp) {//cambiar aqui, sin la exclamacion
                completo = true;                
                $('.i3btn').removeClass('disable');
                $('#i3txt_2,#btnJugar,#btnJugar2').show();
                //playTexto(window.test);
            }
        }
    });
});
/*******************************************************************************/