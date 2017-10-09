@foreach($record->comodos as $comodo)
    {{Form::formGroup([
        Form::hidden('idcomodo[]',$comodo->idcomodo),
        Html::col(
            Form::validate(
                Form::select('idtipocomodo[]',$record->getTiposComodo(),$comodo->idtipocomodo),
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
                    Form::button('',['icon'=>'fa fa-trash','color'=>'info','title'=>'Remover','data-toggle'=>'tooltip','data-placement'=>'bottom','data-action'=>'remover']),
                    Form::button('',['icon'=>'fa fa-pencil','color'=>'info','title'=>'Alterar','data-toggle'=>'tooltip','data-placement'=>'bottom']),
                    Form::button('',['icon'=>'fa fa-plus','color'=>'info','title'=>'Novo','data-toggle'=>'tooltip','data-placement'=>'bottom','data-action'=>'novo'])
                ])
            ,['class'=>'text-center'])
        ,'2')
      ])
    }}
@endforeach
{{Html::tag('div',
Form::formGroup([
    Form::hidden('idcomodo[]'),
    Html::col(
        Form::validate(
            Form::select('idtipocomodo[]',$record->getTiposComodo()),
            Form::label('idtipocomodo[]','Tipo')
        )
    ,'2'),
    Html::col(
        Form::validate(
            Form::text('comdescricao[]'),
            Form::label('comdescricao[]','Descrição')
        )
    ,'5'),
    Html::col(
        Form::validate(
            Form::text('comtamanho[]'),
            Form::label('comtamanho[]','Tamanho (m²)')
        )
    ,'2'),
    Html::col(
        Html::tag('div',Form::label('Ações'),['class'=>'text-center']) . 
        Html::tag('div',
            Form::buttonGroup([
                Form::button('',['icon'=>'fa fa-trash','color'=>'info','title'=>'Remover','data-toggle'=>'tooltip','data-placement'=>'bottom','data-action'=>'remover']),
                Form::button('',['icon'=>'fa fa-pencil','color'=>'info','title'=>'Alterar','data-toggle'=>'tooltip','data-placement'=>'bottom']),
                Form::button('',['icon'=>'fa fa-plus','color'=>'info','title'=>'Novo','data-toggle'=>'tooltip','data-placement'=>'bottom','data-action'=>'novo'])
            ])
        ,['class'=>'text-center'])
    ,'2')
  ]),['class'=>'input-pattern'])
}}

<script>
    $('[data-toggle="tooltip"]').each(function(){
        $(this).tooltip({
            title: $(this).attr('title'),
            placement : $(this).data('placement')
        });
    });

    $('body').on('click','[data-action="novo"]',function(){
        $('#comodos').append($('.input-pattern').first().html());
    });

    $('body').on('click','[data-action="remover"]',function(){
        var div = $(this).closest('.input-pattern');
        if($('#comodos .input-pattern').length > 1){
            div.remove();    
        }
    });
</script>