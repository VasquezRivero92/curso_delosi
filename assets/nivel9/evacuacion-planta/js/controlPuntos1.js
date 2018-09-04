/*******************************************************************************/
function inicioPtos1() {
    $J[1].contAciertos = 0;
    $J[1].ptsWinJuego = 0;
    $J[1].vidas = $J[1].vidaInicial;
    $(".iconCheck").removeClass("check anim").show();
}
function aumentaPtos1() {
    $J[1].contAciertos++;
    $J[1].ptsWinJuego = $J[1].ptsWinJuego + $J[1].puntajeAcierto;
    $("#icon_" + $J[1].contAciertos).addClass("anim check");
    //console.log($J[1].ptsWinJuego);
}

function aumentaVida1(){
    $J[1].vidas++;
    $("#CantVidas").html($J[1].vidas);
}
$J[1].quitaVidas = function(){
    $J[1].vidas--;
    if( $J[1].vidas < 1 ){
        $("#CantVidas").html($J[1].vidas);
        $J[1].finJuego(1);  
    }else{
        $("#CantVidas").html($J[1].vidas);
        if( $GrupoVidas.length ){
            $GrupoVidas.pop();
            $("#Filavidas1_" + $GrupoVidas.length).removeClass("Filavidas");
        }
    }   
}
/***
 function reinicioPuntos1() {
 $J[1].contAciertos = 0;
 $J[1].ptsWinJuego = 0;
 $(".iconCheck").removeClass("check anim").show();
 }/***/
 function aumentaAmigos(nombre){
    if( $GrupoVidas.length ){
        var tempBG ="url("+ odir + "/images/sprite"+nombre+".png)";
        $("#Filavidas"+$JAct+"_"+$GrupoVidas.length).addClass("Filavidas").css({"left":$GrupoVidas[0].x+$J[$JAct].posX,"top":$GrupoVidas[0].y+$J[$JAct].posY,"z-index":$GrupoVidas[0].z});
        $("#Filavidas"+$JAct+"_"+$GrupoVidas.length+" .sprite").css("background-image",tempBG);
        $GrupoVidas.push(new Lab_Vidas(PlayerMov.x,PlayerMov.y));
    }
}

function resultadoPuntos1() {
    //var sumaPuntos = $J[1].ptsWinJuego + $J[1].CTiempo;
    var sumaPuntos = $J[1].ptsWinJuego;
    var estrellas = 0;
    if (sumaPuntos >= 10 && sumaPuntos < 40) {
        estrellas = 1;
    } else if (sumaPuntos >= 40 && sumaPuntos < 100) {
        estrellas = 2;
    } else if (sumaPuntos >= 100) {
        estrellas = 3;
    }
    $('#resumenPuntaje').html(sumaPuntos);
    $('#resumenEstrellas').removeClass().addClass('st' + estrellas);
    var data = {puntaje: sumaPuntos, estrellas: estrellas, check : true};
    $.post(bdir + 'ajax/set_puntaje', data).done(function (data) {
        console.log("resultado: " + data);
    });
    if(sumaPuntos > 70){
        $('#i4Certificado').removeClass('disabled');
    }  
    /***
     $('#resumenPuntaje').html('Puntos: '+ $J[1].ptsWinJuego + '<br>'
     +'Bonus por tiempo: '+ $J[1].CTiempo + '<br>'
     +'Total: '+ sumaPuntos + '<br>'
     +'Estrellas: '+ estrellas);/***/
}

function reinicioPuntos3(){
    $J[1].contAciertos = 0;
    $J[1].ptsWinJuego = 0;
    $J[1].vidas = $J[1].vidaInicial;
    $("#pts").html($J[1].ptsWinJuego);
    $("#CantVidas").html($J[1].vidas);
}
/*******************************************************************************/