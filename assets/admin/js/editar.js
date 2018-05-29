/*******************************************************************************/
function loadEmp() {
    //console.log('userID:'+userID);
    $.ajax({type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxadm/get_users_empresa',
        data: {id_user: userID}
    }).done(function (data, textStatus, jqXHR) {
        uemp = data;
        //console.log(data);
        console.log('get_ue');
        loadListUE();
        loadClick();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
}
function loadListUE() {
    $('#uplist_ue').html('');
    uemp.forEach(function (itm) {
        var empn = $('#empresa option[value="' + itm.id_empresa + '"]').first().text();
        $('#uplist_ue').append('<div data-id="' + itm.id_empresa + '">' + empn + '</div>');
    });
}
function loadClick() {
    $('#uplist_ue div').off().on('click', function () {
        ueActive = parseInt($(this).data('id'));
        var idx = uemp.findIndex(function (itm) {
            return itm.id_empresa == ueActive;
        });
        $('#empresa').val(ueActive).attr('disabled', 'disabled');
        //console.log(idx);
        $('#area').val(uemp[idx].id_area);
        $('#departamento').val(uemp[idx].id_departamento);
        $('#cargo').val(uemp[idx].id_cargo);
        $('#planilla').val(uemp[idx].id_planilla);
        $('#sede').val(uemp[idx].sede);
        $('#seccion').val(uemp[idx].seccion);
        var fingpla = new Date(uemp[idx].fingpla * 1000);
        var mp = fingpla.getMonth() + 1;
        $('#fingpla').val(fingpla.getDate() + '/' + mp + '/' + fingpla.getFullYear());
        $('.uerow').show();
    });
}
/*******************************************************************************/
var uemp = [];
var ueNew = false;
var ueActive = 0;
/*******************************************************************************/
$(document).ready(function () {
    //console.log(userID);
    $('#cleanpoints').click(function (e) {
        var r = confirm('¿Se encuentra seguro de limpiar el puntaje seleccionado?\nEsta acción no se podrá revertir.');
        var data = new Object();
        data.id_user = userID;
        data.id_curso = $('#puntaje option:selected').first().attr('value');
        if (r) {
            $.ajax({
                data: data,
                type: 'POST',
                url: bdir + 'ajaxadm/limpiar_puntos_curso'
            }).done(function (data, textStatus, jqXHR) {
                console.log('Limpiar puntos-curso OK');
                console.log(data);
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log('Fail:');
                console.log(jqXHR);
            });
        }
    });
    $('#update-sub').click(function (e) {
        var data = new Object();
        data.id = userID;
        if ($("#apat").val() && $("#apat").val().trim().length > 0) {
            data.apat = $("#apat").val().trim();
        }
        if ($("#amat").val() && $("#amat").val().trim().length > 0) {
            data.amat = $("#amat").val().trim();
        }
        if ($("#nombre").val() && $("#nombre").val().trim().length > 0) {
            data.nombre = $("#nombre").val().trim();
        }
        if ($("#dni").val() && $("#dni").val().trim().length > 0) {
            data.dni = $("#dni").val().trim();
        }
        if ($("#email").val() && $("#email").val().trim().length > 0) {
            data.email = $("#email").val().trim();
        }
        data.sexo = $('input[name=sexo]:checked').first().attr("value");
        data.grupo = $('#grupo option:selected').first().attr("value");
        data.nivel = $('#nivel option:selected').first().attr("value");
        if ($("#password").val() && $("#password").val().trim().length > 0) {
            if ($("#password").val().trim() === $("#password_confirm").val().trim()) {
                data.password = $("#password").val().trim();
                data.password_confirm = $("#password_confirm").val().trim();
            } else {
                $('#infoMessage').html('Las claves no coinciden');
                return false;
            }
        }
        data.active = $('#estado option:selected').first().attr('value');
        //console.log(data);
        $.ajax({
            data: data,
            type: "POST",
            dataType: 'json',
            url: bdir + 'ajaxadm/edit_usuario'
        }).done(function (data, textStatus, jqXHR) {
            if (data == 1) {
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
    });
    $('#newreg').click(function (e) {
        $('#formeditue')[0].reset();
        ueNew = true;
        $('.uerow').show();
        $('#empresa').removeAttr('disabled');
    });
    $('#updreg').click(function (e) {
        var data = new Object();
        var url = bdir + 'ajaxadm/edit_emp_user';
        data.id_user = userID;
        data.id_empresa = $('#empresa option:selected').first().attr("value");
        data.id_area = $('#area option:selected').first().attr("value");
        data.id_departamento = $('#departamento option:selected').first().attr("value");
        data.id_cargo = $('#cargo option:selected').first().attr("value");
        data.id_planilla = $('#planilla option:selected').first().attr("value");
        var formSend = true;
        var idDupli = 0;
        uemp.forEach(function (itm) {
            if (itm.id_empresa == data.id_empresa) {
                idDupli++;
            }
        });
        if (ueNew) {
            if (idDupli) {
                formSend = false;
                $('#infoMessage').html('El registro en esa empresa ya existe');
            } else {
                url = bdir + 'ajaxadm/reg_emp_user';
            }
        }
        if ($("#sede").val() && $("#sede").val().trim().length > 0) {
            data.sede = $("#sede").val().trim().toUpperCase();
        } else {
            formSend = false;
            $('#infoMessage').html('Complete los campos');
        }
        if ($("#seccion").val() && $("#seccion").val().trim().length > 0) {
            data.seccion = $("#seccion").val().trim().toUpperCase();
        } else {
            formSend = false;
            $('#infoMessage').html('Complete los campos');
        }
        if (formSend) {
            var pfip = $('#fingpla').val().split('/');
            data.fingpla = pfip[1] + '/' + pfip[0] + '/' + pfip[2];
            $.ajax({
                data: data,
                type: "POST",
                dataType: 'json',
                url: url
            }).done(function (data, textStatus, jqXHR) {
                if (data == 1) {
                    loadEmp();
                    $('#infoMessage').html('Datos actualizados');
                    $('#empresa').attr('disabled', 'disabled');
                    ueNew = false;
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
            //$('#infoMessage').html('Debe completar los campos');
        }
    });
    $('#delreg').click(function (e) {
        var r = confirm('¿Se encuentra seguro de que desea eliminar el registro?\nEsta acción no se podrá revertir.');
        if (r) {
            $('input, select').attr('disabled', 'disabled');
            $.ajax({
                data: {id_user: userID, id_empresa: ueActive},
                type: 'POST',
                url: bdir + 'ajaxadm/eliminar_usuario_empresa'
            }).done(function (data, textStatus, jqXHR) {
                console.log('OK');
                console.log(data);
                $('#infoMessage').html('Registro eliminado');
                var idx = uemp.findIndex(function (itm) {
                    return itm.id_empresa == ueActive;
                });
                uemp.splice(idx, 1);
                $('input, select').removeAttr('disabled');
                $('#uplist_ue').find('[data-id="' + ueActive + '"]').remove();
                $('.uerow').hide();
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log("Fail:");
                console.log(jqXHR);
            });
        }
    });
    loadEmp();
});
/*******************************************************************************/