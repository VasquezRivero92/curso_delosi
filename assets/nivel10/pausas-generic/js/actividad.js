function Actividades(){
	var num = [];
	var Pos = [];
	var correctCards = [];
	var PileCant = [];
	var SlotCant = [];
	var $win = [null,true,true,true];
	var cl = { x:0,y:0 };
	var toporg;
	var leftorg;
	var $this = this;

	var puntos = 0;
	var sumaPuntos, estrellas;

	
/*********************************************************************************/
/************************* funciones publicas ************************************/
/*********************************************************************************/
	$this.show = function show(NA){
		$this.ReiniciarActividad(NA);
		$("#Actividad"+NA).fadeIn(1000);
		$('#pregMal').removeClass('EndTime');
	}
/*********************************************************************************/
    $this.ResetActividad = function ResetActividad(RE){
        for( var i = 1; i <= 6; i++ ){
            reinicioCard(i); ReiniciarEscena(i);
			console.log('reiniciado escena',i);
			$("#icon_"+i).removeClass("check ok");
        }
        // if( RE < 7 ){ reinicioCard(RE); ReiniciarEscena(RE); }
        // $win[RE] = true;
    }
	$this.ReiniciarActividad = function ReiniciarActividad(RE){
		if( RE < 7 ){ reinicioCard(RE); ReiniciarEscena(RE); }
		$win[RE] = true;
		$('#pregMal').removeClass('EndTime');
	}
/*********************************************************************************/
	$this.init = function init(){
		for( var i = 1; i <= 6; i++ ){
			correctCards[i] = 0;
			PileCant[i] = $("#cardPile"+i+" .dato"+i).length;
			SlotCant[i] = $("#cardSlots"+i+" .cTiempo"+i).length;
			var PosTemp = [];
			var numTemp = [];
			for( j = 1; j <= PileCant[i]; j++ ){
				var defaults = { left:$("#dato"+i+"_"+j).css("left"),top:$("#dato"+i+"_"+j).css("top") }
				PosTemp.push(defaults); numTemp.push(j);
			}
			Pos[i] = PosTemp; num[i] = numTemp;
			ReiniciarEscena(i);
		}
	};
/*********************************************************************************/
/************************* funciones privadas ************************************/
/*********************************************************************************/
	function ReiniciarEscena(RE){
		correctCards[RE] = 0;
		num[RE].sort( function() { return Math.random() - 0.5 } );
		Pos[RE].sort( function() { return Math.random() - 0.5 } );
		for( var i = 0; i < PileCant[RE]; i++ ){
			$("#Actividad"+RE+" #dato"+RE+"_"+num[RE][i]).data('number',num[RE][i]).css({ "left":Pos[RE][i].left, "top":Pos[RE][i].top }).draggable({
				containment:'#content',
				stack:"#Actividad"+RE+" #cardPile"+RE+" div",
				revert:false,
				start: function(e,ui){
					leftorg = $(this).css("left"); toporg = $(this).css("top");
					cl.x = e.clientX; cl.y = e.clientY;
				},
				drag: function(e,ui){
					var original = ui.originalPosition;
					ui.position = {
						left:(e.clientX-cl.x+original.left)/$scaleActual,
						top:(e.clientY-cl.y+original.top)/$scaleActual
					};
				},
				stop: function(e,ui){	
					if ($(this).hasClass("correct")){
						$(this).draggable('disable');
					}else{
						$(this).animate({"left":leftorg,"top":toporg},500);
					}
				}
			});
		}
		for( var i = 1; i <= SlotCant[RE]; i++ ){
			$("#Actividad"+RE+" #cTiempo"+RE+"_"+i).data("number",i).droppable({
				accept: "#Actividad"+RE+" #cardPile"+RE+" div",
				hoverClass: "hovered",
				drop:function(event,ui){
                    $("#pregWindow").fadeIn(500);
					var slotNumber = $(this).data('number');
					var cardNumber = ui.draggable.data('number');
                    if( slotNumber != cardNumber ){ 
                        //$win[RE] = false; 
                        playFX(window.audioCrash);
                        $("#pregMal").fadeIn(500);
						$("#icon_"+RE).addClass("check");
                    }else{
                        playFX(window.audioCatch);
                        $("#pregBien").fadeIn(500);
						$("#icon_"+RE).addClass('ok');
					}
					myCounter.stop();
                    ui.draggable.addClass('correct');
                    if( parseInt(RE,10) == 2 ) ui.draggable.addClass("pos"+slotNumber);
                    // var dropleft = $(this).css("left");
                    // var droptop = $(this).css("top");
                    // ui.draggable.css({"left":dropleft,"top":droptop});
                    //correctCards[RE]++;
                    //playSound(window.audioPower);
                    // if( correctCards[RE] >= PileCant[RE] ){
                    //     if( $win[RE] ){ animacionGanaste(RE); }
                    //     else{ animacionPerdiste(RE); }
                    // }
				}
			});
		}
	}
/*********************************************************************************/
	function reinicioCard(RE){
		for( var i = 1; i <= PileCant[RE]; i++ ){
			$("#dato"+RE+"_"+i).draggable("enable").removeClass().addClass("dato"+RE+" ui-draggable");
		}
		for( var i = 1; i <= SlotCant[RE]; i++ ){
			$("#cTiempo"+RE+"_"+i).removeClass().addClass("cTiempo"+RE+" ui-droppable").html("");
		}
	}
/*********************************************************************************/
	// function animacionGanaste(NA){
	// 	setTimeout(function(){ $("#winActividad").fadeIn(1500); },500);
	// 	setTimeout(function(){
	// 		$("#winActividad").fadeOut(1500);
	// 		$(".Actividad").hide();
	// 		if( NA >= 3 ){ showInicio(); }
	// 		else{
	// 			var newAct = parseInt(NA,10) + 1;
	// 			$Actividades.show(newAct);
	// 		}
	// 	 },6000);
	// }
	// function animacionPerdiste(NA){
	// 	setTimeout(function(){ $("#loseActividad").fadeIn(1500); },500);
	// 	setTimeout(function(){
	// 		$("#loseActividad").fadeOut(1500);
	// 		$this.ReiniciarActividad(NA);
	// 	},6000);
    // }
/*********************************************************************************/
/*********************************************************************************/
}


