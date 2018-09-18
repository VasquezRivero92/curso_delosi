var $drivers = 0;
var $pared = 0;
// numero de juego actual
var $JAct = 0;
// Maximo nivel alcanzado
//var $JMax = 1;
// intervalo de movimiento del player
var $MuevePlayer = 0;
var $MovCamera = 0;
var $startTime = 0;
var $stopTimeIntervalo = 0;
var $cronoStartTime = 0;
var $stopTimeCrono = 0;
var $delayTime = 20;
// choque futuro con paredes
var ChoqueFuturo = false;
// intervalo del hit(momentaneo)
// var $hitInterval = 0;
// var $hitStartTime = 0;
// arrays de objetos del juego
var $ParedMask1;
var $PowerUps = [];
var $PowerPE = [];
var $PowerPR = [];
var $ActPwrUp = 0;
//var $CasasActv = [0,1,2,3,4,5,6,7,8,9,10,11,12];
// var $CasasActv = [null,true,false,false,true,true,true,false,true,true,false,false,false];
var $Preguntas = [null, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1];
//posiciones guardadas del mapa, jugador y pops;

/* posiciones   MapaX  MapaY PlrX  PlrY */
var $pos_1 =  [ -1036, -497, 1718, 950];        // inicio
var $pos_2 =  [ -734, -719, 1420, 1093];        // drivers
var $pos_3 =  [ -1283, -717, 1976, 1088];       // universidad
var $pos_4 =  [ -17, -1131, 544, 1498];         // evacuando
var $pos_5 =  [ -17, -1583, 644, 1938];         // quimicos
var $pos_6 =  [ -1414, -1528, 2053, 1825];      // museo
var $pos_7 =  [ -1997, -1573, 2649, 1884];      // pausas activas
var $pos_8 =  [ -742, -1488, 1405, 1829];      // construccion1
var $pos_9 =  [ -1055, -1585, 1714, 2034];      // construccion2

/*esta variable se obtendra de la base de datos.*/
var DBValue = 1;
var $posGen_Saved;
var $AnimacionCreada = 0;
// variables de puntaje
//var $puntajeAcumulado = 0;
var $KC_boton;
var $ExisteTouch = 0;
var $J = [];
$J[1] = new Lab_Juego();

var toggle = false;

var $scaleActual = 1;
var buzon_chart = 'Si tienes alguna duda puedes escribir en la casilla de abajo y te responderemos lo antes posible.';

$.fn.reverse = [].reverse;

