/*******************************************************************************/
var context;
var gainNode;
var webaudio;
var musica = 0;
var textoAudio = 0;
var soundsloaded = 0;
var $mute = false;
var loader = {};
loader.imageDone = 0;
loader.imageCounter = 0;
var audios = [
    ['BGIntro', bdir + 'assets/sounds/instrucciones.mp3'],
    ['BGJuego', bdir + 'assets/sounds/juego.mp3'],
    ['BGWin', bdir + 'assets/sounds/ganaste.mp3'],
    ['txti1', bdir + 'assets/sounds/r1/ab1.mp3'],
    ['txti2', bdir + 'assets/sounds/r1/ab1.mp3'],
    ['txti3', bdir + 'assets/sounds/r1/ab1.mp3'],
    ['txti4', bdir + 'assets/sounds/r1/ab1.mp3'],
    ['txti5', bdir + 'assets/sounds/r1/ab1.mp3'],
    ['beep', bdir + 'assets/sounds/beep.mp3'],
    ['beepXL', bdir + 'assets/sounds/beep_largo.mp3'],
    ['bien', bdir + 'assets/sounds/acierto2.mp3'],
    ['audioBlip', bdir + 'assets/sounds/blip.mp3'],
    ['audioCrash', bdir + 'assets/sounds/crash.mp3'],
    ['audioCatch', bdir + 'assets/sounds/catch.mp3'],
    ['audioPower', bdir + 'assets/sounds/power.mp3']
];
try {
    window.AudioContext = window.AudioContext || window.webkitAudioContext;
    context = new AudioContext();
    gainNode = context.createGain();
    //gainNode.gain.value = 1;
    gainNode.connect(context.destination);
    webaudio = true;
} catch (e) {
    webaudio = false;
    soundsloaded = audios.length;
}
function loadSound(obj, url) {
    if (webaudio) {
        var request = new XMLHttpRequest();
        request.open('GET', url, true);
        request.responseType = 'arraybuffer';
        request.onload = function () {
            context.decodeAudioData(request.response, function (buffer) {
                window[obj] = buffer;
                soundsloaded++;
                if (loader.imageCounter) {
                    var percentage = ((loader.imageDone + soundsloaded) / (loader.imageCounter + audios.length)) * 100;
                    $('#qLpercentage').text(Math.ceil(percentage) + "%");
                    $("#img_loader01 div").css({height: percentage + "%"});
                    console.log("s:: " + loader.imageDone + ":" + loader.imageCounter + ":" + soundsloaded + ":" + audios.length);
                    if (percentage >= 100) {
                        $("#qLoverlay").delay(200).fadeOut(300, function () {
                            $("#qLoverlay").remove();
                        });
                        showInicio();
                    }
                }
            });
        };
        request.send();
    }
}
function playSound(buffer) {
    if (webaudio) {
        var source = context.createBufferSource();
        source.buffer = buffer;
        source.connect(gainNode);
        source.start(0);
    }
}
function playBGMusic(buffer) {
    stopBGMusic();
    if (webaudio) {
        musica = context.createBufferSource();
        musica.loop = true;
        musica.buffer = buffer;
        musica.connect(gainNode);
        musica.start(0);
    }
}
function stopBGMusic() {
    if (webaudio && musica) {
        musica.stop(0);
    }
}
function playTexto(buffer) {
    stopTexto();
    if (webaudio) {
        textoAudio = context.createBufferSource();
        textoAudio.buffer = buffer;
        textoAudio.connect(gainNode);
        textoAudio.start(0);
    }
}
function stopTexto() {
    if (webaudio && textoAudio) {
        textoAudio.stop(0);
    }
}
/*******************************************************************************/