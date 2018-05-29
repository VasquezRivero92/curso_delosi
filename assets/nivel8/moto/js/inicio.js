/*******************************************************************************/
// numero de juego actual
var $JAct = 0;
// Maximo nivel alcanzado
//var $JMax = 1;
// intervalo de movimiento del player
var $MuevePlayer = 0;
var $startTime = 0;
var $stopTimeIntervalo = 0;
var $cronoStartTime = 0;
var $stopTimeCrono = 0;
var $delayTime = 20;
// choque futuro con paredes
var ChoqueFuturo = false;
var $Enemigos = [];
var ContPreguntas = 0;
var $TimeDie = false; 
var $TDie = 0; 
// intervalo del hit(momentaneo)
//var $hitInterval = 0;
//var $hitStartTime = 0;
// arrays de objetos del juego
var $ParedMask1;
var $PowerUps = [];
var $PowerPE = [];
var $PowerPR = [];
var $ActPwrUp = 0;
var $Preguntas = [null, 1, 1, 1, 1, 1];
var $slA = [null,
    'preguntas - 1',
    'preguntas - 2',
    'preguntas - 3',
    'preguntas - 4',
    'preguntas - 5',
];
var $slB = [null,
    'opcion 1 - 1',
    'opcion 1 - 2',
    'opcion 1 - 3',
    'opcion 1 - 4',
    'opcion 1 - 5',
];
var $slC = [null,
    'opcion 2 - 1',
    'opcion 2 - 2',
    'opcion 2 - 3',
    'opcion 2 - 4',
    'opcion 2 - 5',
];
var $slD = [null,
    'opcion 3 - 1',
    'opcion 3 - 2',
    'opcion 3 - 3',
    'opcion 3 - 4',
    'opcion 3 - 5',
];
var $opc_TR = [null,
    'porque esta mal opcion 3 - 1',
    'porque esta mal opcion 3 - 2',
    'porque esta mal opcion 3 - 3',
    'porque esta mal opcion 3 - 4',
    'porque esta mal opcion 3 - 5',
];

var $AnimacionCreada = 0;
// variables de puntaje
//var $puntajeAcumulado = 0;
var $KC_boton;
var $ExisteTouch = 0;
var $J = [];
$J[1] = new Lab_Juego();
//for (var i = 1; i <= 6; i++) { $J[i] = new Lab_Juego(); }
//var $seleccionPlayer = 0;
// MiniMap y su canvas
/***
 var $MiniMap1 = new Lab_MiniMap(1); //paredes estaticas
 var $MiniMap2 = new Lab_MiniMap(2); //Player
 /***/
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
    $('#btnReinicio').click(function () {
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
        $('#gameArea1').addClass('pista_anim');
    });
    $('.pregOpc').click(function () {
        $('.caratula').stop().fadeOut(300);
        var idResp = parseInt($(this).attr('id').split("_")[1], 10);
        var x = $('#preg_' + idResp + ' span').text();
        $('#bad_A1 span').text(x)
        if (idResp === $Preguntas[$ActPwrUp]) {
            playSound(window.bien);
            //$PowerUps[$ActPwrUp - 1].visible = -1;
            $('#icoPel_' + $ActPwrUp).hide();
            $('#icoPrev_' + $ActPwrUp).show();
            aumentaPtos1();
            $("#icon_" + $ActPwrUp).addClass("anim check");
            // $("#bienResp").html($(this).children().html().replace("<br>", " "));
            $("#pregBien").stop().delay(300).fadeIn(300);
        } else {
            playSound(window.audioCrash);
            //$PowerUps[$ActPwrUp - 1].visible = 200;
            $('#pregMal').stop().delay(300).fadeIn(300);
            $('#bad_A2 span').html($opc_TR[$ActPwrUp]);
        }
    });
    $('#btnReintento').click(function () {
        $('#pregWindow').stop().fadeOut(400);
        $(".caratula").stop().delay(500).fadeOut(10);
        $('#gameArea1').addClass('pista_anim');
        if ($J[1].contAciertos >= 5) {
            setTimeout(function () {
                $J[1].finJuego(2);
            }, 500);
        } else {
            $J[$JAct].CTiempo = $J[$JAct].CTiempo + 1;
            isPaused = false;
        }
    });
    $('#btnListo').click(function () {
        //$ActPwrUp = 0;
        $('#pregWindow').stop().fadeOut(400);
        $('.caratula').stop().delay(500).fadeOut(10);
        $('#gameArea1').addClass('pista_anim');
        if ($J[1].contAciertos >= 5) {
            setTimeout(function () {
                $J[1].finJuego(2);
            }, 500);
        } else {
            $J[$JAct].CTiempo = $J[$JAct].CTiempo + 1;
            isPaused = false;
        }
    });
    $("#Player_1 .ptje").click(function () {
        /*if ($ActPwrUp) {
            muestraPregunta();
        }*/
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
    }, 1000);
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
    //console.log(CSeg);
    if ($J[$JAct].CSeg < 10) {
        CCero = "0";
    }
    $("#CSeg").html(CCero + $J[$JAct].CSeg);
    ContPreguntas++;
    //
    if (ContPreguntas == 20) {
        ContPreguntas = 0;
        $ActPwrUp++;
        muestraPregunta($ActPwrUp);
    }
    if($TimeDie === true){
        $TDie++;
        console.log($TDie);
    }
}
function pausarJuego() {
    isPaused = true;
    $("#PauseGame").show();
    $('#gameArea1').removeClass('pista_anim');
}
function muestraPregunta(preg) {
    $('#gameArea1').removeClass('pista_anim');
    playSound(window.audioCatch);
    isPaused = true;
    $(".caratula").stop().fadeOut(10);
    $(".pregVista").hide();
    $("#bienFlechas").removeClass("animated bounceIn").hide();
    $(".bienSlider div").removeClass("animated bounceInRight").hide();
    PlayerMov.areaPtje.stop().removeClass('animated rubberBand').fadeOut(300);
    $('#pregTXT span').html($slA[$ActPwrUp]);
    $('#preg_1 span').html($slB[$ActPwrUp]);
    $('#preg_2 span').html($slC[$ActPwrUp]);
    $('#preg_3 span').html($slD[$ActPwrUp]);

    //$("#pregVista_" + preg).show();
    $("#pregMain").show();
    $("#pregWindow").fadeIn(400);
}
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