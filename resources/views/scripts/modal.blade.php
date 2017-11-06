<script type='text/javascript'>
    $('#fr-{{$table}} .flexdatalist').each(function () {
        var readonly = $(this).prop('readonly');
        if (!readonly) {
            $(this).flexdatalist();
        }
    });
    $('#fr-{{$table}} .disable-all :input').prop('disabled', true).addClass('disabled');
    $('#fr-{{$table}} .disable-all :button').prop('disabled', true).addClass('disabled');
    $('#fr-{{$table}} [data-dismiss="modal"]').prop('disabled',false).removeClass('disabled');
    
    inicializaForms($('#fr-{{$table}}'));
</script>