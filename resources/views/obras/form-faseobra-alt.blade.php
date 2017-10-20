@include('obras.form-faseobra-pattern',['fase'=>null,'pattern'=>true])
@foreach($record->fasesObra as $fase)
    @include('obras.form-faseobra-pattern',['fase'=>$fase,'pattern'=>false])
@endforeach
@include('obras.form-faseobra-pattern',['fase'=>null,'pattern'=>false])