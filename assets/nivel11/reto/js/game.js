// VARIABLES DATABASE
// scene: [sceneMainMenu, sceneSeleccion, sceneTeoriaDragAndDrop,sceneDragAndDrop, sceneEscenaFinal, sceneTeoriaNivel2, sceneEscenaApagar, sceneTeoriaNivel3, sceneDesenergizar, sceneTeoriaNivel4, sceneBloqueo, sceneTeoriaNivel5, sceneLiberar, sceneTeoriaNivel6, sceneComprobar, scenePreguntas],

// SISTEMA    

var canvasExt = document.getElementById('canvasextintor');

// Inicializar Phaser
var config = {
    type: Phaser.CANVAS,
    width: 1350,
    height: 700,
    canvas: canvasExt,
    backgroundColor: 'rgba(0, 0, 0, 0)',
    // Menor que 1 baja la calidad pero aumenta el rendimiento, puede ser util para modo de bajo rendimiento
    // Mayor que 1 hace que se vea mucho mejor pero tiene mucho impacto en el rendimiento
    resolution: 1,
    orientatssion: 'LANDSCAPE',
    // scene: [sceneComprobar,sceneComprobarFase1,scenePreguntas],
    scene: {
        preload: preload,
        create: create,
        update: update,

    },
    parentIsWindow: false,
    // plugins: {
    //     global: [{
    //         key: 'GameScalePlugin',
    //         plugin: Phaser.Plugins.GameScalePlugin,
    //         mapping: 'gameScale',
    //         data: {
    //             mode: "fit",
    //         }
    //     }]
    // }
};

// VARIABLES GLOBALES
//var game = new Phaser.Game(config);
//var game;
//var stage = 0; ya esta definido en  js inicio.js
var extintorState = 0;
var centr_lab = $grupo;

function preload() {
    this.load.baseURL = odir + '/extintor/';
    this.load.atlas('extintor', 'extintor.png', 'extintor.json');
    this.load.image('basurero', 'basurero.png');
    this.load.image('basureroR', 'basureroR.png');
    this.load.image('cocina', 'cocina.png');
    this.load.image('cocinaR', 'cocinaR.png');
    this.load.image('corriente', 'corriente.png');
    this.load.image('corrienteR', 'corrienteR.png');
    this.load.image('extract', 'extract.png');
    this.load.image('extractR', 'extractR.png');
    this.load.image('laptop', 'laptop.png');
    this.load.image('laptopR', 'laptopR.png');
    this.load.image('microhondas', 'microhoondas.png');
    this.load.image('microhondasR', 'microhoondasR.png');
}

