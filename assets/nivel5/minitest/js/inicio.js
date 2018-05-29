/*******************************************************************************/
Array.prototype.shuffle = function () {
    var i = this.length, j, temp;
    if (i === 0)
        return this;
    while (--i) {
        j = Math.floor(Math.random() * (i + 1));
        temp = this[i];
        this[i] = this[j];
        this[j] = temp;
    }
    return this;
};
Array.prototype.rotate = function () {
    var i = this.length, j, temp;
    if (i === 0)
        return this;
    while (--i) {
        j = i - 1;
        temp = this[i];
        this[i] = this[j];
        this[j] = temp;
    }
    return this;
};
/*******************************************************************************/
//intervalo de movimiento del player
var $MuevePlayer = 0;
var $startTime = 0;
var $stopTimeIntervalo = 0;
var $cronoStartTime = 0;
var $stopTimeCrono = 0;
var $delayTime = 5000;//para que las opciones giren, deshabilitado

//variables de control del juego
var $J = {
    numJ: 0,
    ptsWinJuego: [], //puntos generados por acierto en el juego
    sol: [null, 2, 1, 2, 1, 2, 3, 1, 2], //soluciones
    corr: [null, //textos que salen cuando la respuesta es incorrecta
        [null, //pregunta 1
            'Esta no es correcta porque recuerda que lo que tiene que estar exhibido es el Aviso (letrero) no el libro en físico.',
            null,
            'Esta no es correcta porque recuerda que lo que tiene que estar exhibido es el Aviso (letrero) no el libro en físico.'
        ], [null, //pregunta 2
            null,
            'No solo debe colocar su firma, sino que también debe marcar el casillero.',
            'El cliente debe marcar el casillero y colocar su firma.'
        ], [null, //pregunta 3
            'Esta no es correcta. Si bien tu puedes dar atención al reclamo, no pongas trabas para que el cliente coloque su reclamo, pues podemos ser sancionados por el Indecopi.',
            null,
            'Siempre debemos entregar el libro de reclamaciones cuando nos lo requieran.'
        ], [null, //pregunta 4
            null,
            'Esta no es correcta, dado que debes enviar el formato e imagen del libro dentro de las 24 horas de interpuesto el reclamo.',
            'Esta no es correcta, dado que debes enviar el formato e imagen del libro dentro de las 24 horas de interpuesto el reclamo.'
        ], [null, //pregunta 5
            'Este no es un supuesto para anular la hoja. Es un reclamo válido.',
            null,
            'Este no es un supuesto para anular la hoja.'
        ], [null, //pregunta 6
            'Esta no es recuerda. Debes comunicarte a la brevedad con tu Gerente de Área a fin que coordine una respuesta con Servicio al Cliente.',
            'Esta no es recuerda. Debes comunicarte a la brevedad con tu Gerente de Área a fin que coordine una respuesta con Servicio al Cliente.'
        ], [null, //pregunta 7
            'No indicar la frase “Lamentamos lo Sucedido” dado que puede ser considerado como asunción de responsabilidad.',
            'Esta es una posible respuesta correcta. Debemos recordarle al cliente que nuestra empresa cuenta con altos estándares de calidad.',
            'Esta es una posible respuesta correcta. Si lo consideras conveniente, ofrécele la devolución de su dinero.'
        ], [null, //pregunta 8
            'Esta respuesta es correcta, dado que siempre debemos detallar en qué consiste e indicar el período de vigencia.',
            null,
            'Esta es correcta. El Gerente de Área debe hacer seguimiento a que los clientes hagan efectiva sus cortesías.'
        ]
    ],
    intentos: 2,
    puntajeAcierto: 20,
    //para el control de tiempo
    CTInicial: 40,
    CTiempo: 0,
    CMin: 0,
    CSeg: 0
};
//variables de la mecanica del juego
var num = [];
var pos = [];
var PileCant = [];
var cantPreg = 0;

var $scaleActual = 1;