$(document).ready(function (e) {

    $drivers = parseInt($('body').data('drivers'), 10);
    $pared = $('body').data('pared'); 
    
    for (var i = 1; i < cursos.length; i++) { 
        //console.log(cursos[i]);
        if(i <= 4 &&  cursos[i] >= 0 && cur_intento[i] >= 1 ){
            $("#CA_"+i).addClass('aprobado');
        }else if(cursos[i] >= 70){
            if($drivers == 2){
                $("#CA_5").fadeIn(100);
            }else{
                $("#CA_5").fadeOut(100);
            }
            $("#CA_"+i).addClass('aprobado');
        }
    }

    $.get(bdir + 'ajax/get_mapa').done(function (data) {
        //console.log("mapa: " + data);
        DBValue = data;
        $posGen_Saved = parseInt(DBValue);
        initJuegos();
    });  
    setTimeout(function () {
        
        if($posGen_Saved != 1){
            $ActPwrUp = parseInt($('#powerUp_'+DBValue).attr('id').split("_")[1], 10);
            muestraPregunta();
        }
    }, 2500);

    $(".dirBtn, .circleExt, .touchElement, .btnPlayer").disableSelection();
    initSonidos();
    $ExisteTouch = 'ontouchend' in document;
    redimensionarJuego();
    if ($ExisteTouch) {
        initTouchControl();
    }
    initKeyControl();
    initBotones();
    $(window).resize(function () {
        redimensionarJuego();
        if ($ExisteTouch) {
            initTouchControl();
        }
    });
    $("#qLoverlay").show();
    $("#historia").queryLoader2({
        barColor: "#000000",
        backgroundColor: "#333333",
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


    $('.btn_Salir').click(function () {
        toggle = false;
        $('.content_curs').removeClass('animated fadeInDown').addClass('animated fadeOutDown');
        setTimeout(function(){  $('#pop_stat_curs').fadeOut(500); }, 500);
    });

    $( "#btn_curs" ).click(function () {
        if(!toggle){
            $('#pop_stat_curs').fadeIn(500);
            $('.content_curs').removeClass('animated fadeOutDown').addClass('animated fadeInDown').fadeIn(10);
            toggle = true;
        }else{
            $('.content_curs').removeClass('animated fadeInDown').addClass('animated fadeOutDown');
            setTimeout(function(){  $('#pop_stat_curs, .content_curs').fadeOut(500); }, 500);
            toggle = false;
        }
    });

    $('.accordionMC').click(function () {
        var idResp = $(this).attr('id').split("_")[1];
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('#pan_acord_'+idResp).hide();
        } else{
            $('.accordionMC').removeClass("active");
            $(".panel").hide();
            $(this).addClass('active');
            $('#pan_acord_'+idResp).show();
        }
    });

    $("#pop2ta").focus(function() {
        $('#pop2txt1').html(buzon_chart);
    });

    $('#correo_mc').click(function() {
        $('#accordion').fadeOut(500);
        $('#formBuzon').fadeIn(500);
    });

    $('.anim').click(function() {
        if($( "#topBar" ).hasClass("animPers")){
            $('#topBar').removeClass('animPers');
        }else{
            $('#topBar').addClass('animPers');
        }
    });

    $('#btn_cont').click(function () {
        playSound(window.audioCatch);
        setTimeout(function () {
            playTexto(window.Fireworks);           
        }, 100);
        $('.instrucciones').stop().hide();
        $('#instrucciones_3').fadeIn(1000);

        setTimeout(function () {
            $( ".mapa_anim" ).addClass('mapa_animation');
            setTimeout(function () { $J[1].showJuego(); }, 4000);
            setTimeout(function () {
                $('.instrucciones').stop().fadeOut(1000);
                $('.caratula').stop().fadeOut(10);
                $(".mapa_anim").delay(2500).fadeOut(1500);
                setTimeout(function () { $( ".mapa_anim" ).removeClass('mapa_animation'); }, 2000);
            }, 5000);
        }, 1000);
    });

    function InitMap() {
        //stopBGMusic();
        //stopTexto();
        playSound(window.audioCatch);
        $('.instrucciones').stop().fadeOut(1000);
        $J[1].showJuego();
        $('.caratula').stop().fadeOut(10);
    }

    //botones del juego
    $('#pausaTouch').click(function () {
        if ($MuevePlayer) {
            if ($(this).hasClass("paused")) {
                $("#btnReanudar").click();
            } else {
                $(this).addClass("paused");
                pausarJuego();
            }
        }
    });
    $('#btnReanudar').click(function () {
        $('#pausaTouch').removeClass('paused');
        $('#PauseGame').fadeOut(200);
        //$J[$JAct].CTiempo = $J[$JAct].CTiempo + 1;
        isPaused = false;
    });

    $('.pregOpc').click(function () {
        playSound(window.playBTN);
        $('.caratula').stop().fadeOut(300);
        var idResp = parseInt($(this).attr('id').split("_")[2], 10);
        $('#powerUp_'+$ActPwrUp).addClass("hit");
        $PowerUps[$ActPwrUp - 1].hit = false;
        $('#pregWindow').stop().fadeOut(400);
        // if (idResp === $Preguntas[$ActPwrUp]) {
        //     playSound(window.bien);
        // }else 
        if (idResp === $Preguntas[1] || idResp === $Preguntas[13] || idResp === $Preguntas[14] ) {
            playSound(window.audioCrash);
            $ActPwrUp = 1;
            $('#pregWindow').stop().fadeOut(400);
            $('.caratula').stop().delay(500).fadeOut(10);
            setTimeout(function () {
                isPaused = false;
            }, 1500);
            $PowerUps[$ActPwrUp - 1].visible = 200;
            $('#accordion').fadeIn(500);
            $('#formBuzon').fadeOut(500);

            $('#pop2txt1').html(buzon_chart);
            $('#pop2ta').val('');
                
        }else{
            playSound(window.audioCrash);
            $ActPwrUp = 1;
            $('#pregWindow').stop().fadeOut(400);
            $('.caratula').stop().delay(500).fadeOut(10);
            setTimeout(function () {
                 isPaused = false;
            }, 1500);
            $PowerUps[$ActPwrUp - 1].visible = 200;
        }
    });

    $("#Player_1 .ptje").click(function () {
        if ($ActPwrUp) {
            muestraPregunta();
        }
    });

    $('#i4Buzon').click(function () {
        playSound(window.playBTN);
        $('#pop2txt1').show().html(buzon_chart);
        $('#pop2ta').val('');
        $('#popup2').fadeIn(1000);
    });

    //Envío de buzón
    //pop2txt1 = $('#pop2txt1').html();
    $('#pop2sub').click(function (e) {
        playSound(window.playBTN);
        e.preventDefault();
        var data = new Object();
        if ($('#pop2ta').val() && $('#pop2ta').val().trim().length > 0) {
            data.texto = $('#pop2ta').val().trim();
            $('#pop2ta').addClass('disable');
            $('#pop2sub').addClass('disable');
            $.ajax({
                data: data,
                type: 'POST',
                dataType: 'json',
                url: bdir + 'ajax/send_buzon'
            }).done(function (data, textStatus, jqXHR) {
                $('#pop2txt1').show().html(data);
                setTimeout(function () {
                    $('#accordion').fadeIn(500);
                    $('#formBuzon').fadeOut(500);
                    $('#pregWindow').fadeOut(1000);
                    $('#popAct_1').fadeOut(1000);
                    isPaused = false; 
                }, 1000);
            }).fail(function (jqXHR, textStatus, errorThrown) {
                $('#pop2ta').addClass('error');
            }).always(function () {
                $('#pop2ta').removeClass('disable');
                $('#pop2sub').removeClass('disable');
            });
        } else {
            $('#pop2txt1').html('Completar el campo de consulta.');
        }
    });

    $('#pop2close').click(function () {
        playSound(window.playBTN);
        $('#popAct_1').fadeOut(1000);
    });
}

function initJuegos() {
    $ParedMask1 = new Lab_Objeto(0, 0, 120, 90);
    $ParedMask1.canvas = document.createElement('canvas');
    $ParedMask1.canvas.width = $ParedMask1.width;
    $ParedMask1.canvas.height = $ParedMask1.height;
    $ParedMask1.ctx = $ParedMask1.canvas.getContext("2d");
    $ParedMask1.ctx.globalCompositeOperation = "copy";
    $J.forEach(function (itm, i) {
        $J[i].init(i);
    });
}

function showInicio() {
    //playBGMusic(window.BGIntro);
    //playTexto(window.txti1);
    redimensionarJuego();
    $('.instrucciones').stop().hide();

    var fw = parseInt($('body').data('firstwindow'), 10);

    if (fw == 4) {
        playBGMusic(window.BGJuego);    
        $J[1].showJuego();
    }else{
        playBGMusic(window.BGIntro);
        $('#instrucciones_1').fadeIn(1000);
        setTimeout(function () {
            $(".instrucciones").stop().delay(300).fadeOut(100);
            $("#instrucciones_2").stop().fadeIn(500);
            playTexto(window.Welcome);
        }, 3000);
    }

    if($pared == 1){
        //console.log("abierto");
        $("#powerUp_17").remove();
        $("#icoPel_15").remove();
    }else{
        //console.log("cerrado");
        $("#fondoOPC1").append('<div id="powerUp_17" class="powerUp powerUp1">17</div>');
        $(".gameFrame").append('<div id="icoPel_15" class="icoPel"><div id="objt_17" class="objt"><span>"Esta barrera aparecerá solo si no has terminado alguno de los cursos de Expertos de la prevención"</span></div></div>');
    }
}
function introJuego() {
    $(".caratula,.conteo").stop().fadeOut(10);
    setTimeout(function () {
        if ($ExisteTouch) {
            $(".touchElement").addClass("show");
        }
    }, 500);
    setTimeout(function () {
        $("#infoWindow").fadeOut(300);
        $J[$JAct].inicioJuego();
        $(".gameEnv").show();
    }, 500);
}

function alcaldeza(){
    var x = Math.floor((Math.random() * 3) + 1);
    var consejos = [ 'Hola, espero que estés disfrutando de los cursos!, recuerda siempre mantener el orden y limpieza en tu área de trabajo.',
                     'Qué bueno volver a verte nuevamente, recuerda no correr dentro de las instalaciones, así evitaremos caídas.',
                     'Hola, aplica todo lo que aprendes en nuestra Ciudad de la Prevención, juntos podemos Prevenir Accidentes!'];
    $('.consejitos').html(consejos[x - 1]);
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
    $('body, html').css("height", window.innerHeight);
}
function MostrarTiempo() {
    $J[$JAct].CSeg = $J[$JAct].CTiempo % 60;
    $J[$JAct].CMin = parseInt($J[$JAct].CTiempo / 60);
    $("#CMin").html($J[$JAct].CMin);
    CCero = "";
    if ($J[$JAct].CSeg < 10) {
        CCero = "0";
    }
    $("#CSeg").html(CCero + $J[$JAct].CSeg);
}
function pausarJuego() {
    isPaused = true;
    $("#PauseGame").show();
}
function muestraPregunta() {
    var curso_value = $("#powerUp_" + $ActPwrUp).data('curso');
    var data = { mapa: curso_value };
    $.post(bdir + 'ajax/set_mapa', data).done(function (data) { 
        //console.log("mapa:" + curso_value);
    }); 
    if($ActPwrUp == 1 || $ActPwrUp == 13 || $ActPwrUp == 14){
        $('#pop2ta').val('');
    }
    playSound(window.audioCatch);
    isPaused = true;
    $(".caratula").hide();
    $("#pregWindow").fadeIn(1000);
    //PlayerMov.areaPtje.removeClass('animated rubberBand').fadeOut(300);
    if($ActPwrUp == 2){
        if($drivers == 2){
            $("#popAct_" + $ActPwrUp).fadeIn(1000);
        }else {
            $("#popAct_-1").fadeIn(1000);        
        }    
    }else if($ActPwrUp == 12){
        if($drivers == 2){
            $("#popAct_0").fadeIn(1000);
        }else {
            $("#popAct_" + $ActPwrUp).fadeIn(1000); 
        }       
    }else if($ActPwrUp == 13 || $ActPwrUp == 14){
        $("#popAct_1").fadeIn(1000);
    }else{
        $("#popAct_" + $ActPwrUp).fadeIn(1000);   
    }    
}
function snd_hablar(snd){
    switch (snd) {
        case 1:
            playSound(window.Hablar2);                      
        break; 
        case 2:
            playSound(window.piso);                      
        break;  
        case 3:
            playSound(window.piso);                      
        break;
        case 13:
            playSound(window.Hablar2);                      
        break; 
        case 14:
            playSound(window.Hablar2);                      
        break;        
        case 15:
            playSound(window.Hablar4);                      
        break;        
        case 16:
            playSound(window.Hablar4);                      
        break; 
        case 17:
            playSound(window.palta1);                      
        break;               
        default:
            playSound(window.piso); 
        break;
    }           
}
$.fn.extend({
    disableSelection: function () {
        this.each(function () {
            this.onselectstart = function () {
                return false;
            };
            this.unselectable = "on";
            $(this).css({'-webkit-user-select': 'none', '-moz-user-select': 'none', 'user-select': 'none'});
        });
    }
});



