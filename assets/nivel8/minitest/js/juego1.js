/*******************************************************************************/
$J.showJuego = function () {
    $('#gamePreg').fadeIn(1000);
    $J.numJ = 1;
    $J.ptsWinJuego = [];
    $('.iconCheck').removeClass('anim check');
    $('.caratula').stop().fadeOut(10);
    $('#marcador').show();
    cargaPreg();
    $.post(bdir + 'ajax/set_intentos_drivers_1').done(function (data) {        
        $p_intentos = data.charAt(1);
        console.log('Intentos: ' + $p_intentos);
        //$s_intentos = data.charAt(2);
        if ($p_intentos >= 2) {
            $('#btnReinicio,#resumenOportunidad').css('background', 'none').hide();
            // $('#resumenMensaje').html('Sigue adelante');
        }else{
            // $('#resumenMensaje').html('¡Vuelve a intentarlo!');
        }
    });
    setTimeout(function () {
        playBGMusic(window.BGJuego);
    }, 1000);
};
$J.finTiempo = function () {
    //if ($MuevePlayer) {
    //    window.cancelAnimationFrame($MuevePlayer);
    //}
    //$MuevePlayer = 0;
    isPaused = true;
    $('#gPreg_' + $J.numJ + ' .btn').addClass('disable');
    $('.caratula').stop().fadeOut(300);
    $('#pregWindow').fadeIn(400);
    $('#pregTime').stop().delay(300).fadeIn(300);
    $('.preguntas').fadeOut(500);
    if($n_pregunta == "gPreg_1"){
            setTimeout(function(){ $('#pregunta1_' + $pID).animateCss('bounceIn').hide(); }, 500);  
                  
            }else if($n_pregunta == "gPreg_2"){
            setTimeout(function(){ $('#pregunta2_' + $pID).animateCss('bounceIn').hide(); }, 500);         
            
            }else if($n_pregunta == "gPreg_3"){
            setTimeout(function(){ $('#pregunta3_' + $pID).animateCss('bounceIn').hide(); }, 500);         
            
            }else if($n_pregunta == "gPreg_4"){
            setTimeout(function(){ $('#pregunta4_' + $pID).animateCss('bounceIn').hide(); }, 500);         
            }else if($n_pregunta == "gPreg_5"){
            setTimeout(function(){ $('#pregunta5_' + $pID).animateCss('bounceIn').hide(); }, 500);         
            }
    $('.punt_anim').css("display","block");
    $('.btn').css("pointer-events","auto");

};
$J.finJuego = function () {
    stopBGMusic();
    $('#marcador').fadeOut(1000);
    // if ($MuevePlayer) {
    //     window.cancelAnimationFrame($MuevePlayer);
    // }
    //$MuevePlayer = 0;
    $('.caratula').stop().fadeOut(10);
    $('#resumenBtns,#resumenOportunidad').stop().fadeOut(10);
    $('#capaResumen').fadeIn(1000);
    resultadoPuntos();
    setTimeout(function () {
        $('#caratulaFin1').fadeIn(1000);
        playSound(window.BGWin);
    }, 500);
    setTimeout(function () {
        $('#resumenBtns,#resumenOportunidad').fadeIn(1000);
    }, 2500);
};
$J.rollBtns = function (RE) {
    pos[RE].rotate();
    for (var i = 0; i < PileCant[RE]; i++) {
        $('#btn_' + RE + '_' + num[RE][i]).css({'left': pos[RE][i].left, 'top': pos[RE][i].top});
    }
};
/*******************************  Puntos juego  *******************************/
function cargaPreg() {
    CronoReset();
    // $('#btnPlay_' + $J.numJ).removeClass('disable');
    // $('#tPreg_' + $J.numJ).removeClass('toTop');
    $('#gPreg_' + $J.numJ + ' .btn').removeClass('show');
    $('.gPreg').stop().fadeOut();
    $('#gPreg_' + $J.numJ).stop().fadeIn();
    //$('.ciPreg').stop().removeClass('anim a10 a8 a6 a4 a2').fadeOut();
}
function aumentaPtos() {
    ptsWinJuego = ptsWinJuego+puntajeAcierto;
    console.log(ptsWinJuego);
    if($n_pregunta=="gPreg_1"){
     $('#icon_1').addClass('anim check');
    }else if($n_pregunta=="gPreg_2"){
        $('#icon_2').addClass('anim check');
    }else if($n_pregunta=="gPreg_3"){
        $('#icon_3').addClass('anim check');
    }else if($n_pregunta=="gPreg_4"){
        $('#icon_4').addClass('anim check');
    }else if($n_pregunta=="gPreg_5"){
        $('#icon_5').addClass('anim check');
    }
    console.log(ptsWinJuego);
}
function resultadoPuntos() {
  
    var estrellas = 0;
    $('#resumenMensaje').html('¡Sigue adelante!');
    $('#resumenAvatar').removeClass();
    if (ptsWinJuego >= 20 && ptsWinJuego < 60) {
        estrellas = 1;
        $('#resumenMensaje').html('¡Muy buen trabajo!');
        $('#resumenAvatar').addClass('pts2');
    } else if (ptsWinJuego >= 60 && ptsWinJuego < 100) {
        estrellas = 2;
        $('#resumenMensaje').html('¡Muy buen trabajo!');
        $('#resumenAvatar').addClass('pts2');
    } else if (ptsWinJuego >= 100) {
        estrellas = 3;
        $('#resumenMensaje').html('¡Excelente!');
        $('#resumenAvatar').addClass('pts3');
    }
    $('#resumenPuntaje').html(ptsWinJuego);
    $('#resumenEstrellas').removeClass().addClass('st' + estrellas);

    var data = {        
        puntaje: ptsWinJuego,
        estrellas: estrellas,
        check: true
    };

    $.post(bdir + 'ajax/set_puntaje', data).done(function (data) {
        console.log('resultado: ' + data);
    });
}
/*******************************************************************************/