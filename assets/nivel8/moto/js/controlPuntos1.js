/*******************************************************************************/
function inicioPtos1() {
    $J[1].contAciertos = 0;
    $J[1].ptsWinJuego = 0;
    $J[1].vidas = $J[1].vidaInicial;
    $J[1].pts_restant = 0;
    /*$("#pts").html($J[2].ptsWinJuego);
    $("#CantVidas").html($J[2].vidas);
    $("#SpriteGloboVida2").css("background-position","0px 0px"); */
    $(".iconCheck").removeClass("check anim").show();
}
function verifyask(){

}
function aumentaPtos1() {
    $J[1].contAciertos++;
    $J[1].ptsWinJuego = $J[1].ptsWinJuego + $J[1].puntajeAcierto;
    //$("#icon_" + $J[1].contAciertos).addClass("anim check");
}
function restapuntos(){
    $J[1].pts_restant++; 
}
 function reinicioPuntos1() {
     $J[1].contAciertos = 0;
     $J[1].ptsWinJuego = 0;
     $(".iconCheck").removeClass("check anim").show();
 }
function resultadoPuntos1() {
    //var sumaPuntos = $J[1].ptsWinJuego + $J[1].CTiempo;
    var sumaPuntos = $J[1].ptsWinJuego - $J[1].pts_restant;
    var estrellas = 0;
    if (sumaPuntos <= 0){ sumaPuntos = 0; }
    if (sumaPuntos >= 10 && sumaPuntos < 40) {
        estrellas = 1;
    } else if (sumaPuntos >= 40 && sumaPuntos < 80) {
        estrellas = 2;
    } else if (sumaPuntos >= 80) {
        estrellas = 3;
    }
    $('#resumenPuntaje').html(sumaPuntos);
    $('#resumenEstrellas').removeClass().addClass('st' + estrellas);
    var data = {puntaje: sumaPuntos, estrellas: estrellas, check : true};
    $.post(bdir + 'ajax/set_puntaje', data).done(function (data) {
        console.log("resultado: " + data);
    });
    /***
     $('#resumenPuntaje').html('Puntos: '+ $J[1].ptsWinJuego + '<br>'
     +'Bonus por tiempo: '+ $J[1].CTiempo + '<br>'
     +'Total: '+ sumaPuntos + '<br>'
     +'Estrellas: '+ estrellas);/***/
}
$J[1].quitaVidas = function(){
    $J[1].vidas--;
    if( $J[1].vidas < 1 ){
        $(".ptje").addClass('animated rubberBand').fadeIn(100);
        //$("#CantVidas").html($J[1].vidas);
        $J[1].finJuego(1);  
    }else{
        //$("#CantVidas").html($J[1].vidas);
    }
    var t_pos = $J[1].vidaInicial - $J[1].vidas;
    var t_PosSpriteX = 73 * t_pos;
    //$("#SpriteGloboVida2").css("background-position","-"+t_PosSpriteX+"px 0px").removeClass("animated tada");
    //setTimeout(function(){ $("#SpriteGloboVida2").addClass("animated tada"); },1);
    
}
/*******************************************************************************/