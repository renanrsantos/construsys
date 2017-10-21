{{
    Html::tag('div',
        Html::panel('Login',
        [
            Html::listGroup($errors->all(),'danger'),
            Form::open(array('url' => 'login','class'=>'form-horizontal')),
            Form::formGroup([
                Form::text('usulogin',null,['label' => 'Usuário','required'])
            ]),
            Form::formGroup([
                Form::password('ususenha', null,['label'=>'Senha','required'])
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
    ['class'=>'col-md-4 col-md-offset-4'])
}}