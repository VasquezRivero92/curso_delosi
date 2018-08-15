/*******************************************************************************/
var $JAct = 0;
var $MuevePlayer = 0;
var $startTime = 0;
var $stopTimeIntervalo = 0;
var $cronoStartTime = 0;
var $stopTimeCrono = 0;
var $delayTime = 20;
var Impactos = 0;
var ChoqueConPared = false;
var DirRetroceso = -1;
var $pasaPared = 0;
var $hitInterval = 0;
var $hitStartTime = 0;
var ChoqueFuturo = false;
// intervalo del hit(momentaneo)
//var $hitInterval = 0;
//var $hitStartTime = 0;
// arrays de objetos del juego
var pass_hit = 0;

var $Enemigos = [];
var $PPwrUp = [];
var $PPwrOc = [];
var $GrupoVidas = [];
var $Meta;
var $AnimacionCreada = 0;

var $intentos = 5;
var $vidasAcumuladas = 0;
var $puntajeAcumulado = 0;
var $sombraSC = 0;
var $KC_boton;

var $ParedMask1;
var $PowerUps = [];
var $PowerPE = [];
var $PowerPR = [];
var $ActPwrUp = 0;
var $Preguntas = [null, 1, 1, 1, 2, 2, 3, 3, 3, 3, 4, 4, 5, 5, 5, 5];
var $slA = [null,'...'];
var $slB = [null,'...'];
var $slC = [null,'...'];
var $AnimacionCreada = 0;
var $KC_boton;
var $ExisteTouch = 0;
var $J = [];
$J[1] = new Lab_Juego();
var $seleccionPlayer = 0;
var $scaleActual = 1;
$.fn.reverse = [].reverse;

