/*******************************************************************************/
var emp = [];
var area = [];
var dep = [];
var car = [];
var pla = [];
var grup = [];
var niv = [];

var packEdUser = [];
var packEdUEmp = [];
var packDelUEmp = [];
var packTienda = [];
var tEdUser = [];
var tEdUEmp = [];
var tDelUEmp = [];
var tTienda = [];

var regIdx = 0;
var suma = 0;
var total = 0;
var nuevo = 0;
var existe = 0;
var userLimit = 50;

var newArea = [];
var newDep = [];
var newCar = [];
var newPla = [];
/*******************************************************************************/
function rel_array(array) {
    var resul = [];
    array.forEach(function (itm) {
        resul[itm.id] = itm.nombre;
    });
    return resul;
}
/*******************************************************************************/
function creaTablaEdUser() {
    var tabla = '<table><tr><td>DNI</td><td colspan=3>APELLIDOS Y NOMBRES</td><td>EMAIL</td><td>GRUPO</td><td>TIPO</td></tr>';
    
    packEdUser.forEach(function (itm) {
        var colB = itm[1] ? itm[1].toUpperCase() : 'S.C.';
        var colC = itm[2] ? itm[2].toUpperCase() : 'S.C.';
        var colD = itm[3] ? itm[3].toUpperCase() : 'S.C.';
        var colE = itm[4] ? itm[4].toLowerCase() : 'S.C.';
        var colF = itm[7] ? grup[itm[7] - 1].nombre : 'S.C.';
        tabla += '<tr>';
        tabla += '<td>' + itm[0] + '</td>';
        tabla += '<td>' + colB + '</td>';
        tabla += '<td>' + colC + '</td>';
        tabla += '<td>' + colD + '</td>';
        tabla += '<td>' + colE + '</td>';
        tabla += '<td>' + colF + '</td>';
        tabla += '<td>' + itm[10] + '</td>';
        tabla += '</tr>';
        if (itm[10] == 'nuevo') {
            nuevo++
        } else {
            existe++;
        }
    });
    tabla += '</table>';
    $('#exc-tabla').show().html(tabla);    
    $('#nuevos').html(nuevo); 
    $('#existentes').html(existe); 

    console.log('nuevos: ' + nuevo);
    console.log('existentes: ' + existe);
}

function creaTablaEdUEmp() {
    var tabla = '<table><tr><td>DNI</td><td>APELLIDOS Y NOMBRES</td><td>EMPRESA</td><td>AREA</td><td>DEPARTAMENTO</td><td>SEDE</td><td>TIPO</td></tr>';
    
    packEdUEmp.forEach(function (itm) {
        var colD = itm[4] ? itm[4].toUpperCase() : 'S.C.';
        var colE = itm[5] ? itm[5].toUpperCase() : 'S.C.';
        var colF = itm[8] ? itm[8].toUpperCase() : 'S.C.';
        tabla += '<tr>';
        tabla += '<td>' + itm[1] + '</td>';
        tabla += '<td>' + itm[2] + '</td>';
        tabla += '<td>' + itm[3] + '</td>';
        tabla += '<td>' + colD + '</td>';
        tabla += '<td>' + colE + '</td>';
        tabla += '<td>' + colF + '</td>';
        tabla += '<td>' + itm[11] + '</td>';
        tabla += '</tr>';
        if (itm[11] == 'nuevo') {
            nuevo++
        } else {
            existe++;
        }
    });
    tabla += '</table>';
    $('#exc-tabla').show().html(tabla);
    $('#nuevos').html(nuevo); 
    $('#existentes').html(existe); 
}

function creaTablaDelUEmp() {
    var tabla = '<table><tr><td>DNI</td><td>APELLIDOS Y NOMBRES</td><td>EMPRESA</td></tr>';
    packDelUEmp.forEach(function (itm) {
        tabla += '<tr>';
        tabla += '<td>' + itm[1] + '</td>';
        tabla += '<td>' + itm[2] + '</td>';
        tabla += '<td>' + itm[3] + '</td>';
        tabla += '</tr>';
    });
    tabla += '</table>';
    $('#exc-tabla').show().html(tabla);
}

