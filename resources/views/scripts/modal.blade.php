<script type='text/javascript'>
    $('{{$content}} .flexdatalist').each(function () {
        var readonly = $(this).prop('readonly');
        if (!readonly) {
            $(this).flexdatalist();
        }
    });
    $('{{$content}} .disable-all :input').prop('disabled', true);
    $('{{$content}} .disable-all :button').prop('disabled', true);
    $('{{$content}} [data-dismiss="modal"]').prop('disabled',false);
    
    $('{{$content}} form[data-toggle="validator"]').each(function(){
        $(this).vindicate("init");
        $(this).prop('submited',false);
    });
</script>