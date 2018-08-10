var puntos = 0;
var sumaPuntos, estrellas;

function resultadoPuntos(punts) {
	puntos = punts;
	$('#resumenPuntaje').html(puntos);
	var data = {puntaje: sumaPuntos, estrellas: estrellas, check : true};
    // $.post(bdir + 'ajax/set_puntaje', data).done(function (data) {
    //     console.log("resultado: " + data);
    // });
    /***
     $('#resumenPuntaje').html('Puntos: '+ $J[1].ptsWinJuego + '<br>'
     +'Bonus por tiempo: '+ $J[1].CTiempo + '<br>'
     +'Total: '+ sumaPuntos + '<br>'
     +'Estrellas: '+ estrellas);/***/
}

function pantallafinal(){
	//stopBGMusic();
	//playFX(window["BGWin"]);
	$("#capaResumen, #caratulaFin1").fadeIn(500);
}

function finalSound(){
	//stopTexto();
	playTexto(window["BGWin"]);
	$("#animation_container").fadeOut(500);
}

function iniciarJuego(){
	//this.returnGame();
	//returnGame();
}

function radioPop(){
    //stopBGMusic();
    setTimeout(function(){
        var ops = Math.floor(Math.random()*3)+1;
        playBGMusic(window["back"+ops]);
    },500);
};

function detenerSonido(){
	stopBGMusic();
}




// resultadoPuntos(PuntajeFinal); linea 15591

// pantallafinal(); finalSound(); linea 14342 14395

// radioPop(); linea 15409