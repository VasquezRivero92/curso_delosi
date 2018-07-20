/*******************************************************************************/
// numero de juego actual
var $JAct = 0;
// Maximo nivel alcanzado
//var $JMax = 1;
// intervalo de movimiento del player
var $MuevePlayer = 0;
var $poposito = 0;
var $startTime = 0;
var $stopTimeIntervalo = 0;
var $cronoStartTime = 0;
var $stopTimeCrono = 0;
var $delayTime = 20;
// choque futuro con paredes
var ChoqueFuturo = false;
var $Enemigos = [];
var $EnemiParachoke = [];
var ContPreguntas = 0;
var $TimeDie = false; 
var $TDie = 0; 
var $ValueEnd = 0;

var $pasar_betwen = false;
var $Val_betwen = 0;
var IntentPT = 0;
// intervalo del hit(momentaneo)
//var $hitInterval = 0;
//var $hitStartTime = 0;
// arrays de objetos del juego
var $ParedMask1;
var $PowerUps = [];
var $PowerPE = [];
var $PowerPR = [];
var $ActPwrUp = 0;
var $Preguntas = [null, 3, 3, 3, 3, 3];
var $slA = [null,
    '1. Todos los carriles están ocupados y solo hay espacio entre los automoviles ¿Qué deberia hacer?',
    '2. Más adelante hay mucho tráfico ¿Qué deberia hacer?',
    '3. Me acerco a un semaforo que esta en ambar ¿Qué deberia hacer?',
    '4. El casco se empieza a mover mucho ¿Qué deberia hacer?',
    '5. Hay tráfico por la luz roja, pero la vereda se ve despejada, ¿Qué deberia hacer?',
];
var $slB = [null,
    'Pasar entre ellos rápidamente',
    'Aprovechar que están detenidos y serpentear entre los carros',
    'Acelerar y pasar antes que cambie a rojo.',
    'Lo acomodo hasta la mitad de mi rostro para que no apriete',
    'Puedo aprovechar y subir por la vereda, rápido antes que alguien se cruze.',
];
var $slC = [null,
    'Tocarles el claxón para que me habran camino',
    'Pasar por los extremos de la pista cerquita de los carros para adelantar.',
    'Aunque cambia a rojo sigo nomas, rapidito.',
    'Voy a desajustar el seguro para que no fastidie.',
    'Me subo a la vereda y si hay alguién lo esquivo nomas.',
];
var $slD = [null,
    'Mantener mi carril y esperar a que se libere una ruta segura para continuar',
    'Mantener el curso y no invadir espacios de riesgo para el peaton y los conductores',
    'Debo desacelerar lentamente y hasta detenerme cuando vea la luz ambar.',
    'Me detengo y reviso el ajuste del casco, este debe estar asegurado a mi cabeza.',
    'Continuo en la pista, subir a la vereda con una moto es poner en riesgo a los peatones.',
];
var $opc_TR = [null,
    'Mantener mi carril y esperar a que se libere una ruta segura para continuar',
    'Mantener el curso y no invadir espacios de riesgo para el peaton y los conductores',
    'Debo desacelerar lentamente y hasta detenerme cuando vea la luz ambar.',
    'Me detengo y reviso el ajuste del casco, este debe estar asegurado a mi cabeza.',
    'Continuo en la pista, subir a la vereda con una moto es poner en riesgo a los peatones.',
];

var CTpreg = 30;

var clearintervalo;

function getRandomSite(){
   var sites = ["¡soy mas vivo!","Mas alla!","Piiiiiiiip","¡Estoy apurado!","Haste a un lado"];
    var i = parseInt(Math.random()*(sites.length-1));
    $('.ptje span').text(sites[i]);
    return sites[i];
};

