/*******************************************************************************/
//si se esta moviendo
var isPaused = false;
/************************  intervalo para el movimiento  ************************/
function ControlIntervalo() {
    if (!isPaused) {
        now = performance.now();
        cronoElapsed = now - $cronoStartTime;
        if (cronoElapsed > 1000) {
            $cronoStartTime = now - (cronoElapsed % 1000);
            if ($stopTimeCrono > 0) {
                $stopTimeCrono--;
            } else {
                CronoPlay();
            }
        }
        elapsed = now - $startTime;
        if (elapsed > $delayTime) {
            $startTime = now - (elapsed % $delayTime);
            if ($stopTimeIntervalo > 0) {
                $stopTimeIntervalo--;
            } else if ($J.CTiempo) {
                $J.rollBtns($J.numJ);
            }
        }
    }
    if ($MuevePlayer) {
        $MuevePlayer = window.requestAnimationFrame(ControlIntervalo);
    }
}
function CronoPlay() {
    $J.CTiempo--;
    MostrarTiempo();
    if ($J.CTiempo <= 0) {
        $J.finTiempo();
    }
}
function CronoReset() {
    $J.CTiempo = $J.CTInicial;
    MostrarTiempo();
}
function MostrarTiempo() {
    $J.CSeg = $J.CTiempo % 60;
    $J.CMin = parseInt($J.CTiempo / 60);
    $('#CMin').html($J.CMin);
    CCero = '';
    if ($J.CSeg < 10) {
        CCero = '0';
    }
    $("#CSeg").html(CCero + $J.CSeg);
    if ($J.CTiempo === 10) {
        $('#ciPreg_' + $J.numJ).addClass('anim a10');
    }
    if ($J.CTiempo === 8) {
        $('#ciPreg_' + $J.numJ).addClass('a8');
    }
    if ($J.CTiempo === 6) {
        $('#ciPreg_' + $J.numJ).addClass('a6');
    }
    if ($J.CTiempo === 4) {
        $('#ciPreg_' + $J.numJ).addClass('a4');
    }
    if ($J.CTiempo === 2) {
        $('#ciPreg_' + $J.numJ).addClass('a2');
    }
}
function intervaloTiempo() {
    isPaused = false;
    $startTime = performance.now();
    $cronoStartTime = performance.now();
    $MuevePlayer = window.requestAnimationFrame(ControlIntervalo);
}
/*******************************************************************************/