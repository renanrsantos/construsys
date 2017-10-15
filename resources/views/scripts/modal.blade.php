<script type='text/javascript'>
    $('[data-function="vindicate"]').on('input',function(){
        var form = $(this).closest('form');
        if(form.prop('submited')){
            form = form.vindicate("get");
            var id = $(this).attr("id");
            var field = form.findById(id);
            field.validate(form.options);
        }
    });
    $('.flexdatalist').each(function () {
        var readonly = $(this).prop('readonly');
        if (!readonly) {
            $(this).flexdatalist();
        }
    });
    $('.disable-all :input').prop('disabled', true);
    $('.disable-all :button').prop('disabled', true);
    $('[data-dismiss="modal"]').prop('disabled',false);

    $('form[data-toggle="validator"]').each(function(){
        $(this).vindicate("init");
        $(this).prop('submited',false);
    });
    $('[data-toggle="submit"]').on('click', function () {
        var form = $($(this).data('target'));
        var validado = form.vindicate("validate");
        form.prop('submited',true);
        if (validado) {
            var url = form.prop('action');
            var data = form.serialize();
            $.post(url, data, function (data) {
                switch (data.status) {
                    case 'ERRO':
                        $('#msg-fr-modal').html(data.msg);
                        break;
                    case 'OK' :
                        window.location.href = data.redirect;
                        break;
                }
            });
        } else {
            var firstInvalid = form.vindicate('get').firstInvalid.element;
            var closest = firstInvalid.closest('.tab-pane');
            var id = closest.attr('id');
            $('.nav a[href="#' + id + '"]').tab('show');
            firstInvalid.focus();
        }
    });
</script>