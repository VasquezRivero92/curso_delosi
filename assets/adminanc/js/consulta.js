/*******************************************************************************/
var cursos = [];
var xhrCC, xhrCC2;
var listadatos = [];
var listapptj = [];
/*******************************************************************************/
function getAreaFltrd() {
    if (typeof (xhrCC) !== 'undefined') {
        xhrCC.abort();
    }
    var empresa = $('#empresa option:selected').first().attr('value');
    var parametros = {'empresa': empresa};
    $('#area,#departamento,#nivel').attr('disabled', 'disabled');
    xhrCC = $.ajax({
        data: parametros,
        type: "POST",
        dataType: 'json',
        url: bdir + 'ajaxanc/get_area_fltrd'
    }).done(function (data, textStatus, jqXHR) {
        $('#area option').each(function (index, opt) {
            var existe = data.some(function (itm) {
                return itm.id_area == $(opt).attr('value');
            });
            if (index && !existe) {
                $(opt).hide();
            } else {
                $(opt).show();
            }
        });
        $('#area').val(0);
        $('#area').removeAttr('disabled');
        console.log('area load OK');
        getDepFltrd();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('area load Fail:');
        console.log(jqXHR);
    });
}
function getDepFltrd() {
    if (typeof (xhrCC2) !== 'undefined') {
        xhrCC2.abort();
    }
    var empresa = $('#empresa option:selected').first().attr('value');
    var area = $('#area option:selected').first().attr('value');
    var parametros = {'empresa': empresa, 'area': area};
    $('#departamento,#nivel').attr('disabled', 'disabled');
    xhrCC2 = $.ajax({
        data: parametros,
        type: "POST",
        dataType: 'json',
        url: bdir + 'ajaxanc/get_dep_fltrd'
    }).done(function (data, textStatus, jqXHR) {
        $('#departamento option').each(function (index, opt) {
            var existe = data.some(function (itm) {
                return itm.id_departamento == $(opt).val();
            });
            if (index && !existe) {
                $(opt).hide();
            } else {
                $(opt).show();
            }
        });
        $('#departamento').val(0);
        $('#departamento,#nivel').removeAttr('disabled');
        console.log('dpto load OK');
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('dpto load Fail:');
        console.log(jqXHR);
    });
}
function crearTablaConsulta(porPtj) {
    var nombre;
    var array;
    var url_rep;
    if (porPtj) {
        array = listapptj;
        url_rep = bdir + 'adminanc/reporte_consulta/puntaje';
    } else {
        array = listadatos;
        url_rep = bdir + 'adminanc/reporte_consulta';
    }
    var tabla = '<a href="' + url_rep + '" id="rep-consulta" target="_blank">Generar reporte</a>';
    tabla += '<table id="tabla-consul">';
    tabla += '<tr>';
    tabla += '<th>Ap. paterno</th>';
    tabla += '<th>Ap. materno</th>';
    tabla += '<th>Nombres</th>';
    tabla += '<th>Email</th>';
    tabla += '<th>DNI</th>';
    tabla += '<th>Datos<br>autorizados</th>';
    cursos.forEach(function (cur) {        
        tabla += '<th>' + cur.descrip + '</th>';    
        tabla += '<th>Visto</th>';
    });
    tabla += '<th>Total</th>';
    tabla += '</tr>';
    array.forEach(function (itm) {
        var autoriz = (itm.last_login) ? 'SI' : 'NO';
        tabla += '<tr>';
        tabla += '<td>' + itm.apat + '</td>';
        tabla += '<td>' + itm.amat + '</td>';
        tabla += '<td>' + itm.nombre + '</td>';
        tabla += '<td>' + itm.email + '</td>';
        tabla += '<td>' + itm.dni + '</td>';
        tabla += '<td>' + autoriz + '</td>';
        cursos.forEach(function (cur) {
            tabla += '<td>' + itm['c' + cur.id] + '</td>';
            tabla += '<td>' + itm['r' + cur.id] + '</td>';
        });
        tabla += '<td>' + itm.total + '</td>';
        tabla += '</tr>';
    });
    tabla += '</table>';
    $('#ctabla-consul').show().html(tabla);
}
function ordenPorPuntaje(arr1) {
    listapptj = arr1;
    var sorted = false;
    while (!sorted) {
        sorted = true;
        listapptj.forEach(function (itm, i, arr) {
            if (arr[i + 1] && (itm.total < arr[i + 1].total)) {
                arr[i] = arr[i + 1];
                arr[i + 1] = itm;
                sorted = false;
            }
        });
    }
}
/*******************************************************************************/
$(document).ready(function () {
    $('#q-orden').hide();
    $('#load-consul').hide();
    $('#consul-empty').hide();
    $('#q-submit').click(function () {
        $('#q-orden-ape').prop('checked', true);
        var data = new Object();
        if ($('#q-apat').val() && $('#q-apat').val().trim().length > 0) {
            data.apat = $('#q-apat').val().trim();
            formSend = true;
        }
        if ($('#q-amat').val() && $('#q-amat').val().trim().length > 0) {
            data.amat = $('#q-amat').val().trim();
            formSend = true;
        }
        if ($('#q-nombre').val() && $('#q-nombre').val().trim().length > 0) {
            data.nombre = $('#q-nombre').val().trim();
            formSend = true;
        }
        if ($('#q-email').val() && $('#q-email').val().trim().length > 0) {
            data.email = $('#q-email').val().trim();
            formSend = true;
        }
        if ($('#q-dni').val() && $('#q-dni').val().trim().length > 0) {
            data.dni = $('#q-dni').val().trim();
            formSend = true;
        }
        data.empresa = $('#empresa option:selected').first().attr('value');
        data.area = $('#area option:selected').first().attr('value');
        data.departamento = $('#departamento option:selected').first().attr('value');
        data.orden = $('.q-orden:checked').first().attr('value');
        data.activo = $('#q-activo option:selected').first().attr('value');
        data.parti = $('#q-parti option:selected').first().attr('value');
        $('.q-input').removeClass('error');
        $('#q-submit').addClass('disable');
        $('#load-consul').show();
        $('#ctabla-consul').hide().html('');
        $('#consul-empty').hide();
        $.ajax({
            data: data,
            type: "POST",
            dataType: 'json',
            url: bdir + 'ajaxanc/consulta_usuarios'
        }).done(function (data, textStatus, jqXHR) {
            $('#q-submit').removeClass('disable');
            $('#load-consul').hide();
            if (data.length) {
                $('#q-orden').show();
                listadatos = [];
                data.forEach(function (itm) {
                    listadatos.push(itm);
                });
                ordenPorPuntaje(data);
                crearTablaConsulta(false);
            } else {
                $('#consul-empty').show();
                $('#q-orden').hide();
            }
            console.log("OK usuarios");
        }).fail(function (jqXHR, textStatus, errorThrown) {
            $('#q-submit').removeClass('disable');
            $('#load-consul').hide();
            console.log("Fail:");
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
    });
    $('#q-orden input').change(function () {
        var orden = $('.q-orden:checked').first().attr('value');
        if (orden === 'ptj') {
            crearTablaConsulta(true);
        } else {
            crearTablaConsulta(false);
        }
    });
    getAreaFltrd();
    $('#empresa').change(getAreaFltrd);
    $('#area').change(getDepFltrd);
    $.ajax({type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxanc/get_cursos'
    }).done(function (data, textStatus, jqXHR) {
        cursos = data;
        console.log('get_cursos');
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log("Error:");
        console.log(jqXHR);
    });
});
/*******************************************************************************/