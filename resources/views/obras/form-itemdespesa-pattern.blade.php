{{
Form::formGroup([
    Form::hidden('iditemdespesa[]',$item ? $item->iditemdespesa : ''),
    Html::col(
        Form::validate(
            Form::inputConsulta('cadastros','produto',['value-id'=> $item ? $item->produto->idproduto : '','value'=>$item ? $item->produto->prddescricao : '','data-main'=>'.form-group'],
                ['props'=>'idproduto,prddescricao,unmsigla,prdvalorunitario',
                 'propsAlt'=>'idproduto[],prddescricao,unmsigla,itdvalorunitario[]',
                 'id'=>'idproduto[]'])
        )
    ,'6'),
    Html::col(
        Form::validate(
            Form::text('itdquantidade[]',$item ? $item->itdquantidade : '',['data-vindicate'=>'format:decimal']),
            Form::label('itdquantidade[]','Quantidade')
        )
    ,'2'),
    Html::col(
        Form::validate(
            Form::text('itdvalorunitario[]',$item ? $item->itdvalorunitario : '',['data-vindicate'=>'format:decimal']),
            Form::label('itdvalorunitario[]','Valor Unitário')
        )
    ,'2'),
    Html::col(
        Html::tag('div',Form::label('Ações'),['class'=>'text-center']) . 
        Html::tag('div',
            Form::buttonGroup([
                Form::button('',['icon'=>'fa fa-minus','color'=>'info','title'=>'Remover','data-action'=>'remover','class'=>$item ? 'sr-only' : '','tabindex'=>'-1']),
                Form::button('',['icon'=>'fa fa-plus','color'=>'info','title'=>'Adicionar','data-action'=>'replicar','data-from'=>'.itemdespesa-pattern','data-append'=>'#itens','datalist'=>'true'])
            ])
        ,['class'=>'text-center'])
    ,'2')
  ],['class'=>$pattern ? 'sr-only itemdespesa-pattern' : ''])
}}