$(document).ready(function (e) {
    initJuegos();
    $(".dirBtn, .circleExt, .touchElement, .btnPlayer").disableSelection();
    initSonidos();
    $ExisteTouch = 'ontouchend' in document;
    redimensionarJuego();
    if ($ExisteTouch) {
        initTouchControl();
    }
    initKeyControl();
    initBotones();
    $(window).resize(function () {
        redimensionarJuego();
        if ($ExisteTouch) {
            initTouchControl();
        }
    });
    $("#qLoverlay").show();
    $("#historia").queryLoader2({
        barColor: "#000000",
        backgroundColor: "#333333",
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
        $J[1].showJuego();
        $('.caratula').stop().fadeOut(10);
    });
    //botones del juego
    $('#btnReiniciar').click(function () {
        // playSound(window.audioCatch);
        // showInicio();
        stopBGMusic();
        stopTexto();
        playSound(window.audioCatch);
        $('.instrucciones').stop().fadeOut(1000);
        $JAct = 1;        
        introJuego();
        CalcularLimites();
        PlayerMov.id = $('#Player_1');
        PlayerMov.cargar();
        $('.caratula').stop().fadeOut(10);        
        $('.caratula, .game, #capaResumen, #TerminoTiempo').stop().fadeOut(500);
        $('#escenaJuego1').fadeIn(1000);
    });
    $('#btnReinicio').click(function () {
        playSound(window.audioCatch);
        showInicio();
        $('.caratula, .game, #capaResumen').stop().fadeOut(500);
    });
    $('#pausaTouch').click(function () {
        if ($MuevePlayer) {
            if ($(this).hasClass("paused")) {
                $("#btnReanudar").click();
            } else {
                $(this).addClass("paused");
                pausarJuego();
            }
        }
    });
    $('#btnReanudar').click(function () {
        $('#pausaTouch').removeClass('paused');
        $('#PauseGame').fadeOut(200);
        $J[$JAct].CTiempo = $J[$JAct].CTiempo + 1;
        isPaused = false;
    });
    // $('.pregOpc').click(function () {
    //     $('.caratula').stop().fadeOut(300);
    //     var idResp = parseInt($(this).attr('id').split("_")[1], 10);
    //     //$('#powerUp_'+$ActPwrUp).addClass("hit");
    //     $PowerUps[$ActPwrUp - 1].hit = false;
    //     if ($ActPwrUp >= 12 && idResp === $Preguntas[$ActPwrUp]) {
    //         playSound(window.bien);
    //         $('#pregWindow').stop().fadeOut(400);
    //         $('.caratula').stop().delay(500).fadeOut(10);
    //         $PowerUps[$ActPwrUp - 1].visible = -1;
    //         $J[$JAct].CTiempo = $J[$JAct].CTiempo + 1;
    //         isPaused = false;
    //         $ActPwrUp = 0;
    //     } else if (idResp === $Preguntas[$ActPwrUp]) {
    //         playSound(window.bien);
    //         $PowerUps[$ActPwrUp - 1].visible = -1;
    //         $('#icoPel_' + $ActPwrUp).hide();
    //         $('#icoPrev_' + $ActPwrUp).show();
    //         aumentaPtos1();
    //         $("#bienResp").html($(this).children().html().replace("<br>", " "));
    //         $("#pregBien").stop().delay(300).fadeIn(300);
    //         setTimeout(function () {
    //             $('#bienSlide_' + $ActPwrUp + ' .bSlideA').html($slA[$ActPwrUp]).addClass("animated bounceInRight").show();
    //         }, 500);
    //         setTimeout(function () {
    //             $('#bienSlide_' + $ActPwrUp + ' .bSlideB').html($slB[$ActPwrUp]).addClass("animated bounceInRight").show();
    //         }, 800);
    //         setTimeout(function () {
    //             $('#bienSlide_' + $ActPwrUp + ' .bSlideC').html($slC[$ActPwrUp]).addClass("animated bounceInRight").show();
    //         }, 1100);
    //         setTimeout(function () {
    //             $('#bienFlechas').addClass("animated bounceIn").show();
    //         }, 1300);
    //     } else {
    //         playSound(window.audioCrash);
    //         $PowerUps[$ActPwrUp - 1].visible = 200;
    //         $('#pregMal').stop().delay(300).fadeIn(300);
    //     }
    // });
    $('#btnReintento').click(function () {
        $('#pregWindow').stop().fadeOut(400);
        $(".caratula").stop().delay(500).fadeOut(10);
        $J[$JAct].CTiempo = $J[$JAct].CTiempo + 1;
        isPaused = false;
    });
    $('#btnListo').click(function () {
        $ActPwrUp = 0;
        $('#pregWindow').stop().fadeOut(400);
        $('.caratula').stop().delay(500).fadeOut(10);
        if ($J[1].contAciertos >= 11) {
            setTimeout(function () {
                $J[1].finJuego(2);
            }, 500);
        } else {
            $J[$JAct].CTiempo = $J[$JAct].CTiempo + 1;
            isPaused = false;
        }
    });
    $("#Player_1 .ptje").click(function () {
        if ($ActPwrUp) {
            muestraPregunta();
        }
    });
}
function initJuegos() {
    $ParedMask1 = new Lab_Objeto(0, 0, 120, 90);
    $ParedMask1.canvas = document.createElement('canvas');
    $ParedMask1.canvas.width = $ParedMask1.width;
    $ParedMask1.canvas.height = $ParedMask1.height;
    $ParedMask1.ctx = $ParedMask1.canvas.getContext("2d");
    $ParedMask1.ctx.globalCompositeOperation = "copy";
    $J.forEach(function (itm, i) {
        $J[i].init(i);
    });
}
function showInicio() {
    playBGMusic(window.BGIntro);
    playTexto(window.txti1);
    redimensionarJuego();
    $('.instrucciones').stop().hide();
    $('#instrucciones_1').fadeIn(1000);
    setTimeout(function () {
        $(".instrucciones").stop().delay(300).fadeOut(100);
        $("#instrucciones_2").stop().fadeIn(500);
        playTexto(window.txti2);
    }, 4000);
}
function introJuego() {
    $(".caratula,.conteo").stop().fadeOut(10);
    $(".conteo").removeClass('anima bounceIn');
    $("#infoWindow").show();
    setTimeout(function () {
        $("#conteo3").addClass('anima bounceIn').show();
        playSound(window.beep);
    }, 1500);
    setTimeout(function () {
        $("#conteo2").addClass('anima bounceIn').show();
        playSound(window.beep);
    }, 2500);
    setTimeout(function () {
        $("#conteo1").addClass('anima bounceIn').show();
        playSound(window.beep);
    }, 3500);
    setTimeout(function () {
        if ($ExisteTouch) {
            $(".touchElement").addClass("show");
        }
    }, 4000);
    setTimeout(function () {
        $("#infoWindow").fadeOut(300);
        $J[$JAct].inicioJuego();
        $(".gameEnv").show();
    }, 4000);
    setTimeout(function () {
        playSound(window.beepXL);
    }, 4500);
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
    $('body, html').css("height", window.innerHeight);
}
function MostrarTiempo() {
    $J[$JAct].CSeg = $J[$JAct].CTiempo % 60;
    $J[$JAct].CMin = parseInt($J[$JAct].CTiempo / 60);
    $("#CMin").html($J[$JAct].CMin);
    CCero = "";
    if ($J[$JAct].CSeg < 10) {
        CCero = "0";
    }
    $("#CSeg").html(CCero + $J[$JAct].CSeg);
}
function pausarJuego() {
    isPaused = true;
    $("#PauseGame").show();
}

function TerminoTiempo() {
    isPaused = true;
    $("#TerminoTiempo").show();
}

function showPuntos() {
    //PlayerMov.areaPtje.removeClass('animated rubberBand');
    setTimeout(function () {
        //PlayerMov.areaPtje.addClass('animated rubberBand').show();
    }, 1);
    setTimeout(function () {
        //PlayerMov.areaPtje.fadeOut(500);
    }, 1000);
    setTimeout(function () {
        //PlayerMov.areaPtje.removeClass('animated rubberBand');
    }, 1500);
}


function showT20s() {
    //$J[$JAct].ptsWinJuego = $J[$JAct].ptsWinJuego + $J[$JAct].puntajeAcierto;
    //$("#pts").html($J[$JAct].ptsWinJuego);
    PlayerMov.areaT20s.removeClass('animated rubberBand');
    setTimeout(function () {
        PlayerMov.areaT20s.addClass('animated rubberBand').show();
    }, 1);
    setTimeout(function () {
        PlayerMov.areaT20s.fadeOut(500);
    }, 1000);
    setTimeout(function () {
        PlayerMov.areaT20s.removeClass('animated rubberBand');
    }, 1500);
}

function Celebracion(nombre) {
    $(".celebracion").removeClass("anim anim2");
    setTimeout(function () {
        $("#celeb" + $JAct + "_" + nombre).addClass("anim");
        $("#icon_" + nombre).addClass("anim check");
    }, 1);
}

// function muestraPregunta() {
//     playSound(window.audioCatch);
//     isPaused = true;
//     $(".caratula").stop().fadeOut(10);
//     $(".pregVista").hide();
//     $("#bienFlechas").removeClass("animated bounceIn").hide();
//     $(".bienSlider div").removeClass("animated bounceInRight").hide();
//     PlayerMov.areaPtje.stop().removeClass('animated rubberBand').fadeOut(300);
//     $('#pregTXT').html($slA[$ActPwrUp]);
//     $("#pregVista_" + $ActPwrUp).show();
//     $("#pregMain").show();
//     $("#pregWindow").fadeIn(400);
// }

$.fn.extend({
    disableSelection: function () {
        this.each(function () {
            this.onselectstart = function () {
                return false;
            };
            this.unselectable = "on";
            $(this).css({'-webkit-user-select': 'none', '-moz-user-select': 'none', 'user-select': 'none'});
        });
    }
});
/*******************************************************************************/