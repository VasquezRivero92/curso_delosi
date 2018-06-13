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
                    //console.log("s:: " + loader.imageDone + ":" + loader.imageCounter + ":" + soundsloaded + ":" + audios.length);
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


/*! jqueryanimatesprite - v1.3.5 - 2014-10-17
* http://blaiprat.github.io/jquery.animateSprite/
* Copyright (c) 2014 blai Pratdesaba; Licensed MIT */
// (function(t,i,n){"use strict";var e=function(i){return this.each(function(){var e=t(this),a=e.data("animateSprite"),r=function(t){var i=e.css("background-image").replace(/url\((['"])?(.*?)\1\)/gi,"$2"),n=new Image;n.onload=function(){var i=n.width,e=n.height;t(i,e)},n.src=i};a||(e.data("animateSprite",{settings:t.extend({width:e.width(),height:e.height(),totalFrames:!1,columns:!1,fps:12,complete:function(){},loop:!1,autoplay:!0},i),currentFrame:0,controlAnimation:function(){var t=function(t,i){return t++,t>=i?this.settings.loop===!0?(t=0,a.controlTimer()):this.settings.complete():a.controlTimer(),t};if(this.settings.animations===n)e.animateSprite("frame",this.currentFrame),this.currentFrame=t.call(this,this.currentFrame,this.settings.totalFrames);else{if(this.currentAnimation===n)for(var i in this.settings.animations){this.currentAnimation=this.settings.animations[i];break}var r=this.currentAnimation[this.currentFrame];e.animateSprite("frame",r),this.currentFrame=t.call(this,this.currentFrame,this.currentAnimation.length)}},controlTimer:function(){var t=1e3/a.settings.fps;a.settings.duration!==n&&(t=a.settings.duration/a.settings.totalFrames),a.interval=setTimeout(function(){a.controlAnimation()},t)}}),a=e.data("animateSprite"),a.settings.columns?a.settings.autoplay&&a.controlTimer():r(function(t,i){if(a.settings.columns=Math.round(t/a.settings.width),!a.settings.totalFrames){var n=Math.round(i/a.settings.height);a.settings.totalFrames=a.settings.columns*n}a.settings.autoplay&&a.controlTimer()}))})},a=function(i){return this.each(function(){if(t(this).data("animateSprite")!==n){var e=t(this),a=e.data("animateSprite"),r=Math.floor(i/a.settings.columns),s=i%a.settings.columns;e.css("background-position",-a.settings.width*s+"px "+-a.settings.height*r+"px")}})},r=function(){return this.each(function(){var i=t(this),n=i.data("animateSprite");clearTimeout(n.interval)})},s=function(){return this.each(function(){var i=t(this),n=i.data("animateSprite");i.animateSprite("stopAnimation"),n.controlTimer()})},o=function(){return this.each(function(){var i=t(this),n=i.data("animateSprite");i.animateSprite("stopAnimation"),n.currentFrame=0,n.controlTimer()})},m=function(i){return this.each(function(){var n=t(this),e=n.data("animateSprite");"string"==typeof i?(n.animateSprite("stopAnimation"),e.settings.animations[i]!==e.currentAnimation&&(e.currentFrame=0,e.currentAnimation=e.settings.animations[i]),e.controlTimer()):(n.animateSprite("stopAnimation"),e.controlTimer())})},c=function(i){return this.each(function(){var n=t(this),e=n.data("animateSprite");e.settings.fps=i})},u={init:e,frame:a,stop:r,resume:s,restart:o,play:m,stopAnimation:r,resumeAnimation:s,restartAnimation:o,fps:c};t.fn.animateSprite=function(i){return u[i]?u[i].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof i&&i?(t.error("Method "+i+" does not exist on jQuery.animateSprite"),n):u.init.apply(this,arguments)}})(jQuery,window);











