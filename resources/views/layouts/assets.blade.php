<link rel="icon" href="{{URL::asset('favicon.ico')}}" type="image/x-icon"/>
<!-- Fonts -->
<!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->

<link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}"/>
<link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/jquery.flexdatalist.min.css')}}"/>
<link rel="stylesheet" href="{{URL::asset('css/datatables.bootstrap.css')}}"/>
<link rel="stylesheet" href="{{URL::asset('css/jquery.gantt.css')}}"/>
<!--<link rel="stylesheet" href="{{URL::asset('css/jquery.minimizemodal.css')}}">-->
<link rel="stylesheet" href="{{URL::asset('css/construsys.css')}}">
<script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/jquery.flexdatalist.min.js')}}"></script>
<script type="text/javascript" src="js/jquery.datatables.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/datatables.bootstrap.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/jquery.mask.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('js/vindicate.js')}}"></script>
<!--<script type="text/javascript" src="{{URL::asset('js/moment.min.js')}}"></script>-->
<script type="text/javascript" src="{{URL::asset('js/jquery.gantt.js')}}"></script>
<!--<script type="text/javascript" src="js/jquery.minimizemodal.js')}}"></script>-->
<script type="text/javascript" src="{{URL::asset('js/construsys.js')}}"></script>

@if(isset($moduloSelecionado))
    @php 
        $jsModulo = '/js'.$moduloSelecionado->modpath.'.js'; 
    @endphp
    @if(file_exists(public_path() .'/'.$jsModulo))
        <script type="text/javascript" src="{{URL::asset($jsModulo)}}"></script>
    @endif
@endif