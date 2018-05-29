/*******************************************************************************/
var xhrCC;
var area = [];
/*******************************************************************************/
function loadSelectCCosto() {
    if (typeof (xhrCC) !== 'undefined') {
        xhrCC.abort();
    }
    $('#sede,#r-submit').attr('disabled', 'disabled');
    var data = new Object();
    data.empresa = $('#empresa option:selected').first().attr('value');
    if (sendID) {
        data.sendID = sendID;
    }
    //console.log(data);
    xhrCC = $.ajax({
        data: data,
        type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxanc/get_sede_emps'
    }).done(function (data, textStatus, jqXHR) {/***/
        var iSel = false;
        $('#sede option').each(function (index, opt) {
            var existe = data.some(function (itm) {
                return itm.seccion === $(opt).text();
            });
            if (existe) {
                $(opt).show();
                if (iSel === false) {
                    iSel = $(opt).val();
                }
            } else {
                $(opt).hide();
            }
        });
        $('#sede').val(iSel);
        if (iSel !== false) {
            $('#sede,#r-submit').removeAttr('disabled');
        }/***/
        console.log('sede load OK');
        //console.log(data);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('sede load Fail:');
        console.log(jqXHR);
    });
}
/*******************************************************************************/
$(document).ready(function () {
    //$('#fechainic').datepicker();
    //$('#fechafin').datepicker();
    var dateFormat = 'dd/mm/yy';
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $.datepicker.setDefaults({dateFormat: dateFormat});
    var from = $('#fechainic').datepicker().on('change', function () {
        to.datepicker('option', 'minDate', getDate(this));
    });
    var to = $('#fechafin').datepicker().on('change', function () {
        from.datepicker('option', 'maxDate', getDate(this));
    });
    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }
        return date;
    }

    $('#load-reporte').hide();
    $('#reporte-empty').hide();
    $('#r-submit').click(function () {
        var data = new Object();
        data.empresa = $('#empresa option:selected').first().attr('value');
        data.sede = $('#sede option:selected').first().attr('value');
        data.seccion = $('#sede option:selected').first().text();
        data.activo = $('#q-activo option:selected').first().attr('value');
        if ($('#fechainic').val() && $('#fechainic').val().trim().length > 0) {
            var fechainic = $('#fechainic').val().split('/');
            data.fechainic = fechainic[1] + '/' + fechainic[0] + '/' + fechainic[2];
        }
        if ($('#fechafin').val() && $('#fechafin').val().trim().length > 0) {
            var fechafin = $('#fechafin').val().split('/');
            data.fechafin = fechafin[1] + '/' + fechafin[0] + '/' + fechafin[2];
        }
        data.orden = $('.r-orden:checked').first().attr('value');
        data.nivel = $('#nivel option:selected').first().attr('value');
        $('#r-submit').addClass('disable');
        $('#load-reporte').show();
        $('#ctabla-reporte').hide().html('');
        $('#reporte-empty').hide();
        //console.log(data);
        console.log('::' + data.fechainic + '::');
        $.ajax({
            data: data,
            type: 'POST',
            dataType: 'json',
            url: bdir + 'ajaxanc/reporte_tabla'
        }).done(function (data, textStatus, jqXHR) {
            $('#r-submit').removeClass('disable');
            $('#load-reporte').hide();
            if (data.length) {
                var tabla = '<a href="' + bdir + 'adminanc/reporte_descarga" id="rep-descarga" target="_blank">Descargar reporte</a>';
                tabla += '<table id="tabla-reporte">';
                tabla += '<tr>';
                tabla += '<th>DNI</th>';
                tabla += '<th>Ap. paterno</th>';
                tabla += '<th>Ap. materno</th>';
                tabla += '<th>Nombres</th>';
                //tabla += '<th>Sección</th>';
                tabla += '<th>Puntaje</th>';
                tabla += '<th>Fecha</th>';
                tabla += '</tr>';
                data.forEach(function (itm) {
                    tabla += '<tr>';
                    tabla += '<td>' + itm.dni + '</td>';
                    tabla += '<td>' + itm.apat + '</td>';
                    tabla += '<td>' + itm.amat + '</td>';
                    tabla += '<td>' + itm.nombre + '</td>';
                    //tabla += '<td>' + itm.seccion + '</td>';
                    tabla += '<td>' + itm.puntaje + '</td>';
                    var fecha = new Date(itm.fecha * 1000);
                    var mes = fecha.getMonth() + 1;
                    tabla += '<td>' + fecha.getDate() + '/' + mes + '/' + fecha.getFullYear() + '</td>';
                    tabla += '</tr>';
                });
                tabla += '</table>';
                $('#ctabla-reporte').show().html(tabla);
            } else {
                $('#reporte-empty').show();
            }
            console.log('OK');
            //console.log(data);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            $('#r-submit').removeClass('disable');
            $('#load-reporte').hide();
            console.log('Fail:');
            console.log(jqXHR);
        });
    });
    $('#empresa').change(loadSelectCCosto);
    loadSelectCCosto();
    $.ajax({type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxanc/get_areas'
    }).done(function (data, textStatus, jqXHR) {
        console.log('get_areas');
        area = data;//JSON.parse(data);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
});
/*******************************************************************************/