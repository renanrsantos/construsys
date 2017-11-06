function setFiltro(table) {
    $('[expanded="true"]').each(function(){
        var checkboxes = $($(this).closest('.multiselect').find('.ms-checkboxes'));
        checkboxes.css('display','none');
        $(this).attr('expanded','false');
    });
    carregaDados(table);
}

function clearOperador(main){
    main.find('.operador-filtro').removeClass('sr-only').html('');
}

function clearValor(main){
    main.find('.valor-filtro').removeClass('sr-only').html('');
}

function setOperadorByType(main,type){
    var operador = $('<select></select>').attr('name','operador-filtro[]')
        .attr('id','operador-filtro[]').addClass('form-control form-control-sm');
    clearOperador(main);
    switch(type){
        case 'string':
            operador.append($('<option></option>').val('%%').html('Contém'));
            operador.append($('<option></option>').val('%').html('Inicia com'));
            operador.append($('<option></option>').val('=').html('Igual'));
            break;
        case 'int':
        case 'date':
            operador.append($('<option></option>').val('=').html('Igual'));
            operador.append($('<option></option>').val('<>').html('Diferente'));
            operador.append($('<option></option>').val('>').html('Maior que'));
            operador.append($('<option></option>').val('<').html('Menor que'));
            operador.append($('<option></option>').val('>=').html('Maior ou Igual'));
            operador.append($('<option></option>').val('<=').html('Menor ou Igual'));
            operador.append($('<option></option>').val('in').html('Contido em'));
            break;
        case 'boolean':
            main.find('.operador-filtro').addClass('sr-only');
            operador.append($('<option></option>').val('=').attr('selected',true));
            break;
        case 'multi':
            main.find('.operador-filtro').addClass('sr-only');
            operador.append($('<option></option>').val('in').attr('selected',true));
            break;
    }
    main.find('.operador-filtro').append(operador);
}

function setValorByType(main,type,operador = ''){
    operador = operador ? operador : main.find('[name="operador-filtro[]"]').val();
    clearValor(main);
    var valor = $('<input></input>').addClass('form-control form-control-sm').attr('name','valor-filtro[]')
        .attr('id','valor-filtro[]').attr('data-function','vindicate'),
        col = 'auto';
    switch(type){
        case 'string':
            col = 'col-4';
            valor.prop('type','text').attr('placeholder','Digite para pesquisar...');
            break;
        case 'int':
            if(operador === 'in'){
                col = 'col-3';
                valor.attr('placeholder','Ex.: 1,3,6,8');
            } else {
                col = 'col-2';
                valor.prop('type','text').attr('data-vindicate','format:numeric');
            }
            break;
        case 'date':
            col = 'auto';
            valor.prop('type','date').attr('data-vindicate','format:date');
            break;
        case 'boolean':
            col = 'auto';
            valor = $('<select></select>').addClass('form-control form-control-sm')
                    .attr('name','valor-filtro[]').attr('id','valor-filtro[]')
                    .append($('<option></option>').val('1').html('Sim'))
                    .append($('<option></option>').val('0').html('Não'));
            break;
        case 'multi':
            var divMult = $('<div></div>').addClass('multiselect')
                    .append($('<div></div>').addClass('ms-select')
                            .append($('<select></select>').addClass('form-control form-control-sm')
                                .attr('name','valor-filtro[]').attr('id','valor-filtro[]')
                                .append('<option seleted></option>'))
                            .append($('<div></div>').addClass('ms-over-select'))),
                options = JSON.parse(main.find('.campo-filtro option:selected').attr('options')),
                divCheckboxes = $('<div></div>').addClass('ms-checkboxes');
            $.each(options,function(val){
                var checkbox = '<input type="checkbox" value="'+val+'" class="ms-opt-checkbox" id="chk-'+val+'"/> '+this;
                divCheckboxes.append($('<label></label>').html(checkbox));
            });
            divMult.append(divCheckboxes);
            valor = divMult;
            col = 'col-3';
            break;
    }
    valor = $('<div></div>').addClass('input-validate').append(valor)
        .append($('<span></span>').addClass('form-control-feedback'));
    main.find('.valor-filtro').removeClass().addClass(col+' valor-filtro').append(valor);
    main.closest('form').vindicate('init');
}

function setFiltroInt(main){
    setOperadorByType(main,'int');
    setValorByType(main,'int');
}

