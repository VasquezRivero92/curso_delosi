/*****************************************************************************/
$J[1].init = function () {
    $J[1].gameArea = $("#gameArea1");
    $J[1].canvasWall = document.getElementById("canvasWall_1");
    $J[1].posInitX = 0;
    $J[1].posInitY = 0;
    $J[1].width = 1350;
    $J[1].height = 700;
    $J[1].posPlayerX = 560;
    $J[1].posPlayerY = 370;
};
$J[1].cargarParedes = function () { };
/******************************  Objetos juego 1  ******************************/
var tempID_p;
function initObjetos1() {
    if ($AnimacionCreada == 1) {
        $Enemigos.forEach(function(val,i){ 
            val.x = -2400 + ( i * 500 ); 
            val.draw(); 
        });

    }else{
        $Enemigos = [];
        $PowerUps = [];
        $PowerPR = [];
        $ActPwrUp = 0;

        $(".enemigo").each(function(i,obj){
            var initX = [-100,-1400,-614,-2000,-2058,-2600,-2400,0,0];
            var initY = [220,380,522,230,380,542,220,145,660];
            var Temp_id = "Enemigo2_"+i;
            tempID_p = i;
            var Temp_enemigo = new Lab_Enemigo(initX[i],initY[i],$(obj).width(),$(obj).height());
            $(obj).attr("id",Temp_id);
            Temp_enemigo.id = $("#"+Temp_id);
            Temp_enemigo.vel = 1 + 1;
            Temp_enemigo.vert = (Math.floor(Math.random()*2)*2)-1;
            Temp_enemigo.draw(Math.floor(Math.random()*2)*2);
            //Temp_enemigo.z = Math.floor(initY/10);
            $Enemigos.push(Temp_enemigo);
        });
    }
    CronoReset();
    //$AnimacionCreada = 1;
}

$J[1].hitEnemy = function () {
    


    var hitenemigo = false;
    var MCitm;
    $Enemigos.forEach(function (itm, i) {
        if( itm.enPantalla() ){

        var pointPlay1 = PlayerMov.x;
        var pointPlay2 = PlayerMov.y;
        var pointPlay3 = PlayerMov.x + PlayerMov.width;
        var pointPlay4 = PlayerMov.y + PlayerMov.height;

        var pointEnemi1 = $Enemigos[i].x;
        var pointEnemi2 = $Enemigos[i].y;
        var pointEnemi3 = $Enemigos[i].x + $Enemigos[i].width;
        var pointEnemi4 = $Enemigos[i].y + $Enemigos[i].height;

            if( PlayerMov.hittest(itm) ){
                hitenemigo = true;
                if(itm.hit){
                    itm.hit = true;
                    PlayerMov.areaPtje.stop().addClass('animated rubberBand').fadeIn(100);                         
                    if(i == 7 || i == 8){
                        if($TimeDie){
                            if($ValueEnd == 2){
                                tiempo_Subs();
                            }
                        }
                    }else{

                        if(pointPlay3 > 1350 || pointPlay4 > 700 || pointPlay1 < 0){
                            tiempo_Subs();
                        }else{
                            if($pasar_betwen){
                                PlayerMov.warningMC.addClass('show_warn');
                                if($Val_betwen == 2){
                                    tiempo_Subs();
                                }
                            }
                            if(pointPlay4 < pointEnemi4){
                                PlayerMov.cambiaY(-3); 
                                return false;
                            }
                            if(pointPlay2 > pointEnemi2){
                                PlayerMov.cambiaY(3); 
                                return false;
                            }
                            if(pointPlay3 < pointEnemi3){
                                PlayerMov.cambiaY(-2); 
                                return false;
                            }
                            if(pointPlay1 > pointEnemi1){
                                PlayerMov.cambiaY(3); 
                                return false;
                            }
                        }
                    }
                }
            }else{
                itm.hit = false; 
           }
            itm.draw(i);
        }
        if( itm.visible > 0 ){
            itm.visible--;
        }
    });
    if( !hitenemigo && PlayerMov.areaPtje.hasClass('animated') ){
        $ValueEnd = 0;
        $TimeDie = false;
        $pasar_betwen = false;
        $Val_betwen = 0;
        PlayerMov.warningMC.removeClass('show_warn');
        PlayerMov.areaPtje.stop().removeClass('animated rubberBand').fadeOut(300);
        $J[1].Vereda = 0;
        $J[1].BetwenCars = 0;
    }
}


function finObjetos1() {
    $(".icoPel, .icoPrev").hide();
    $Enemigos.forEach(function (val, i) { val.hit = false; });
}
/*****************************************************************************/