/*******************************************************************************/
var avatarXHR = false;
/*******************************************************************************/
function showInicio() {
    redimensionarJuego();
    var fw = parseInt($('body').data('firstwindow'), 10);
    $('.instrucciones').stop().hide();
    $('#instruccion_' + fw).fadeIn(1000);
    if (fw >= 3) {
        playBGMusic(window.menuBG);
    }
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
//console.log(entraarecla);
    //instruccion 1: cambio de password
    $('#i1submit').click(function (e) {
        playSound(window.playBTN);
        e.preventDefault();
        var data = new Object();
        var formSend = false;
        if ($('#newPassword').val() && $('#newPassword').val().trim().length > 0) {
            data.np_new = $('#newPassword').val().trim();
            formSend = true;
        }
        if ($('#reNewPassword').val() && $('#reNewPassword').val().trim().length > 0) {
            data.np_confirm = $('#reNewPassword').val().trim();
            formSend = true;
        }
        if (formSend) {
            $('#newPassword').addClass('disable');
            $('#reNewPassword').addClass('disable');
            $('#i1submit').addClass('disable');
            $.ajax({
                data: data,
                type: 'POST',
                dataType: 'json',
                url: bdir + 'ajax/change_password'
            }).done(function (data, textStatus, jqXHR) {
                $('#i1txt1').show().html(data);
                console.log(data);
                if (data) {
                    console.log('OK (con errores)');
                } else {
                    console.log('OK:');
                    $('.instrucciones').stop().delay(1300).fadeOut(100);
                    $('#instruccion_2').stop().delay(1000).fadeIn(500);
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log('Fail:');
                console.log(jqXHR);
            }).always(function () {
                $('#newPassword').removeClass('disable');
                $('#reNewPassword').removeClass('disable');
                $('#i1submit').removeClass('disable');
            });
        } else {
            $('#i1txt1').html('Complete ambos campos');
        }
    });
    //instruccion 2: video
    $('#i2_btn').click(function () {
        playBGMusic(window.menuBG);
        playSound(window.playBTN);
        $('video').each(function () {
            $(this)[0].pause();
            $(this)[0].currentTime = 0;
        });
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#instruccion_3').stop().fadeIn(500);
        playTexto(window.txti1);
    });

    //instruccion 3: bienvenidos
    $('#i3btn_1').click(function () {
        playSound(window.playBTN);
        stopTexto();
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#instruccion_4').stop().fadeIn(500);
    });

    //instruccion 4: seleccion de avatar
    $('.i4avatar').click(function () {
        playSound(window.playBTN);
        var t = $(this).attr('id').split('_')[1];
        if ($('body').hasClass('av-oficina')) {
            $('body').removeClass().addClass('av-oficina avO' + t);
        } else if ($('body').hasClass('av-planta')) {
            $('body').removeClass().addClass('av-planta avP' + t);
        } else if ($('body').hasClass('av-restaurante')) {
            $('body').removeClass().addClass('av-restautante avR' + t);
        }
        if (avatarXHR) {
            avatarXHR.abort();
        }
        var data = new Object();
        if (t === 'M') {
            data.avatar = 1;
        } else {
            data.avatar = 2;
        }
        avatarXHR = $.ajax({
            data: data,
            type: 'POST',
            dataType: 'json',
            url: bdir + 'ajax/set_avatar'
        }).done(function (data, textStatus, jqXHR) {
            console.log('OK:');
            console.log(data);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log('Fail:');
            console.log(jqXHR);
        }).always(function () {});
        $('.instrucciones').stop().delay(300).fadeOut(500);
        $('#instruccion_5').stop().fadeIn(1000);
    });

    //instruccion 5: autorizacion de datos
    $('#i5btn').click(function () {
        playSound(window.playBTN);
        console.log('grupo: ' + grup);
        if (entraarecla) {
            $('.instrucciones').stop().delay(300).fadeOut(100);
            $('#instruccion_6').stop().fadeIn(500);
        } else {
            setTimeout(function () {
                window.location = bdir + 'mapa';
            }, 500);
        }
    });
});
/*******************************************************************************/