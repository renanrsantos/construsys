<!--
    @section('breadcrumb')
        @if(Request::segment(1) === 'sistema' && count($errors) === 0)
            <ol class="breadcrumb">
                <li class="active">{{ucfirst(Request::segment(2))}}</li>
                <li class="{{ Request::segment(5) ? '' : 'active' }}">
                    <a href="{{url('sistema/'.Request::segment(2).'/rotina/'.Request::segment(4))}}">{{ucfirst(Request::segment(4))}}</a>
                </li>
                @if (Request::segment(5))
                    <li class="active">{{ucfirst(Request::segment(5))}}</li>
                    @if (Request::segment(6))
                        <li class="active">{{ucfirst(Request::segment(6))}}</li>
                    @endif
                @endif
            </ol>
        @endif
    @show
-->