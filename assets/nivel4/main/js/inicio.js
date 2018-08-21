/*******************************************************************************/
var sClick = [null, [false, 0, 0, 0, 0, 0, 0, 0, 0]];
var sID = 0;
var completo = false;
/*******************************************************************************/
function showInicio() {
    redimensionarJuego();
    $('.instrucciones').stop().hide();
    $('#instruccion_1').fadeIn(1000);
    playSound(window.nivelBG);
    setTimeout(function () {
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#instruccion_2').stop().fadeIn(500);
        playBGMusic(window.menuBG);
        playTexto(window.txti2);
    }, 4000);
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
    $('body, html').css('height', window.innerHeight);
}
function initSonidos() {
    audios.forEach(function (itm, i) {
        loadSound(itm[0], itm[1]);
    });
}
/*******************************************************************************/
$(document).ready(function (e) {
    if (grup === 'O') {// Si el grupo es 'Oficina' se eliminan los items que no se necesitan
        $('#s1i6').parent().remove();
        sClick[1] = [false, 0, 0, 0, 0, 0, 1, 0, 0];
    } else if (grup === 'P') {// Si el grupo es 'Planta' se eliminan los items que no se necesitan
        $('#s1i7, #s1i8').parent().remove();
        sClick[1] = [false, 0, 0, 0, 0, 0, 0, 1, 1];
    }
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
        $.post(bdir + 'ajax/init_curso').done(function (data) {
            console.log('Init nivel: ' + data);
        });
    });
    $('.i3btn').click(function () {
        playSound(window.playBTN);
        sID = parseInt($(this).attr('id').split('_')[1], 10);
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#sliderPage_' + sID).stop().fadeIn(500);
    });
    $('#i4btn_1').click(function () {
        playSound(window.playBTN);
        $('video').each(function () {
            $(this)[0].pause();
            $(this)[0].currentTime = 0;
        });
        $('.instrucciones').stop().delay(10).fadeOut(500);
        $('#instruccion_3').stop().fadeIn(10);
        playBGMusic(window.menuBG);
    });

    var $this;
    $('.item').on({'touchstart mousedown': function (e) {
            $(this).addClass('itemLoading');
            $this = this;
            clearTimeout(this.downTimer);
            this.downTimer = setTimeout(function () {
                var id = parseInt($($this).data('id'), 10);
                $($this).removeClass('itemLoading');
                if ($($this).hasClass('wPlay')) {
                    if ($($this).hasClass('selected')) {
                        playTexto(window['s' + grup + sID + 'i' + id]);
                        //console.log('s' + grup + sID + 'i' + id);
                        $($this).removeClass('selected');
                    } else {
                        playTexto(window['s' + grup + sID + 'i' + id + 'h']);
                        //console.log('s' + grup + sID + 'i' + id + 'h');
                        $($this).addClass('selected');
                    }
                    if (!completo) {
                        sClick[sID][id] = 1;
                        //console.log(sClick[sID]);
                        var check = true;
                        var n = 0;
                        sClick[sID].forEach(function (itm, i) {
                            if (itm === 0) {
                                check = false;
                            } else if (itm) {
                                n++;
                            }
                        });
                        if (n >= 2) {
                            $('#sliderPage_' + sID + ' .owl-nav').show();
                        }
                        if (check) {
                            $('#sliderPage_' + sID + ' .btnVolver').show();
                            $('#i3btn_' + sID).addClass('disable');
                            sClick[sID][0] = true;
                            var comp = true;
                            sClick.forEach(function (itm, i) {
                                if (itm && itm[0] === false) {
                                    comp = false;
                                }
                            });
                            if (comp) {
                                completo = true;
                                $('.i3btn').removeClass('disable');
                                $('#i3txt_2,#btnJugar').show();
                            }
                        }
                    }
                } else {
                    playTexto(window['s' + grup + sID + 'i' + id]);
                    //console.log('s' + grup + sID + 'i' + id);
                    $($this).addClass('wPlay');
                }
            }, 1000);
        }, 'touchend mouseup': function (e) {
            clearTimeout(this.downTimer);
            $(this).removeClass('itemLoading');
        }});
    $('.btnVolver').click(function () {
        stopTexto();
        playSound(window.playBTN);
        $('.instrucciones').stop().delay(10).fadeOut(500);
        if (completo && win < 2) {
            stopBGMusic();
            $('#instruccion_4').stop().fadeIn(10);
        } else {
            $('#instruccion_3').stop().fadeIn(10);
        }
    });
    $('.owl-carousel').owlCarousel({
        dots: false,
        items: 2,
        loop: false,
        margin: 20,
        nav: true,
        mouseDrag: false,
        touchDrag: false
    });

    $('#btnciudad').click(function (e) {
        playSound(window.playBTN);
        window.location.href = bdir + 'mapa';
    });
});
/*******************************************************************************/