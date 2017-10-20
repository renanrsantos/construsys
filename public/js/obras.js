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

$(document).ready(function(){
   $('body').on('blur', '#itdvalorunitario\\[\\]',function(){
       calcValorTotal('[name="itdvalorunitario\\[\\]"]','[name="itdquantidade\\[\\]"]','[name="dsovalortotal"]');
   });
   
   $('body').on('blur', '#itdquantidade\\[\\]',function(){
       calcValorTotal('[name="itdvalorunitario\\[\\]"]','[name="itdquantidade\\[\\]"]','[name="dsovalortotal"]');
   });
});