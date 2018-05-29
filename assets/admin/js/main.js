/*******************************************************************************/
$(document).ready(function () {
    $('.btnupdate').click(function () {
        var id = parseInt($(this).attr('id').split('-')[1], 10);
        var value = $('#selcur-' + id + ' option:selected').val();
        $('#loadupdate-' + id).show();
        $(this).addClass('loading');
        $('#selcur-' + id).prop('disabled', 'disabled');
        var data = {id: id, value: value};
        $.post(bdir + 'ajaxadm/set_curso', data).done(function (data) {
            //console.log("resultado: "+data);
            $('#loadupdate-' + id).hide();
            $('#btnupdate-' + id).removeClass('loading');
            $('#selcur-' + id).prop('disabled', false);
        });
    });
});
/*******************************************************************************/