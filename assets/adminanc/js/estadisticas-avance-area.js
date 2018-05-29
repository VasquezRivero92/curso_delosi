/*******************************************************************************/
var barChartData = {
    labels: ['Usuarios que jugaron', 'Usuarios sin jugar'],
    datasets: [{
            backgroundColor: ['rgba(100,250,250,1)', 'rgba(120,120,120,1)'],
            data: [0, 0]
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
        url: bdir + 'ajaxanc/est_avance'
    }).done(function (data, textStatus, jqXHR) {
        console.log('Get avance OK');
        barChartData.datasets[0].data = data;
        window.myBar.update();
        var fin = parseInt(data[0], 10);
        var falta = parseInt(data[1], 10);
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