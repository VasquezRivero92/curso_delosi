$.fn.extend({
  animateCss: function(animationName, callback) {
    var animationEnd = (function(el) {
      var animations = {animation: 'animationend',OAnimation: 'oAnimationEnd',MozAnimation: 'mozAnimationEnd',WebkitAnimation: 'webkitAnimationEnd',};
      for (var t in animations) {
        if (el.style[t] !== undefined) {
          return animations[t];
        }
      }
    })(document.createElement('div'));
    this.addClass('animated ' + animationName).one(animationEnd, function() {
      $(this).removeClass('animated ' + animationName);

      if (typeof callback === 'function') callback();
    });
    return this;
  },
});

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
// Array.prototype.shuffle = function () {
//     var i = this.length, j, temp;
//     if (i === 0)
//         return this;
//     while (--i) {
//         j = Math.floor(Math.random() * (i + 1));
//         temp = this[i];
//         this[i] = this[j];
//         this[j] = temp;
//     }
//     return this;
// };
// Array.prototype.rotate = function () {
//     var i = this.length, j, temp;
//     if (i === 0)
//         return this;
//     while (--i) {
//         j = i - 1;
//         temp = this[i];
//         this[i] = this[j];
//         this[j] = temp;
//     }
//     return this;
// };
/*******************************************************************************/
//intervalo de movimiento del player
var $sigpregunta = 0;
var $r_correcta = false;
//var $MuevePlayer = 0;
var $startTime = 0;
var $stopTimeIntervalo = 0;
var $cronoStartTime = 0;
var $stopTimeCrono = 0;
var $delayTime = 5000;//para que las opciones giren, deshabilitado
var $n_pregunta;
var $pID;
var ptsWinJuego = 0;
var puntajeAcierto= 10;
var $rps_correcta=0;

var $pg = [null,
    'El driver se encuentra visiblemente con una molestia. ¿Que deberia hacer?',
    'El driver NO esta vistiendo la casaca negra distintiva  ¿Que deberia hacer?',
    'El faro frontal de la motocicleta esta roto  ¿Que se deberia hacer?',
    'Al driver le hace falta la revisión tecnica de la moto ¿Que deberia hacer?',
    'El casco del driver esta visiblemente dañado ¿Que se deberia hacer?',
];
var $r1 = [null,
    'No pasa nada, nadie se fija en eso.',
    'El driver debe estar en condiciones aptas para iniciar su turno. Debe  recuperarse.',
    'Es una condición común, se puede dejar pasar.',
];
var $r2 = [null,
    'La casaca es parte integral de su uniforme, debe usarla obligatoriamente.',
    'No pasa nada, nadie se fija en eso.',
    '¿Quien se fija en la casaca de todos modos? Puede manejar con otra prenda encima.',
];
var $r3 = [null,
    'Una Motocicleta debe estar en optimas condiciones. Debe reemplazar ese faro lo antes posible.',
    'Es una condición común, se puede dejar pasar. Ademas es turno de día no las necesita.',
    'La moto funciona igual sin esa luz. Puedes apoyarte en la luz de calle.',
];
var $r4 = [null,
    'No pasa nada, nadie se fija en eso. Ademas no hay tantos controles en su ruta.',
    'Que se consiga la revisión tecnica de la  moto de alguien más y que incie su turno.',
    'Un driver debe contar con toda su documentación antes de iniciar su turno,  ¡Siempre!',
];
var $r5 = [null,
    'Es una cosa menor, el visor no protege nada igual',
    'El casco debera ser reemplazado de inmediato.',
    'Que conduzca sin casco hasta que repare el que tiene.',
];

//variables de control del juego
var $J = {
    numJ: 0,
    intentos: 2,
    //para el control de tiempo
    CTInicial: 60,
    CTiempo: 0,
    CMin: 0,
    CSeg: 0
};
//variables de la mecanica del juego


var $scaleActual = 1;

