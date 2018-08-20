/*******************************************************************************/
$J[1].showJuego = function () {
    $JAct = 1;
    $('#escenaJuego1').fadeIn(1000);
    introJuego();
    CalcularLimites();
    PlayerMov.id = $('#Player_1');
    PlayerMov.cargar();
    //PlayerMov.areaPtje.stop().removeClass('animated rubberBand').fadeOut(300);
    $J[$JAct].cargarParedes();
    $.post(bdir + 'ajax/set_intentos').done(function (data) {
       console.log("Intentos: " + data);
       if (data >= 2) {
            $('#btnReinicio,#resumenOportunidad').css('background', 'none').hide();
       }
    });
};
$J[1].inicioJuego = function () {
    setTimeout(function () {
        playBGMusic(window.evacuando);
    }, 1500);
    $("#fondoOPC3").show();
    $('#fondoOPC1').show();
    $(".iconPersonaje").removeClass("check anim").show();
    $("#icon_Marion").addClass("check");
    $sombraSC = 0;
    $("#escenaJuego1 .vidaJ3").removeClass("Filavidas");
    $GrupoVidas = [];
    $GrupoVidas.push(new Lab_Vidas(0,0));
    inicioPtos1();
    initObjetos1();
    IntervaloMovimiento();
};
$J[1].finJuego = function (valor) {
    stopBGMusic();
    finMovimiento();
    $('.gameEnv').fadeOut(1000);
    $('.iconCheck').fadeOut(1000);
    //finObjetos1();
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
    $.post(bdir + 'ajax/init_calificacion').done(function (data) {
       console.log("calificacion: " + data);
       if(data == 0){
        $('#calificacion').stop().fadeIn(1000);
       }else{
        $('#calificacion').stop().fadeOut(1000);
       }
    });
};
/*******************************************************************************/
$J[1].reinicioJuego = function(){
    stopMusica(); playBGMusic(window.evacuando);
    CalcularLimites();
    reinicioPuntos3();
    PlayerMov.cargar(); $J[$JAct].cargarParedes();
    $(".vidaJ3").removeClass("Filavidas");
    $(".iconPersonaje").removeClass("check anim").show();
    $("#icon_Marion").addClass("check");
    $GrupoVidas = [];
    $GrupoVidas.push(new Lab_Vidas(0,0));
    inicioPtos1();
    initObjetos1();
    IntervaloMovimiento();
}





