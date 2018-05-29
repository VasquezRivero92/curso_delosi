/*******************************************************************************/
var sClick = [true, false, true, false, false];
var lAudio = [null, '', '', '', ''];
var sID = 0;
var completo = false;
var checkS3 = [true, false, false, false, false, false, false, false, false, false, false, false, false, false, false];
var act_desc = new Boolean(false);
/*******************************************************************************/
function showInicio() {
    redimensionarJuego();
    $('.instrucciones').stop().hide();
    $('#instruccion_1').fadeIn(1000);
    playSound(window.nivelBG);
    setTimeout(function () {
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#instruccion_2').stop().fadeIn(500);//aqui va instruccion_2
        playBGMusic(window.menuBG);
        playTexto(window.txti2);
    }, 4000);
    $('#s3det_11').tinyscrollbar({trackSize: 330, thumbSize: 50});
}
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
function initSonidos() {
    audios.forEach(function (itm, i) {
        loadSound(itm[0], itm[1]);
    });
}
/*******************************************************************************/
$(document).ready(function (e) {
    initSonidos();
    redimensionarJuego();
    $(window).resize(redimensionarJuego);
    $('#qLoverlay').show();
    $('#historia').queryLoader2({
        barColor: '#000000',
        backgroundColor: '#333333',
        percentage: true,
        minimumTime: 100,
        barHeight: 0,
        onComplete: showInicio
    });
    $('#i2btn_1').click(function () {
        stopTexto();
        playSound(window.playBTN);
        sID = parseInt($(this).attr('id').split('_')[1], 10);
        
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#instruccion_5').stop().fadeIn(500);
        $.post(bdir + 'ajax/init_curso').done(function (data) {
            console.log('Init nivel: ' + data);
        });
        setTimeout(function () {
            $('.instrucciones').stop().delay(300).fadeOut(100);
            $('#instruccion_3').stop().fadeIn(500);
        }, 4000);
    });
    $('.i3btn').click(function () {
        playSound(window.playBTN);
        sID = parseInt($(this).attr('id').split('_')[1], 10);
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#sliderPage_' + sID).stop().fadeIn(500);
        console.log(sID);        
       
        if (lAudio[sID]) {
         playTexto(window[lAudio[sID]]);
         console.log(lAudio[sID]);
         } else {   
          if(sID == 3){
              playTexto(window.txti2); 
            console.log("asdgasjdgasdg");
        }else { playTexto(window['s' + sID + 'i1']);};        
        
         
         
           
         }         
        $('.s3btn').removeClass('checked');
    });
    $('.btnVolver').click(function () {
        stopTexto();
        playSound(window.playBTN);
        $('.instrucciones').stop().delay(10).fadeOut(500);
        $('#instruccion_3').stop().fadeIn(10);
        var comp1 = sClick.every(function (itm) {
                    return itm === true;
                });
                if (comp1) {
                    playTexto(window.test);
                }
    });
    $('.owl-carousel').owlCarousel({
        dots: false,
        items: 1,
        loop: false,
        margin: 0,
        nav: true,
        mouseDrag: false,
        touchDrag: false
    }).on('translated.owl.carousel', function (e) {
        //console.log(e.item);
        var id = e.item.index + 1;
        lAudio[sID] = 's' + sID + 'i' + id;
        playTexto(window[lAudio[sID]]);
        console.log(lAudio[sID]);
        if (!completo && id === e.item.count) {
            $('#sliderPage_' + sID + ' .btnVolver').show();
            $('#i3btn_' + sID).addClass('disable');
            sClick[sID] = true;
            var comp = sClick.every(function (itm) {
                return itm === true;
            });
            if (comp) {
                completo = true;
                $('.i3btn').removeClass('disable');
                $('#i3txt_2,#btnJugar,#btnJugar2').show();
            }
        }
    });
    $('.s3btn').click(function () {
        playSound(window.playBTN);  
        sIDL = parseInt($(this).attr('id').split('_')[1], 10);
        $('#s3Hoja').removeClass();
        $('.s3det').stop().fadeOut(500);
        stopTexto();
        if(act_desc == false){
              act_desc = true;
              //playTexto(window.txti2);
               playTexto(window['s2i'+sIDL]);
               console.log("s2i"+sIDL);
          }else{
              stopTexto();
              console.log("stop audio");
              act_desc = false;
          }  
        if ($(this).hasClass('detail')) {
            
            $(this).addClass('checked');
            $('#s3t1').stop().fadeIn(500);
            $('#s3t2').stop().fadeOut(500);
            $('#s3CHoja').removeClass('detail');
            $('.s3btn').stop().delay(500).fadeIn(10).removeClass('detail');
            //console.log(checkS3);
            
            var fullS3 = checkS3.every(function (itm) {
                return itm === true;
            });
            if (fullS3) {//aqui va lo mismo que en el carrusel
                $('#popup_1').stop().fadeIn(1000);
                playTexto(window.sP2ipop);
                $('#sliderPage_' + sID + ' .btnVolver').show();
                $('#i3btn_' + sID).addClass('disable');
                sClick[sID] = true;
                var comp = sClick.every(function (itm) {
                    return itm === true;
                });
                if (comp) {
                    completo = true;
                    $('.i3btn').removeClass('disable');
                    $('#i3txt_2,#btnJugar,#btnJugar2').show();
                }
            }
        } else {
            var id = parseInt($(this).attr('id').split('_')[1], 10);
            $('#s3t1').stop().fadeOut(500);
            $('#s3t2').stop().fadeIn(500);
            $('#s3CHoja').addClass('detail');
            $('#s3Hoja').addClass('focus' + id);
            $('.s3btn').stop().fadeOut(10);
            $(this).stop().fadeIn(10).addClass('detail');
            $('#s3det_' + id).stop().fadeIn(500);
            checkS3[id] = true;
            setTimeout(function () {
                $('#s3det_11').data('plugin_tinyscrollbar').update();
                //$('#s3det_11').tinyscrollbar({trackSize: 330, thumbSize: 50});
            }, 200);
        }
    });
    $('#pop1btn_1').click(function () {
        stopTexto();
        $('#popup_1').stop().fadeOut(1000);
    });
});
/*******************************************************************************/