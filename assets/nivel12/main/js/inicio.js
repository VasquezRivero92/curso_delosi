/*******************************************************************************/
var sClick = [true, false, true, false, false];
var lAudio = [null, '', '', '', ''];
var sID = 0;
var completo = false;
var act_desc = new Boolean(false);
var sli_1,sli_2,sli_3 = new Boolean(false);
var id_sl = 0;
var $count_btn = false;
// var $intentos_juego = 0;
var text_ok=[   null,
                'LO QUE DEBES HACER<br><br>Lavarse las manos (agua y jabón) para evitar contaminar la herida.',
                'LO QUE DEBES HACER<br><br>Dejarla drenar un poco. ',
                'LO QUE DEBES HACER<br><br>Limpiar la herida con agua y jabón y siempre desde adentro hacia afuera de la herida.',
                'LO QUE DEBES HACER<br><br>Usar guantes estériles. ',
                'LO QUE DEBES HACER<br><br>Limpiar la herida con agua y jabón y siempre desde adentro hacia afuera de la herida. ',
                'LO QUE DEBES HACER<br><br>Se pueden utilizar antisépticos no colorantes:  agua oxigenada.',
                //sec2
                'LO QUE DEBES HACER<br><br>Como norma general, aplicación de frío (compresas, hielo envuelto en un trapo) y reposo de la zona afectada..',
                'LO QUE DEBES HACER<br><br>Ante una contusión grave es importante no vaciar los hematomas, hay que inmovilizar la zona y evacuar al herido a un centro hospitalario.',
                //sec3
                'LO QUE DEBES HACER<br><br>Inmovilización de la zona afectada',
                'LO QUE DEBES HACER<br><br>En caso de luxación, NUNCA intentar colocar los huesos en su posición normal.',
                'LO QUE DEBES HACER<br><br>Evacuación.',
                //sec4
                'LO QUE DEBES HACER<br><br>Evitar movilizaciones.',
                'LO QUE DEBES HACER<br><br>En fractura abierta, aplicar sobre la herida apósitos estériles. ',
                'LO QUE DEBES HACER<br><br>Presión directa: colocar apósitos estériles sobre la herida.',
                'LO QUE DEBES HACER<br><br>Evaluación primaria: signos vitales: pulso, respiración, temperatura.',
                'LO QUE DEBES HACER<br><br>Tapar al paciente (Protección térmica)',
                'LO QUE DEBES HACER<br><br>Elevación del miembro donde se encuentra la herida sangrante.',
                'LO QUE DEBES HACER<br><br>Evaluación secundaria: dolor, movimiento, comparar las extremidades, acortamiento de las mismas, deformidades.',
                'LO QUE DEBES HACER<br><br>Evacuar, manteniendo el control de las constantes vitales y vigilando el acondicionamiento  de la fractura.',
                'LO QUE DEBES HACER<br><br>Presión indirecta: cuando el sangrado no se detiene a pesar de la presión directa sobre la herida, haga compresiones en grandes arterias: carótida (cuello), subclavia (encima de las clavículas), humeral (brazo), femoral (muslos)',
                //quemaduras
                'LO QUE DEBES HACER<br><br>En la medida de lo posible, tratar de eliminar la causa: cortar la corriente eléctrica, alejar del fuego.',
                'LO QUE DEBES HACER<br><br>Aplicar agua fría en abundancia sobre la superficie quemada, abrir el grifo del agua a baja o mediana presión, quitar todo aquello que mantenga el calor.',
                'LO QUE DEBES HACER<br><br>Solo si la quemadura es de II° y/o III° (extensas y profundas) proceda a envolver las lesiones con gasas estériles humedecidas en agua fría, el vendaje ha de ser flojo .',
                'LO QUE DEBES HACER<br><br>Vigilar constantemente los signos vitales: pulso, temperatura, frecuencia respiratoria.',
                'LO QUE DEBES HACER<br><br>Evacuar a un centro de salud lo más pronto posible.',
                //convulciones
                'LO QUE DEBES HACER<br><br>Despeje el área en la que se encuentra la persona que está convulsionando, es decir, retirar muebles y objetos cercanos que puedan causarle daño.',
                'LO QUE DEBES HACER<br><br>Afloje la ropa para que pueda respirar .',
                'LO QUE DEBES HACER<br><br>Una vez que haya pasado la convulsión se debe colocar a la persona de costado, poniendo la cabeza sobre una almohada o sobre la pierna de uno.',
                'LO QUE DEBES HACER<br><br>Si no respira se debe aplicar RCP básico mientras llegue la ayuda especializada.',
                'LO QUE DEBES HACER<br><br>Cuando pase la crisis convulsiva explicarle que es lo que sucedió.',
                //desmayos 
                'LO QUE DEBES HACER<br><br>Eleve las piernas de la persona desmayada, esto mejorará el retorno sanguíneo hacia el corazón.',
                'LO QUE DEBES HACER<br><br>Controle signos vitales: pulso y frecuencia respiratoria.',
                'LO QUE DEBES HACER<br><br>Mantenga caliente a la persona que se desmayó, tápelo con chompas y/o casacas.',
            ];

