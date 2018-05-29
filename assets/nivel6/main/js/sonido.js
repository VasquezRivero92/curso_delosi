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
    ['txti2', odir + '/sounds/txti2.mp3'],
    ['s1i1', odir + '/sounds/sO1i1.mp3'],
    ['s1i2', odir + '/sounds/sO1i2.mp3'],
    ['s1i3', odir + '/sounds/sO1i3.mp3'],
    ['s1i4', odir + '/sounds/sO1i4.mp3'],
    ['s1i5', odir + '/sounds/sO1i5.mp3'],
    ['s1i6', odir + '/sounds/sO1i6.mp3'],
    ['s2i1', odir + '/sounds/sO2i1.mp3'],
    ['s2i2', odir + '/sounds/sO2i2.mp3'],
    ['s2i3', odir + '/sounds/sO2i3.mp3'],
    ['s2i4', odir + '/sounds/sO2i4.mp3'],
    ['s2i5', odir + '/sounds/sO2i5.mp3'],
    ['s3i1', odir + '/sounds/sO3i1.mp3'],
    ['s3i2', odir + '/sounds/sO3i2.mp3'],
    ['s3i3', odir + '/sounds/sO3i3.mp3'],
    ['s3i4', odir + '/sounds/sO3i4.mp3'],
    ['s3i5', odir + '/sounds/sO3i5.mp3'],
    ['s3i6', odir + '/sounds/sO3i6.mp3'],
    ['s3i7', odir + '/sounds/sO3i7.mp3'],
    ['s3i8', odir + '/sounds/sO3i8.mp3'],
    ['s3i9', odir + '/sounds/sO3i9.mp3'],
    ['s3i10', odir + '/sounds/sO3i10.mp3'],
    ['s4i1', odir + '/sounds/sO4i1.mp3'],
    ['s4i2', odir + '/sounds/sO4i2.mp3'],
    ['s4i3', odir + '/sounds/sO4i3.mp3'],
    ['test', odir + '/sounds/test.mp3']
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