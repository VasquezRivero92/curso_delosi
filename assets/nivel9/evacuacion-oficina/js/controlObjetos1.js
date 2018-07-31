/*******************************************************************************/
$J[1].init = function () {
    $J[1].gameArea = $("#gameArea1");
    $J[1].canvasWall = document.getElementById("canvasWall_1");
    $J[1].posInitX = -1198;
    $J[1].posInitY = -184;
    $J[1].width = 2548;
    $J[1].height = 884;
    $J[1].posPlayerX = 2153;
    $J[1].posPlayerY = 585;
    $J[1].vidaInicial = 1;
    $J[1].vidas = 1;
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
    $("#escenaJuego1 .powerUp").removeClass("hit").show();
    if ($AnimacionCreada == 1) {
        $PowerUps.forEach(function (val, i) {
            val.hit = false;
            val.draw(i);
        });
        $Enemigos.forEach(function (val, i) {
            val.draw();
        });
    } else {
        $Enemigos = [];
        $PowerUps = [];
        $("#escenaJuego1 .enemigo").each(function (i, obj) {
            var initX, initY, durAnim;
            var movDelay = 0;
            initX = parseInt($(obj).css("left"), 10);
            initY = parseInt($(obj).css("top"), 10);
            var Temp_enemigo = new Lab_Enemigo(initX, initY, $(obj).width(), $(obj).height());
            var Temp_id = "Enemigo1_" + i;
            $(obj).attr("id", Temp_id);
            /*
            if ($(obj).hasClass("enemigoC"))
                Temp_enemigo.initSprite("#" + Temp_id, 9, 3);
            else
                
            
            if ($(obj).data("delay"))
                movDelay = $(obj).data("delay");
            Temp_enemigo.initMov(movX, movY, durAnim, movDelay);
            */
            Temp_enemigo.initSprite("#" + Temp_id);
            durAnim = $(obj).data("dur-anim");

            movX = 0;
            movY = 0;
            Temp_enemigo.initMov(movX, movY, durAnim, movDelay);
            Temp_enemigo.draw();
            $Enemigos.push(Temp_enemigo);
        });
        $("#escenaJuego1 .powerUp").each(function (i, obj) {
            var TPUp = new Lab_PowerUp(parseInt($(obj).css("left"), 10), parseInt($(obj).css("top"), 10), $(obj).width(), $(obj).height());
            if ($(obj).hasClass("powerUp1")) {
                TPUp.nombre = $(obj).data("nombre");
                TPUp.tipo = 1;
            } else if ($(obj).hasClass("powerUp3")) {
                TPUp.tiempo = parseInt($(obj).data("time"));
                TPUp.tipo = 3;
                TPUp.idval = $(obj).data("id");
                TPUp.nombre = $(obj).data("nombre");
            }
            TPUp.draw(i);
            $PowerUps.push(TPUp);
        });
    }
    CronoReset();
    $AnimacionCreada = 1;
}
$J[1].hitPowerUps = function () {
    $PowerUps.forEach(function (itm, i) {
        if (itm.enPantalla()) {
            if (PlayerMov.hittest(itm) && !itm.hit) {
                $("#escenaJuego1 .powerUp").eq(i).addClass("hit");
                if(i == 2){
                    if (itm.tipo == 3) {
                        if(itm.idval == "puerta"){
                            if ($J[1].contAciertos >= 5) {
                                itm.hit = true;
                                Celebracion(itm.nombre);
                                $stopTimeCrono = 6;
                                $stopTimeIntervalo = 5500 / $delayTime;
                                stopBGMusic(window.evacuando);
                                playSound(window.terminobien);
                                setTimeout(function () {
                                    $J[1].finJuego(2);
                                }, 4000);  
                            }else{
                                //console.log(itm.nombre);
                                itm.hit = true;
                                Celebracion('falta_items');
                                $stopTimeCrono = 5;
                                $stopTimeIntervalo = 6500 / $delayTime;
                                //playSound(window.terminomal);
                                setTimeout(function () {
                                    itm.hit = false;
                                    $('#puerta').removeClass("hit");
                                    //console.log(itm.hit);
                                }, 8000); 
                            }                   
                        }
                        showT20s();
                    }                    
                }else{
                    itm.hit = true;
                    if (itm.tipo == 1) {
                        showPuntos();
                        aumentaPtos1();
                        Celebracion(itm.nombre);
                        aumentaVida1();
                        aumentaAmigos(itm.nombre);
                        $stopTimeCrono = 4;
                        $stopTimeIntervalo = 3500 / $delayTime;
                        if ($J[1].contAciertos >= 5) {
                            //console.log('salvaste a todas las personas');
                        }
                    } else if (itm.tipo == 3) {
                        if(itm.idval != "puerta"){
                            aumentaPtos1();
                            Celebracion(itm.nombre);
                            $stopTimeCrono = 4;
                            $stopTimeIntervalo = 3500 / $delayTime;
                            $("#icon_" + i).addClass("anim check");
                            //$J[1].CTiempo = $J[1].CTiempo + itm.tiempo;
                            showT20s();
                        }
                    }                    
               }
                MostrarTiempo();
                playSound(window.audioPower);
            }
            itm.draw(i);
        }
    });
};

function finObjetos1() {
    //$(".powerUp").addClass("hit");
    //$(".icoPel, .icoPrev").hide();
    //$PowerUps.forEach(function (val, i) { val.hit = false; });
}
/*******************************************************************************/