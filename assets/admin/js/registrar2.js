/*******************************************************************************/
/*******************************************************************************/
$(document).ready(function () {
    $('#regempuser').click(function () {
        var data = new Object();
        data.id_user = userID;
        data.id_empresa = $('#empresa option:selected').first().attr("value");
        data.id_area = $('#area option:selected').first().attr("value");
        data.id_departamento = $('#departamento option:selected').first().attr("value");
        data.id_cargo = $('#cargo option:selected').first().attr("value");
        data.id_planilla = $('#planilla option:selected').first().attr("value");
        var formSend = true;
        if ($("#sede").val() && $("#sede").val().trim().length > 0) {
            data.sede = $("#sede").val().trim();
        } else {
            formSend = false;
        }
        if ($("#seccion").val() && $("#seccion").val().trim().length > 0) {
            data.seccion = $("#seccion").val().trim();
        } else {
            formSend = false;
        }
        if (formSend) {
            var pfip = $('#fingpla').val().split('/');
            data.fingpla = pfip[1] + '/' + pfip[0] + '/' + pfip[2];
            $.ajax({
                data: data,
                type: "POST",
                dataType: 'json',
                url: bdir + 'ajaxadm/reg_emp_user'
            }).done(function (data, textStatus, jqXHR) {
                if (data == 1) {
                    $('#interline').before('<tr><td>Registro en empresa</td><td>' + $('#empresa option:selected').first().text() + '</td></tr>');
                    $('#resetempuser').click();
                    $('#infoMessage').html('Datos registrados');
                } else {
                    $('#infoMessage').html(data);
                }
                console.log("OK");
                console.log(data);
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log("Fail:");
                console.log(jqXHR);
            });
        } else {
            $('#infoMessage').html('Debe completar los campos');
        }
    });
    $('#backempuser').click(function () {
        window.location = window.location.href;
    });
});
/*******************************************************************************/