<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
        <script>
var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
function init() {
    canvas = document.getElementById("canvas");
    anim_container = document.getElementById("animation_container");
    dom_overlay_container = document.getElementById("dom_overlay_container");
    var comp=AdobeAn.getComposition("4BBD3DAD411B4E3185F410FBD46734F1");
    var lib=comp.getLibrary();
    var loader = new createjs.LoadQueue(false);
    loader.installPlugin(createjs.Sound);
    loader.addEventListener("complete", function(evt){handleComplete(evt,comp)});
    var lib=comp.getLibrary();
    loader.loadManifest(lib.properties.manifest);
}
function handleComplete(evt,comp) {
    //This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
    var lib=comp.getLibrary();
    var ss=comp.getSpriteSheet();
    var queue = evt.target;
    var ssMetadata = lib.ssMetadata;
    for(i=0; i<ssMetadata.length; i++) {
        ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
    }
    exportRoot = new lib.drag_DropPausas();
    stage = new lib.Stage(canvas);  
    //Registers the "tick" event listener.
    fnStartAnimation = function() {
        stage.addChild(exportRoot);
        createjs.Ticker.setFPS(lib.properties.fps);
        createjs.Ticker.addEventListener("tick", stage);
    }       
    //Code to support hidpi screens and responsive scaling.
    function makeResponsive(isResp, respDim, isScale, scaleType) {      
        var lastW, lastH, lastS=1;      
        window.addEventListener('resize', resizeCanvas);        
        resizeCanvas();     
        function resizeCanvas() {           
            var w = lib.properties.width, h = lib.properties.height;            
            var iw = window.innerWidth, ih=window.innerHeight;          
            var pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;          
            if(isResp) {                
                if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {                    
                    sRatio = lastS;                
                }               
                else if(!isScale) {                 
                    if(iw<w || ih<h)                        
                        sRatio = Math.min(xRatio, yRatio);              
                }               
                else if(scaleType==1) {                 
                    sRatio = Math.min(xRatio, yRatio);              
                }               
                else if(scaleType==2) {                 
                    sRatio = Math.max(xRatio, yRatio);              
                }           
            }           
            canvas.width = w*pRatio*sRatio;         
            canvas.height = h*pRatio*sRatio;
            canvas.style.width = dom_overlay_container.style.width = anim_container.style.width =  w*sRatio+'px';               
            canvas.style.height = anim_container.style.height = dom_overlay_container.style.height = h*sRatio+'px';
            stage.scaleX = pRatio*sRatio;           
            stage.scaleY = pRatio*sRatio;           
            lastW = iw; lastH = ih; lastS = sRatio;            
            stage.tickOnUpdate = false;            
            stage.update();            
            stage.tickOnUpdate = true;      
        }
    }
    makeResponsive(true,'both',true,1); 
    AdobeAn.compositionLoaded(lib.properties.id);
    fnStartAnimation();
}
function playSound(id, loop) {
    return createjs.Sound.play(id, createjs.Sound.INTERRUPT_EARLY, 0, 0, loop);
}
</script>
 <script type="text/javascript">
            var bdir = '<?php echo base_url(); ?>';
            var odir = '<?php echo base_url($own_dir); ?>';
            var grup = '<?php echo strtoupper(substr($this->session->grupo, 0, 1)); ?>';
            var win = <?php echo $this->session->win; ?>;
</script>
 <script src="<?php echo base_url($own_dir . '/createjs-2015.11.26.min.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/drag_Drop_Pausas.js?1532028448341'); ?>"></script>
        
    </head>
    <style>
  #animation_container {
    position:absolute;
    margin:auto;
    left:0;right:0;
  }
</style>
    
    <body onload="init();" style="margin:0px;">
        <div id="animation_container" style="background-color:rgba(255, 255, 204, 1.00); width:1350px; height:700px">
        <canvas id="canvas" width="1350" height="700" style="position: absolute; display: block; background-color:rgba(255, 255, 204, 1.00);"></canvas>
        <div id="dom_overlay_container" style="pointer-events:none; overflow:hidden; width:1350px; height:700px; position: absolute; left: 0px; top: 0px; display: block;">
        </div>
    </div>
    </body>
</html>