@extends('layouts.modal')

@section('header')
	Despesa da Obra
@endsection
@section('body')

@php
	$obra = $obra ? $obra : $record->obra;
@endphp
	{{
		Html::navTabs([
			[
	          	'link'=>'despesa',
	          	'label'=>'Despesa',
	          	'tab'=> Form::formGroup([
							Form::hidden('iddespesaobra',$record->iddespesaobra),
							Form::hidden('idobra',$obra->idobra),
							Html::col(
								Form::validate(
									Form::date('dsodata',$record->dsodata,['data-vindicate'=>'required']),
									Form::label('dsodata','Data')
								)
							,'4'),
							Html::col(
								Form::validate(
									Form::select('dsotipo',[''=>'',1=>'Manual',2=>'Por Item'],$record->dsotipo,['data-vindicate'=>'required'],[''=>['disabled','selected']]),
									Form::label('dsodata','Tipo')
								)
							,'4'),
							Html::col(
								Form::validate(
									Form::text('dsovalortotal',$record->dsovalortotal,['data-vindicate'=>'required|format:decimal',$record->dsotipo != 2 ? '' : 'disabled']),
									Form::label('dsovalortotal','Valor Total')
								)
							,'4')
						]) .
						Form::formGroup([
							Html::col(
								Form::validate(
									Form::select('idfaseobra',$obra->fasesObraAsArray(),$record->idfaseobra,['data-vindicate'=>'required'],[''=>['disabled','selected']]),
									Form::label('idfaseobra','Fase da Obra')
								)
							,'6'),
							Html::col(
								Form::validate(
									Form::select('idcomodo',$obra->comodosAsArray(),$record->idcomodo),
									Form::label('idcomodo','Cômodo')
								)
							,'6')
						]) .
						Form::formGroup([
							Html::col(
								Form::validate(
									Form::textarea('dsoobs',$record->dsoobs,['rows'=>5]),
									Form::label('dsoobs','Observação')
								)
							,'12')
						])

	        ],
	        [
	        	'link'=>'itens',
	        	'label'=>'Itens da Desesa',
	        	'tab'=> View::make('obras.form-itemdespesa',['despesa'=>$record])->render()
	        ]
		])
	}}
<script>
	@if($record->dsotipo !== 2)
		$('[href="#itens"]').addClass('disabled').attr('disabled','disabled');
	@endif

	$('[name="dsotipo"]').on('change',function(){
		var tabItens = $('[href="#itens"]'),
			campoValor = $('[name="dsovalortotal"]');
		if($(this).val() == '2'){
			tabItens.removeClass('disabled').attr('disabled','');
			if(!campoValor.attr('disabled')){
				campoValor.addClass('disabled').attr('disabled','disabled');
				campoValor.closest('form').vindicate('get').findById(campoValor.prop('id')).required = false;
			}
		} else{
			if(!tabItens.hasClass('disabled')){
				tabItens.addClass('disabled').attr('disabled','disabled');
			}
			campoValor.removeClass('disabled').attr('disabled',false);	
			campoValor.closest('form').vindicate('get').findById(campoValor.prop('id')).required = true;
		} 
	});
</script>
@endsection
