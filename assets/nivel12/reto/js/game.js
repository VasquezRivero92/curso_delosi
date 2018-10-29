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
var $GR = $grup;
var objects;

console.log($GR);

function preload() {
    this.load.baseURL = odir + '/auxilio/';
    this.load.atlas('auxilio', 'auxilio.png', 'auxilio.json');

    this.load.image('O_a1', 'O_a1.png');
    this.load.image('O_a2', 'O_a2.png');
    this.load.image('O_a3', 'O_a3.png');
    this.load.image('O_a4', 'O_a4.png');
    this.load.image('O_a5', 'O_a5.png');

    this.load.image('P_a1', 'P_a1.png');
    this.load.image('P_a2', 'P_a2.png');
    this.load.image('P_a3', 'P_a3.png');
    this.load.image('P_a4', 'P_a4.png');
    this.load.image('P_a5', 'P_a5.png');

    this.load.image('R_a1', 'R_a1.png');
    this.load.image('R_a2', 'R_a2.png');
    this.load.image('R_a3', 'R_a3.png');
    this.load.image('R_a4', 'R_a4.png');
    this.load.image('R_a5', 'R_a5.png');

    this.load.image('D_a1', 'D_a1.png');
    this.load.image('D_a2', 'D_a2.png');
    this.load.image('D_a3', 'D_a3.png');
    this.load.image('D_a4', 'D_a4.png');
    this.load.image('D_a5', 'D_a5.png');
}

