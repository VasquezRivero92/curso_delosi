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
    ['driversBG', bdir + 'assets/sounds/drivers.mp3'],
    ['test', odir + '/sounds/test.mp3'],
    ['txti2', odir + '/sounds/txti2.mp3'],
    ['s1i1', odir + '/sounds/sP1i1.mp3'],
    ['s1i2', odir + '/sounds/sP1i2.mp3'],
    ['s1i3', odir + '/sounds/sP1i3.mp3'],
    ['s1i4', odir + '/sounds/sP1i4.mp3'],
    ['s2text', odir + '/sounds/txti3.mp3'],
    ['s2i1', odir + '/sounds/sP2i1.mp3'],
    ['s2i2', odir + '/sounds/sP2i2.mp3'],
    ['s2i3', odir + '/sounds/sP2i3.mp3'],
    ['s2i4', odir + '/sounds/sP2i4.mp3'],
    ['s2i5', odir + '/sounds/sP2i5.mp3'],
    ['s2i6', odir + '/sounds/sP2i6.mp3'],
    ['s2i7', odir + '/sounds/sP2i7.mp3'],
    ['s2i8', odir + '/sounds/sP2i8.mp3'],
    ['s2i9', odir + '/sounds/sP2i9.mp3'],
    ['s2i10', odir + '/sounds/sP2i10.mp3'],
    ['s2i11', odir + '/sounds/sP2i11.mp3'],
    ['s2i12', odir + '/sounds/sP2i12.mp3'],
    ['s2i13', odir + '/sounds/sP2i13.mp3'],
    ['s2i14', odir + '/sounds/sP2i14.mp3'],
    ['sP2ipop', odir + '/sounds/sP2ipop.mp3'],
    ['s4i1', odir + '/sounds/sP4i1.mp3'],
    ['s4i2', odir + '/sounds/sP4i2.mp3'],
    ['s4i3', odir + '/sounds/sP4i3.mp3'],
    ['s4i4', odir + '/sounds/sP4i4.mp3'],
    ['s4i5', odir + '/sounds/sP4i5.mp3'],
    ['s4i6', odir + '/sounds/sP4i6.mp3']
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