var text_no=[   null,
                'LO QUE NO DEBES HACER<br><br>Utilizar polvos, cremas, pomadas, etc.',
                'LO QUE NO DEBES HACER<br><br>Utilizar algodón.',
                'LO QUE NO DEBES HACER<br><br>Aplicar alcohol directamente a la herida. ',
                'LO QUE NO DEBES HACER<br><br>Manipular la herida y quitar cuerpos extraños enclavados.',
                //heridas arriba
                //quemaduras 
                'LO QUE NO DEBES HACER<br>Aplicar cremas, pomadas, gasa parafinada estéril (JELONET), recuerden, solo se debe de brindar los primeros auxilios, el uso de lo arriba mencionado puede exponer al accidentado a posibles infecciones de la herida y/o retardar la atención en el centro de salud ya que tendrán que retirarlas para poder hacer las curaciones respectivas.',
                'LO QUE NO DEBES HACER<br><br>Enfriar demasiado al accidentado, solo las partes quemadas.',
                'LO QUE NO DEBES HACER<br><br>Dar analgésicos por vía oral .',
                'LO QUE NO DEBES HACER<br><br>Romper las ampollas .',
                'LO QUE NO DEBES HACER<br><br>Despegar la ropa o cualquier otro elemento que esté pegado a la piel.',
                'LO QUE NO DEBES HACER<br><br>Dejar solo a la víctima .',            
                //convulciones
                'LO QUE NO DEBES HACER<br><br>NUNCA trate de detener la crisis convulsiva ',
                'LO QUE NO DEBES HACER<br><br>No abrace o sujete a la persona que está convulsionando, puede causarle algún tipo de fractura.',
                'LO QUE NO DEBES HACER<br><br>No llame a la persona por su nombre, no lo va a oír, recuerde que está desconectada  del exterior.',
                'LO QUE NO DEBES HACER<br><br>No darle nada de beber y/o comer.',
                'LO QUE NO DEBES HACER<br><br>No colocarle nada dentro de la boca, si se lo traga puede causarle muerte por asfixia.',
            ];

