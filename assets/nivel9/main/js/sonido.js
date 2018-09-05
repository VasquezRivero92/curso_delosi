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
    ['nivelBG', odir + '/sounds/capitulo.mp3'],
    ['menuBG', bdir + 'assets/sounds/menu.mp3'],
    ['playBTN', bdir + 'assets/sounds/catch.mp3'],
    ['emergencia', bdir + 'assets/sounds/drivers.mp3'],
    ['txti1', odir + '/sounds/txti1.mp3'],
    ['sO1i1', odir + '/sounds/sO1i1.mp3'],
    ['sO1i2', odir + '/sounds/sO1i2.mp3'],
    ['sO1i3', odir + '/sounds/sO1i3.mp3'],
    ['sO1i4', odir + '/sounds/sO1i4.mp3'],
    ['sO2i1', odir + '/sounds/sO2i1.mp3'],
    ['sO2i2', odir + '/sounds/sO2i2.mp3'],
    ['sO2i3', odir + '/sounds/sO2i3.mp3'],
    ['sO3i1', odir + '/sounds/sO3i1.mp3'],
    ['sO3i2', odir + '/sounds/sO3i2.mp3'],
        
    ['sP1i1', odir + '/sounds/sP1i1.mp3'],
    ['sP1i2', odir + '/sounds/sP1i2.mp3'],
    ['sP1i3', odir + '/sounds/sP1i3.mp3'],
    ['sP1i4', odir + '/sounds/sP1i4.mp3'],
    ['sP2i1', odir + '/sounds/sP2i1.mp3'],
    ['sP2i2', odir + '/sounds/sP2i2.mp3'],
    ['sP2i3', odir + '/sounds/sP2i3.mp3'],
    ['sP3i1', odir + '/sounds/sP3i1.mp3'],
    ['sP3i2', odir + '/sounds/sP3i2.mp3'],
    
    ['sR1i1', odir + '/sounds/sR1i1.mp3'],
    ['sR1i2', odir + '/sounds/sR1i2.mp3'],
    ['sR1i3', odir + '/sounds/sR1i3.mp3'],
    ['sR1i4', odir + '/sounds/sR1i4.mp3'],
    ['sR2i1', odir + '/sounds/sR2i1.mp3'],
    ['sR2i2', odir + '/sounds/sR2i2.mp3'],
    ['sR2i3', odir + '/sounds/sR2i3.mp3'],
    ['sR3i1', odir + '/sounds/sR3i1.mp3'],
    ['sR3i2', odir + '/sounds/sR3i2.mp3'],

    ['sD1i1', odir + '/sounds/sR1i1.mp3'],
    ['sD1i2', odir + '/sounds/sR1i2.mp3'],
    ['sD1i3', odir + '/sounds/sR1i3.mp3'],
    ['sD1i4', odir + '/sounds/sR1i4.mp3'],
    ['sD2i1', odir + '/sounds/sR2i1.mp3'],
    ['sD2i2', odir + '/sounds/sR2i2.mp3'],
    ['sD2i3', odir + '/sounds/sR2i3.mp3'],
    ['sD3i1', odir + '/sounds/sR3i1.mp3'],
    ['sD3i2', odir + '/sounds/sR3i2.mp3']   
    
];

audios = audios.concat();
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
                    $('#img_loader01 div').css({height: percentage + "%"});
                    console.log("s:: " + loader.imageDone + ":" + loader.imageCounter + ":" + soundsloaded + ":" + audios.length);
                    if (percentage >= 100) {
                        $('#qLoverlay').delay(200).fadeOut(300, function () {
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