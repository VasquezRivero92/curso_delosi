/*******************************************************************************
 //para probar el campo de nombre en la constancia
 Array.prototype.shuffle = function () {
 var i = this.length, j, temp;
 if (i === 0) {
 return this;
 }
 while (--i) {
 j = Math.floor(Math.random() * (i + 1));
 temp = this[i];
 this[i] = this[j];
 this[j] = temp;
 }
 return this;
 };
 var nomConstancia = [
 'ESPINOZA MATVEEVA, GALIA DEL CARMEN TOLENTINOVNA',
 'BERMUDEZ CANGAHUALA, STEFANIE KATHERINE MARLENE',
 'FERNANDEZ CABANILLAS, ALVARO FABRIZIO SALVATORE',
 'ESQUIVEL DE LA ROSA, STEPHANY ROSARIO DEL PILAR',
 'CHICLAYO DEL CARPIO, CLAUDIA MARIA DEL ROSARIO',
 'CHAVEZ CORONADO, MARIA DE LOS ÁNGELES CLAUDIA',
 'COLLAHUA MENDOZA, JAHAIRA STHEFANY CONCEPCIÓN',
 'RODRIGUEZ DE LA VIUDA CHANG, FERNANDO ANTONIO',
 'SANTISTEBAN BARRANTES, CLAUDIA SARITA ABIGAIL',
 'VELASQUEZ AROTINCO, ALEJANDRA ADBHERLUZ BELEN',
 'LUZA VEGA, ABEL',
 'LUO HE, HUANTIAN',
 'VELA PEREZ, EDER',
 'CHANG CHEN, LUIS',
 'MONGE SOTO, JHON',
 'TECO LIMA, DORIS',
 'GUTIERREZ SULCA, LUIS ERNESTO',
 'VERA CACERES, FRANCESCA POLET',
 'ESCOBAR NOVOA, CHRISTIAN JHON',
 'PEVEZ BARRENA, MANUEL GERARDO',
 'PENADILLO BONIFACIO, FERNANDO'
 ];
 /*******************************************************************************/
function showInicio() {
    redimensionarJuego();
    $('.instrucciones').stop().hide();
    $('#instruccion_5').fadeIn(1000);
    playBGMusic(window.BGresul);
}
function redimensionarJuego() {
    scale1 = (window.innerWidth / 1350);
    scale2 = (window.innerHeight / 700);
    if (scale1 <= scale2) {// cuando sobra height
        $('.resizeWindow').css({'left': '0px', 'transform': 'scale(' + scale1 + ')'});
        $scaleActual = scale1;
    } else {//cuando sobra width
        var left = (window.innerWidth - (1350 * scale2)) / 2;
        $('.resizeWindow').css({'left': left + 'px', 'transform': 'scale(' + scale2 + ')'});
        $scaleActual = scale2;
    }
    $('body, html').css("height", window.innerHeight);
}
function initSonidos() {
    audios.forEach(function (itm, i) {
        loadSound(itm[0], itm[1]);
    });
}
/*******************************************************************************/
$(document).ready(function (e) {
    initSonidos();
    redimensionarJuego();
    $(window).resize(redimensionarJuego);
    $('#qLoverlay').show();
    $('#historia').queryLoader2({
        barColor: '#000000',
        backgroundColor: '#333333',
        percentage: true,
        minimumTime: 100,
        barHeight: 0,
        onComplete: showInicio
    });
    $('#i5btn_1').click(function () {
        playSound(window.playBTN);
        playTexto(window.txti4);
        $('.instrucciones').stop().delay(10).fadeOut(500);
        $('#instruccion_4').stop().fadeIn(10);
        $.post(bdir + 'ajax/set_constancia').done(function (data) {
            console.log('Set constancia: ' + data);
        });
    });
    $('#i4btn_1').click(function (e) {
        playSound(window.playBTN);
        $('#instruccion_6').fadeIn(1000);
        setTimeout(function () {
            window.location.href = bdir + 'main';
            //console.log(bdir + 'main');
        }, 4000);
    });
    //para probar el campo de nombre en la constancia
    /***
     $('#i5tit_1').click(function () {
     nomConstancia.shuffle();
     $('#i5txt_1 span').html(nomConstancia[0]);
     });
     $('#i5tit_1').click();
     /***/
});
/*******************************************************************************/