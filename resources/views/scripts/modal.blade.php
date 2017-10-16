<script type='text/javascript'>
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
</script>