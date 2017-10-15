@push('javascript')
<script>
	$('[data-toggle="tooltip"]').each(function(){
        $(this).tooltip({
            title: $(this).attr('title'),
            placement : $(this).data('placement')
        });
    });

    $('body').on('click','[data-action="novo"]',function(){
        $('#comodos').append($('.input-pattern').first().html());
    });

    $('body').on('click','[data-action="remover"]',function(){
        var div = $(this).closest('.input-pattern');
        if($('#comodos .input-pattern').length > 1){
            div.remove();    
        }
    });	
</script>
@endpush