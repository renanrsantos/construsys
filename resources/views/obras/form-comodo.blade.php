<?php
    $url = explode('/', Request::url());
    $url[9] = 'comodo';
    $url[10] = 'data';
    $url = implode('/', $url);
?>
<script>
    montaDataTable($('#tb-comodo'));
</script>
<div class="form-group col-12">
    <table id="tb-comodo" class="table table-bordered table-hover table-sm" scrollY='200' url="{{$url}}" data="idobra={{$record->idobra}}"></table>
</div>
