/*******************************************************************************/
var avatarXHR = false;
var pop2txt1;
/*******************************************************************************/
function showInicio() {
    redimensionarJuego();
    //para que no se muestren las instrucciones, lo bloqueamos en la ventana 4
    var fw = 4;//parseInt($('body').data('firstwindow'), 10);
    $('.instrucciones').stop().hide();
    playBGMusic(window.menuBG);
    $('#instruccion_' + fw).fadeIn(1000);
    if (fw == 3) {
        setTimeout(function () {
            $('#i3bg,#i3pop_1').fadeIn(1000);
        }, 1000);
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
    $('#i3btn_1').click(function () {
        playSound(window.playBTN);
        $("#i3bg,#i3pop_1").fadeOut(1000);
        setTimeout(function () {
            $("#instruccion_3").addClass('i3pop2');
            $("#i3bg,#i3pop_2").fadeIn(1000);
        }, 1500);
    });
    $('#i3btn_2').click(function () {
        playSound(window.playBTN);
        $('.instrucciones').stop().delay(300).fadeOut(100);
        $('#instruccion_4').fadeIn(1000);
    });
    $('#i4Buzon').click(function () {
        playSound(window.playBTN);
        $('#pop2txt1').show().html(pop2txt1);
        $('#pop2ta').val('');
        $('#popup2').fadeIn(1000);
    });
    //Envío de buzón
    pop2txt1 = $('#pop2txt1').html();
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
                url: bdir + 'ajax/send_buzon_reclamaciones'
            }).done(function (data, textStatus, jqXHR) {
                $('#pop2txt1').show().html(data);
                console.log("OK:");
                console.log(data);
                setTimeout(function () {
                    $('#popup2').fadeOut(1000);
                }, 1000);
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log("Fail:");
                console.log(jqXHR);
            }).always(function () {
                $('#pop2ta').removeClass('disable');
                $('#pop2sub').removeClass('disable');
            });
        } else {
            $('#pop2txt1').html('Complete el campo');
        }
    });
    $('#pop2close').click(function () {
        playSound(window.playBTN);
        $('#popup2').fadeOut(1000);
    });
});
/*******************************************************************************/