/*******************************************************************************/
function inicioPtos1() {
    $J[1].contAciertos = 0;
    $J[1].ptsWinJuego = 0;
    $('.iconCheck').removeClass('check anim').show();
}
function aumentaPtos1() {
    $J[1].contAciertos++;
    $J[1].ptsWinJuego = $J[1].ptsWinJuego + $J[1].puntajeAcierto;
    $('#icon_' + $J[1].contAciertos).addClass('anim check');
}
function resultadoPuntos1() {
    var sumaPuntos = $J[1].ptsWinJuego + $J[1].CTiempo;
    var estrellas = 0;
    if (sumaPuntos >= 10 && sumaPuntos < 30) {
        estrellas = 1;
    } else if (sumaPuntos >= 30 && sumaPuntos < 50) {
        estrellas = 2;
    } else if (sumaPuntos >= 50) {
        estrellas = 3;
    }
    $('#resumenPuntaje').html(sumaPuntos);
    $('#resumenEstrellas').removeClass().addClass('st' + estrellas);
    var data = {puntaje: sumaPuntos, estrellas: estrellas, check : true};
    $.post(bdir + 'ajax/set_puntaje', data).done(function (data) {
        console.log("resultado: " + data);
    });
}
/*******************************************************************************/