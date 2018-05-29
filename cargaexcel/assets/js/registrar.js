/*******************************************************************************/
var paquete = [];
var regParam = [];
var tParam = [];
var regIdx = 0;
var sumaReg = 0;
var dir = [];
var ger = [];
var limit;
/*******************************************************************************/
function creaTabla() {
    console.log('Cantidad de datos: ' + paquete.length);
    var tabla = '<table id="t-excel">';
    paquete.forEach(function (itm, i) {
        if (!itm[0]) {
            console.log('Celda vacia: ' + i);
        } else {
            tabla += '<tr>';
            tabla += '<td>' + itm[0].toLowerCase() + '</td>';
            tabla += '</tr>';
        }
    });
    tabla += '</table>';
    $('#exc-tabla').show().html(tabla);
}
/*******************************************************************************/
function init_ajax() {
    $('#exc-registrar').addClass('disable');
    $('#mail-masivo').addClass('disable');
    regParam = [];
    tParam = [];
    limit = parseInt($('#cant-mails').val(), 10);
    console.log('tamaño del paquete: ' + limit);
    paquete.forEach(function (itm) {
        if (itm[0]) {
            regParam.push({email: itm[0]});
        }
    });
    regIdx = 0;
    sumaReg = 0;
    console.log('Mails sin vacios: ' + regParam.length);
    $('#load-msg').hide();
}
/*******************************************************************************/
function mail_masivo() {
    var tData = regParam.slice(regIdx * limit, (regIdx + 1) * limit);
    if (!tData.length) {
        $('#exc-registrar').removeClass('disable');
        $('#mail-masivo').removeClass('disable');
        $('#load-msg').show().html(sumaReg + ' emails enviados.');
        return;
    }
    $.post(ajax_dir + 'ajax/mail_masivo', {data: tData}).done(function (data) {
        regIdx++;
        sumaReg = sumaReg + parseInt(data, 10);
        $('#load-msg').show().html(sumaReg + ' emails enviados...');
        $('#load-msg').show().html(data);
        console.log('Mails bloque ' + regIdx + ' enviado:');
        console.log(data);
        mail_masivo();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
}
/*******************************************************************************/
$(document).ready(function () {
    $('#exc-form').submit(function () {
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: ajax_dir + 'ajax/up_reg_excel',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            contentType: false,
            processData: false
        }).done(function (data, textStatus, jqXHR) {
            paquete = data;
            creaTabla();
            $('#exc-registrar').show();
            $('#mail-masivo').show();
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log('error:');
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
        return false;
    });
    $('#mail-masivo').click(function () {
        init_ajax();
        mail_masivo();
    });
});
/*******************************************************************************/