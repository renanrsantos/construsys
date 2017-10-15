<div style="background-color: #00CCFF">
    <div class="col-md-4 col-md-offset-4" style="margin-top: 100px;">
        <div class="panel panel-primary">
            <div class="panel-heading"><h4>Login</h4></div>
            <div class="panel-body">
                {{ Form::open(array('url' => 'login','class'=>'form-horizontal')) }}
                    <!-- if there are login errors, show them here -->
                    @if (count($errors) > 0)
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    {{ Form::hidden('redirect',Request::url())}}
                    <div class="form-group">
                        <label for="usulogin" class="control-label sr-only">Login</label>
                        <div class="col-md-8 col-md-offset-2">
                        {{ Form::text('usulogin',
                                    Input::old('usulogin'), 
                                    array('placeholder' => 'Usuário',
                                        'class'=>'form-control',
                                        'required'=>'true')
                                ) 
                        }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ususenha" class="control-label sr-only">Senha</label>
                        <div class="col-md-8 col-md-offset-2">
                        {{ Form::password('ususenha', array('placeholder'=>'Senha', 'class'=>'form-control','required'=>'true')) }}
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-5 col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                  {{ Form::checkbox('lembrar') }} Lembrar-me
                                </label>
                            </div>
                        </div>

                        {{ Form::button('Entrar&nbsp;<i class="fa fa-sign-in"></i>', array('class' => 'btn btn-primary','type'=>'submit')) }}
                    </div>
                {{ Form::close() }}
            </div>
            <div class="panel-footer"><small class=""><i class="fa fa-copyright"></i> 2017 Construsys. Todos os direitos reservados</small></div>
        </div>
    </div>
</div>