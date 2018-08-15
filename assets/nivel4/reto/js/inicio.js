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
// intervalo de movimiento del player
var $MuevePlayer = 0;
var $startTime = 0;
var $stopTimeIntervalo = 0;
var $cronoStartTime = 0;
var $stopTimeCrono = 0;
var $delayTime = 5000;

//variables de control del juego
var $J = {
    numJ: 0,
    ptsWinJuego: [], //ptos generados por acierto en el juego
    sol: [null, 4, 3, 3, 2, 3, 1], //solucion
    corr: [//textos que salen cuando la respuesta es incorrecta
        null,
        '<b>D:</b> Recuerda que al levantar una caja debes verificar que el peso permitido sea el correcto y mantener la postura adecuada, si excede el peso  debes pedir ayuda',
        '<b>C:</b> Recuerda que para trasladar una carga el peso máximo en hombres en 50kg y mujeres 30kg si este peso se excede debes pedir ayuda',
        '<b>C:</b> Es necesario tomarse una pausa!, recuerda que cada 2 horas de trabajo continuo debes realizar una pausa activa',
        '<b>B:</b> Al realizar trabajo de pie es necesario que puedas alternar el peso en ambos miembros inferiores, no te mantengas apoyado sobre un solo pie',
        '<b>C:</b> Si vas a levantar peso por encima de la altura de los hombros tus brazos pueden quedar en un ángulo de 90&deg;, de estar muy alto recuerda utilizar una escalera y respetar los pesos máximos',
        '<b>A:</b> Al realizar actividades frente al computador o cuando estamos en una reunión es importante mantener una postura correcta para no dañarnos, por esto es importante mantener la espalda recta'
    ],
    intentos: 2,
    puntajeAcierto: 15,
    // para el control de tiempo
    CTInicial: 30,
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
    if (grupo === 'oficina') {
        $('#tPreg_4 span').html('¿Cuál es la manera correcta de manipular el mouse?');
        $('#btn_4_1 span').html('a. De acuerdo a mi comodidad');
        $('#btn_4_2 span').html('b. No hay una forma especifica');
        $('#btn_4_3 span').html('c. La muñeca debo moverla');
        $('#btn_4_4 span').html('d. La muñeca debe estar recta');
        $J.sol[4] = 4;
        $J.corr[4] = '<b>D:</b> Al hacer uso del mouse la muñeca debe permanecer recta, nunca lateralizada, No lo olvides!';
        //console.log($J.sol);
    } else if (grupo === 'planta') {
        $('#tPreg_3 span').html('¿Cuál es el peso máximo para manipular una carga?');
        $('#btn_3_1 span').html('a. Mujeres: 15 kg / Hombres: 25 kg');
        $('#btn_3_2 span').html('b. Mujeres: 12 kg / Hombres: 30 kg');
        $('#btn_3_3 span').html('c. Mujeres: 30 kg / Hombres: 50 kg');
        $('#btn_3_4 span').html('d. Hombres y mujeres: 25 kg');
        $J.sol[3] = 1;
        $J.corr[3] = '<b>A:</b> Al manipular una carga debes verificar cual es el peso, si este excede los 15 kg. (mujeres) o 25 kg. (hombres) debes pedir ayuda, de esta manera evitaremos lesionarnos';
    }
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

    $('#nextInt_1').click(function () {
        playSound(window.audioCatch);
        $('.instr').stop().fadeOut(100);
        $('#inst_2').stop().fadeIn(100);
    });
    $('.btn_CAL_A').click(function () {
        playSound(window.audioCatch);
        var id = String($(this).attr('id').split('_')[1], 10);
        $('.instr').stop().fadeOut(100);
        $('#calificacion').stop().fadeOut(1000);
        calif1 = id;
        // convertir el concatenado en valor numerico
        var x = parseInt(calif1);
        var data = {calificacion: x};
        $.post(bdir + 'ajax/set_calificacion', data).done(function (data) {
        console.log("resultado: " + data);
        });
    });

    
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
            $('#txtPM_2 span').html($J.corr[$J.numJ]);
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
    if (scale1 <= scale2) {// cuando sobra height
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