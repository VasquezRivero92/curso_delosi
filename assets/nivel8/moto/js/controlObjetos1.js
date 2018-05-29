/******************************************************************************/
$J[1].init = function () {
    $J[1].gameArea = $("#gameArea1");
    $J[1].canvasWall = document.getElementById("canvasWall_1");
    $J[1].posInitX = 0;
    $J[1].posInitY = 0;
    $J[1].width = 1350;
    $J[1].height = 700;
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
var tempID_p;
function initObjetos1() {
    //$(".powerUp").removeClass("hit").show();
    //$(".icoPel").show(); $(".icoPrev").hide();
            console.log($AnimacionCreada);
    if ($AnimacionCreada == 1) {
        $PowerUps.forEach(function (val, i) {
            val.hit = false;
            val.visible = 0;
            val.draw(i);
        });
        //$PowerPE.forEach(function (val, i) { if(val){ val.draw(i); } });
        //$PowerPR.forEach(function (val, i) { if(val){ val.draw(i); } });

        $Enemigos.forEach(function(val,i){ 
            val.x = 1500 + ( i * 500 ); 
            val.draw(); 
        });

    }else{
        $Enemigos = [];
        $PowerUps = [];
        $PowerPE = [];
        $PowerPR = [];
        //$ActPwrUp = 0;
        // $(".powerUp").each(function (i, obj) {//para los Power-Ups
        //     var TPUp = new Lab_PowerUp(parseInt($(obj).css('left'),10), parseInt($(obj).css('top'),10), $(obj).width(), $(obj).height());
        //     TPUp.id = $(this).attr('id');
        //     var id = parseInt(TPUp.id.split("_")[1], 10);
        //     TPUp.draw(i);
        //     $PowerUps.push(TPUp);
        //     if($('#icoPel_'+id).length){
        //         var tmpPE = new Lab_PowerUp(parseInt($('#icoPel_'+id).css('left'),10), parseInt($('#icoPel_'+id).css('top'),10), $('#icoPel_'+id).width(), $('#icoPel_'+id).height());
        //         tmpPE.id = 'icoPel_'+id;
        //         tmpPE.draw(i);
        //         $PowerPE[i] = tmpPE;
        //     }
        //     if($('#icoPrev_'+id).length){
        //         var tmpPR = new Lab_PowerUp(parseInt($('#icoPrev_'+id).css('left'),10), parseInt($('#icoPrev_'+id).css('top'),10), $('#icoPrev_'+id).width(), $('#icoPrev_'+id).height());
        //         tmpPR.id = 'icoPrev_'+id;
        //         tmpPR.draw(i);
        //         $PowerPR[i] = tmpPR;
        //     }
        // });

        $(".enemigo").each(function(i,obj){
            //var initX = 1500 + Math.floor(Math.random() * 1500);
            var initX = [1600,1819,1514,2400,2658,2700,0];
            //var initY = [220,390,555]; //200 + Math.floor(Math.random() * 200);
            var initY = [220,390,562,230,380,572,141];
            
            var Temp_id = "Enemigo2_"+i;
            tempID_p = i;
            var Temp_enemigo = new Lab_Enemigo(initX[i],initY[i],$(obj).width(),$(obj).height());
            $(obj).attr("id",Temp_id);
            Temp_enemigo.id = $("#"+Temp_id);
            Temp_enemigo.vel = 2 + 1;
            Temp_enemigo.vert = (Math.floor(Math.random()*2)*2)-1;
            Temp_enemigo.draw(Math.floor(Math.random()*2)*2);
            //Temp_enemigo.z = Math.floor(initY/10);
            $Enemigos.push(Temp_enemigo);
        });
    }
    CronoReset();
    $AnimacionCreada = 1;
}

/*
$J[1].hitPowerUps = function () {
    var hitPU = false;
    $PowerUps.forEach(function (itm, i) {
        if( itm.enPantalla() ){
            if( PlayerMov.hittest(itm) ){
                hitPU = true;
                if( !itm.hit && itm.visible === 0 ){
                    itm.hit = true;
                    //$ActPwrUp = parseInt(itm.id.split("_")[1], 10);
                    PlayerMov.areaPtje.stop().addClass('animated rubberBand').fadeIn(100);
                }
            }else{
                if( itm.visible >= 0 ){ itm.hit = false; }
            }
            itm.draw(i);
        }
        if( itm.visible > 0 ){
            itm.visible--;
        }
    });
    $PowerPE.forEach(function (itm, i) { if(itm && itm.enPantalla()){ itm.draw(i); } });
    $PowerPR.forEach(function (itm, i) { if(itm && itm.enPantalla()){ itm.draw(i); } });
    if( !hitPU && PlayerMov.areaPtje.hasClass('animated') ){
        //$ActPwrUp = 0;
        PlayerMov.areaPtje.stop().removeClass('animated rubberBand').fadeOut(300);
    }
};
*/

$J[1].hitEnemy = function () {
    var hitenemigo = false;    
    $Enemigos.forEach(function (itm, i) {
        if( itm.enPantalla() ){
            if( PlayerMov.hittest(itm) ){
                hitenemigo = true;
                if(i == 6){
                    $TimeDie = true;
                  console.log($TimeDie, $TDie);
                   if($TDie == 5){
                        setTimeout(function () {
                            $J[1].finJuego(2);
                        }, 500); 
                   }
                }else{

                    PlayerMov.cambiaY(5);
                    PlayerMov.cambiaX(-4);
                    //console.log(itm.id)
                    //PlayerMov.areaPtje.stop().addClass('animated').fadeIn(100);
                    //restapuntos();
                }
            }
        }
        if( itm.visible > 0 ){
            itm.visible == 0;
            //console.log('A3');
        }
    });
    if( !hitenemigo && PlayerMov.areaPtje.hasClass('animated') ){
        //$ActPwrUp = 0;
        //PlayerMov.areaPtje.stop().removeClass('animated').delay(800).fadeOut(300);
   }
};

function finObjetos1() {
    //$(".powerUp").addClass("hit");
    $(".icoPel, .icoPrev").hide();
    $PowerUps.forEach(function (val, i) { val.hit = false; });
}
/******************************************************************************/