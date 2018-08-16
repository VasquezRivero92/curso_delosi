$puntos_minitest = 0;

/*******************************************************************************/
$J[1].showJuego = function () {
    $JAct = 1;
    $('#escenaJuego1').fadeIn(1000);
    introJuego();
    CalcularLimites();
    PlayerMov.id = $('#Player_1');
    PlayerMov.cargar();
    PlayerMov.areaPtje.stop().removeClass('animated rubberBand').fadeOut(300);
    PlayerMov.warningMC.removeClass('show_warn');

    $J[$JAct].cargarParedes();
    $.get(bdir + 'ajax/get_puntaje').done(function (data) {
        console.log('puntos: ' + data);
        $puntos_minitest = data;
    });
    $.post(bdir + 'ajax/set_intentos_drivers_2').done(function (data) {
        $p_intentos = data.charAt(2);
       console.log("Intentos: " + $p_intentos);
       if ($p_intentos >= 2) {
            $('#btnReinicio,#resumenOportunidad').css('background', 'none').hide();
            // $('#resumenMensaje').html('Sigue adelante');
       }else{
            // $('#resumenMensaje').html('¡Vuelve a intentarlo!');
        }
    });
};
$J[1].inicioJuego = function () {
    playBGMusic(window.race);
    $('#fondoOPC1').show();
    inicioPtos1();
    initObjetos1();
    IntervaloMovimiento();
    $('#gameArea1').addClass('pista_anim');
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
    $('#gameArea1').removeClass('pista_anim');
    resultadoPuntos1();
    setTimeout(function () {
        $('#caratulaFin1').fadeIn(1000);
        playSound(window.BGWin);
    }, 500);
    setTimeout(function () {
        $('#resumenBtns,#resumenOportunidad').fadeIn(1000);
    }, 2500);
    $.post(bdir + 'ajax/init_calificacion').done(function (data) {
       console.log("calificacion: " + data);
       if(data != 0){
        $('#calificacion').stop().fadeIn(1000);
       }else{
        $('#calificacion').stop().fadeOut(1000);
       }
    });
};
/*******************************************************************************/