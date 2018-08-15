/*******************************************************************************/
// intervalo de movimiento del player
var $MuevePlayer = 0;
var $startTime = 0;
var $stopTimeIntervalo = 0;
var $cronoStartTime = 0;
var $stopTimeCrono = 0;
var $delayTime = 20;

var $J = {
    numJ: 1,
    ptsWinJuego: [0, 0, 0, 0, 0], //ptos generados por acierto en el juego
    intentos: 3,
    puntajeAcierto: 20,
    // para el control de tiempo
    CTInicial: 60,
    CTiempo: 0,
    CMin: 0,
    CSeg: 0
};
var $scaleActual = 1;

$.fn.reverse = [].reverse;

$(document).ready(function (e) {
    //$(".dirBtn, .circleExt, .touchElement, .btnPlayer").disableSelection();
    initSonidos();
    redimensionarJuego();
    $('.slot li').each(function (i) {
        var id = $(this).data('id') ? $(this).data('id') : '0';
        $(this).addClass('rlItm' + id);
    });
    $('.slot').jSlots({
        number: 4,
        spinner: '#btnPlay',
        time: 5000,
        loops: 3
    });
    initBotones();
    $(window).resize(function () {
        redimensionarJuego();
    });
    $('#qLoverlay').show();

    $('#historia').queryLoader2({
        barColor: '#000000',
        backgroundColor: '#333333',
        percentage: true,
        minimumTime: 100,
        barHeight: 0,
        onComplete: showInicio
    });
});
function initSonidos() {
    audios.forEach(function (itm, i) {
        loadSound(itm[0], itm[1]);
    });
}
function initBotones() {

    $('#nextInt_1').click(function () {
        playSound(window.audioCatch);
        $('.instr').stop().fadeOut(100);
        $('#inst_2').stop().fadeIn(100);
    });
    $('.btn_CAL_A').click(function () {
        playSound(window.audioCatch);
        var id = String($(this).attr('id').split('_')[1], 10);
        $('.instr').stop().fadeOut(100);
        $('#calificacion').stop().fadeOut(1000);
        calif1 = id;
        // convertir el concatenado en valor numerico
        var x = parseInt(calif1);
        var data = {calificacion: x};
        $.post(bdir + 'ajax/set_calificacion', data).done(function (data) {
        console.log("resultado: " + data);
        });
    });

    
    $('.btnUp').mouseenter(function () {
        $(this).addClass('hover');
    }).mouseleave(function () {
        $('.btn').removeClass('hover');
    });
    $('.btnDown').mouseenter(function () {
        $(this).addClass('hover');
        var id = parseInt($(this).attr('id').split('_')[1], 10) - 1;
        if (id === 3) {
            $('.btnUp').eq(1).addClass('hover');
        }
    }).mouseleave(function () {
        $('.btn').removeClass('hover');
    });
    /***************************************************************************/
    $('.btnPrev').click(function () {
        playSound(window.audioCatch);
        var id = parseInt($(this).attr('id').split('_')[1], 10);
        $('.instrucciones').stop().delay(10).fadeOut(500);
        var j = id - 1;
        $('#instrucciones_' + j).stop().fadeIn(10);
        playTexto(window['txti' + j]);
    });
    $('.btnNext').click(function () {
        playSound(window.audioCatch);
        var id = parseInt($(this).attr('id').split('_')[1], 10);
        $('.instrucciones').stop().delay(300).fadeOut(100);
        var j = id + 1;
        $('#instrucciones_' + j).stop().fadeIn(500);
        playTexto(window['txti' + j]);
    });
    $('#btnJugar').click(function () {
        stopBGMusic();
        stopTexto();
        playSound(window.audioCatch);
        $('.instrucciones').stop().fadeOut(1000);
        $J.showJuego();
        $('.caratula').stop().fadeOut(10);
    });
    //botones del juego
    $('#btnReinicio').click(function () {
        showInicio();
        $('.caratula, .game, #capaResumen').stop().fadeOut(500);
    });
    $('#pausaTouch').click(function () {
        if ($MuevePlayer) {
            if ($(this).hasClass('paused')) {
                $('#btnReanudar').click();
            } else {
                $(this).addClass('paused');
                pausarJuego();
            }
        }
    });
    $('#btnReanudar').click(function () {
        $('#pausaTouch').removeClass('paused');
        $('#PauseGame').fadeOut(200);
        $J.CTiempo = $J.CTiempo + 1;
        isPaused = false;
    });
    $('#btnComprobar').click($J.comprobar);
    $('#btnFin,#btnListo').click(function () {
        $('#pregWindow').stop().fadeOut(400);
        $('.caratula').stop().delay(500).fadeOut(10);
        $('#slideImagen').hide();
        $J.numJ++;
        setTimeout(function () {
            if ($J.numJ > 4) {
                $J.finJuego();
            } else {
                $('#btnPlay').click();
            }
        }, 500);
    });
}
function blockBtns() {
    $('#tragamonedas .btn').addClass('disable');
    $('#btnComprobar').addClass('disable');
    $('#btnPlay').removeClass('disable');
}
function unblockBtns() {
    $('#tragamonedas .btn').removeClass('disable');
    $('#btnComprobar').removeClass('disable');
    $('#btnPlay').addClass('disable');
}
function showInicio() {
    playBGMusic(window.BGIntro);
    playTexto(window.txti1);
    redimensionarJuego();
    $('.instrucciones').stop().hide();
    $('#instrucciones_1').fadeIn(1000);
    setTimeout(function () {
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#instrucciones_2').stop().fadeIn(500);
        playTexto(window.txti2);
    }, 4000);
}
function introJuego() {
    $('.caratula').stop().fadeOut(10);
    $('.gameEnv').show();
    setTimeout(function () {
        $J.inicioJuego();
    }, 1500);
}
/*******************************************************************************/
function redimensionarJuego() {
    scale1 = (window.innerWidth / 1350);
    scale2 = (window.innerHeight / 700);
    if (scale1 <= scale2) {// cuando sobra height
        $('.resizeWindow').css({'left': '0px', 'transform': 'scale(' + scale1 + ')'});
        $scaleActual = scale1;
    } else {//cuando sobra width
        var left = (window.innerWidth - (1350 * scale2)) / 2;
        $('.resizeWindow').css({'left': left + 'px', 'transform': 'scale(' + scale2 + ')'});
        $scaleActual = scale2;
    }
    $('body, html').css('height', window.innerHeight);
}
function pausarJuego() {
    isPaused = true;
    $("#PauseGame").show();
}
$.fn.extend({
    disableSelection: function () {
        this.each(function () {
            this.onselectstart = function () {
                return false;
            };
            this.unselectable = 'on';
            $(this).css({'-webkit-user-select': 'none', '-moz-user-select': 'none', 'user-select': 'none'});
        });
    }
});
/*******************************************************************************/