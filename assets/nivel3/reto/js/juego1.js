/*******************************************************************************/
$J.showJuego = function () {
    $('#tragamonedas').fadeIn(1000);
    introJuego();
    blockBtns();
    CronoReset();
    $.post(bdir + 'ajax/set_intentos').done(function (data) {
        console.log('Intentos: ' + data);
        if (data >= $J.intentos) {
            $('#btnReinicio,#resumenOportunidad').css('background', 'none').hide();
        }
    });
};
$J.inicioJuego = function () {
    playBGMusic(window.BGJuego);
    $('#fondoOPC1').show();
    inicioPtos();
    $J.numJ = 1;
};
$J.finJuego = function () {
    stopBGMusic();
    $('.gameEnv').fadeOut(1000);
    $('.iconCheck').fadeOut(1000);
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
        $('#resumenBtns').fadeIn(1000);
    }, 2500);
};
/******************************  Puntos juego 1  ******************************/
function inicioPtos() {
    $J.ptsWinJuego = [0, 0, 0, 0, 0];
}
function aumentaPtos() {
    if ($J.CTiempo > 0) {
        $J.ptsWinJuego[$J.numJ] = $J.puntajeAcierto + parseInt($J.CTiempo / 2, 10);
    } else {
        $J.ptsWinJuego[$J.numJ] = $J.puntajeAcierto;
    }
    console.log($J.ptsWinJuego);
}
function resultadoPuntos() {
    var sumaPuntos = 0;
    if ($J.ptsWinJuego[0] > 0) {
        $J.ptsWinJuego[0] = 0;
    }
    $J.ptsWinJuego.forEach(function (itm, i) {
        sumaPuntos += parseInt(itm, 10);
    });
    var estrellas = 0;
    if (sumaPuntos >= 60 && sumaPuntos < 80) {
        estrellas = 1;
    } else if (sumaPuntos >= 80 && sumaPuntos < 100) {
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