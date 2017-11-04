<link rel="icon" href="{{URL::asset('favicon.ico')}}" type="image/x-icon"/>
<!-- Fonts -->
<!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->

<link rel="stylesheet" href="{{URL::asset('css/ext/bootstrap.min.css')}}"/>
<link rel="stylesheet" href="{{URL::asset('css/ext/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/ext/jquery.flexdatalist.min.css')}}"/>
<link rel="stylesheet" href="{{URL::asset('css/ext/datatables.bootstrap.css')}}"/>
<link rel="stylesheet" href="{{URL::asset('css/ext/jquery.gantt.css')}}"/>
<!--<link rel="stylesheet" href="{{URL::asset('css/ext/jquery.minimizemodal.css')}}">-->
<link rel="stylesheet" href="{{URL::asset('css/construsys.css')}}">
<script type="text/javascript" src="{{URL::asset('js/ext/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/ext/popper.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/ext/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/ext/jquery.flexdatalist.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/ext/jquery.datatables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/ext/datatables.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/ext/jquery.mask.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/ext/vindicate.js')}}"></script>
<!--<script type="text/javascript" src="{{URL::asset('js/ext/moment.min.js')}}"></script>-->
<script type="text/javascript" src="{{URL::asset('js/ext/jquery.gantt.js')}}"></script>
<!--<script type="text/javascript" src="js/ext/jquery.minimizemodal.js')}}"></script>-->
<script type="text/javascript" src="{{URL::asset('js/construsys.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/filtro.js')}}"></script>

@if(isset($moduloSelecionado))
    @php 
        $jsModulo = '/js/modulos/'.$moduloSelecionado->modpath.'.js'; 
    @endphp
    @if(file_exists(public_path() .'/'.$jsModulo))
        <script type="text/javascript" src="{{URL::asset($jsModulo)}}"></script>
    @endif
@endif