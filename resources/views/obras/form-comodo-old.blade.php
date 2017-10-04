<!--idcomodo,idtipocomodo,comdescricao,comtamanho-->
@foreach($record->comodos as $comodo)
    {{Form::formGroup([
        Form::hidden('idcomodo[]',$comodo->idcomodo),
        Html::col(
            Form::validate(
                Form::select('idtipocomodo[]',$comodo->tipoComodo->getTiposComodo(),$comodo->idtipocomodo),
                Form::label('idtipocomodo[]','Tipo')
            )
        ,'2'),
        Html::col(
            Form::validate(
                Form::text('comdescricao[]',$comodo->comdescricao),
                Form::label('comdescricao[]','Descrição')
            )
        ,'5'),
        Html::col(
            Form::validate(
                Form::text('comtamanho[]',$comodo->comtamanho),
                Form::label('comtamanho[]','Tamanho (m²)')
            )
        ,'2'),
        Html::col(
            Html::tag('div',Form::label('Ações'),['class'=>'text-center']) . 
            Html::tag('div',
                Form::buttonGroup([
                    Form::button('',['icon'=>'fa fa-trash','color'=>'info','title'=>'Remover']),
                    Form::button('',['icon'=>'fa fa-pencil','color'=>'info','title'=>'Alterar'])
                ])
            ,['class'=>'text-center'])
        ,'2')
      ])
    }}
@endforeach