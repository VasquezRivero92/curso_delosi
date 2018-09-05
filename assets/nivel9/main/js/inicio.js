/*******************************************************************************/
var sClick = [true, false, true, false, false];
var lAudio = [null, '', '', '', ''];
var sID = 0;
var completo = false;
var act_desc = new Boolean(false);
var sli_1,sli_2,sli_3 = new Boolean(false);
var id_sl = 0;
var $count_btn = 0;
// var $intentos_juego = 0;
/*******************************************************************************/
function showInicio() {
    $.post(bdir + 'ajax/init_curso').done(function (data) {
            console.log("Init nivel: " + data);
        }); 
    redimensionarJuego();
    $('.instrucciones').stop().hide();
    $('#instruccion_1').fadeIn(1000);
    playSound(window.nivelBG);
    setTimeout(function () {
        $(".instrucciones").stop().delay(300).fadeOut(100);
        $("#instruccion_2").stop().fadeIn(500);
        playBGMusic(window.emergencia);
        playTexto(window.txti1);
    }, 4000);
    $('#i3btn_1').addClass('slider_scale');
    $('#i3btn_2').addClass('disable');
    $('#i3btn_3').addClass('disable');
    $('#i3btn_4').addClass('disable'); 
}
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
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#instruccion_3').stop().fadeIn(500);
        
    });
    $('.i3btn').click(function () {
        $('.btnVolver').removeClass('disable');
        $('.owl-carousel').trigger('to.owl.carousel', 0)
        playSound(window.playBTN);
        sID = parseInt($(this).attr('id').split('_')[1], 10);
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#sliderPage_' + sID).stop().fadeIn(500);
        switch(sID) {
        case 1:
            sli_1 = true;
            sli_2 = false;
            sli_3 = false;
            playTexto(window.window['s' + grup + sID + 'i' + 1]);
            break;
        case 2:
            sli_1 = false;
            sli_2 = true;
            sli_3 = false;
            playTexto(window.window['s' + grup + sID + 'i' + 1]);
            break;
        case 3:
            sli_1 = false;
            sli_2 = false;
            sli_3 = true;
            playTexto(window.window['s' + grup + sID + 'i' + 1]);
            break;
        }
                 
        $('.s3btn').removeClass('checked');     
        $('#s2i1_2_1').click(function () {
            $('#s2i1_2_1').addClass('img_disabled');
            }); 
        $('#s2i4_1_2').click(function () {
            $('#s2i4_1_2').addClass('img_disabled');
            $('#s2i4_1_1').addClass('img_disabled');
            });   
    });
    
    $('.btnVolver').click(function () {
        $count_btn = 0;
        // $('.owl-stage-outer').css("overflow","visible");
        $('.btnVolver').addClass('disable');
        stopTexto();
        playSound(window.playBTN);
        $('.instrucciones').stop().delay(10).fadeOut(500);
        if (completo && win < 2) {
            stopBGMusic();
            //$('#instruccion_4').stop().fadeIn(10);
        } else {
            $('#instruccion_3').stop().fadeIn(10);
        }
        sID +=1;
        if(sID==4){
            $('#btnJugar').css("display","block");
            $('#btnJugar').addClass('slider_scale');
            // $('#i3btn_'+sID).removeClass('disable');
        }else{
            $('#i3btn_'+sID).removeClass('disable');
            $('#i3btn_'+sID).addClass('slider_scale');
            $('#btnJugar').css("display","none");
        }
        var sIDn = sID-1
        $('#i3btn_'+sIDn).removeClass('slider_scale');
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
        id_sl = e.item.index + 1;             
        lAudio[sID] = 's' + grup + sID + 'i' + id_sl;
        
        playTexto(window.window['s' + grup + sID + 'i' + id_sl]);
        console.log(lAudio[sID]);
        if (!completo && id_sl === e.item.count) {
            $('#sliderPage_' + sID + ' .btnVolver').show();
            sClick[sID] = true;
            var comp = sClick.every(function (itm) {
                return itm === true;
            });
        }
    });



    $('.s3btn').click(function () {
        playSound(window.playBTN);  
        $sIDL = parseInt($(this).attr('id').split('_')[1], 10);
        $('#s3Hoja').removeClass();
        $('.s3det').stop().fadeOut(500);
        stopTexto();
        if(act_desc == false){
            act_desc = true;
            console.log("s2i"+$sIDL);
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

            if (fullS3) {//aqui va lo mismo que en el carrusel
                $('#popup_1').stop().fadeIn(1000);
                //playTexto(window.sP2ipop);
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
            // checkS3[id] = true;
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