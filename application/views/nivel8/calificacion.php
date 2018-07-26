<!doctype html>
<html>
    <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
            <script type="text/javascript">
                var bdir = '<?php echo base_url(); ?>';
                var odir = '<?php echo base_url($own_dir); ?>';
            </script> 
            <link rel="stylesheet" href="<?php echo base_url($own_dir . '/css/style.css'); ?>">     
            <script src="<?php echo base_url($assets_dir . '/js/prefixfree.min.js'); ?>"></script>
            <script src="<?php echo base_url($assets_dir . '/js/jquery-1.11.0.min.js'); ?>"></script>
            <script src="<?php echo base_url($assets_dir . '/js/jquery-ui.js'); ?>"></script>
            <script src="<?php echo base_url($assets_dir . '/js/jquery.ui.touch-punch.min.js'); ?>"></script>
            <script src="<?php echo base_url($own_dir . '/js/libs/panicoLoader.js'); ?>"></script>
            <script src="<?php echo base_url($assets_dir . '/js/owl.carousel.min.js'); ?>"></script>                       
            <script src="<?php echo base_url($own_dir . '/js/inicio.js'); ?>"></script>
            <script src="<?php echo base_url($own_dir . '/js/sonido.js'); ?>"></script>
    </head>
   

<body>
<div id="wrapper" class="formulario1">

<form action="" method="post">
<p><?php echo $pregunta;?></p>
<p class="clasificacion">
<input id="radio1" type="radio" name="calificacion1" value="5">
<label for="radio1">★</label>
<input id="radio2" type="radio" name="calificacion1" value="4">
<label for="radio2">★</label>
<input id="radio3" type="radio" name="calificacion1" value="3">
<label for="radio3">★</label>
<input id="radio4" type="radio" name="calificacion1" value="2">
<label for="radio4">★</label>
<input id="radio5" type="radio" name="calificacion1" value="1">
<label for="radio5">★</label>
</p>
<p><input type="submit" value="submit" name="submit1"></p>
</form>
</div>

<div id="wrapper" class="formulario2">

<form action="" method="post">
<p><?php echo $pregunta;?></p>
<p class="clasificacion">
<input id="radio6" type="radio" name="calificacion2" value="5">
<label for="radi6">★</label>
<input id="radio7" type="radio" name="calificacion2" value="4">
<label for="radio7">★</label>
<input id="radio8" type="radio" name="calificacion2" value="3">
<label for="radio8">★</label>
<input id="radio9" type="radio" name="calificacion2" value="2">
<label for="radio9">★</label>
<input id="radio10" type="radio" name="calificacion2" value="1">
<label for="radio10">★</label>
</p>
<p><input type="submit" value="submit" name="submit2"></p>
</form>
</div>

<div id="wrapper" class="formulario3">

<form action="" method="post">
<p><?php echo $pregunta;?></p>
<p class="clasificacion">
<input id="radio1" type="radio" name="calificacion" value="5">
<label for="radio1">★</label>
<input id="radio2" type="radio" name="calificacion" value="4">
<label for="radio2">★</label>
<input id="radio3" type="radio" name="calificacion" value="3">
<label for="radio3">★</label>
<input id="radio4" type="radio" name="calificacion" value="2">
<label for="radio4">★</label>
<input id="radio5" type="radio" name="calificacion" value="1">
<label for="radio5">★</label>
</p>
<p><input type="submit" value="submit" name="submit"></p>
</form>
</div>

<div id="wrapper" class="formulario4">

<form action="" method="post">
<p><?php echo $pregunta;?></p>
<p class="clasificacion">
<input id="radio1" type="radio" name="calificacion" value="5">
<label for="radio1">★</label>
<input id="radio2" type="radio" name="calificacion" value="4">
<label for="radio2">★</label>
<input id="radio3" type="radio" name="calificacion" value="3">
<label for="radio3">★</label>
<input id="radio4" type="radio" name="calificacion" value="2">
<label for="radio4">★</label>
<input id="radio5" type="radio" name="calificacion" value="1">
<label for="radio5">★</label>
</p>
<p><input type="submit" value="submit" name="submit"></p>
</form>
</div>

<div id="wrapper" class="formulario5">

<form action="" method="post">
<p><?php echo $pregunta;?></p>
<p class="clasificacion">
<input id="radio1" type="radio" name="calificacion" value="5">
<label for="radio1">★</label>
<input id="radio2" type="radio" name="calificacion" value="4">
<label for="radio2">★</label>
<input id="radio3" type="radio" name="calificacion" value="3">
<label for="radio3">★</label>
<input id="radio4" type="radio" name="calificacion" value="2">
<label for="radio4">★</label>
<input id="radio5" type="radio" name="calificacion" value="1">
<label for="radio5">★</label>
</p>
<p><input type="submit" value="submit" name="submit"></p>
</form>
</div>

<div>

</div>

</body></html>