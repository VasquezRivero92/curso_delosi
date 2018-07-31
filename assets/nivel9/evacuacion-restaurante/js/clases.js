/*******************************************************************************/
function Lab_Juego() {
    // si no se realiza algun cambio, estos son los valores por defecto
    // puntos
    this.ptsWinJuego = 0; //ptos generados por acierto en el juego
    this.vidaInicial = 3;
    this.intentos = 3;
    this.puntajeAcierto = 20;
    this.contAciertos = 0;
    this.vidas = 3;
    // para el control de tiempo
    this.CTInicial = 90;
    this.CTiempo = 0;
    this.CMin = 0;
    this.CSeg = 0;
    //posicion de la escena del juego ( se carga en CalcularLimites )
    this.gameArea = 0;
    //posicion inicial del area de juego
    this.posInitX = null;
    this.posInitY = null;
    //posicion del area de juego
    this.posX = 0;
    this.posY = 0;
    //ancho y alto
    this.width = null;
    this.height = null;
    //posicion inicial del player
    this.posPlayerX = null;
    this.posPlayerY = null;
    this.mueveAreaX = function (plus) {
        this.posX = this.posX + plus;
        this.mueveGameArea();
    };
    this.mueveAreaY = function (plus) {
        this.posY = this.posY + plus;
        this.mueveGameArea();
    };
    this.mueveGameArea = function () {
        this.gameArea.css({"left": this.posX, "top": this.posY});
    };
}
/*******************************************************************************/
function Lab_Objeto(x, y, ancho, alto) {
    this.x = x;
    this.y = y;
    this.width = ancho;
    this.height = alto;
    this.enPantalla = function () {
        var PoxX = this.x + $J[$JAct].posX;
        var AbsX = PoxX + this.width;
        var PoxY = this.y + $J[$JAct].posY;
        var AbsY = PoxY + this.height;
        return!(AbsX <= -10 || PoxX >= 1360 || AbsY <= -10 || PoxY >= 710);
    };
}
/*******************************************************************************/
/*******************************************************************************************/
function Lab_Enemigo(x, y, ancho, alto, direccion) {
    Lab_Objeto.call(this, x, y, ancho, alto);
    this.id = 0;
    this.initX = x;
    this.initY = y;

    this.Pos_Anim = 0;
    this.Anim_counter = 0;
    this.Anim_rate = 0;
    this.CantSprites = 0;
    this.direccion = 0;

    this.PosSpriteX = 0;
    this.PosSpriteY = 0;

    this.movX = 0;
    this.movY = 0;
    this.durAnim = 0;
    this.delay = 0;
    this.tStep = 0;
    this.stepCounter = 0;
    this.stepArray = [];
    this.vKey = 0;
    this.dirMov = 0;

    this.hit = false;
    this.hitTime = 0;

    this.initSprite = function (id, CantSprites, Anim_rate) {
        this.id = $(id);
        if (CantSprites === undefined) {
            this.CantSprites = 4;
        } else {
            this.CantSprites = CantSprites;
        }
        if (Anim_rate === undefined) {
            this.Anim_rate = 5;
        } else {
            this.Anim_rate = Anim_rate;
        }

    }
    this.initMov = function (movX, movY, durAnim, delay) {
        this.movX = 0;
        this.movY = 0;
        this.durAnim = 0;
        this.delay = parseInt((delay / $delayTime), 10);
        MovTotal = Math.abs(this.movX) + Math.abs(this.movY);
        TimeHorz = this.durAnim * (Math.abs(this.movX) / MovTotal);
        TimeVert = this.durAnim * (Math.abs(this.movY) / MovTotal);
        stepHorz = parseInt((TimeHorz / $delayTime), 10);
        stepVert = parseInt((TimeVert / $delayTime), 10);
        dirX = this.movX / Math.abs(this.movX);
        dirY = this.movY / Math.abs(this.movY);
        if (this.movY)
            this.stepArray.push({x: 0, y: dirY, num: stepVert});
        if (this.movX)
            this.stepArray.push({x: dirX, y: 0, num: stepHorz});
        dirX = -1 * dirX;
        dirY = -1 * dirY;
        if (this.movY)
            this.stepArray.push({x: 0, y: dirY, num: stepVert});
        if (this.movX)
            this.stepArray.push({x: dirX, y: 0, num: stepHorz});
        this.tStep = stepHorz + stepVert;
        this.vKey = MovTotal / this.tStep;
        this.stepCounter = 0;
        this.dirMov = 0;
        if (this.movX > 0)
            this.direccion = 1;
        else if (this.movX < 0)
            this.direccion = 0;
        if (this.movY > 0)
            this.direccion = 2;
        else if (this.movY < 0)
            this.direccion = 3;
    }
    this.choque = function (tiempo) {
        /*
        if (tiempo === undefined) {
            this.hitTime = 75;
        } ///  1500/20
        else {
            this.hitTime = parseInt((tiempo / $delayTime), 10);
        }
        this.hit = true;
        this.id.addClass("hit");
        */
    }
    this.Move = function () {
        // timer del hit 
        /*
        if (this.hit) {
            if (this.hitTime > 0)
                this.hitTime--;
            if (this.hitTime == 1) {
                this.hit = false;
                this.id.removeClass("hit");
            }
        }
       
        // animacion del sprite
        this.Anim_counter++;
        if (this.Anim_counter >= this.Anim_rate) {
            this.Anim_counter = 0;
            this.Pos_Anim = (this.Pos_Anim + 1) % this.CantSprites;
        }
        this.PosSpriteX = this.width * this.Pos_Anim;
        this.PosSpriteY = this.height * this.direccion;
        this.id.css("background-position", "-" + this.PosSpriteX + "px -" + this.PosSpriteY + "px");
        // ejecucion del movimiento
        this.stepCounter++;
        var enMovimiento = true; */
        /*if (this.stepCounter > this.stepArray[this.dirMov].num) {
            if (this.stepCounter > (this.stepArray[this.dirMov].num + this.delay)) {
                this.stepCounter = 0;
                this.dirMov++;
                if (this.dirMov >= this.stepArray.length)
                    this.dirMov = 0;
                enMovimiento = true;
                if (this.stepArray[this.dirMov].y > 0)
                    this.direccion = 2;
                else if (this.stepArray[this.dirMov].y < 0)
                    this.direccion = 3;
                if (this.stepArray[this.dirMov].x > 0)
                    this.direccion = 1;
                else if (this.stepArray[this.dirMov].x < 0)
                    this.direccion = 0;
            } else {
                enMovimiento = false;
            }

        }
        if (enMovimiento) {
            this.x = this.x + (this.vKey * this.stepArray[this.dirMov].x);
            this.y = this.y + (this.vKey * this.stepArray[this.dirMov].y);
            this.z = Math.floor(this.y / 10);
        }*/
    }
    this.moveRemolino = function () {
        // timer del hit 
        if (this.hit) {
            if (this.hitTime > 0)
                this.hitTime--;
            if (this.hitTime == 1) {
                this.hit = false;
                this.id.removeClass("hit");
            }
        }
        if (this.x > -20 && this.x < 0) {
            this.id.addClass("hide");
        }
        if (this.x > 1490 && this.x <= 1500) {
            this.id.removeClass("hide");
        }
        if (this.x > -350) {
            this.x = this.x - this.vel;
            this.y = this.y + (2 * this.vert);
            this.z = Math.floor(this.y / 10);
            if (this.y < 100) {
                this.vert = 1;
            } else if (this.y > 600) {
                this.vert = -1;
            }
        } else {
            this.x = 1500 + Math.floor(Math.random() * 1000);
            this.y = 200 + Math.floor(Math.random() * 400);
            this.z = Math.floor(this.y / 10);
            this.vel = 3 + Math.floor(Math.random() * 3);
            this.vert = (Math.floor(Math.random() * 2) * 2) - 1;
            this.draw();
        }

    }
    this.controlHit = function () {
        /*
        if (PlayerMov.hittest(this) && !this.hit) {
            this.choque();
            PlayerMov.id.removeClass('animated flash');
            $J[$JAct].quitaVidas();
            playSound(window.audioCrash);

            // setTimeout(function () {
            //     PlayerMov.id.addClass('animated flash');
            // }, 1);
        }*/
    }
    this.draw = function () {
        this.id.css({"left": this.x + $J[$JAct].posX, "top": this.y + $J[$JAct].posY, "z-index": this.z});
    }
}
/*******************************************************************************/
function Lab_PowerUp(x, y, ancho, alto) {
    Lab_Objeto.call(this, x, y, ancho, alto);
    this.id = 0;
    this.timer = 0;
    this.hit = false;
    this.visible = false;

    this.draw = function (i) {
        if (i === undefined) {
            //console.log(i);
            this.id.css({"left": this.x + $J[$JAct].posX, "top": this.y + $J[$JAct].posY});
        } else {
            $("#escenaJuego" + $JAct + " .powerUp").eq(i).css({"left": this.x + $J[$JAct].posX, "top": this.y + $J[$JAct].posY});
        }
    }
}
/*******************************************************************************************/
    function Lab_Vidas(x, y) {
        Lab_Objeto.call(this, x, y, 0, 0);
        this.z = 0;
        this.sPos = 0;
        this.Anim_counter = 0;
        this.cargaPosDe = function (fuente) {
            this.x = fuente.x;
            this.y = fuente.y;
            this.z = fuente.z;
        }
    }