$(document).ready(function (e) {
    initSonidos();
    redimensionarJuego();
    $(window).resize(redimensionarJuego);
    //console.log('grupo: ' + grupo);
    cantPreg = $('.gPreg').length;
    for (var i = 1; i <= cantPreg; i++) {
        PileCant[i] = $('#gPreg_' + i + ' .btn').length;
        var PosTemp = [];
        var numTemp = [];
        for (var j = 1; j <= PileCant[i]; j++) {
            var defaults = {left: $('#btn_' + i + '_' + j).css('left'), top: $('#btn_' + i + '_' + j).css('top')};
            PosTemp.push(defaults);
            numTemp.push(j);
        }
        pos[i] = PosTemp;
        num[i] = numTemp;
        //$J.randBtns(i);
    }
    initBotones();

    $('#qLoverlay').show();
    $('#historia').queryLoader2({
        barColor: '#000000',
        backgroundColor: '#333333',
        percentage: true,
        minimumTime: 100,
        barHeight: 0,
        onComplete: showInicio
    });
});
function initSonidos() {
    audios.forEach(function (itm, i) {
        loadSound(itm[0], itm[1]);
    });
}
function initBotones() {
    //boton de la instruccion 5
    $('#btnJugar').click(function () {
        stopBGMusic();
        stopTexto();
        playSound(window.audioCatch);
        $('.instrucciones').stop().fadeOut(1000);
        $J.showJuego();
        $('.caratula').stop().fadeOut(10);
    });
    //botones del juego
    $('.btnPlay').click(function () {
        $('#btnPlay_' + $J.numJ).addClass('disable');
        $('#tPreg_' + $J.numJ).addClass('toTop');
        $('#gPreg_' + $J.numJ + ' .btn').removeClass('disable').addClass('show');
        $('#ciPreg_' + $J.numJ).stop().fadeIn();
        setTimeout(intervaloTiempo, 1000);
    });
    $('#pausaTouch').click(function () {
        if ($MuevePlayer) {
            if ($(this).hasClass('paused')) {
                $('#btnReanudar').click();
            } else {
                $(this).addClass('paused');
                pausarJuego();
            }
        }
    });
    $('#btnReanudar').click(function () {
        $('#pausaTouch').removeClass('paused');
        $('#PauseGame').fadeOut(200);
        $J.CTiempo = $J.CTiempo + 1;
        isPaused = false;
    });
    $('#btnReinicio').click(function () {
        showInicio();
        $('.caratula, .game, #capaResumen').stop().fadeOut(500);
    });
    $('.btn').click(function () {
        isPaused = true;
        var id = parseInt($(this).attr('id').split('_')[2], 10);
        $('.caratula').stop().fadeOut(300);
        $('#pregWindow').fadeIn(400);
        if (id === $J.sol[$J.numJ]) {
            if ($MuevePlayer) {
                window.cancelAnimationFrame($MuevePlayer);
            }
            $MuevePlayer = 0;
            playSound(window.bien);
            aumentaPtos();
            $('#pregBien').stop().delay(300).fadeIn(300);
        } else {
            var texto = $(this).children('span').html();
            $('#txtPM_1 span').html(texto);
            $('#txtPM_2 span').html($J.corr[$J.numJ][id]);
            playSound(window.audioCrash);
            $('#pregMal').stop().delay(300).fadeIn(300);
        }
    });
    $('#btnPBien,#btnPMal,#btnPTime').click(function () {
        $J.numJ++;
        $('#pregWindow').stop().fadeOut(500);
        $('.caratula').stop().delay(500).fadeOut(10);
        if ($J.numJ > cantPreg) {
            setTimeout($J.finJuego, 500);
        } else {
            cargaPreg();
        }
    });
}
function showInicio() {
    playBGMusic(window.BGIntro);
    redimensionarJuego();
    $('.instrucciones').stop().hide();
    $('#instrucciones_1').fadeIn(1000);
    setTimeout(function () {
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#instrucciones_5').stop().fadeIn(500);
    }, 4000);
}
/*******************************************************************************/
function redimensionarJuego() {
    scale1 = (window.innerWidth / 1350);
    scale2 = (window.innerHeight / 700);
    if (scale1 <= scale2) {//cuando sobra height
        $('.resizeWindow').css({'left': '0px', 'transform': 'scale(' + scale1 + ')'});
        $scaleActual = scale1;
    } else {//cuando sobra width
        var left = (window.innerWidth - (1350 * scale2)) / 2;
        $('.resizeWindow').css({'left': left + 'px', 'transform': 'scale(' + scale2 + ')'});
        $scaleActual = scale2;
    }
    $('body, html').css('height', window.innerHeight);
}
function pausarJuego() {
    isPaused = true;
    $("#PauseGame").show();
}
/*******************************************************************************/