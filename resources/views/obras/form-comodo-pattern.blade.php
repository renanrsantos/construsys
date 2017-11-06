{{Form::formGroup([
    Form::hidden('idcomodo[]',$comodo ? $comodo->idcomodo : ''),
    Html::col(
        Form::validate(
            Form::inputConsulta('obras','tipocomodo',[
                'value-id'=>$comodo ? $comodo->idtipocomodo : '',
                'value'=>$comodo ? $comodo->tipoComodo->tconome : ''
            ],['id'=>'idtipocomodo[]'])
        )
    ,'3'),
    Html::col(
        Form::validate(
            Form::text('comdescricao[]',$comodo ? $comodo->comdescricao : ''),
            Form::label('comdescricao[]','Descrição')
        )
    ,'5'),
    Html::col(
        Form::validate(
            Form::text('comtamanho[]',$comodo ? $comodo->comtamanho : '',['data-vindicate'=>'decimal']),
            Form::label('comtamanho[]','Tamanho (m²)')
        )
    ,'2'),
    Html::col(
        Html::tag('div',Form::label('Ações'),['class'=>'text-center']) . 
        Html::tag('div',
            Form::buttonGroup([
                Form::button('',['icon'=>'fa fa-trash','color'=>'info','title'=>'Remover','data-action'=>'remover','data-id'=>'idcomodo','data-confirm'=>'Deseja realmente excluir este cômodo?','data-url'=>url(Request::segment(1).'/modulo/obras/rotina/comodo/excluir')]),
                Form::button('',['icon'=>'fa fa-plus','color'=>'info','title'=>'Adicionar','data-action'=>'replicar','data-from'=>'.comodo-pattern','data-append'=>'#comodos'])
            ])
        ,['class'=>'text-center'])
    ,'2')
  ],['class'=>$pattern ? 'sr-only comodo-pattern' : ''])
}}