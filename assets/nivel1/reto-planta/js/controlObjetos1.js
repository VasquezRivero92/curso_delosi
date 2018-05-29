/*******************************************************************************/
$J[1].init = function () {
    $J[1].gameArea = $("#gameArea1");
    $J[1].canvasWall = document.getElementById("canvasWall_1");
    $J[1].posInitX = 0;
    $J[1].posInitY = 0;
    $J[1].width = 2548;
    $J[1].height = 884;
    $J[1].posPlayerX = 400;
    $J[1].posPlayerY = 350;
};
$J[1].cargarParedes = function () {
    /***
    var img = document.getElementById("fondoStage_1");//fondoStage_1//canvasWall_1
    $MiniMap1.initDraw();
    $MiniMap1.ctx.globalAlpha = 0.7;
    $MiniMap1.ctx.drawImage(img, 0, 0, $MiniMap1.width, $MiniMap1.height);
    /***/
};
/******************************  Objetos juego 1  ******************************/
function initObjetos1() {
    //$(".powerUp").removeClass("hit").show();
    $(".icoPel").show(); $(".icoPrev").hide();
    if ($AnimacionCreada == 1) {
        $PowerUps.forEach(function (val, i) {
            val.hit = false;
            val.visible = 0;
            val.draw(i);
        });
        $PowerPE.forEach(function (val, i) { if(val){ val.draw(i); } });
        $PowerPR.forEach(function (val, i) { if(val){ val.draw(i); } });
    }else{
        $PowerUps = [];
        $PowerPE = [];
        $PowerPR = [];
        $ActPwrUp = 0;
        $(".powerUp").each(function (i, obj) {//para los Power-Ups
            var TPUp = new Lab_PowerUp(parseInt($(obj).css('left'),10), parseInt($(obj).css('top'),10), $(obj).width(), $(obj).height());
            TPUp.id = $(this).attr('id');
            var id = parseInt(TPUp.id.split("_")[1], 10);
            TPUp.draw(i);
            $PowerUps.push(TPUp);
            if($('#icoPel_'+id).length){
                var tmpPE = new Lab_PowerUp(parseInt($('#icoPel_'+id).css('left'),10), parseInt($('#icoPel_'+id).css('top'),10), $('#icoPel_'+id).width(), $('#icoPel_'+id).height());
                tmpPE.id = 'icoPel_'+id;
                tmpPE.draw(i);
                $PowerPE[i] = tmpPE;
            }
            if($('#icoPrev_'+id).length){
                var tmpPR = new Lab_PowerUp(parseInt($('#icoPrev_'+id).css('left'),10), parseInt($('#icoPrev_'+id).css('top'),10), $('#icoPrev_'+id).width(), $('#icoPrev_'+id).height());
                tmpPR.id = 'icoPrev_'+id;
                tmpPR.draw(i);
                $PowerPR[i] = tmpPR;
            }
        });
    }
    CronoReset();
    $AnimacionCreada = 1;
}
$J[1].hitPowerUps = function () {
    var hitPU = false;
    $PowerUps.forEach(function (itm, i) {
        if( itm.enPantalla() ){
            if( PlayerMov.hittest(itm) ){
                hitPU = true;
                if( !itm.hit && itm.visible === 0 ){
                    itm.hit = true;
                    $ActPwrUp = parseInt(itm.id.split("_")[1], 10);
                    PlayerMov.areaPtje.stop().addClass('animated rubberBand').fadeIn(100);
                }
            }else{
                if( itm.visible >= 0 ){ itm.hit = false; }
            }
            itm.draw(i);
        }
        if( itm.visible > 0 ){
            /***
            if( itm.visible === 1 && $PowerPE[i] ){
                //$('#'+itm.id).removeClass("hit");
                $('#'+$PowerPE[i].id).show();
            }/***/
            itm.visible--;
        }
    });
    $PowerPE.forEach(function (itm, i) { if(itm && itm.enPantalla()){ itm.draw(i); } });
    $PowerPR.forEach(function (itm, i) { if(itm && itm.enPantalla()){ itm.draw(i); } });
    if( !hitPU && PlayerMov.areaPtje.hasClass('animated') ){
        $ActPwrUp = 0;
        PlayerMov.areaPtje.stop().removeClass('animated rubberBand').fadeOut(300);
    }
};
function finObjetos1() {
    //$(".powerUp").addClass("hit");
    $(".icoPel, .icoPrev").hide();
    $PowerUps.forEach(function (val, i) { val.hit = false; });
}
/*******************************************************************************/