function create() {
    var scene = this;
    var respuestasGlobalP1 = [];
    var respuestasGlobalP2 = [];
    var rect;
    var a, b, c, d, e, f, g, h, i, j;
    var count;
    var originalX, originalY;
    var ilus;
    var selectedGameObject;

    var stages = [{
        respuestaPaso1: ['a','b'],
        ilustracion: $GR+'_a1',
    },{
        respuestaPaso1: ['c','d'],
        ilustracion: $GR+'_a2',
    },{
        respuestaPaso1: ['g','h'],
        ilustracion: $GR+'_a3',
    },{
        respuestaPaso1: ['e','f'],
        ilustracion: $GR+'_a4',
    },{
        respuestaPaso1: ['i','j'],
        ilustracion: $GR+'_a5',
    }];

    extintorGame(stages[stage].ilustracion, stages[stage].respuestaPaso1);

    function extintorGame(ilustracion, respuestaPaso1) {
        respuestasGlobalP1 = respuestaPaso1;

        //ilus = scene.add.image(game.config.width * 0.5, game.config.height * 0.5, ilustracion);
        ilus = scene.add.image(-1000, 75, ilustracion).setOrigin(0,0);
        ilus.alpha = 0;
        // ilusR = scene.add.image(game.config.width * 0.5, 169, ilustracionR).setOrigin(0.5,0);
        // ilusR.alpha = 0;

        count = 1;
        switch (stage) {
            case 0:
              crearObjetos(true,true,false,false,true,true,false,false,true,true);
            break;
            case 1:
              crearObjetos(true,false,true,true,true,true,true,false,false,false);
            break;
            case 2:
              crearObjetos(true,true,false,true,true,false,true,true,false,false);
            break;
            case 3:
              crearObjetos(false,false,true,true,true,true,false,false,true,true);
            break;
            case 4:
              crearObjetos(true,true,false,false,true,true,false,false,true,true);
            break;
        }
        function crearObjetos(a,b,c,d,e,f,g,h,i,j){
            objects = [];
            var positiones = [{x:762, y:255},{x:942, y:255},{x:1121, y:255},{x:762, y:456},{x:942, y:456},{x:1121, y:456}];

            if(a){ 
                var index = Math.floor(Math.random() * positiones.length) + 0;  
                a = scene.add.image(positiones[index].x, positiones[index].y, 'auxilio', 'opc_1.png').setInteractive({ useHandCursor: true }); 
                positiones.splice(index,1);
                a.setDataEnabled();
                a.data.set('nombre','a');
                objects.push(a);
            }
            if(b){ 
                var index = Math.floor(Math.random() * positiones.length) + 0;  
                b = scene.add.image(positiones[index].x, positiones[index].y, 'auxilio', 'opc_2.png').setInteractive({ useHandCursor: true }); 
                positiones.splice(index,1);
                b.setDataEnabled();
                b.data.set('nombre','b');
                objects.push(b);}
            if(c){ 
                var index = Math.floor(Math.random() * positiones.length) + 0;  
                c =  scene.add.image(positiones[index].x, positiones[index].y, 'auxilio', 'opc_3.png').setInteractive({ useHandCursor: true }); 
                positiones.splice(index,1);
                c.setDataEnabled();
                c.data.set('nombre','c');
                objects.push(c);}
            if(d){ 
                var index = Math.floor(Math.random() * positiones.length) + 0;  
                d = scene.add.image(positiones[index].x, positiones[index].y,'auxilio', 'opc_4.png').setInteractive({ useHandCursor: true }); 
                positiones.splice(index,1);
                d.setDataEnabled();
                d.data.set('nombre','d');
                objects.push(d);}
            if(e){ 
                var index = Math.floor(Math.random() * positiones.length) + 0;  
                e = scene.add.image(positiones[index].x, positiones[index].y, 'auxilio', 'opc_5.png').setInteractive({ useHandCursor: true }); 
                positiones.splice(index,1);
                e.setDataEnabled();                
                e.data.set('nombre','e');                                
                objects.push(e);
            }
            if(f){
                var index = Math.floor(Math.random() * positiones.length) + 0;  
                f = scene.add.image(positiones[index].x, positiones[index].y, 'auxilio', 'opc_6.png').setInteractive({ useHandCursor: true }); 
                positiones.splice(index,1);
                f.setDataEnabled();
                f.data.set('nombre','f');                
                objects.push(f);}       
            if(g){
                var index = Math.floor(Math.random() * positiones.length) + 0;  
                g = scene.add.image(positiones[index].x, positiones[index].y, 'auxilio', 'opc_7.png').setInteractive({ useHandCursor: true }); 
                positiones.splice(index,1);
                g.setDataEnabled();
                g.data.set('nombre','g');                
                objects.push(g);
            } 
            if(h){
                var index = Math.floor(Math.random() * positiones.length) + 0;  
                h = scene.add.image(positiones[index].x, positiones[index].y, 'auxilio', 'opc_8.png').setInteractive({ useHandCursor: true }); 
                positiones.splice(index,1);
                h.setDataEnabled();
                h.data.set('nombre','h');                
                objects.push(h);
            }
            if(i){
                var index = Math.floor(Math.random() * positiones.length) + 0;  
                i = scene.add.image(positiones[index].x, positiones[index].y, 'auxilio', 'opc_9.png').setInteractive({ useHandCursor: true }); 
                positiones.splice(index,1);
                i.setDataEnabled();
                i.data.set('nombre','i');                
                objects.push(i);
            }
            if(j){
                var index = Math.floor(Math.random() * positiones.length) + 0;  
                j = scene.add.image(positiones[index].x, positiones[index].y, 'auxilio', 'opc_10.png').setInteractive({ useHandCursor: true }); 
                positiones.splice(index,1);
                j.setDataEnabled();
                j.data.set('nombre','j');
                objects.push(j);
            } 
        }

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
            scene.input.setDraggable(object);
        });

        var timeline = scene.tweens.createTimeline();
        timeline.add({
            targets: objects,
            duration: 500,
            ease: 'Power2'
        });
        timeline.add({
            targets: ilus,
            x: 92,
            alpha: 1,
            duration: 500,
            ease: 'Power2',
            onComplete: function(){
                rect = ilus.getBounds();
                var graphics = scene.add.graphics();
            }
        });
        timeline.play();
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
            if (insideRect(gameObject, rect)) {
                if (respuestasGlobalP1.includes(gameObject.data.get('nombre'))) {
                    if (count < respuestasGlobalP1.length) {
                        removeObj(gameObject, 1);
                        count++;
                    } else { popUp('correcto', ilus); }
                } else {
                    tweenBack(gameObject, originalX, originalY);
                    popUp('incorrecto');
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
        scene.add.tween({
            targets: targets,
            x: 2500 * val,
            duration: 500,
            ease: 'Power2',
            onComplete: function () {
               
                    targets.destroy();
                
            }
        });
    }
    function popUp(image, ilustracion) {
        // var objects = [a, b, c, d, e, f, g, h, i, j];
        objects.forEach(function (element) {
            element.disableInteractive();
        });
        // var objects = [a, b, c, d, e, f, g, h, i, j];
        objects.forEach(function (element) {
            try { element.setInteractive();
            } catch (error) {  }
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
            if (count < respuestasGlobalP1.length - 1) {
                removeObj([selectedGameObject], 1);
                count++;
            } else {
                // var obj = [a, b, c, d, e, f, g, h, i, j];
                removeObj(objects, 1);
                setTimeout(function(){
                    activarevent();
                }, 500);
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
