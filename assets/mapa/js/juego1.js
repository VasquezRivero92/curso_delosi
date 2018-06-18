/*******************************************************************************/
$J[1].showJuego = function () {
    $JAct = 1;
    $('#instrucciones_4').fadeIn(1000);
    introJuego();
    CalcularLimites();
    PlayerMov.id = $('#Player_1');
    PlayerMov.cargar();
    PlayerMov.areaPtje.stop().removeClass('animated rubberBand').fadeOut(300);
    $J[$JAct].cargarParedes();
    //$.post(bdir + 'ajax/set_intentos').done(function (data) {
     //   console.log("Intentos: " + data);
       // if (data >= 2) {
            $('#btnReinicio,#resumenOportunidad').css('background', 'none').hide();
       // }
    //});
};
$J[1].inicioJuego = function () {
    playBGMusic(window.BGJuego);
    $('#fondoOPC1').show();
    inicioPtos1();
    initObjetos1();
    IntervaloMovimiento();
};
$J[1].finJuego = function (valor) {
    stopBGMusic();
    finMovimiento();
    $('.gameEnv').fadeOut(1000);
    $('.iconCheck').fadeOut(1000);
    finObjetos1();
    if ($MuevePlayer) {
        window.cancelAnimationFrame($MuevePlayer);
    }
    $MuevePlayer = 0;
    $J[$JAct].intentos--;
    $('.caratula').stop().fadeOut(10);
    $('#resumenBtns,#resumenOportunidad').stop().fadeOut(10);
    $('#capaResumen').fadeIn(1000);
    resultadoPuntos1();
    setTimeout(function () {
        $('#caratulaFin1').fadeIn(1000);
        playSound(window.BGWin);
    }, 500);
    setTimeout(function () {
        $('#resumenBtns,#resumenOportunidad').fadeIn(1000);
    }, 2500);
};
/*******************************************************************************/