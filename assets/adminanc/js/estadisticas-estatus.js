/*******************************************************************************/
var psym = '';
/*******************************************************************************/
var rndVal = function () {
    return 0;//Math.round(Math.random() * 100);
};
var barChartData = {
    labels: labels,
    datasets: [{
            backgroundColor: 'rgba(69,21,91,0.5)',
            data: [rndVal(), rndVal(), rndVal(), rndVal(), rndVal(), rndVal()]
        }]
};
var generarGrafico = function () {
    var tipo = $('.tipo-estadistica.active').first().attr('id').split('-')[2];
    var nivel = $('#nivel option:selected').first().attr('value');
    var parametros = {'tipo': tipo, 'nivel': nivel};
    //console.log(parametros);
    $.ajax({
        data: parametros,
        type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxanc/est_estatus'
    }).done(function (data, textStatus, jqXHR) {
        console.log('Get estatus OK');
        barChartData.datasets[0].data = data;
        window.myBar.update();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
    $('.perc-txt').hide();
    if (tipo == 1) {
        psym = '';
    } else if (tipo == 2) {
        psym = '%';
    } else if (tipo == 3) {
        psym = ' Pts';
    }
};
/*******************************************************************************/
$(document).ready(function () {
    var ctx = document.getElementById('promedio').getContext('2d');

    Chart.defaults.global.defaultFontColor = '#000';
    //Chart.canvas.parentNode.style.height = '228px';
    window.myBar = new Chart(ctx, {
        type: 'horizontalBar',
        data: barChartData,
        options: {
            //responsive: true,
            legend: {display: false},
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        return tooltipItem.xLabel + psym;
                    }
                }
            },
            scales: {
                yAxes: [{ticks: {beginAtZero: true}}]
            }
        }
    });
    $('.tipo-estadistica').first().addClass('active');
    generarGrafico();
    $('.tipo-estadistica').click(function () {
        $('.tipo-estadistica').removeClass('active');
        $(this).addClass('active');
        generarGrafico();
    });
    $('#nivel').change(generarGrafico);
});
/*******************************************************************************/