function resultadoPuntos(punts) {
    puntos = punts;
    $('#resumenPuntaje').html(puntos);
    var data = {puntaje: puntos, estrellas: estrellas, check : true};
    $.post(bdir + 'ajax/set_puntaje', data).done(function (data) {
        console.log("resultado: " + data);
    });

    if(puntos >= 70){
        $('#i4Certificado').removeClass('disabled');
    }

}

function pantallafinal(){
	stopBGMusic();
	//playFX(window["BGWin"]);
	$("#capaResumen, #caratulaFin1").fadeIn(500);
    $.post(bdir + 'ajax/init_calificacion').done(function (data) {
       console.log("calificacion: " + data);
       if(data == 0){
        $('#calificacion').stop().fadeIn(1000);
       }else{
        $('#calificacion').stop().fadeOut(1000);
       }
    });

}


function Countdown(options) {
	var timer,
	instance = this,
	seconds = options.seconds || 10,
	updateStatus = options.onUpdateStatus || function () {},
	counterEnd = options.onCounterEnd || function () {};
	function decrementCounter() {
	  updateStatus(seconds);
	  if (seconds<=9) {
		$("#CSeg").html('0'+seconds);
	  }else{$("#CSeg").html(seconds);}
	  if (seconds === 0) {
		counterEnd();
		instance.stop();
	  }
	  seconds--;
	}
	this.start = function () {
	  clearInterval(timer);
	  timer = 0;
	  seconds = options.seconds;
	  timer = setInterval(decrementCounter, 1000);
	};
	this.stop = function () {
	  clearInterval(timer);
	};
  }