function creaTablaTienda() {
    var tabla = '<table><tr><td>MARCA</td><td>FORMATO</td><td>SEDE</td><td>USUARIO</td><td>NOMBRE</td><td>TIPO</td></tr>';
    packTienda.forEach(function (itm) {
        var colA = itm[0] ? itm[0] : 'S.C.';
        var colB = itm[1] ? itm[1] : 'S.C.';
        var colC = itm[2] ? itm[2] : 'S.C.';
        var colD = itm[3] ? itm[3] : 'S.C.';
        var colE = itm[5] ? itm[5] : 'S.C.';
        tabla += '<tr>';
        tabla += '<td>' + colA + '</td>';
        tabla += '<td>' + colB + '</td>';
        tabla += '<td>' + colC + '</td>';
        tabla += '<td>' + colD + '</td>';
        tabla += '<td>' + colE + '</td>';
        tabla += '<td>' + itm[7] + '</td>';
        tabla += '</tr>';
    });
    tabla += '</table>';
    $('#exc-tabla').show().html(tabla);
    //console.log(packTienda);
}
/*******************************************************************************/
function initAjaxEdUser() {
    $('.runBTN').attr('disabled', 'disabled');
    //$('#mail-masivo').addClass('disable');
    tEdUser = [];
    packEdUser.forEach(function (itm, i) {
        var dupliDNI = tEdUser.some(function (obj) {
            return obj.dni === itm[0];
        });
        var dupliMail = tEdUser.some(function (obj) {
            return (itm[4] && obj.email && (obj.email.toLowerCase() === itm[4].toLowerCase()));
        });
        var email = itm[4] ? itm[4] : null;
        if (dupliMail) {
            email = null;
        }
        if (!dupliDNI) {
            var activo = (itm[9] === 0) ? 0 : 1;
            var uRow = {
                dni: itm[0],
                apat: itm[1],
                amat: itm[2],
                nombre: itm[3],
                email: email,
                password: itm[5],
                sexo: itm[6],
                id_grupo: itm[7],
                id_nivel: itm[8],
                activo: activo,
                existe: itm[10]
            };
            tEdUser.push(uRow);
        }
    });
    regIdx = 0;
    suma = 0;
    total = tEdUser.length;
    //console.log(tEdUser[0]);
    console.log('Sin duplicados: ' + total);
}

function initAjaxEdUEmp() {
    $('.runBTN').attr('disabled', 'disabled');
    tEdUEmp = [];
    newArea = [];
    newDep = [];
    newCar = [];
    newPla = [];
    packEdUEmp.forEach(function (itm) {
        var indEmp = emp.findIndex(function (obj) {
            return obj == itm[3];
        });
        var indArea = area.findIndex(function (obj) {
            return obj == itm[4];
        });
        var indDep = dep.findIndex(function (obj) {
            return obj == itm[5];
        });
        var indCar = car.findIndex(function (obj) {
            return obj == itm[6];
        });
        var indPla = pla.findIndex(function (obj) {
            return obj == itm[7];
        });
        if (indEmp < 0) {
            //console.log('no indEmp: ' + itm[3]);
        }
        if (indArea < 0 && $.inArray(itm[4], newArea) < 0) {
            //console.log('no indArea: ' + itm[4]);
            newArea.push(itm[4]);
        }
        if (indDep < 0 && $.inArray(itm[5], newDep) < 0) {
            //console.log('no indDep: ' + itm[5]);
            newDep.push(itm[5]);
        }
        if (indCar < 0 && $.inArray(itm[6], newCar) < 0) {
            //console.log('no indCar: ' + itm[6]);
            newCar.push(itm[6]);
        }
        if (indPla < 0 && $.inArray(itm[7], newPla) < 0) {
            //console.log('no indPla: ' + itm[7]);
            newPla.push(itm[7]);
        }
        //var pfip = itm[9].split('/');
        var ueRow = {
            id_user: itm[0],
            id_empresa: indEmp,
            id_area: indArea,
            id_departamento: indDep,
            id_cargo: indCar,
            id_planilla: indPla,
            sede: itm[8],
            seccion: itm[9],
            fingpla: itm[10], //pfip[1]+'/'+pfip[0]+'/'+pfip[2]
            existe: itm[11]
        };
        //console.log(ueRow);
        tEdUEmp.push(ueRow);
    });
    regIdx = 0;
    suma = 0;
    total = tEdUEmp.length;
    //console.log(tEdUEmp);
    console.log('Sin duplicados: ' + total);
}