$.fn.extend({
    animateCss: function(animationName, callback) {
      var animationEnd = (function(el) {
        var animations = {animation: 'animationend', OAnimation: 'oAnimationEnd', MozAnimation: 'mozAnimationEnd', WebkitAnimation: 'webkitAnimationEnd',};
        for (var t in animations) {
          if (el.style[t] !== undefined) {return animations[t];}
        }
      })(document.createElement('div'));
      this.addClass('anima ' + animationName).one(animationEnd, function() {
        $(this).removeClass('anima ' + animationName);
        if (typeof callback === 'function') callback();
      });
      return this;
    },
  });


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

    var animacion_mc;
    $('#cur_btn').click(function () {
        $( ".cur_mc" ).removeClass('inn');
        $( ".cur_mc" ).each(function( i, el ) {            
            window.setTimeout(function(){ 
                animacion_mc = $(el).data('anim');
                $(el).animateCss(animacion_mc).addClass('inn');               
            }, 200 * i);
        });
    })

    $('.btn_prp').click(function () {
        var valuetxt = $(this).data('name');
        var valNum = $(this).data('val');
        $(this).addClass('no-after desabilit');
        $('#content').removeClass('cont_msj_ok cont_msj_bad');
        if(valuetxt === 'text_ok'){
            $('#content').html(text_ok[valNum]).addClass('cont_msj_ok');
        }else{
            $('#content').html(text_no[valNum]).addClass('cont_msj_bad');
        }
        $('#content').animateCss('zoomInDown');
        $('.btn_prp').removeClass('desabilit');
    });

    $('.i3btn').click(function () {
        $('.btnVolver').removeClass('disable');
        $('.owl-carousel').trigger('to.owl.carousel', 0)
        playSound(window.playBTN);
        sID = parseInt($(this).attr('id').split('_')[1], 10);
        //console.log(sID);
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#sliderPage_' + sID).stop().fadeIn(500);
        switch(sID) {
            case 1:
                if (!$count_btn) {
                    sli_1 = true;
                    sli_2 = false;
                    sli_3 = false;
                }
                playTexto(window.window['s' + grup + sID + 'i' + 1]);
                $('#sliderPage_' + sID + ' .btnVolver').show();
                $('#popActiv').show();
            break;
            case 2:
            if (!$count_btn) {
                sli_1 = false;
                sli_2 = true;
                sli_3 = false;
            }
                playTexto(window.window['s' + grup + sID + 'i' + 1]);
            break;
            case 3:
            if (!$count_btn) {
                sli_1 = false;
                sli_2 = false;
                sli_3 = true;
                $count_btn = true;
            }
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

    $('#popActiv').click(function () {
        $(this).hide();
        $('#s1i2_pop').fadeIn(500);
    }); 
    $('.btnCont').click(function () {
        $('#s1i2_pop').fadeOut(500);
        volverMain();
    }); 
    
    function volverMain () {   
        $('#content').removeClass('cont_msj_ok cont_msj_bad');     
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
            $('#btnJugar').css("display","block");
            $('#btnJugar').addClass('slider_scale');
            // $('#i3btn_'+sID).removeClass('disable');
        }else{
            $('#i3btn_'+sID).removeClass('disable');
            $('#i3btn_'+sID).addClass('slider_scale');
            $('#btnJugar').css("display","none");
        }
        if($count_btn){
            $('#btnJugar').css("display","block");
            $('#btnJugar').addClass('slider_scale');
            $('.i3btn').removeClass('slider_scale');
        }
        var sIDn = sID-1
        $('#i3btn_'+sIDn).removeClass('slider_scale');
    }
    $('#btnJugar').click(function () {
        $count_btn = 0;
    });
    
    $('.btnVolver').click(function () {
        volverMain();
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
        $('#content').removeClass('cont_msj_ok cont_msj_bad');
        //console.log(lAudio[sID]);
        if (!completo && id_sl === e.item.count) {
            $('#sliderPage_' + sID + ' .btnVolver').show();
            //$count_btn++;
            sClick[sID] = true;
            var comp = sClick.every(function (itm) {
                return itm === true;
            });
        }
    });



    // $('.s3btn').click(function () {
    //     playSound(window.playBTN);  
    //     $sIDL = parseInt($(this).attr('id').split('_')[1], 10);
    //     $('#s3Hoja').removeClass();
    //     $('.s3det').stop().fadeOut(500);
    //     stopTexto();
    //     if(act_desc == false){
    //         act_desc = true;
    //         console.log("s2i"+$sIDL);
    //       }else{
    //         stopTexto();
    //         console.log("stop audio");
    //         act_desc = false;
    //       }  
    //     if ($(this).hasClass('detail')) {
    //         $(this).addClass('checked');
    //         $('#s3t1').stop().fadeIn(500);
    //         $('#s3t2').stop().fadeOut(500);
    //         $('#s3CHoja').removeClass('detail');
    //         $('.s3btn').stop().delay(500).fadeIn(10).removeClass('detail');
    //         //console.log(checkS3);
    //         if (fullS3) {//aqui va lo mismo que en el carrusel
    //             $('#popup_1').stop().fadeIn(1000);
    //             //playTexto(window.sP2ipop);
    //             $('#sliderPage_' + sID + ' .btnVolver').show();
    //             $('#i3btn_' + sID).addClass('disable');
    //             sClick[sID] = true;
    //             var comp = sClick.every(function (itm) {
    //                 return itm === true;
    //             });
    //             if (comp) {
    //                 completo = true;
    //                 $('.i3btn').removeClass('disable');
    //                 $('#i3txt_2,#btnJugar,#btnJugar2').show();
    //             }
    //         }
    //     } else {
    //         var id = parseInt($(this).attr('id').split('_')[1], 10);
    //         $('#s3t1').stop().fadeOut(500);
    //         $('#s3t2').stop().fadeIn(500);
    //         $('#s3CHoja').addClass('detail');
    //         $('#s3Hoja').addClass('focus' + id);
    //         $('.s3btn').stop().fadeOut(10);
    //         $(this).stop().fadeIn(10).addClass('detail');
    //         $('#s3det_' + id).stop().fadeIn(500);
    //         // checkS3[id] = true;
    //         setTimeout(function () {
    //             $('#s3det_11').data('plugin_tinyscrollbar').update();
    //             //$('#s3det_11').tinyscrollbar({trackSize: 330, thumbSize: 50});
    //         }, 200);
    //     }
    // });

    $('#pop1btn_1').click(function () {
        stopTexto();
        $('#popup_1').stop().fadeOut(1000);
    });
});
/*******************************************************************************/