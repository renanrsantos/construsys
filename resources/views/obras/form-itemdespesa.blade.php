@include('obras.form-itemdespesa-pattern',['item'=>null,'pattern'=>true])
@foreach($despesa->itens as $item)
    @include('obras.form-itemdespesa-pattern',['item'=>$item,'pattern'=>false])
@endforeach
@include('obras.form-itemdespesa-pattern',['item'=>null,'pattern'=>false])