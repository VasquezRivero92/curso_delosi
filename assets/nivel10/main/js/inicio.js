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
    //playTexto(window.txti1);
    setTimeout(function () {
        $(".instrucciones").stop().delay(300).fadeOut(100);
        $("#instruccion_2").stop().fadeIn(500);
        playBGMusic(window.fndPausas);
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
    $('#i2btn_1_1').click(function () {
        stopTexto();
        playSound(window.playBTN);
        $('#sliderPage_4_1').stop().delay(300).fadeOut(100);
        $('#sliderPage_1').stop().fadeIn(500);
        $('#s1txt_1').html('Antes de realizar la Pausas Activas, revisemos<br>algunos consejos para tener una buena postura:');
        playTexto(window.window['s' + grup + sID + 'i' + 1]);
    });
    $('#i2btn_1').click(function () {
        stopTexto();
        playSound(window.playBTN);
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#instruccion_3').stop().fadeIn(500);
        
    });
    $('#i2btn_2').click(function () {
        stopTexto();
        playSound(window.playBTN);
        $('#sliderPage_2_1').stop().fadeOut(100);
        $('#sliderPage_' + sID).stop().fadeIn(500);
        $('#s2txt_1').html('CABEZA Y CUELLO');
        playTexto(window.window['s' + grup + sID + 'i' + 1]);
    });
    $('#i2btn_3').click(function () {
        stopTexto();
        playSound(window.playBTN);
        $('#sliderPage_3_1').stop().fadeOut(100);
        $('#sliderPage_' + sID).stop().fadeIn(500);
        playTexto(window.window['s' + grup + sID + 'i' + 1]);
    });
    $('.i3btn').click(function () {
        id_sl = 0;
        $('.btnVolver').removeClass('disable');
        $('.owl-carousel').trigger('to.owl.carousel', 0)
        playSound(window.playBTN);
        sID = parseInt($(this).attr('id').split('_')[1], 10);
        $('.instrucciones').stop().delay(300).fadeOut(100);
        console.log(sID);
        if(sID == 2){
            $('#sliderPage_2_1').stop().fadeIn(500);
        }else if(sID == 3){
            $('#sliderPage_3_1').stop().fadeIn(500);
        }else{
            $('#sliderPage_4_1').stop().fadeIn(500);
        }
        switch(sID) {
        case 1:
            sli_1 = true;
            sli_2 = false;
            sli_3 = false;
            playTexto(window.txti2);
            break;
        case 2:
            sli_1 = false;
            sli_2 = true;
            sli_3 = false;
            playTexto(window.txti3);
            break;
        case 3:
            sli_1 = false;
            sli_2 = false;
            sli_3 = true;
            playTexto(window.txti4);
            break;
        }
        if (lAudio[sID]) {
         //playTexto(window[lAudio[sID]]);
         } else {   
            if(sID == 3){
              //playTexto(window.txti2); 
            }else { 
                //playTexto(window['s' + sID + 'i1']);
            };        
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
    $('.btnVolver2').click(function () {

        $('#sliderPage_' + sID).stop().fadeIn(500);  

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
        } else {
            $('#instruccion_3').stop().fadeIn(10);
        }
        sID +=1;
        if(sID==4){
            $('#btnJugar, #btnJugar2').css("display","block");
            $('#btnJugar, #btnJugar2').addClass('slider_scale');
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
        console.log(id_sl);
         if(id_sl == 3 || id_sl == 4){
            $('#s1txt_1').html('Mantener  posiciones neutrales en:');
            $('#s2txt_1').html('BRAZOS Y TRONCO');
         }else if(id_sl == 5 || id_sl == 6){
            $('#s2txt_1').html('PIERNAS');
         }else{
            $('#s1txt_1').html('Antes de realizar la Pausas Activas, revisemos algunos consejos para tener una buena postura:');
            $('#s2txt_1').html('CABEZA Y CUELLO');
        }
        if(sli_1 == true){
            sl_1();
        }else if(sli_2 == true){
            sl_2();
        }

        playTexto(window.window['s' + grup + sID + 'i' + id_sl]);
        console.log(grup, sID);
        //$('#sliderPage_1').addClass('cvhangeimg');
        if (!completo && id_sl === e.item.count) {
            
            //$('#i3btn_' + sID).addClass('disable');
            // if(sID == 3){
            //     $('#sliderPage_' + sID + ' .btnVolver').show();
            // }else if(sID == 4){
            //     $('#sliderPage_' + sID + ' .btnVolver').show();
            // }
            $('#sliderPage_' + sID + ' .btnVolver').show();
            sClick[sID] = true;
            var comp = sClick.every(function (itm) {
                return itm === true;
            });
            // if (comp) {
                
            //     completo = true;
            //     $('.i3btn').removeClass('disable');
            //     $('#i3txt_2,#btnJugar,#btnJugar2').show();
            // }
        }
    });

// $('.punt_anim').click(function () {
//     $count_btn++;
//     $('#ayuda_'+sID).addClass('img_disabled');
//     if (sID == 1) {
//         if($count_btn == 4){
//         $('#sliderPage_' + sID + ' .btnVolver').show();
//         $count_btn = 0;
//         }
//     }else if (sID == 2) {        
//         if($count_btn == 4){        
//         $('.owl-next').removeClass('disabled');
//         console.log("holiii");
//         $count_btn = 4;
//         }else if($count_btn == 5){
//             $('#ayuda_3').addClass('img_disabled');
//         }else if($count_btn == 9){        
//         $('#sliderPage_' + sID + ' .btnVolver').show();
//         $count_btn = 0;
//         }
//     }

//     $id = parseInt($(this).attr('id').split('_')[2]);

//     if(sli_1 == true){
//             if($id==1){
//                 $('#s1i3_0_1').addClass('inn_pop1').show();
//             }else if($id==2){
//                 $('#s1i3_0_2').addClass('inn_pop3').show();
//             }else if($id==3){
//                 $('#s1i3_0_3').addClass('inn_pop4').show();
//             }else if($id==4){
//                 $('#s1i3_0_4').addClass('inn_pop4').show();
//             }    
//             $('#s1i3_1_1').addClass('img_disabled');
//             $('#s1i3_1_2').addClass('img_disabled');
//         }else if(sli_2 == true){
//             if($id==1){
//                 $('#s2i1_0_2').addClass('inn_pop2').show();
//             }else if($id==2){
//                 $('#s2i1_0_4').addClass('inn_pop3').show();
//             }else if($id==3){
//                 $('#s2i1_0_1').addClass('inn_pop2').show();
//             }else if($id==4){
//                 $('#s2i1_0_3').addClass('inn_pop3').show();
//             }else if($id==5){
//                 $('#s2i4_0_4').addClass('inn_pop1').show();
//             }else if($id==6){
//                 $('#s2i4_0_1').addClass('inn_pop4').show();
//             }else if($id==7){
//                 $('#s2i4_0_2').addClass('inn_pop2').show();
//             }else if($id==8){
//                 $('#s2i4_0_5').addClass('inn_pop1').show();
//             }else if($id==9){
//                 $('#s2i4_0_3').addClass('inn_pop3').show();
//             }
//                 $('#s2i1_2_1').addClass('img_disabled');  
//                 $('#s2i4_1_1').addClass('img_disabled');
//                 $('#s2i4_1_2').addClass('img_disabled');

//         }            
    
// });


// $('#i3btn_4').click(function() {
//     $('.s4_1').css("display","block");
//     $('.s4_1').removeClass('img_disabled');
//     $('.s4_2').addClass('img_disabled');
//     $('.s4_3').addClass('img_disabled');  
//     $('.s4_4').addClass('img_disabled');
//     $('.s4_5').addClass('img_disabled');
//     $('.owl-stage-outer').css("overflow","visible");
//     $('.s4s1').removeClass('op');
//     $('.s4s2').addClass('op');
//     $('.s4s3').addClass('op');
//     $('.s4s4').addClass('op');
//     $('.s4s5').addClass('op');
// });


// $('#s4t1').click(function(){
//     id = parseInt($(this).attr('id').split('_')[2]);

// });

// $('#i3btn_2').click(function() {
//     $('#sliderPage_2').removeClass('cvhangeimg2');  
//     $('.owl-stage-outer').css("overflow","visible");  
//     setTimeout(function () {
//     $('#sliderPage_2 .cont-carousel .owl-nav .owl-next').addClass('disabled');
                
//             }, 270);
//     console.log("btn2");
// });


function sl_1(){
    // if(id_sl==3){ 
    //         //$('#s1t3').removeClass('img_disabled');
    //         $('#sliderPage_1').addClass('cvhangeimg');
    //         //$('#s1tit_1').hide();
    //         $('.owl-stage-outer').css("overflow","visible");
    //         $('#s1i3_1_1').click(function () {
    //         $('#s1i3_1_1').addClass('img_disabled');
    //         $('#s1i3_1_2').addClass('img_disabled');
    //         });
    //         $('#s1i3_1_2').click(function () {
    //         $('#s1i3_1_2').addClass('img_disabled');
    //         $('#s1i3_1_1').addClass('img_disabled');
    //         });
    //     }else{ 
    //         $('#sliderPage_1').removeClass('cvhangeimg'); 
    //         //$('#s1tit_1').show(); 
    //         //$('#s1t3').addClass('img_disabled');
    //         $('.owl-stage-outer').css("overflow","hidden"); 
    //         $('#s1i3_0_1').hide();
    //         $('#s1i3_0_2').hide();
    //         $('#s1i3_0_3').hide();
    //         $('#s1i3_0_4').hide(); 
                       
    //     }
}
function sl_2(){

    // if(id_sl==1){ 
    //         //$('#s1t3').removeClass('img_disabled');
    //         $('#sliderPage_2').removeClass('cvhangeimg2');
    //         //$('#s1tit_1').hide();
    //         $('.owl-stage-outer').css("overflow","visible");
    //         $('#s2i1_2_1').click(function () {
    //         $('#s2i1_2_1').addClass('img_disabled');
    //         });            
    //     }else if(id_sl==4){ 
    //         //$('#s1t3').removeClass('img_disabled');
    //         $('#sliderPage_2').addClass('cvhangeimg2'); 
    //         $('#sliderPage_2').addClass('cvhangeimg3');
    //         //$('#s1tit_1').hide();
    //         $('.owl-stage-outer').css("overflow","visible");
    //         $('#s2i4_1_1').click(function () {
    //         $('#s2i4_1_1').addClass('img_disabled');
    //         $('#s2i4_1_2').addClass('img_disabled');
    //         });
    //         $('#s2i4_1_2').click(function () {
    //         $('#s2i4_1_2').addClass('img_disabled');
    //         $('#s2i4_1_1').addClass('img_disabled');
    //         });
    //     }else{ 
    //         $('#sliderPage_2').addClass('cvhangeimg2');
    //         $('#sliderPage_2').removeClass('cvhangeimg3');
    //         //$('#s1tit_1').show(); 
    //         //$('#s1t3').addClass('img_disabled');
    //         $('.owl-stage-outer').css("overflow","hidden"); 
    //         $('#s2i1_0_1').hide();
    //         $('#s2i1_0_2').hide();
    //         $('#s2i1_0_3').hide();
    //         $('#s2i1_0_4').hide();
    //         $('#s2i4_0_1').hide();
    //         $('#s2i4_0_2').hide();
    //         $('#s2i4_0_3').hide();
    //         $('#s2i4_0_4').hide();
    //         $('#s2i4_0_5').hide();                       
    //     }
}

    $('.s3btn').click(function () {
        playSound(window.playBTN);  
        $sIDL = parseInt($(this).attr('id').split('_')[1], 10);
        $('#s3Hoja').removeClass();
        $('.s3det').stop().fadeOut(500);
        stopTexto();
        if(act_desc == false){
              act_desc = true;
              //playTexto(window.txti2);
               playTexto(window['s2i'+$sIDL]);
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
            
            // 

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