function create() {
    var scene = this;
    var respuestasGlobalP1 = [];
    var respuestasGlobalP2 = [];
    var rect;
    var a, b, c, d, k;
    var co2, pqs, acetato;
    var count;
    var originalX, originalY;
    var ilus;
    var selectedGameObject;

    if(centr_lab === "oficina"){
        var stages = [{
            respuestaPaso1: 0,
            respuestasPaso2: [1],
            ilustracion: 'basurero',
            ilustracionR: 'basureroR'
        },{
            respuestaPaso1: 2,
            respuestasPaso2: [0, 1],
            ilustracion: 'laptop',
            ilustracionR: 'laptopR'
        },{
            respuestaPaso1: 2,
            respuestasPaso2: [0, 1],
            ilustracion: 'corriente',
            ilustracionR: 'corrienteR'
        },{
            respuestaPaso1: 1,
            respuestasPaso2: [0, 1],
            ilustracion: 'cocina',
            ilustracionR: 'cocinaR'
        },{
            respuestaPaso1: 3,
            respuestasPaso2: [2],
            ilustracion: 'extract',
            ilustracionR: 'extractR'
        }];
       
    }else{
        var stages = [{
            respuestaPaso1: 0,
            respuestasPaso2: [1],
            ilustracion: 'basurero',
            ilustracionR: 'basureroR'
        },{
            respuestaPaso1: 2,
            respuestasPaso2: [0, 1],
            ilustracion: 'microhondas',
            ilustracionR: 'microhondasR'
        },{
            respuestaPaso1: 2,
            respuestasPaso2: [0, 1],
            ilustracion: 'corriente',
            ilustracionR: 'corrienteR'
        },{
            respuestaPaso1: 1,
            respuestasPaso2: [0, 1],
            ilustracion: 'cocina',
            ilustracionR: 'cocinaR'
        },{
            respuestaPaso1: 3,
            respuestasPaso2: [2],
            ilustracion: 'extract',
            ilustracionR: 'extractR'
        }];
    }

    extintorGame(stages[stage].ilustracion, stages[stage].respuestaPaso1, stages[stage].respuestasPaso2, stages[stage].ilustracionR);

    function extintorGame(ilustracion, respuestaPaso1, respuestasPaso2, ilustracionR) {
        respuestasGlobalP1 = respuestaPaso1;
        respuestasGlobalP2 = respuestasPaso2;

        //ilus = scene.add.image(game.config.width * 0.5, game.config.height * 0.5, ilustracion);
        ilus = scene.add.image(game.config.width * 0.5, 169, ilustracion).setOrigin(0.5,0);
        ilus.alpha = 0;
        ilusR = scene.add.image(game.config.width * 0.5, 169, ilustracionR).setOrigin(0.5,0);
        ilusR.alpha = 0;

        count = 1;
        a = scene.add.image(-1000, (168 + 43), 'extintor', 'a.png').setInteractive({ useHandCursor: true });
        b = scene.add.image(-1000, 254 + 43, 'extintor', 'b.png').setInteractive({ useHandCursor: true });
        c = scene.add.image(-1000, 340 + 43, 'extintor', 'c.png').setInteractive({ useHandCursor: true });
        d = scene.add.image(-1000, 427 + 43, 'extintor', 'd.png').setInteractive({ useHandCursor: true });
        k = scene.add.image(-1000, 513 + 43, 'extintor', 'k.png').setInteractive({ useHandCursor: true });

        co2 = scene.add.image(2350, 167 + 70, 'extintor', 'co2.png').setInteractive({ useHandCursor: true }).disableInteractive();
        pqs = scene.add.image(2350, 314 + 70, 'extintor', 'pqs.png').setInteractive({ useHandCursor: true }).disableInteractive();
        acetato = scene.add.image(2350, 461 + 70, 'extintor', 'acetato.png').setInteractive({ useHandCursor: true }).disableInteractive();

        var objects = [a, b, c, d, k, co2, pqs, acetato];

        objects.forEach(function (object) {
            object.depth = 10;
            object.on('pointerover', function () {
                scene.add.tween({
                    targets: object,
                    scaleX: 1.1,
                    scaleY: 1.1,
                    duration: 300,
                    ease: 'Power2'
                });
            });
            object.on('pointerout', function () {
                object.depth = 1;
                scene.add.tween({
                    targets: object,
                    scaleX: 1,
                    scaleY: 1,
                    duration: 300,
                    ease: 'Power2'
                });
            });
            object.on('pointerdown', function () {
                object.depth = 1;
                scene.add.tween({
                    targets: object,
                    scaleX: 0.9,
                    scaleY: 0.9,
                    duration: 300,
                    ease: 'Power2'
                });
            });
        });

        var timeline = scene.tweens.createTimeline();
        timeline.add({
            targets: [a, b, c, d, k],
            x: 105 + 83,
            duration: 500,
            ease: 'Power2'
        });
        timeline.add({
            targets: [co2, pqs, acetato],
            x: 1079 + 83,
            duration: 500,
            ease: 'Power2'
        });
        timeline.add({
            targets: ilus,
            alpha: 1,
            duration: 1000,
            ease: 'Power2'
        });

        rect = ilus.getBounds();
        timeline.play();
        scene.input.setDraggable(a);
        scene.input.setDraggable(b);
        scene.input.setDraggable(c);
        scene.input.setDraggable(d)
        scene.input.setDraggable(k);
    }

    scene.input.on('dragstart', function (pointer, gameObject) {
        originalX = gameObject.x;
        originalY = gameObject.y;
        selectedGameObject = gameObject;
    });
    scene.input.on('drag', function (pointer, gameObject, dragX, dragY) {
        gameObject.x = dragX;
        gameObject.y = dragY;
        gameObject.depth = 2;
    });
    scene.input.on('dragend', function (pointer, gameObject) {
        gameObject.depth = 1;
        if (extintorState == 0) {
            switch (respuestasGlobalP1) {
                case 0:
                    if (insideRect(gameObject, rect)) {
                        if (gameObject == a) {
                            popUp('correcto');
                            var obj = [a, b, c, d, k]
                            removeObj(obj, -1);
                            scene.input.setDraggable(co2);
                            scene.input.setDraggable(acetato);
                            scene.input.setDraggable(pqs);
                        } else {
                            popUp('incorrecto');
                            tweenBack(gameObject, originalX, originalY);
                        }
                    } else {
                        tweenBack(gameObject, originalX, originalY);
                    }
                    break;
                case 1:
                    if (insideRect(gameObject, rect)) {
                        if (gameObject == b) {
                            popUp('correcto');
                            var obj = [a, b, c, d, k]
                            removeObj(obj, -1);
                            scene.input.setDraggable(co2);
                            scene.input.setDraggable(acetato);
                            scene.input.setDraggable(pqs);
                        } else {
                            popUp('incorrecto');
                            tweenBack(gameObject, originalX, originalY);
                        }
                    } else {
                        tweenBack(gameObject, originalX, originalY);
                    }
                    break;
                case 2:
                    if (insideRect(gameObject, rect)) {
                        if (gameObject == c) {
                            popUp('correcto');
                            var obj = [a, b, c, d, k]
                            removeObj(obj, -1);
                            scene.input.setDraggable(co2);
                            scene.input.setDraggable(acetato);
                            scene.input.setDraggable(pqs);
                        } else {
                            popUp('incorrecto');
                            tweenBack(gameObject, originalX, originalY);
                        }
                    } else {
                        tweenBack(gameObject, originalX, originalY);
                    }
                    break;
                case 3:
                    if (insideRect(gameObject, rect)) {
                        if (gameObject == d) {
                            popUp('correcto');
                            var obj = [a, b, c, d, k]
                            removeObj(obj, -1);
                            scene.input.setDraggable(co2);
                            scene.input.setDraggable(acetato);
                            scene.input.setDraggable(pqs);
                        } else {
                            popUp('incorrecto');
                            tweenBack(gameObject, originalX, originalY);
                        }
                    } else {
                        tweenBack(gameObject, originalX, originalY);
                    }
                    break;
                case 4:
                    if (insideRect(gameObject, rect)) {
                        if (gameObject == k) {
                            popUp('correcto');
                            var obj = [a, b, c, d, k]
                            removeObj(obj, -1);
                            scene.input.setDraggable(co2);
                            scene.input.setDraggable(acetato);
                            scene.input.setDraggable(pqs);
                        } else {
                            popUp('incorrecto');
                            tweenBack(gameObject, originalX, originalY);
                        }
                    } else {
                        tweenBack(gameObject, originalX, originalY);
                    }
                    break;
            }
        }
        if (extintorState == 1) {
            if (insideRect(gameObject, rect)) {

                if (gameObject == co2) {
                    if (respuestasGlobalP2.includes(0)) {
                        if (count < respuestasGlobalP2.length) {
                            removeObj([co2], 1);
                            count++;
                        } else {
                            popUp('correcto', ilus);
                        }
                    } else {
                        tweenBack(gameObject, originalX, originalY);
                        popUp('incorrecto');
                    }
                }

                if (gameObject == pqs) {
                    if (respuestasGlobalP2.includes(1)) {
                        if (count < respuestasGlobalP2.length) {
                            removeObj([pqs], 1);
                            count++;
                        } else {
                            popUp('correcto', ilus);
                        }
                    } else {
                        tweenBack(gameObject, originalX, originalY);
                        popUp('incorrecto');
                    }
                }

                if (gameObject == acetato) {
                    if (respuestasGlobalP2.includes(2)) {
                        if (count < respuestasGlobalP2.length) {
                            removeObj([acetato], 1);
                            count++;
                        } else {
                            popUp('correcto', ilus);
                        }
                    } else {
                        tweenBack(gameObject, originalX, originalY);
                        popUp('incorrecto');
                    }
                }

            } else {
                tweenBack(gameObject, originalX, originalY);
            }
        }
    });
    function insideRect(gameObject, rect) {
        if (gameObject.x >= rect.x && gameObject.x <= rect.x + rect.width && gameObject.y >= rect.y && gameObject.y <= rect.y + rect.height) {
            return true;
        } else {
            return false;
        }
    }
    function tweenBack(gameObject, x, y) {
        gameObject.disableInteractive();
        scene.add.tween({
            targets: gameObject,
            x: x,
            y: y,
            duration: 500,
            ease: 'Power2',
            onComplete: function () {
                gameObject.setInteractive();
            }
        });
    }
    function removeObj(targets, val) {
        // Val es 1 o -1 para que sea 1000 o -1000 y el objeto se vaya a la derecha o a la izquierda
        scene.add.tween({
            targets: targets,
            x: 2500 * val,
            duration: 500,
            ease: 'Power2',
            onComplete: function () {
                targets.forEach(function (element) {
                    element.destroy();
                });
            }
        });
    }
    function popUp(image, ilustracion) {
        console.log(image);
        var objects = [a, b, c, d, k, co2, pqs, acetato];
        objects.forEach(function (element) {
            element.disableInteractive();
        });
        var objects = [a, b, c, d, k, co2, pqs, acetato];
        objects.forEach(function (element) {
            try {
                element.setInteractive();
            } catch (error) {
                // nada
            }
        });
        if (image == 'correcto') {            
            if (extintorState == 0) {
                extintorState = 1;
            } else {
                if (ilustracion != null) {
                    extintorState = 0;
                }
            } 
            playSound(window.bien);   
        }else{
            playSound(window.audioCrash);
            removeObj(objects, 1);
            extintorState = 0;
            game.destroy();
            playSound(window.audioCrash);
            $PowerUps[$ActPwrUp - 1].visible = 200;
            $('#pregMal').stop().delay(300).fadeIn(300);
        }
        if (ilustracion != null) {
            if (count < respuestasGlobalP2.length - 1) {
                removeObj([selectedGameObject], 1);
                count++;
            } else {
                var obj = [co2, acetato, pqs];
                removeObj(obj, 1);
                setTimeout(function(){
                    activarevent();
                }, 3000);
                ilusR.alpha = 1;
                function activarevent() {
                    $PowerUps[$ActPwrUp - 1].visible = -1;
                    $('#icoPel_' + $ActPwrUp).hide();
                    $('#icoPrev_' + $ActPwrUp).show();
                    $("#pregBien").stop().delay(300).fadeIn(300);
                    aumentaPtos1();
                    extintorState = 0;
                    game.destroy();
                    ilustracion.destroy();
                }
            }
        }
    }
}





function update(){

}
