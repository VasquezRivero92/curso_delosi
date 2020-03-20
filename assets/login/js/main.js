/*******************************************************************************/
$(document).ready(function () {
    var parallaxInstance = new Parallax(ctr_parallax);
    
    $("#opti-cont").click(function (e) {
        $("#opti-cont").removeClass('show');
        $("#login-cont").show();
    });
    $('#openForgot').click(function () {
        $('#popForgot').fadeIn(500);
    });
    $('#btnClose').click(function (e) {
        $('#popForgot').fadeOut(300);
    });
    $('#f-submit').click(function () {
        var data = new Object();
        var formSend = true;
        if ($("#f-email").val() && $("#f-email").val().trim().length > 0) { data.fdni = $("#f-email").val().trim(); }
        else { formSend = false; }
        if (formSend) {
            $("#f-email").addClass('disable');
            $("#f-submit").addClass('disable');
            $("#f-code").addClass('disable');
            $("#new_password").addClass('disable');
            $("#new_confirm").addClass('disable');
            $("#f-change").addClass('disable');
            $('#f-msg').hide().html('');
            $.ajax({
                data: data,
                type: "POST",
                dataType: 'json',
                url: bdir + 'ajax/forgot_password'
            }).done(function (data, textStatus, jqXHR) {
                $('#f-msg').show().html(data);
                if (data == 'El código de verificación fue enviado a su correo') {
                    $('#formReset').fadeIn(500);
                }
                console.log("OK:");
                console.log(data);
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log("Fail:");
                console.log(jqXHR);
            }).always(function () {
                $("#f-email").removeClass('disable');
                $("#f-submit").removeClass('disable');
                $("#f-code").removeClass('disable');
                $("#new_password").removeClass('disable');
                $("#new_confirm").removeClass('disable');
                $("#f-change").removeClass('disable');
            });
        } else {
            $('#f-msg').show().html('Complete el campo con su email');
        }
    });
    $('#f-change').click(function () {
        var data = new Object();
        var formSend = true;
        if ($("#f-email").val() && $("#f-email").val().trim().length > 0) { data.fdni = $("#f-email").val().trim(); } 
        else { formSend = false; }
        if ($("#f-code").val() && $("#f-code").val().trim().length > 0) { data.fcode = $("#f-code").val().trim(); } 
        else { formSend = false; }
        if ($("#new_password").val() && $("#new_password").val().trim().length > 0) { data.new_password = $("#new_password").val().trim(); } 
        else { formSend = false; }
        if ($("#new_confirm").val() && $("#new_confirm").val().trim().length > 0) { data.new_confirm = $("#new_confirm").val().trim(); } 
        else { formSend = false; }
        if (formSend) {
            $("#f-email").addClass('disable');
            $("#f-submit").addClass('disable');
            $("#f-code").addClass('disable');
            $("#new_password").addClass('disable');
            $('#new_confirm').addClass('disable');
            $("#f-change").addClass('disable');
            $('#f-msg').hide().html('');
            $.ajax({
                data: data,
                type: "POST",
                dataType: 'json',
                url: bdir + 'ajax/change_forgot_password'
            }).done(function (data, textStatus, jqXHR) {
                $('#f-msg').show().html(data);
                console.log("OK:");
                console.log(data);
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log("Fail:");
                console.log(jqXHR);
            }).always(function () {
                $("#f-email").removeClass('disable');
                $("#f-submit").removeClass('disable');
                $("#f-code").removeClass('disable');
                $("#new_password").removeClass('disable');
                $("#new_confirm").removeClass('disable');
                $("#f-change").removeClass('disable');
            });
        } else {
            $('#f-msg').show().html('Completar todos los campos');
        }
    });
});
/*******************************************************************************/