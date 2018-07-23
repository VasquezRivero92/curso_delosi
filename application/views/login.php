<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="icon" href="images/favicon.ico" /> -->
        <link rel="stylesheet" href="<?php echo base_url($assets_dir . '/fonts/style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url($assets_dir . '/css/reset.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url($own_dir . '/css/style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url($own_dir . '/css/mediastyle.css'); ?>">
        <script src="<?php echo base_url($assets_dir . '/js/prefixfree.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url($assets_dir . '/js/jquery-ui.js'); ?>"></script>
        <script type="text/javascript">
            var bdir = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo base_url($own_dir . '/js/parallax.min.js'); ?>"></script>
        <script src="<?php echo base_url($own_dir . '/js/main.js'); ?>"></script>
        <title>Login - <?php echo $this->config->item('site_title', 'ion_auth'); ?></title>
    </head>
    <body>
        <div id="fullcont">
            <div id="opti-cont" class="container <?php echo $iewindow; ?>">
                <div class="row"><img src="<?php echo base_url($own_dir . '/images/opti.png'); ?>" alt=""/></div>
            </div>
            <div id="login-cont" class="container <?php echo $iewindow; ?>">
                <!-- <header id="header" class="row"></header> -->
                <div id="ctr_parallax">
                    <div data-depth="0.02"><div id="nubes1_mc" class="nube_anim"></div></div>
                    <div data-depth="0.03"><div id="nubes2_mc" class="nube_anim2"></div></div>
                    <div data-depth="0.02" id="edificios_mc"></div>
                    <div data-depth-x="-0.03" id="edif1_mc"></div>
                    <div data-depth-x="0.04" id="edif2_mc"></div>
                    <div data-depth-x="-0.05" id="edif3_mc"></div>
                    <div data-depth-x="0.06" id="grass1_mc"></div>
                    <div data-depth="-0.1" id="grass2_mc"></div>
                    <div data-depth="0.2" id="grass3_mc"></div>
                    <div data-depth="-0.1" id="personas_mc"></div>
                </div>
                <div id="logo_mc" class="row"></div>
                <div class="row">
                    <?php echo form_open('/login', $form_open); ?>
                    <?php echo form_input($username); ?>
                    <?php echo form_input($password); ?>
                    <div id="openForgot">Olvidé mi contraseña</div>
                    <?php echo form_submit($submit); ?>
                    <?php echo form_close(); ?>
                </div>
                <!--<p><?php echo $message; ?></p>-->
            </div>
            <div class="container"><footer id="footer"></footer></div>
            <div id="popForgot" class="container">
                <?php echo form_open('/login', $form_forgot); ?>
                <div id="btnClose">X</div>
                <p id="f-msg"></p>
                <?php echo form_input($forgotten); ?>
                <?php echo form_input($frun); ?>
                <div id="formReset">
                    <?php echo form_input($fcode); ?>
                    <?php echo form_input($new_password); ?>
                    <?php echo form_input($new_password_confirm); ?>
                    <?php echo form_input($fchange); ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </body>
</html>