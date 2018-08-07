$( document ).ready(function() {
    console.log( "ready!" );
    console.log(bdir);    
    $('.aceptar').click(function () {
        $.post(bdir + 'ajax/init_calificacion').done(function (data) {
            console.log("Init nivel: " + data);
        }); 
    });
});