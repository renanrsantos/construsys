{{
Form::formGroup([
    Form::hidden('idfaseobra[]',$fase ? $fase->idfaseobra : ''),
    Html::col(
    	Form::validate(
            Form::inputConsulta('obras','fase',[
                'value-id'=>$fase ? $fase->idfase : '',
                'value'=>$fase ? $fase->fase->fsedescricao : ''
            ],['id'=>'idfase[]'])
        )
    ,'3'),
    Html::col(
        Form::validate(
            Form::date('fsodatainicio[]',$fase ? $fase->fsodatainicio : ''),
            Form::label('fsodatainicio[]','Data início')
        )
    ,'2'),
    Html::col(
        Form::validate(
            Form::date('fsodataprevistafim[]',$fase ? $fase->fsodataprevistafim : '',['data-vindicate'=>'function:validaDataFaseObra(this)']),
            Form::label('fsodataprevistafim[]','Data prev. fim')
        )
    ,'2'),
    Html::col(
    	Form::validate(
    		Form::textarea('fsoobservacao[]',$fase ? $fase->fsoobservacao : '',['rows'=>2]),
    		Form::label('fsoobservacao[]','Observação')
    	)
    ,'2'),
    Html::col(
    	Form::validate(
    		Form::text('fsoporcentagem[]',$fase ? $fase->fsoporcentagem : ''),
    		Html::tag('small',Form::label('fsoporcentagem[]','% da Obra'))
    	)
    ,'1 sr-only'),
    Html::col(
    	Form::validate(
    		Form::select('fsostatus[]',App\Http\Models\Obras\Faseobra::getStatusFase(),$fase ? $fase->fsostatus : ''),
    		Form::label('fsostatus[]','Status')
    	)
    ,'auto'),
    Html::col(
        Html::tag('div',Form::label('Ações'),['class'=>'text-center']) . 
        Html::tag('div',
            Form::buttonGroup([
                Form::button('',['icon'=>'fa fa-trash','color'=>'info','title'=>'Remover','data-action'=>'remover','data-id'=>'idfaseobra','data-confirm'=>'Deseja realmente excluir esta fase?','data-url'=>url(Request::segment(1).'/modulo/obras/rotina/faseobra/excluir')]),
                Form::button('',['icon'=>'fa fa-plus','color'=>'info','title'=>'Adicionar','data-action'=>'replicar','data-from'=>'.fase-pattern','data-append'=>'#fases'])
            ])
        ,['class'=>'text-center'])
    ,'1')
  ],['class'=>$pattern ? 'sr-only fase-pattern' : ''])
}}