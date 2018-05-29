/*******************************************************************************/
$J.showJuego = function () {
    $('#gamePreg').fadeIn(1000);
    /*for (var i = 1; i <= cantPreg; i++) {
     $J.randBtns(i);
     }*/
    $J.numJ = 1;
    $J.ptsWinJuego = [];
    $('.iconCheck').removeClass('anim check');
    $('.caratula').stop().fadeOut(10);
    $('#marcador').show();
    cargaPreg();
    $.post(bdir + 'ajax/set_intentos').done(function (data) {
        console.log('Intentos: ' + data);
        if (data >= $J.intentos) {
            $('#btnReinicio,#resumenOportunidad').css('background', 'none').hide();
        }
    });
    setTimeout(function () {
        playBGMusic(window.BGJuego);
    }, 1000);
};
$J.finTiempo = function () {
    if ($MuevePlayer) {
        window.cancelAnimationFrame($MuevePlayer);
    }
    $MuevePlayer = 0;
    $('#gPreg_' + $J.numJ + ' .btn').addClass('disable');
    $('.caratula').stop().fadeOut(300);
    $('#pregWindow').fadeIn(400);
    $('#pregTime').stop().delay(300).fadeIn(300);
};
$J.finJuego = function () {
    stopBGMusic();
    $('#marcador').fadeOut(1000);
    if ($MuevePlayer) {
        window.cancelAnimationFrame($MuevePlayer);
    }
    $MuevePlayer = 0;
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
/*$J.randBtns = function (RE) {
 num[RE].shuffle();
 //pos[RE].shuffle();
 for (var i = 0; i < PileCant[RE]; i++) {
 $('#btn_' + RE + '_' + num[RE][i]).css({'left': pos[RE][i].left, 'top': pos[RE][i].top});
 }
 };*/
$J.rollBtns = function (RE) {
    pos[RE].rotate();
    for (var i = 0; i < PileCant[RE]; i++) {
        $('#btn_' + RE + '_' + num[RE][i]).css({'left': pos[RE][i].left, 'top': pos[RE][i].top});
    }
};
/*******************************  Puntos juego  *******************************/
function cargaPreg() {
    CronoReset();
    $('#btnPlay_' + $J.numJ).removeClass('disable');
    $('#tPreg_' + $J.numJ).removeClass('toTop');
    $('#gPreg_' + $J.numJ + ' .btn').removeClass('show');
    $('.gPreg').stop().fadeOut();
    $('#gPreg_' + $J.numJ).stop().fadeIn();
    $('.ciPreg').stop().removeClass('anim a10 a8 a6 a4 a2').fadeOut();
}
function aumentaPtos() {
    $J.ptsWinJuego[$J.numJ] = $J.puntajeAcierto;
    $('#icon_' + $J.numJ).addClass('anim check');
}
function resultadoPuntos() {
    var sumaPuntos = 0;
    $J.ptsWinJuego.forEach(function (itm, i) {
        sumaPuntos += parseInt(itm, 10);
    });
    if (sumaPuntos === 125) {
        sumaPuntos = 110;
    } else if (sumaPuntos === 150) {
        sumaPuntos = 120;
    }
    var estrellas = 0;
    if (sumaPuntos >= 25 && sumaPuntos < 50) {
        estrellas = 1;
    } else if (sumaPuntos >= 50 && sumaPuntos < 100) {
        estrellas = 2;
    } else if (sumaPuntos >= 100) {
        estrellas = 3;
    }
    $('#resumenPuntaje').html(sumaPuntos);
    $('#resumenEstrellas').removeClass().addClass('st' + estrellas);
    var data = {
        puntaje: sumaPuntos,
        estrellas: estrellas,
        check: true
    };
    $.post(bdir + 'ajax/set_puntaje', data).done(function (data) {
        console.log('resultado: ' + data);
    });
}
/*******************************************************************************/