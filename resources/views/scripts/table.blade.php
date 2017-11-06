<script>
    montaDataTable($('#{{$id}}').find('#{{$table}}'),$('#{{$id}}').find('#fr-registros-{{$table}}').serialize());
    atualizaBotoes($('#{{$id}}').find('#fr-registros-{{$table}}'));
    inicializaForms($('#{{$id}}').find('form'));
</script>