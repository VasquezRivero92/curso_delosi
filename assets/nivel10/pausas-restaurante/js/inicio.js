
$(document).ready(function (e) {
    init();
    initSonidos();
    redimensionarJuego();
    initBotones();
    $(window).resize(function () {
        redimensionarJuego();

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
        playFX(window.audioCatch);
        var id = parseInt($(this).attr('id').split('_')[1], 10);
        $('.instrucciones').stop().delay(10).fadeOut(500);
        var j = id - 1;
        $('#instrucciones_' + j).stop().fadeIn(10);
        playTexto(window['txti' + j]);
    });
    $('.btnNext').click(function () {
        playFX(window.audioCatch);
        var id = parseInt($(this).attr('id').split('_')[1], 10);
        $('.instrucciones').stop().delay(300).fadeOut(100);
        var j = id + 1;
        $('#instrucciones_' + j).stop().fadeIn(500);
        playTexto(window['txti' + j]);
    });
    $('#btnJugar').click(function () {
        stopBGMusic();
        stopTexto();
        playFX(window.audioCatch);
        $('.instrucciones').stop().fadeOut(1000);
        introJuego();
        $('.caratula').stop().fadeOut(10);
        
        $('#animation_container').stop().fadeIn(500);
        
    });
    //botones del juego
    $('#btnReiniciar').click(function () {
        playFX(window.audioCatch);
        showInicio();
        $('.caratula, .game, #capaResumen, #TerminoTiempo').stop().fadeOut(500);
        init();
    });
    $('#btnReinicio').click(function () {
        playFX(window.audioCatch);
        showInicio();
        $('.caratula, .game, #capaResumen').stop().fadeOut(500);
        init();
    });

    $('#btnReintento').click(function () {

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
    // cargar el juego createJS
     $.post(bdir + 'ajax/set_intentos').done(function (data) {
       console.log("Intentos: " + data);
       if (data >= 2) {
            $('#btnReinicio,#resumenOportunidad').css('background', 'none').hide();
       }
    });   
    /**************/
}
function introJuego() {
    $(".caratula,.conteo").stop().fadeOut(10);
    $(".conteo").removeClass('anima bounceIn');
    $("#infoWindow").show();
    setTimeout(function () {
        $("#conteo3").addClass('anima bounceIn').show();
        playFX(window.beep);
    }, 1500);
    setTimeout(function () {
        $("#conteo2").addClass('anima bounceIn').show();
        playFX(window.beep);
    }, 2500);
    setTimeout(function () {
        $("#conteo1").addClass('anima bounceIn').show();
        playFX(window.beep);
    }, 3500);
    setTimeout(function () {
        
        //inicioJuego();
        //$("#animation_container").fadeIn(300);
        
        
        //returnGame();
        $(".gameEnv").show();
    }, 4000);
    setTimeout(function () {
        $("#infoWindow").fadeOut(300);
        playFX(window.beepXL);
        //$("#historia").stop().fadeOut(500);

        iniciarJuego();
        
        radioPop();


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