$(document).ready(function (e) {
    
    initSonidos();
    redimensionarJuego();
    $(window).resize(redimensionarJuego);
    //console.log('grupo: ' + grupo);
    //cantPreg = $('.gPreg').length;
    // for (var i = 1; i <= cantPreg; i++) {
    //     PileCant[i] = $('#gPreg_' + i + ' .btn').length;
    //     var PosTemp = [];
    //     var numTemp = [];
    //     for (var j = 1; j <= PileCant[i]; j++) {
    //         var defaults = {left: $('#btn_' + i + '_' + j).css('left'), top: $('#btn_' + i + '_' + j).css('top')};
    //         PosTemp.push(defaults);
    //         numTemp.push(j);
    //     }
    //     pos[i] = PosTemp;
    //     num[i] = numTemp;
    //     //$J.randBtns(i);
    // }
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
    $('.btnPrev').click(function () {
        playSound(window.audioCatch);
        var id = parseInt($(this).attr('id').split('_')[1], 10);
        $('.instrucciones').stop().delay(10).fadeOut(500);
        var j = id - 1;
        $('#instrucciones_' + j).stop().fadeIn(10);
        playTexto(window['txti' + j]);
    });
    $('.btnNext').click(function () {
        playSound(window.audioCatch);
        var id = parseInt($(this).attr('id').split('_')[1], 10);
        $('.instrucciones').stop().delay(300).fadeOut(100);
        var j = id + 1;
        $('#instrucciones_' + j).stop().fadeIn(500);
        playTexto(window['txti' + j]);
    });
    //console.log($n_pregunta);
    $('.punt_anim').click(function(event) {
        playSound(window.audioCrash);
        $n_pregunta = $(this).parent().parent().attr("id");


         $pID = parseInt($(this).attr('id').split('_')[1], 10);

         $(this).css("display","none");
         $('#CTimer').css('display','block');

         $('.preguntas').fadeIn(500);
            console.log($n_pregunta);

            if($n_pregunta == "gPreg_1"){
            setTimeout(function(){ $('#pregunta1_' + $pID).animateCss('bounceIn').show(); }, 500);                   
            }else if($n_pregunta == "gPreg_2"){
            setTimeout(function(){ $('#pregunta2_' + $pID).animateCss('bounceIn').show(); }, 500);                   
            }else if($n_pregunta == "gPreg_3"){
            setTimeout(function(){ $('#pregunta3_' + $pID).animateCss('bounceIn').show(); }, 500);                   
            }else if($n_pregunta == "gPreg_4"){
            setTimeout(function(){ $('#pregunta4_' + $pID).animateCss('bounceIn').show(); }, 500);      
            }else if($n_pregunta == "gPreg_5"){
            setTimeout(function(){ $('#pregunta5_' + $pID).animateCss('bounceIn').show(); }, 500);      
            }
            
         //$('#pregunta1_' + pID).css("display","block");
         isPaused = false;
     });
    //boton de la instruccion 5
    $('#btnJugar').click(function () {
        // setTimeout(intervaloTiempo, 1000);
        isPaused = true;
        stopBGMusic();
        playSound(window.audioCatch);
        $('.instrucciones').stop().fadeOut(1000);
        $J.showJuego();
        introJuego();
        $('.caratula').stop().fadeOut(10);
        setTimeout(intervaloTiempo, 1000);

    });
    //botones del juego
    // $('.btnPlay').click(function () {
    //     $('#btnPlay_' + $J.numJ).addClass('disable');
    //     $('#tPreg_' + $J.numJ).addClass('toTop');
    //     $('#gPreg_' + $J.numJ + ' .btn').removeClass('disable').addClass('show');
    //     //$('#ciPreg_' + $J.numJ).stop().fadeIn();
    //     setTimeout(intervaloTiempo, 1000);
    //     $sigpregunta = 0;
    // });
    $('#pausaTouch').click(function () {
        //if ($MuevePlayer) {
            if ($(this).hasClass('paused')) {
                $('#btnReanudar').click();
            } else {
                $(this).addClass('paused');
                stopBGMusic();
                pausarJuego();
            }
        //}
    });
    $('#btnReanudar').click(function () {
        playBGMusic(window.BGJuego);
        $('#pausaTouch').removeClass('paused');
        $('#PauseGame').fadeOut(200);
        $J.CTiempo = $J.CTiempo + 1;
        isPaused = false;
    });
    $('#btnReinicio').click(function () {
        showInicio();
        $('.caratula, .game, #capaResumen').stop().fadeOut(500);
        $ptsWinJuego = 0;  
        $sigpregunta =0;
        $('#driver_1').css("background-image", "url("+odir+"/images/driver_1.png)");
        $('#driver_2').css("background-image", "url("+odir+"/images/driver_2.png)"); 
        $('#driver_5').css("background-image", "url("+odir+"/images/driver_5.png)"); 
        $(this).css("pointer-events"," none");
        $('.btn').removeAttr('style')    
    });
    
    $('.btn').click(function () {
        $('#CTimer').css('display','none');
        playSound(window.audioCatch);
        var checkDiv = $('.driver').attr('id');
        $(this).css("pointer-events"," none");
        $sigpregunta++;
        isPaused = true;
        var resp1 = parseInt($(this).attr('id').split('_')[1], 10);       
        var resp2 = parseInt($(this).attr('id').split('_')[2], 10);
        
        console.log(resp1);
        
        var id = parseInt($(this).data('rspt'));
        var id_correc = parseInt($(this).attr('id').split('_')[1], 10);        
            if(id==1){
                $r_correcta = true;
                if($pID == 1){ 
                    console.log($pID);
                    if ($n_pregunta == "gPreg_1") {                        
                        $('#driver_1').css("background-image", "url("+odir+"/images/driver_pass.png)");  
                    }else if($n_pregunta == "gPreg_2"){
                        $('#driver_2').css("background-image", "url("+odir+"/images/driver_pass2.png)");  
                    }
                }else if($pID == 2){
                    if($n_pregunta == "gPreg_5"){
                        console.log("5");
                        $('#driver_5').css("background-image", "url("+odir+"/images/driver_pass5.png)");  
                    }
                }
                console.log("correcto");
                $rps_correcta = id;
             
            }else{

                if(resp1 == 1){
                    $('#preg'+resp1+' span').html($r1[resp2]);
                    $('#resp'+resp1+' span').html($r1[2]);   
                }else if(resp1 == 2){
                    $('#preg'+resp1+' span').html($r2[resp2]);
                    $('#resp'+resp1+' span').html($r2[1]);   
                }else if(resp1 == 3){
                    $('#preg'+resp1+' span').html($r3[resp2]);
                    $('#resp'+resp1+' span').html($r3[1]);   
                }else if(resp1 == 4){
                    $('#preg'+resp1+' span').html($r4[resp2]);
                    $('#resp'+resp1+' span').html($r4[3]);   
                }else if(resp1 == 5){
                    $('#preg'+resp1+' span').html($r5[resp2]);
                    $('#resp'+resp1+' span').html($r5[2]);   
                }
                console.log("incorrecto");
            }            
            if($n_pregunta == "gPreg_1"){
            setTimeout(function(){ $('#pregunta1_' + $pID).animateCss('bounceOut').fadeOut(800);
             }, );
            if($sigpregunta == 1){                
                $('#icon_1').css('background-image', 'url('+odir+'/images/icon1.png)');             
            }else if($sigpregunta == 2){
                $('#icon_1').css('background-image', 'url('+odir+'/images/icon2.png)'); 
            }else{
                $('#icon_1').css('background-image', 'url('+odir+'/images/icon3.png)'); 
            }            
            }else if($n_pregunta == "gPreg_2"){
            setTimeout(function(){ $('#pregunta2_' + $pID).animateCss('bounceOut').fadeOut(800); }, );
            if($sigpregunta == 1){                
                $('#icon_2').css('background-image', 'url('+odir+'/images/icon1.png)');             
            }else if($sigpregunta == 2){
                $('#icon_2').css('background-image', 'url('+odir+'/images/icon2.png)'); 
            }else{
                $('#icon_2').css('background-image', 'url('+odir+'/images/icon3.png)'); 
            }  
            }else if($n_pregunta == "gPreg_3"){
            setTimeout(function(){ $('#pregunta3_' + $pID).animateCss('bounceOut').fadeOut(800); }, );
            if($sigpregunta == 1){                
                $('#icon_3').css('background-image', 'url('+odir+'/images/icon1.png)');              
            }else if($sigpregunta == 2){
                $('#icon_3').css('background-image', 'url('+odir+'/images/icon2.png)'); 
            }else{
                $('#icon_3').css('background-image', 'url('+odir+'/images/icon3.png)'); 
            } 
            }else if($n_pregunta == "gPreg_4"){
            setTimeout(function(){ $('#pregunta4_' + $pID).animateCss('bounceOut').fadeOut(800); }, );
            if($sigpregunta == 1){                
                $('#icon_4').css('background-image', 'url('+odir+'/images/icon1.png)');              
            }else if($sigpregunta == 2){
                $('#icon_4').css('background-image', 'url('+odir+'/images/icon2.png)'); 
            }else{
                $('#icon_4').css('background-image', 'url('+odir+'/images/icon3.png)'); 
            }          
            }else if($n_pregunta == "gPreg_5"){
            setTimeout(function(){ $('#pregunta5_' + $pID).animateCss('bounceOut').fadeOut(800); }, );
            if($sigpregunta == 1){                
                $('#icon_5').css('background-image', 'url('+odir+'/images/icon1.png)');             
            }else if($sigpregunta == 2){
                $('#icon_5').css('background-image', 'url('+odir+'/images/icon2.png)'); 
            }else{
                $('#icon_5').css('background-image', 'url('+odir+'/images/icon3.png)'); 
            }           
            }
            if ($rps_correcta == 1){
                $('.btn_pass').css("background-image", "url("+odir+"/images/BGacierto.png)");
                $('.texto1,.texto2').css('display', 'none');
                
            }else{
                $('.btn_pass').css("background-image", "url("+odir+"/images/BGerror.png)");
                setTimeout(function(){ $('.texto1,.texto2').fadeIn(800); }, );     
            }
            $('.preguntas').fadeOut(1500);
        
            if($sigpregunta == 3){

        setTimeout(function(){ $('.btn_pass_sombra').show(); }, 1500);
        setTimeout(function(){ $('.btn_pass').animateCss('bounceIn').show(); }, 1500);
        // $('.btn_pass_sombra').css("display","block");
        }
    });

    $('.btn_pass').click(function() {
        $('.btn_pass_sombra').css("display","none");
         $('#CSeg').html("60");
         $rps_correcta = 0;
        $('.btn_pass').css("background-image", "url("+odir+"/images/BGacierto.png)");
        $('.texto1,.texto2').css('display', 'none');  
        $J.CTiempo = 60,
        $sigpregunta = 0;
         var id_p = parseInt($(this).attr('id').split('_')[1], 10);
        $('.btn_pass').css("pointer-events"," none");
         var id_pm = id_p;
         id_pm++;


        setTimeout(function(){ 
            $('#gPreg_' + id_p).animateCss('bounceOutLeft'); 
            setTimeout(function(){ $('#gPreg_' + id_p).fadeOut(); }, 800);
        }, 1000);

        setTimeout(function(){ 
            $('#gPreg_' + id_pm).animateCss('bounceInRight').show();
            id_pm = 0; 
            $('.btn_pass').css("pointer-events"," auto").hide();
            
            }, 1000);
         setTimeout(function(){$('.punt_anim').css("display","block").show();},1500);
        if($r_correcta == true){
           aumentaPtos(); 
           $r_correcta = false;
        }else{
            if($n_pregunta=="gPreg_1"){
                $('#icon_1').addClass('anim check icon_incorrecto');
            }else if($n_pregunta=="gPreg_2"){
                $('#icon_2').addClass('anim check icon_incorrecto');
            }else if($n_pregunta=="gPreg_3"){
                $('#icon_3').addClass('anim check icon_incorrecto');
            }else if($n_pregunta=="gPreg_4"){
                $('#icon_4').addClass('anim check icon_incorrecto');
            }else if($n_pregunta=="gPreg_5"){
                $('#icon_5').addClass('anim check icon_incorrecto');
            }
        }
        if(id_p == 5){
             setTimeout($J.finJuego, 700);
        }
          
    });
    $('#btnPBien,#btnPMal,#btnPTime').click(function () {
        
        $('#pregWindow').stop().fadeOut(500);
        $('.caratula').stop().delay(500).fadeOut(10);
        $('.gPreg').stop().delay(500).fadeOut(10);
        // if ($n_pregunta == "gPreg_5") {
            setTimeout($J.finJuego, 500);
        // } else {
            CronoReset();            
        // }
     });
    }
function showInicio() {
    playBGMusic(window.intro);
    redimensionarJuego();
    $('.instrucciones').stop().hide();
    $('#instrucciones_1').fadeIn(1000);
    setTimeout(function () {
        $(".instrucciones").stop().delay(300).fadeOut(100);
        $("#instrucciones_1_2").stop().fadeIn(500);
        playTexto(window.txti2);
    }, 4000);
    $('#i2btn_1').click(function () {
        $('#instrucciones_2').fadeIn(500);
     });
}

function introJuego() {
    // $(".caratula,.conteo").stop().fadeOut(10);
    // $(".conteo").removeClass('anima bounceIn');
    $(".transparencia").show();
    setTimeout(function () {
        $("#conteo3").addClass('anima bounceIn').show();
        playSound(window.beep);
    }, 1500);
    setTimeout(function () {
        $("#conteo2").addClass('anima bounceIn').show();
        playSound(window.beep);
    }, 2500);
    setTimeout(function () {
        $("#conteo1").addClass('anima bounceIn').show();
        playSound(window.beep);
    }, 3500);
    setTimeout(function () {
        
    }, 4000);
    setTimeout(function () {
        $(".transparencia").fadeOut(300);
        // $J[$JAct].inicioJuego();
        // $(".gameEnv").show();
    }, 4000);
    setTimeout(function () {
        playSound(window.beepXL);
    }, 4500);
}
/*******************************************************************************/

/*******************************************************************************/