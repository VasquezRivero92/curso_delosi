/*******************************************************************************/
var barChartData = {
    labels: ['Calificacion 0', 'Calificacion 1', 'Calificacion 2', 'Calificacion 3', 'Calificacion 4', 'Calificacion 5'],
    datasets: [{
            backgroundColor: ['rgba(102,0,204,1)','rgba(100,250,250,1)', 'rgba(255,0,0,1)','rgba(255,255,0,1)', 'rgba(0,0,102,1)', 'rgba(255,102,255,1)'],
            data: [0, 0, 0, 0, 0, 0]
        }]
};
var xhrCC, xhrCC2;
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
        url: bdir + 'ajaxadm/get_area_fltrd'
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
        url: bdir + 'ajaxadm/get_dep_fltrd'
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
        generarGrafico();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('dpto load Fail:');
        console.log(jqXHR);
    });
}
function generarGrafico() {
    var empresa = $('#empresa option:selected').first().attr('value');
    var area = $('#area option:selected').first().attr('value');
    var departamento = $('#departamento option:selected').first().attr('value');
    var nivel = $('#nivel option:selected').first().attr('value');
    var parametros = {
        'empresa': empresa,
        'area': area,
        'departamento': departamento,
        'nivel': nivel
    };
    //console.log(parametros);
    $.ajax({
        data: parametros,        
        type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxadm/est_estatus_cali'
    }).done(function (data, textStatus, jqXHR) {
        console.log(data);
        console.log('Get avance OK');
        barChartData.datasets[0].data = data;
        console.log(barChartData.datasets[0].data);
        window.myBar.update();
        var fin = parseInt(data[0], 10);
        var falta = parseInt(data[0], 10);
        var total = fin + falta;
        var pfin = 0;
        if (fin > 0) {
            pfin = (100 * fin) / total;
        }
        pfin = pfin.toFixed(1);
        var pfalta = (100 - pfin).toFixed(1);
        $('#perc-total').html(total);
        $('#perc-fin').html(pfin + '% (' + fin + ')');
        $('#perc-falta').html(pfalta + '% (' + falta + ')');
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
};
/*******************************************************************************/
$(document).ready(function () {    
var ctx = document.getElementById('promedio').getContext('2d');
    Chart.defaults.global.defaultFontColor = '#000000';
    window.myBar = new Chart(ctx, {
        type: 'pie',
        data: barChartData,
        options: {responsive: true}
    });
    getAreaFltrd();
    $('#empresa').change(getAreaFltrd);
    $('#area').change(getDepFltrd);
    $('#departamento,#nivel').change(generarGrafico);
});
/*******************************************************************************/