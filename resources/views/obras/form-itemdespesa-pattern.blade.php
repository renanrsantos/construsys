{{
Form::formGroup([
    Form::hidden('iditemdepesa[]',$item ? $item->iditemdepesa : ''),
    Html::col(
        Form::validate(
            Form::inputConsulta('cadastros','produto',['value-id'=> $item ? $item->produto->idproduto : '','value'=>$item ? $item->produto->prddescricao : ''])
        )
    ,'6'),
    Html::col(
        Form::validate(
            Form::text('itdquantidade[]',$item ? $item->itdquantidade : ''),
            Form::label('itdquantidade[]','Quantidade')
        )
    ,'2'),
    Html::col(
        Form::validate(
            Form::text('itdvalorunitario[]',$item ? $item->itdvalorunitario : ''),
            Form::label('itdvalorunitario[]','Valor Unitário')
        )
    ,'2'),
    Html::col(
        Html::tag('div',Form::label('Ações'),['class'=>'text-center']) . 
        Html::tag('div',
            Form::buttonGroup([
                Form::button('',['icon'=>'fa fa-minus','color'=>'info','title'=>'Remover','data-action'=>'remover','class'=>$item ? 'sr-only' : '']),
                Form::button('',['icon'=>'fa fa-plus','color'=>'info','title'=>'Adicionar','data-action'=>'replicar','data-from'=>'.itemdespesa-pattern','data-append'=>'#itens'])
            ])
        ,['class'=>'text-center'])
    ,'2')
  ],['class'=>$pattern ? 'sr-only itemdespesa-pattern' : ''])
}}