@include('obras.form-comodo-pattern',['comodo'=>null,'pattern'=>true])
@foreach($record->comodos as $comodo)
    @include('obras.form-comodo-pattern',['comodo'=>$comodo,'pattern'=>false])
@endforeach
@include('obras.form-comodo-pattern',['comodo'=>null,'pattern'=>false])