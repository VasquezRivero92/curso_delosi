/*******************************************************************************/
var MovX = 0;
var MovY = 0; // el desplazamiento de un tiempo
var MinX = 0;
var MinY = 25; // limite minimo de desplazamiento
var MaxX;
var MaxY; // limite maximo
// variables de actividad de cada tecla
var Dtecla = [];
Dtecla[0] = false; //left
Dtecla[1] = false; //up
Dtecla[2] = false; //right
Dtecla[3] = false; //down
//variable del jugador
var PlayerMov = new Lab_Player(); // jugador
var $dtctPlayX = 0;
var $dtctPlayY = 0;
//variable del enemigo
var EnemyMov = new Lab_Enemigo(); // jugador
var $dtctEnemyX = 0;
var $dtctEnemyY = 0;

//si se esta moviendo
var isPlaying = false;
var isPaused = false;

function CalcularLimites() {
    // variables de control para la posicion del escenario
    $J[$JAct].posX = $J[$JAct].posInitX;
    $J[$JAct].posY = $J[$JAct].posInitY;
    $J[$JAct].mueveGameArea();
    /***
    //redimension del miniMap
    $MiniMap1.update();
    $MiniMap2.update();
    /***/
}
/********************* para identificar la tecla que debe ejecutarse  *********************/
function MovTecla() {
    if (Dtecla[0] != Dtecla[2] || Dtecla[1] != Dtecla[3]) {
        isPlaying = true;
    } else {
        isPlaying = false;
    }
    if (isPlaying) {
        if (Dtecla[1] && !Dtecla[3]) { // arriba
            MovX = 0;
            MovY = -1 * PlayerMov.vKey;
            PlayerMov.cambiaSprite("arriba");
        }
        if (!Dtecla[1] && Dtecla[3]) { // abajo
            MovX = 0;
            MovY = PlayerMov.vKey;
            PlayerMov.cambiaSprite("abajo");
        }
        if (Dtecla[2]) {
            if (Dtecla[1] == Dtecla[3]) { // derecha
                MovX = PlayerMov.vKey;
                MovY = 0;
                PlayerMov.cambiaSprite("derecha");
            }
        } else {
            if (Dtecla[1] == Dtecla[3]) { // izquierda
                MovX = -1 * PlayerMov.vKey;
                MovY = 0;
                PlayerMov.cambiaSprite("izquierda");
            }
        }
    } else {
        MovX = 0;
        MovY = 0;
        PlayerMov.cambiaSprite("izquierda")
        //PlayerMov.StopSprite();
    }
}
var gg=0;
/************************  intervalo para el movimiento  ************************/
function EjecucionMovimiento() {
    //$MiniMap2.initDraw();
    //choque futuro con paredes
    ChoqueFuturo = false;
    //choque actual con paredes
    ChoqueConPared = false;

    posControl = [
        {x: 10, y: 10},
        {x: 10 + (PlayerMov.width/2), y: 10},
        {x: 10 + PlayerMov.width, y: 10},
        {x: 10 + PlayerMov.width, y: 10 + PlayerMov.height},
        {x: 10 + (PlayerMov.width/2), y: 10 + PlayerMov.height},
        {x: 10, y: 10 + PlayerMov.height}
    ];
    
    posControl.forEach(function (itm, i) {
        var pixel = $ParedMask1.ctx.getImageData(itm.x + MovX, itm.y + MovY, 1, 1);
        if (pixel.data[3] != 0) {
            ChoqueFuturo = true;
        }
    });
    // ejecucion del movimiento del player
    if( isPlaying ){
        if (!ChoqueFuturo) {
            if (PlayerMov.x + MovX >= MinX && PlayerMov.x + MovX <= MaxX && MovX) {
                PlayerMov.cambiaX(MovX);
            }
            if (PlayerMov.y + MovY >= MinY && PlayerMov.y + MovY <= MaxY && MovY) {
                PlayerMov.cambiaY(MovY);
            }
        }
        PlayerMov.AnimaSprite();
    }else{ 
        PlayerMov.AnimaSprite();
    }

    //if( $Enemigos.length ) 
    $Enemigos.forEach(function(itm,i){
        if(i == 7 || i == 8){
            itm.veredaMC();
        }else{
            if( $JAct == 1 ) itm.moveRemolino();
            else itm.Move();                
        }
        if( itm.enPantalla() ){ itm.controlHit(); itm.draw(); }

    });  

    if(PlayerMov.x + (PlayerMov.width/2) > 1350 || (PlayerMov.x + PlayerMov.width) < 0){ tiempo_Subs(); }

    $J[$JAct].hitEnemy();
}
function ControlIntervalo() {
    if (!isPaused) {
        now = performance.now();
        cronoElapsed = now - $cronoStartTime;
        if (cronoElapsed > 1000) {
            $cronoStartTime = now - (cronoElapsed % 1000);
            if ($stopTimeCrono > 0){ $stopTimeCrono--; }
            else{ CronoPlay(); }
        }
        elapsed = now - $startTime;
        if (elapsed > $delayTime) {
            $startTime = now - (elapsed % $delayTime);
            if ($stopTimeIntervalo > 0){ $stopTimeIntervalo--; }
            else{ EjecucionMovimiento(); }
        }
    }
    if ($MuevePlayer){ $MuevePlayer = window.requestAnimationFrame(ControlIntervalo); }
}
function IntervaloMovimiento() {
    isPaused = false;
    $startTime = performance.now();
    $cronoStartTime = performance.now();
    $MuevePlayer = window.requestAnimationFrame(ControlIntervalo);
}
function CronoPlay() {
    $J[$JAct].CTiempo--;
    MostrarTiempo();
    if ($J[$JAct].CTiempo <= 0) { $J[$JAct].finJuego(1); }
    $J[$JAct].Vereda++;
    $J[$JAct].BetwenCars++;
}
function CronoReset() {
    $J[$JAct].CTiempo = $J[$JAct].CTInicial;
    MostrarTiempo();
    $J[$JAct].Vereda = 0;
    $J[$JAct].BetwenCars = 0;
}
function finMovimiento() {
    Dtecla.forEach(function (itm, i) { Dtecla[i] = false; });
    $(".dirBtn").removeClass("on");
    if ($MuevePlayer && !isPaused){ MovTecla(); }
}
/**************************  Funciones para el touch  **************************/
function labClick(x, y) {
    if ($MuevePlayer && $KC_Circulo.hitPoint(x, y)) {
        var mover = false;
        $KC_boton.forEach(function (itm, i) {
            if (itm.hitPoint(x, y)) {
                $KC_boton[i].hit = true;
                $("#DBtn_" + i).addClass("on");
                Dtecla[i] = true;
                mover = true;
            } else if (itm.hit) {
                $KC_boton[i].hit = false;
                $("#DBtn_" + i).removeClass("on");
                Dtecla[i] = false;
            }
        });
        if (mover) { MovTecla(); }
    }
}
$.fn.labTouch = function () {
    var start = function (e) {
        e = e.originalEvent;
        x = e.changedTouches[0].pageX;
        y = e.changedTouches[0].pageY;
        labClick(x, y);
    };
    var move = function (e) {
        e.preventDefault();
        e = e.originalEvent;
        x = e.changedTouches[0].pageX;
        y = e.changedTouches[0].pageY;
        labClick(x, y);
    };
    var stop = function (e) { finMovimiento(); };
    $(this).on("touchstart", start);
    $(this).on("touchmove", move);
    $(window).on("touchend", stop);
};
$.fn.labPointer = function () {
    var start = function (e) {
        e = e.originalEvent;
        x = e.pageX;
        y = e.pageY;
        labClick(x, y);
    };
    var move = function (e) {
        e.preventDefault();
        e = e.originalEvent;
        x = e.pageX;
        y = e.pageY;
        labClick(x, y);
    };
    var stop = function (e) { finMovimiento(); };
    $(this).on("MSPointerDown", start);
    $(this).on("MSPointerMove", move);
    $(window).on("MSPointerUp", stop);
};
$.fn.labMouse = function () {
    var clicked = 0;
    var start = function (e) {
        clicked = 1;
        x = e.pageX;
        y = e.pageY;
        labClick(x, y);
    };
    var move = function (e) {
        if (clicked) {
            x = e.pageX;
            y = e.pageY;
            labClick(x, y);
        }
    };
    var stop = function (e) {
        clicked = 0;
        finMovimiento();
    };
    $(this).on("mousedown", start);
    $(this).on("mousemove", move);
    $(window).on("mouseup", stop);
};
/***************************  iniciar control touch  ***************************/
function initTouchControl() {
    $('body').addClass('touchIsOn');
    //para la posicion de los controles
    var CKC = $(window).height() - $("#contKeyControls").height() - 20;
    $("#contKeyControls").css("top", CKC);
    $KC_Circulo = new Lab_Circulo($("#contKeyControls").width() / 2);
    $KC_Circulo.x = $("#contKeyControls").offset().left;
    $KC_Circulo.y = $("#contKeyControls").offset().top;
    $KC_boton = [];
    $("#contKeyControls .dirBtn").each(function (i, itm) {
        var x = $(itm).offset().left;
        var y = $(itm).offset().top;
        var width = $(itm).width();
        var height = $(itm).height();
        $KC_boton.push(new Lab_Boton(x, y, width, height));
    });
    $("body").labTouch();
    $("body").labPointer();
    $("body").labMouse();
}
/*************************  iniciar control de teclado  *************************/
function initKeyControl() {
    $(window).keydown(function (e) {
        if ($MuevePlayer && !isPaused) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if (code >= 37 && code < 41) {
                Dtecla[code - 37] = true;
                MovTecla();
            }else if (code == 27){
                pausarJuego();
            }else if (code == 88 && $ActPwrUp) {
                muestraPregunta();
            }
        }
    });
    $(window).keyup(function(e){
        if( $MuevePlayer ){// && !isPaused
            var code = (e.keyCode ? e.keyCode : e.which);
            if (code >= 37 && code < 41) {
                Dtecla[code - 37] = false;
                MovTecla();
            }
        }
    });
}
/*******************************************************************************/