var $AnimacionCreada = 0;
// variables de puntaje
//var $puntajeAcumulado = 0;
var $KC_boton;
var $ExisteTouch = 0;
var $J = [];
$J[1] = new Lab_Juego();
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

    $('#btnReinicio').click(function () {
        $TimeDie = false; 
        $TDie = 0; 
        $ValueEnd = 0;

        $pasar_betwen = false;
        $Val_betwen = 0;
        
        ContPreguntas = 0;
        $ActPwrUp = 0;
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
        playBGMusic(window.race);
        $('#pausaTouch').removeClass('paused');
        $('#PauseGame').fadeOut(200);
        $J[$JAct].CTiempo = $J[$JAct].CTiempo + 1;
        isPaused = false;
        $('#gameArea1').addClass('pista_anim');

    });
    $('.pregOpc').click(function () {
        clearInterval(clearintervalo);
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
            $("#icon_" + $ActPwrUp).addClass("anim icon_correcto");
            // $("#bienResp").html($(this).children().html().replace("<br>", " "));
            $("#pregBien").stop().delay(300).fadeIn(300);
        } else {
            $("#icon_" + $ActPwrUp).addClass("anim check");
            playSound(window.audioCrash);
            //$PowerUps[$ActPwrUp - 1].visible = 200;
            $('#pregMal').stop().delay(300).fadeIn(300);
            $('#bad_A2 span').html($opc_TR[$ActPwrUp]);
        }
        // $poposito = 0;
    });
    $('#btnReintento').click(function () {
        $("#icon_" + $ActPwrUp).addClass("anim check");
        $("#vinetatiempo").fadeOut(400);
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
            if($TDie >= 5){
                setTimeout(function () { $J[1].finJuego(2); }, 500);
            }
        }
    });
    $('#btnReset').click(function () {
        if(IntentPT >= 3){
            $('#reset_time').stop().fadeOut(500);
            setTimeout(function () { $J[1].finJuego(2); }, 500);
            IntentPT = 0;
        }else{
            $TimeDie = false; 
            $TDie = 0; 
            $ValueEnd = 0;

            $pasar_betwen = false;
            $Val_betwen = 0;
            
            ContPreguntas = 0;
            $ActPwrUp = 0;

            
            $('.caratula, .game, #capaResumen').stop().fadeOut(500);
            $('#reset_time').stop().fadeOut(500);
            $("#infoWindow").fadeOut(300);
            volverintentar();
        }
    });   

    $('#btnListo').click(function () {
        //$ActPwrUp = 0;

        $("#vinetatiempo").fadeOut(400);
        $('#pregWindow').stop().fadeOut(400);
        $('.caratula').stop().delay(500).fadeOut(10);
        $('#gameArea1').addClass('pista_anim');
        if ($J[1].contAciertos >= 5) {
            setTimeout(function () { $J[1].finJuego(2); }, 500);
        } else {
            $J[$JAct].CTiempo = $J[$JAct].CTiempo + 1;
            isPaused = false;
            if($TDie >= 5){
                setTimeout(function () { $J[1].finJuego(2); }, 500);
            }
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
    playBGMusic(window.intro);
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
function volverintentar() { 
    redimensionarJuego();   
    $JAct = 1;
    $('#escenaJuego1').fadeIn(1000);
    introJuego();
    CalcularLimites();
    PlayerMov.id = $('#Player_1');
    PlayerMov.cargar();
    PlayerMov.areaPtje.stop().removeClass('animated rubberBand').fadeOut(300);
    PlayerMov.warningMC.removeClass('show_warn');

    $J[$JAct].cargarParedes();
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
    if ($J[$JAct].CSeg < 10) { CCero = "0"; }
    $("#CSeg").html(CCero + $J[$JAct].CSeg);
    ContPreguntas++;
    if (ContPreguntas == 20) {
        ContPreguntas = 0;
        $ActPwrUp++;
        muestraPregunta($ActPwrUp);
        $TDie++;
    }
    if($TimeDie){
        $ValueEnd = $J[$JAct].Vereda;
    }else{
        $J[$JAct].Vereda = 0;
    }
    if($pasar_betwen){
        $Val_betwen = $J[$JAct].BetwenCars;
    }else{
        $J[$JAct].BetwenCars = 0;
    }
}
function MostrarTiempoPregunta() {
    $J[$JAct].CSeg = $J[$JAct].CTiempo % 60;
    $J[$JAct].CMin = parseInt($J[$JAct].CTiempo / 60);
    $("#CMin").html($J[$JAct].CMin);
    CCero = "";
    if ($J[$JAct].CSeg < 10) { CCero = "0"; }
    $("#CSeg").html(CCero + $J[$JAct].CSeg);
    
    if (ContPreguntas == 20) {
        ContPreguntas = 0;
        $ActPwrUp++;
        muestraPregunta($ActPwrUp);
        $TDie++;
    }
    if($TimeDie){
        $ValueEnd = $J[$JAct].Vereda;
    }else{
        $J[$JAct].Vereda = 0;
    }
    if($pasar_betwen){
        $Val_betwen = $J[$JAct].BetwenCars;
    }else{
        $J[$JAct].BetwenCars = 0;
    }
}
function pausarJuego() {
    isPaused = true;
    $("#PauseGame").show();
    $('#gameArea1').removeClass('pista_anim');
    stopBGMusic(window.termino_mal);
}
function tiempo_Subs() {
    clearInterval(clearintervalo);
    stopBGMusic(window.termino_mal);
    playSound(window.termino_mal);
    isPaused = true;
    $("#reset_time").fadeIn(500);
    $('#gameArea1').removeClass('pista_anim');
    IntentPT++;
    console.log(IntentPT);
}
function muestraPregunta(preg) {
    ControlIntervaloPregunta();
    $("#vinetatiempo").fadeIn(400);
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
    $('.img_ask').attr('id', 'image_ref_'+$ActPwrUp);
    $("#pregMain").show();
    $("#pregWindow").fadeIn(400);
    $("#vinetatiempo").fadeIn(400);
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