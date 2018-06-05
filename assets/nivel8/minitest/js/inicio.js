
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
    //console.log($n_pregunta);
    $('.punt_anim').click(function(event) {

        $n_pregunta = $(this).parent().parent().attr("id");

         $pID = parseInt($(this).attr('id').split('_')[1], 10);

         $(this).css("display","none");

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
        stopBGMusic();
        stopTexto();
        playSound(window.audioCatch);
        $('.instrucciones').stop().fadeOut(1000);
        $J.showJuego();
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
                pausarJuego();
            }
        //}
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
        $ptsWinJuego = 0;  
        $sigpregunta =0;
        $('#driver_1').css("background-image", "url("+odir+"/images/driver_1.png)");
        $('#driver_2').css("background-image", "url("+odir+"/images/driver_2.png)"); 
        $('#driver_5').css("background-image", "url("+odir+"/images/driver_5.png)"); 
        $(this).css("pointer-events"," none");
        $('.btn').removeAttr('style')    
    });
    
    $('.btn').click(function () {
        var checkDiv = $('.driver').attr('id');
        $(this).css("pointer-events"," none");
        $sigpregunta++;
        isPaused = true;
        console.log(checkDiv);
        var id = parseInt($(this).data('rspt'));    
            if(id==1){
                $r_correcta = true;
                if($pID == 1){ 
                    if ($n_pregunta == "gPreg_1") {                        
                        $('#driver_1').css("background-image", "url("+odir+"/images/driver_pass.png)");  
                    }else if($n_pregunta == "gPreg_2"){
                        $('#driver_2').css("background-image", "url("+odir+"/images/driver_pass2.png)");  
                    }else if($n_pregunta == "gPreg_5"){
                        $('#driver_5').css("background-image", "url("+odir+"/images/driver_pass5.png)");  
                    }
                }
                console.log("correcto");
            }else{
                console.log("incorrecto");
            }
            if($n_pregunta == "gPreg_1"){
            setTimeout(function(){ $('#pregunta1_' + $pID).animateCss('bounceIn').hide(); }, 500);  
                  
            }else if($n_pregunta == "gPreg_2"){
            setTimeout(function(){ $('#pregunta2_' + $pID).animateCss('bounceIn').hide(); }, 500);         
            
            }else if($n_pregunta == "gPreg_3"){
            setTimeout(function(){ $('#pregunta3_' + $pID).animateCss('bounceIn').hide(); }, 500);         
            
            }else if($n_pregunta == "gPreg_4"){
            setTimeout(function(){ $('#pregunta4_' + $pID).animateCss('bounceIn').hide(); }, 500);         
            }else if($n_pregunta == "gPreg_5"){
            setTimeout(function(){ $('#pregunta5_' + $pID).animateCss('bounceIn').hide(); }, 500);         
            }
        $('.preguntas').fadeOut(500);
        
        
        
        if($sigpregunta == 3){
        
        setTimeout(function(){ $('.btn_pass').animateCss('bounceIn').show(); }, 500);
        }
    });

    $('.btn_pass').click(function() {
        $J.CTiempo = 60,
        $sigpregunta = 0;
         var id_p = parseInt($(this).attr('id').split('_')[1], 10);
        $('.btn_pass').css("pointer-events"," none");
         var id_pm = id_p;
         id_pm++;


        setTimeout(function(){ 
            $('#gPreg_' + id_p).animateCss('bounceOutLeft'); 
            setTimeout(function(){ $('#gPreg_' + id_p).hide(); }, 800);
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
        }
        if(id_p == 5){
             setTimeout($J.finJuego, 500);
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

/*******************************************************************************/