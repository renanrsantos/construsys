<link rel="icon" href="favicon.ico" type="image/x-icon"/>

<!-- Fonts -->
<!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->

<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/jquery.flexdatalist.min.css"/>
<link rel="stylesheet" href="css/datatables.bootstrap.css"/>
<link rel="stylesheet" href="css/jquery.gantt.css"/>
<!--<link rel="stylesheet" href="css/jquery.minimizemodal.css">-->
<link rel="stylesheet" href="css/construsys.css">
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.flexdatalist.min.js"></script>
<script type="text/javascript" src="js/jquery.datatables.min.js"></script>
<script type="text/javascript" src="js/datatables.bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.mask.js"></script>
<script type="text/javascript" src="js/vindicate.js"></script>
<!--<script type="text/javascript" src="js/moment.min.js"></script>-->
<script type="text/javascript" src="js/jquery.gantt.js"></script>
<!--<script type="text/javascript" src="js/jquery.minimizemodal.js"></script>-->
<script type="text/javascript" src="js/construsys.js"></script>

@if(isset($moduloSelecionado))
    @php 
        $jsModulo = '/js'.$moduloSelecionado->modpath.'.js'; 
    @endphp
    @if(file_exists(public_path() .'/'.$jsModulo))
        <script type="text/javascript" src="{{URL::asset($jsModulo)}}"></script>
    @endif
@endif