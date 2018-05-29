/*******************************************************************************/
var metaarray = [];
var indx = 0;
var stringPDF = [];
/*******************************************************************************/
function crearCertificados(lista) {
    $('#rc-mensaje').html('Generando los certificados...');
    var i, j, chunk = 500;
    console.log('paquetes de ' + chunk);
    metaarray = [];
    for (i = 0, j = lista.length; i < j; i += chunk) {
        metaarray.push(lista.slice(i, i + chunk));
        //console.log(temparray.length);
        //console.log(temparray[0]);
    }
    indx = 0;
    stringPDF = [];
    crearPDF();
}
function crearPDF() {
    if (metaarray[indx].length) {
        $.post(bdir + 'ajaxadm/reporte_certif2', {data: metaarray[indx]}).done(function (data) {
            indx++;
            $('#rc-mensaje').html('Generando los certificados... ' + parseInt(100 * indx / metaarray.length, 10) + '%');
            stringPDF.push(data);
            console.log('Bloque ' + indx + ' de ' + metaarray.length);
            console.log(data);
            if (metaarray.length > indx) {
                crearPDF();
            } else {
                getData();
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log('Error:');
            console.log(jqXHR);
        });
    }
}
function getData() {
    var opcion = $('.rc-opcion:checked').first().attr('value');
    var url, msj;
    if (opcion === 'mail') {//envio por mail
        url = 'ajaxadm/reporte_certif3';
        msj = 'Enviado por mail';
    } else {//descarga por defecto
        url = 'ajaxadm/reporte_certif3B';
        msj = 'Enviado por descarga';
    }
    $.post(bdir + url, {data: stringPDF}).done(function (data) {
        console.log('getData OK');
        console.log(data);
        $('#rc-mensaje').html(msj);
        $('#rc-load').hide();
        if (opcion === 'download') {
            var element = document.createElement('a');
            element.setAttribute('href', bdir + 'admin/certificados_descarga/' + data);
            element.style.display = 'none';
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
}
/*******************************************************************************/
$(document).ready(function () {
    $('#rc-load').hide();
    $('#rc-submit').click(function () {
        $('#rc-submit').attr('disabled', 'disabled');
        $('#rc-load').show();
        $('#rc-mensaje').html('Obteniendo la lista de usuarios...');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: bdir + 'ajaxadm/reporte_certif1'
        }).done(function (data, textStatus, jqXHR) {
            console.log('reporte_certif1: OK');
            //console.log(data.length);
            //console.log(data[0]);
            if (data.length) {
                var lista = [];
                data.forEach(function (itm) {
                    lista.push({
                        empresa: itm.empresa,
                        nombre: itm.apat + ' ' + itm.amat + ', ' + itm.nombre
                    });
                });
                console.log('lista hecha');
                console.log(lista.length);
                //console.log(lista[0]);
                //para que no se amontone todo aquí, lo mandé a una función
                crearCertificados(lista);
            } else {
                console.log('lista sin datos');
            }

        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log('Fail:');
            console.log(jqXHR);
        }).always(function () {
            $('#rc-submit').removeAttr('disabled');
        });
        ;
    });
});
/*******************************************************************************/