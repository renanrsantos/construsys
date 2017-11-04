function calcValorTotal(inputVlrUnit, inputQuantidade, inputVlrTotal){
    $(inputVlrTotal).val(0);
    for(var i = 0; i < $(inputVlrUnit).length; i++){
        if($(inputVlrUnit).eq(i).val() !== '' && $(inputQuantidade).eq(i).val() !== ''){
            var qtd = parseFloat($(inputQuantidade).eq(i).val()),
                vlrUnit = parseFloat($(inputVlrUnit).eq(i).val()),
                vlrTotal = parseFloat($(inputVlrTotal).val()) + (qtd * vlrUnit);
            $(inputVlrTotal).val(vlrTotal.toFixed(2));            
        }
    }
}

function validaDataFaseObra(field){
    var dataFim = field.element.val(),
        dataIni = field.element.closest('.form-group')
            .find('#'+field.id.replace('fsodataprevistafim','fsodatainicio')).val();
    if(dataFim !== "" && dataFim < dataIni){
        field.validationSoftFail = true;
        field.validationMessage = "A data deve ser superior à data de início.";
    }
}

$(document).ready(function(){
   $('body').on('blur', '#itdvalorunitario\\[\\]',function(){
       calcValorTotal('[name="itdvalorunitario\\[\\]"]','[name="itdquantidade\\[\\]"]','[name="dsovalortotal"]');
   });
   
   $('body').on('blur', '#itdquantidade\\[\\]',function(){
       calcValorTotal('[name="itdvalorunitario\\[\\]"]','[name="itdquantidade\\[\\]"]','[name="dsovalortotal"]');
   });
});