/*******************************************************************************************/

function Lab_Player() {
    Lab_Objeto.call(this, 0, 0, 0, 0);
    this.id = 0;
    this.spriteId = 0;
    this.areaPtje = 0;
    this.areaT20s = 0;
    this.z = 0; // trabaja con el z-index y el valor de "y", para el efecto 3D
    this.sprite = new Lab_Objeto(0, 0, 0, 0);
    this.vKey = 4;
// posicion inicial
    this.initX = 0;
    this.initY = 0;
// posicion relativa a la ventana web
    this.FPosX = 0;
    this.FPosY = 0;
// para el sprite
    this.defaultSprite = [0, 0, 0, 0, 0, 0, 0];
    this.Pos_Anim = 0;
    this.Anim_counter = 0;
    this.Anim_rate = 3;
    this.CantSprites = 8;
// posicion inicial (movimiento) del sprite
    this.PosSpriteX = 0;
// posicion inicial (vertical) del sprite
    this.PosSpriteY = 0;
// posicion del conjunto de animaciones
// esto se utiliza para el ultimo juego, 
// los primeros cuatro son para la niña sin libro
// y los siguientes cuatro son para la niña con libro
    this.ConjuntoSprite = 0;
// un booleando para saber si lleva algun libro o no
    this.llevaLibro = false;
// esto va segun la imagen (de arriba hacia abajo)
// por defecto esta como abajo: 0 > izquierda: 1 > derecha: 2 > arriba: 3
    this.$arrayDir = ["abajo", "izquierda", "derecha", "arriba"];
    this.dirSprite = 0;

    this.cargar = function () {
        this.spriteId = this.id.children(".sprite");
        //this.areaPtje = this.id.children(".ptje");
        this.areaT20s = this.id.children(".ptje20s");
       if (this.defaultSprite[$JAct]) {
            this.spriteId.css("background-image", this.defaultSprite[$JAct]);
        } else {
            this.defaultSprite[$JAct] = this.spriteId.css("background-image");
        }
        this.x = $J[$JAct].posPlayerX;
        this.y = $J[$JAct].posPlayerY;
        this.z = Math.floor(this.y / 10);
        this.FPosX = this.x + $J[$JAct].posX;
        this.FPosY = this.y + $J[$JAct].posY;

        this.width = this.id.width();
        this.height = this.id.height();

        this.sprite.width = this.spriteId.width();
        this.sprite.height = this.spriteId.height();
        this.vKey = 4;
        this.CantSprites = 8;
        this.PosSpriteX = 0;
        this.PosSpriteY = 0;
        this.ConjuntoSprite = 0;
        this.llevaLibro = false;
        this.dirSprite = 0;
        this.dirUpdate();
        // variables de control para la posicion del Player
        MaxX = $J[$JAct].width - this.width;
        MaxY = $J[$JAct].height - this.height;
        this.draw();
    };

    this.setX = function (x) {
        this.x = x;
        this.FPosX = this.x + $J[$JAct].posX;
        this.draw();
    };
    this.setY = function (y) {
        this.y = y;
        this.FPosY = this.y + $J[$JAct].posY;
        this.z = Math.floor(this.y / 10);
        this.draw();

    };

    this.cambiaX = function (plus) {
        if (this.FPosX <= 200 && plus < 0) {
            if ($J[$JAct].posX < 0) {
                $J[$JAct].mueveAreaX(-1 * plus);
            } else {
                this.FPosX = this.FPosX + plus;
            }
        } else if (this.FPosX + this.width >= 1150 && plus > 0) {
            var cond = $J[$JAct].width + $J[$JAct].posX;
            if (cond > 1350) {
                $J[$JAct].mueveAreaX(-1 * plus);
            } else {
                this.FPosX = this.FPosX + plus;
            }
        } else {
            this.FPosX = this.FPosX + plus;
        }
        this.x = this.x + plus;
        this.draw();
    };
    this.cambiaY = function (plus) {
        if (this.FPosY <= 350 && plus < 0) {
            if ($J[$JAct].posY < 200) {
                $J[$JAct].mueveAreaY(-1 * plus);
            } else {
                this.FPosY = this.FPosY + plus;
            }
        } else if (this.FPosY + this.height >= 500 && plus > 0) {
            var cond = $J[$JAct].height + $J[$JAct].posY;
            if (cond > 700) {
                $J[$JAct].mueveAreaY(-1 * plus);
            } else {
                this.FPosY = this.FPosY + plus;
            }
        } else {
            this.FPosY = this.FPosY + plus;
        }
        this.y = this.y + plus;
        this.z = Math.floor(this.y / 10);
        this.draw();
    };
    this.hittest = function (elmB, plusX, plusY) {
        if (plusX === undefined) { plusX = 0; }
        if (plusY === undefined) { plusY = 0; }
        var elmA_top = this.y + plusY;
        var elmA_height = elmA_top + this.height;
        var elmA_left = this.x + plusX;
        var elmA_width = elmA_left + this.width;
        var elmB_top = elmB.y;
        var elmB_height = elmB.y + elmB.height;
        var elmB_left = elmB.x;
        var elmB_width = elmB.x + elmB.width;

        return!(elmA_width < elmB_left ||
                elmB_width < elmA_left ||
                elmA_height < elmB_top ||
                elmB_height < elmA_top);
    };
    this.draw = function () {
        this.id.css({"left": this.FPosX, "top": this.FPosY, "z-index": this.z});
        $ParedMask1.ctx.drawImage($J[$JAct].canvasWall, 10 - PlayerMov.x, 10 - PlayerMov.y);
        //console.log(this.z);
    };
    /*********************  funciones del sprite *******************************/
    this.cambiaSprite = function (direccion) {
        for (var i = 0; i < this.$arrayDir.length; i++) {
            if (direccion == this.$arrayDir[i] && this.dirSprite != i) {
                this.dirSprite = i;
                this.PosSpriteY = (this.ConjuntoSprite * 4 + this.dirSprite) * this.sprite.height;
            }
        }
    };
    this.dirUpdate = function () {
        this.PosSpriteY = (this.ConjuntoSprite * 4 + this.dirSprite) * this.sprite.height;
        this.spriteId.css("background-position", "-" + this.PosSpriteX + "px -" + this.PosSpriteY + "px");
    };
    this.AnimaSprite = function () {
        this.Anim_counter++;
        if(this.Anim_counter >= this.Anim_rate) {
            this.Anim_counter = 0;
            this.Pos_Anim = (this.Pos_Anim + 1) % this.CantSprites;
        }
        this.PosSpriteX = this.sprite.width * (this.Pos_Anim + 1);
        if ($JAct != 2)
        this.spriteId.css("background-position", "-" + this.PosSpriteX + "px -" + this.PosSpriteY + "px");
    };
    this.StopSprite = function () {
        this.Anim_counter = 0;
        this.Pos_Anim = 0;
        this.PosSpriteX = 0;
        if ($JAct != 2)
        this.spriteId.css("background-position", "0px -" + this.PosSpriteY + "px");
    };
}
/*******************************************************************************/
// el circulo y los botones trabajan con valores offset
function Lab_Circulo(radio) {
    if (radio === undefined) { radio = 100; }
    Lab_Objeto.call(this, 0, 0, radio * 2, radio * 2);
    this.radio = radio;
    this.hit = false;
    this.hitPoint = function (x, y) {
        return !(x < this.x ||
                x > this.x + this.width ||
                y < this.y ||
                y > this.y + this.height);
    };
}
function Lab_Boton(x, y, ancho, alto) {
    Lab_Objeto.call(this, x, y, ancho, alto);
    this.hit = false;
    this.hitPoint = function (x, y) {
        return !(x < this.x ||
                x > this.x + this.width ||
                y < this.y ||
                y > this.y + this.height);
    };
}


/*******************************************************************************************/
/*******************************************************************************/