function setFiltroDate(main){
    setOperadorByType(main,'date');
    setValorByType(main,'date');
    
}

function setFiltroString(main){
    setOperadorByType(main,'string');
    setValorByType(main,'string');
    
}

function setFiltroMulti(main){
    setOperadorByType(main,'multi');
    setValorByType(main,'multi');
}

function setFiltroBoolean(main){
    setOperadorByType(main,'boolean');
    setValorByType(main,'boolean');    
}

function setFiltroNulo(main){
    setOperadorByType(main,'');
    setValorByType(main,'');        
}


$(document).ready(function(){
    $('body').on('click', '#reset-filter', function (event) {
        event.preventDefault();
        var form = $(this).closest($(this).attr('aria-controls'));
        form.find('input').each(function () {
            $(this).val('');
        });
        form.find('select').each(function () {
            $(this).val('');
            if($(this).attr('name') === 'campo-filtro[]'){
                setFiltroNulo($(this).closest('.form-row'));
            }
        });
        form.find('#btn-filtrar').trigger('click');
    });

    $('body').on('click', '#add-filter', function (event) {
        event.preventDefault();
        var form = $(this).closest($(this).attr('aria-controls'));
        $(form).append('<div class="filtro-adicional" style="margin-top:5px;">' + form.closest('.table-filter-main').find('#filtro-padrao').html() + '</div>');
    });

    $('body').on('click', '#remove-filter', function (event) {
        event.preventDefault();
        var form = $(this).closest($(this).attr('aria-controls'));
        form.find('.filtro-adicional').each(function () {
            $(this).remove();
        });
        form.find('#reset-filter').trigger('click');
    });    
    
    $('body').on('click', '#btn-filtrar',function () {
        var table = $(this).closest('.table-main').find('#'+$(this).attr('aria-controls'));
        $(this).button('loading');
        if($(this).closest('form').vindicate('validate')){
            setFiltro(table);
        } else {
            $(this).button('reset');
        }
    });
    
    $('body').on('change','[name="campo-filtro[]"]',function(){
        var main = $(this).closest('.form-row'),
            selected = $(this).find('option:selected');
        switch(selected.attr('type')){
            case 'int':
                setFiltroInt(main);
                break;
            case 'string':
                setFiltroString(main);
                break;
            case 'date':
                setFiltroDate(main);
                break;
            case 'boolean':
                setFiltroBoolean(main);
                break;
            case 'multi':
                setFiltroMulti(main);
                break;
        }
    });   
    
    $('body').on('change','[name="operador-filtro[]"]',function(){
        var main = $(this).closest('.form-row'),
            selected = main.find('[name="campo-filtro[]"]').find('option:selected');
        setValorByType(main,selected.attr('type'),$(this).val());
    });
    
    $('body').on('keydown', 'input[name="valor-filtro[]"]', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $btn = $(this).closest('form').find('#btn-filtrar');
            $btn.focus();
            $btn.trigger('click');
            return false;
        }
    });
    
    $('body').on('click','.ms-select',function(){
        var expanded = $(this).attr('expanded') === 'true',
            checkboxes = $($(this).closest('.multiselect').find('.ms-checkboxes'));
        if(!expanded){
            checkboxes.css('display','block');
        } else {
            checkboxes.css('display','none');
        }
        $(this).attr('expanded',!expanded);
    });
    $('body').on('click','.ms-opt-checkbox',function(){
        var option = $(this).closest('.multiselect').find('option'),
            val = $(this).val(),
            text = $(this).closest('label').text().trim(),
            items = option.attr('ms-items') ? option.attr('ms-items') : 0;
        if($(this).prop('checked')){
            val = option.val() ? option.val() + ',' + val : val;
            text = option.text() ? option.text() + ', '+ text : text;
            items++;
            option.val(val);
            option.text(text);
            option.attr('ms-items',items);
            $(this).attr('ms-item',items);
        } else {
            var idx = $(this).attr('ms-item');
            val = option.val().split(',');
            text = option.text().split(',');
            val.splice(idx-1,1);
            text.splice(idx-1,1);
            items--;
            option.val(val.join());
            option.text(text.join());
            option.attr('ms-items',items);
            $(this).closest('.ms-checkboxes').find('.ms-opt-checkbox').each(function(){
                idx = $(this).attr('ms-item');
                $(this).attr('ms-item',idx-1);
            });
        }
    });
});