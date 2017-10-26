{{
    Html::tag('div',
        Html::panel('Login',
        [
//            Html::listGroup($errors->all(),'danger'),
            Form::open(array('url' => 'login','class'=>'form-horizontal')),
            Form::formGroup([
                Html::col(
                    Form::validate(
                        Form::text('usulogin',null,['data-vindicate'=>'required']),
                        Form::label('usulogin','Usuário')
                    )
                ,'12')
            ]),
            Form::formGroup([
                Form::validate(
                        Form::password('ususenha', null,['data-vindicate'=>'required']),
                        Form::label('ususenha','Senha')
                    )
                ,'12')
            ]),
            Html::tag('div',
                Form::formGroup([
                    Form::checkbox('lembrar',1,null,['label'=>'Lembrar-me','class'=>'chk-ativo'])
                ],[],false).
                Form::formGroup([
                    Html::link(url('/forget'),'Esqueci minha senha')
                ],[],false)
            ,['class'=>'text-center']),
            Form::button('Entrar', ['class' => 'btn-block','color'=>'primary','type'=>'submit','icon'=>'fa fa-sign-in']),
            Form::close()
        ],
        Html::icon('fa fa-copyright').date('Y').' '.Html::link('http://construsys.com.br','Construsys').'. Todos os direitos reservados',
        ['color'=>'primary']),
    ['class'=>'text-center'])
}}