function initAjaxDelUEmp() {
    $('.runBTN').attr('disabled', 'disabled');
    tDelUEmp = [];
    packDelUEmp.forEach(function (itm) {
        var indEmp = emp.findIndex(function (obj) {
            return obj == itm[3];
        });
        var ueRow = {
            id_user: itm[0],
            id_empresa: indEmp
        };
        tDelUEmp.push(ueRow);
    });
    regIdx = 0;
    suma = 0;
    total = tDelUEmp.length;
}

function initAjaxTienda() {
    $('.runBTN').attr('disabled', 'disabled');
    tTienda = [];
    packTienda.forEach(function (itm, i) {
        var dupliUser = tTienda.some(function (obj) {
            return obj.usuario === itm[3];
        });
        var dupliUser2 = tTienda.some(function (obj) {
            return obj.usuario2 === itm[2];
        });
        if (!dupliUser && !dupliUser2) {
            var activo = itm[9] ? 0 : 1;
            var uRow = {
                marca: itm[0],
                formato: itm[1],
                usuario2: itm[2],
                usuario: itm[3],
                password: itm[4],
                nombre: itm[5],
                activo: activo,
                existe: itm[7]
            };
            tTienda.push(uRow);
        }
    });
    regIdx = 0;
    suma = 0;
    total = tTienda.length;
    //console.log(tTienda);
    console.log('Sin duplicados: ' + total);
}
/*******************************************************************************/
function runEdUser() {
    var tData = tEdUser.slice(regIdx * userLimit, (regIdx + 1) * userLimit);
    if (!tData.length) {
        regIdx = 0;
        $('.runBTN').removeAttr('disabled');
        $('#infoMessage').html('Actualización de usuarios completada');
        console.log('Registros: ' + suma);
        // $('#faltantes').html(suma); 
        return;
    }
    $.post(bdir + 'ajaxadm/run_ed_user', {data: tData}).done(function (data) {
        regIdx++;
        suma = suma + parseInt(data, 10);
        $('#infoMessage').html('Actualización al ' + parseInt(100 * suma / total, 10) + '%');
        console.log('Bloque Nº ' + regIdx + ' actualizado: ');
        console.log(data);
        runEdUser();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
}

function mail_masivo() {
    var tData = tEdUser.slice(regIdx * userLimit, (regIdx + 1) * userLimit);
    if (!tData.length) {
        regIdx = 0;
        $('.runBTN').removeAttr('disabled');
        $('#infoMessage').html('Envío de mails completado');
        console.log('Registros: ' + suma);
        return;
    }
    $.post(bdir + 'ajaxadm/mail_masivo', {data: tData}).done(function (data) {
        regIdx++;
        suma = suma + parseInt(data, 10);
        $('#infoMessage').html(suma + ' emails enviados...');
        console.log('Mails bloque " + regIdx + " enviado:');
        console.log(data);
        mail_masivo();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
}

function runEdUEmp() {
    var tData = tEdUEmp.slice(regIdx * userLimit, (regIdx + 1) * userLimit);
    if (!tData.length) {
        regIdx = 0;
        $('.runBTN').removeAttr('disabled');
        $('#infoMessage').html('Actualización de usuarios completada');
        console.log('Registros: ' + suma);
        return;
    }
    $.post(bdir + 'ajaxadm/run_ed_uemp', {data: tData}).done(function (data) {
        regIdx++;
        suma = suma + parseInt(data, 10);
        $('#infoMessage').html('Actualización al ' + parseInt(100 * suma / total, 10) + '%');
        console.log('Bloque Nº ' + regIdx + ' registrado: ');
        console.log(data);
        runEdUEmp();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
}

function runDelUEmp() {
    var tData = tDelUEmp.slice(regIdx * userLimit, (regIdx + 1) * userLimit);
    if (!tData.length) {
        regIdx = 0;
        $('.runBTN').removeAttr('disabled');
        $('#infoMessage').html('Eliminación de registros completado');
        console.log('Registros: ' + suma);
        return;
    }
    $.post(bdir + 'ajaxadm/run_del_uemp', {data: tData}).done(function (data) {
        regIdx++;
        suma = suma + parseInt(data, 10);
        $('#infoMessage').html('Eliminación al ' + parseInt(100 * suma / total, 10) + '%');
        console.log('Bloque Nº ' + regIdx + ' eliminado: ');
        console.log(data);
        runDelUEmp();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
}

function runTienda() {
    var tData = tTienda.slice(regIdx * userLimit, (regIdx + 1) * userLimit);
    if (!tData.length) {
        regIdx = 0;
        $('.runBTN').removeAttr('disabled');
        $('#infoMessage').html('Actualización de tiendas completada');
        console.log('Registros: ' + suma);
        return;
    }
    $.post(bdir + 'ajaxadm/run_ed_tienda', {data: tData}).done(function (data) {
        regIdx++;
        suma = suma + parseInt(data, 10);
        $('#infoMessage').html('Actualización al ' + parseInt(100 * suma / total, 10) + '%');
        console.log('Bloque Nº ' + regIdx + ' actualizado: ');
        console.log(data);
        runEdUser();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
}
/*******************************************************************************/
$(document).ready(function () {
    $('.runBTN').hide();
    $('#masivo-menu > div').click(function () {
        $('#nuevos').html(0); 
        $('#existentes').html(0);
        $('#recibidos').html(0);
        // $('#faltantes').html(0); 
        $('#exc-tabla').show().html('');
        $('#masivo-menu > div').removeClass('active');
        $('.reg-multi').removeClass('active');
        var id = $(this).data('id');
        $(this).addClass('active');
        $('#' + id).addClass('active');
    });
    $('#eduser-form').submit(function () {
        suma = 0;
        total = 0;
        nuevo = 0;
        existe = 0;
        $('#nuevos').html(0); 
        $('#existentes').html(0);
        $('#recibidos').html(0); 
        // $('#faltantes').html(0); 
        $('.subBTN').attr('disabled', 'disabled');
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: bdir + 'ajaxadm/upload_eduser_excel',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            contentType: false,
            processData: false
        }).done(function (data, textStatus, jqXHR) {
            packEdUser = data;
            $('.runBTN').attr('disabled', 'disabled');
            $('#eduser-run,#eduser-mail').removeAttr('disabled').show();
            $('.subBTN').removeAttr('disabled');
            console.log('edUser recibido: ' + data.length);            
            $('#recibidos').html(data.length); 
            //console.log(data);
            creaTablaEdUser();
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log('Error:');
            console.log(jqXHR);
            $('.subBTN').removeAttr('disabled');
        });
        return false;
    });

    $('#eduemp-form').submit(function () {
        suma = 0;
        total = 0;
        nuevo = 0;
        existe = 0;
        $('#nuevos').html(0); 
        $('#existentes').html(0);
        $('#recibidos').html(0); 
        // $('#faltantes').html(0); 
        $('.subBTN').attr('disabled', 'disabled');
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: bdir + 'ajaxadm/upload_eduemp_excel',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            contentType: false,
            processData: false
        }).done(function (data, textStatus, jqXHR) {
            packEdUEmp = data;
            $('.runBTN').attr('disabled', 'disabled');
            $('#eduemp-run').removeAttr('disabled').show();
            $('.subBTN').removeAttr('disabled');
            console.log('edUEmp recibido: ' + data.length);
            $('#recibidos').html(data.length); 
            //console.log(data);
            creaTablaEdUEmp();
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log('Error:');
            console.log(jqXHR);
            $('.subBTN').removeAttr('disabled');
        });
        return false;
    });

    $('#deluemp-form').submit(function () {
        $('.subBTN').attr('disabled', 'disabled');
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: bdir + 'ajaxadm/upload_deluemp_excel',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            contentType: false,
            processData: false
        }).done(function (data, textStatus, jqXHR) {
            packDelUEmp = [];
            //console.log(data);
            data.forEach(function (itm) {
                if (itm[4] == 'existe') {
                    packDelUEmp.push(itm);
                }
            });
            console.log('delUEmp recibido: ' + packDelUEmp.length);
            //console.log(packDelUEmp.length);
            $('.runBTN').attr('disabled', 'disabled');
            $('#deluemp-run').removeAttr('disabled').show();
            $('.subBTN').removeAttr('disabled');
            creaTablaDelUEmp();
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log('Error:');
            console.log(jqXHR);
            $('.subBTN').removeAttr('disabled');
        });
        return false;
    });

    $('#tienda-form').submit(function () {
        $('.subBTN').attr('disabled', 'disabled');
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: bdir + 'ajaxadm/upload_tienda_excel',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            contentType: false,
            processData: false
        }).done(function (data, textStatus, jqXHR) {
            packTienda = data;
            $('.runBTN').attr('disabled', 'disabled');
            $('#tienda-run').removeAttr('disabled').show();
            $('.subBTN').removeAttr('disabled');
            console.log('tiendas recibidas: ' + data.length);
            //console.log(data);
            creaTablaTienda();
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.log('Error:');
            console.log(jqXHR);
            $('.subBTN').removeAttr('disabled');
        });
        return false;
    });

    $('#eduser-run').click(function () {
        initAjaxEdUser();
        runEdUser();
    });

    $('#eduser-mail').click(function () {
        initAjaxEdUser();
        mail_masivo();
    });

    $('#eduemp-run').click(function () {
        initAjaxEdUEmp();
        //si existe algun campo nuevo, primero lo registra y después vuelve
        //a ejecutarse (para que los indices nuevos no queden como -1)
        if (newArea.length || newDep.length || newCar.length || newPla.length) {
            console.log('newdata uemp');
            var parametros = {'area': newArea, 'departamento': newDep, 'cargo': newCar, 'planilla': newPla};
            $.ajax({
                data: parametros,
                type: 'POST',
                dataType: 'json',
                url: bdir + 'ajaxadm/reg_newdata_uemp'
            }).done(function (data, textStatus, jqXHR) {
                console.log('reg_newdata_uemp');
                if (data.area && data.area.length) {
                    area = rel_array(data.area);
                }
                if (data.departamento && data.departamento.length) {
                    dep = rel_array(data.departamento);
                }
                if (data.cargo && data.cargo.length) {
                    car = rel_array(data.cargo);
                }
                if (data.planilla && data.planilla.length) {
                    pla = rel_array(data.planilla);
                }
                //console.log(dep);
                $('#eduemp-run').click();
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log('Error:');
                console.log(jqXHR);
            });
        } else {
            runEdUEmp();
        }
    });

    $('#deluemp-run').click(function () {
        initAjaxDelUEmp();
        runDelUEmp();
    });

    $('#tienda-run').click(function () {
        initAjaxTienda();
        runTienda();
    });

    $('#masivo-menu > div').get(0).click();

    //aqui viene el llenado de variables por ajax
    $.ajax({type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxadm/get_empresas'
    }).done(function (data, textStatus, jqXHR) {
        emp = rel_array(data);
        console.log('get_empresas');
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
    $.ajax({type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxadm/get_areas'
    }).done(function (data, textStatus, jqXHR) {
        area = rel_array(data);
        console.log('get_areas');
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
    $.ajax({type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxadm/get_departamentos'
    }).done(function (data, textStatus, jqXHR) {
        dep = rel_array(data);
        console.log('get_departamentos');
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
    $.ajax({type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxadm/get_cargos'
    }).done(function (data, textStatus, jqXHR) {
        car = rel_array(data);
        console.log('get_cargos');
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
    $.ajax({type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxadm/get_planillas'
    }).done(function (data, textStatus, jqXHR) {
        console.log('get_planillas');
        pla = rel_array(data);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });

    $.ajax({type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxadm/get_grupos'
    }).done(function (data, textStatus, jqXHR) {
        grup = data;
        console.log('get_grupos');
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
    $.ajax({type: 'POST',
        dataType: 'json',
        url: bdir + 'ajaxadm/get_admlvl'
    }).done(function (data, textStatus, jqXHR) {
        niv = data;
        console.log('get_admlvl');
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.log('Error:');
        console.log(jqXHR);
    });
});
/*******************************************************************************/