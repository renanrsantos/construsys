$.fn.button = function(state){
    var btn = $(this),
        i = btn.find('i'),
        btnAux = btn.next('button[data-toggle="dropdown"]');
    switch(state){
        case 'loading':
            btn.addClass('disabled');
            btnAux.addClass('disabled');
            btn.attr('loading',true);
            i.attr('original-icon',i.attr('class'));
            i.removeClass();
            i.addClass('fa fa-circle-o-notch fa-spin fa-fw');
            break;
        case 'reset':
            i.removeClass();
            i.addClass(i.attr('original-icon'));
            btn.removeClass('disabled');
            btnAux.removeClass('disabled');
            btn.attr('loading',false);
            break;
    }
};

function getDisabled() {
    return $('#btn-incluir').prop('disabled');
}

function alteraBotao(botao, habilitado) {
    if (habilitado) {
        botao.removeClass('disabled');
    } else {
        botao.addClass('disabled');
    }
//    botao.attr('enabled', habilitado);
//    botao.attr('disabled', !habilitado);
}

function validaControllers(dataValida,checked){
    if(dataValida){
        for(i=0; i < dataValida.length; i++){
            for(j=0; j < dataValida[i].btns.length;j++){
                var btn = $(dataValida[i].btns[j]);
                alteraBotao(btn,dataValida[i].value && checked);
                btn.tooltip('dispose');
                if(dataValida[i].hint && !dataValida[i].value){
                    btn.tooltip({
                       title : dataValida[i].hint,
                       placement : 'bottom'
                    });
                }
            }
        }
    }
}

function botaoHabilitado(botao) {
//    return botao.attr('enabled') === 'true' || botao.attr('enabled') === true;
    return !botao.hasClass('disabled');
}

function atualizaBotoes(table = null) {
    var selecionados = 0;
    var checks = $('.chk-acao');
//    var checkAll = $('#chk-all'); 
    var btnSingle = $('.btn-single');
    var btnMulti = $('.btn-multi');
    if (table !== null){
        checks = table.find('.chk-acao');
        checkAll = table.find('#chk-all');
        btnSingle = table.closest('form').find('.btn-single');
        btnMulti = table.closest('form').find('.btn-multi');
    }
    checks.each(function () {
        if ($(this).prop('checked') === true) {
            selecionados++;
        } else {
//            checkAll.prop('checked', false);
        }
    });
    if (selecionados === 1) {
        alteraBotao(btnSingle, !getDisabled());
        alteraBotao(btnMulti, !getDisabled());
    } else if (selecionados > 1) {
        alteraBotao(btnSingle, false);
        alteraBotao(btnMulti, !getDisabled());
    } else {
        alteraBotao(btnSingle, false);
        alteraBotao(btnMulti, false);
    }
}

function inicializaForms(forms){
    forms.each(function(){
       $(this).vindicate('init');
       $(this).prop('submited',false);
    });
}

function formataCampoCpfCnpj(select){
    var form = select.closest('form').vindicate('get'),
        field = form.findById('pescpfcnpj');
    switch(select.val()){
        case '1' :
            field.format = 'cpf';
            break;
        case '2':
            field.format = 'cnpj';
            break;
    }
    field.setMask();
}

function montaDataTable(table,data = '') {
    var url = table.attr('url');
    $.getJSON(url + '?columns=true', function (result) {
        table.html(result.columns);
        carregaDados(table, data);
    });
}

function carregaDados(table, data = '') {
    var filtro = table.closest('.table-main').find('.table-filter'),
        limit = table.closest('.table-main').find('.table-limit select').val();
    data = (data !== '') ? '?data=true&' + data : '?data=true';
    data += '&'+table.closest('.table-main').find('.fr-registros').serialize();
    data += '&'+filtro.serialize();
    data += (limit === undefined) ? '&limit=10' : '&limit='+limit;
    var url = $(table).attr('url') + data;
    $(table).DataTable({
        ajax : url,
        scrollY: table.attr("scrollY"),
        drawCallback : function(settings){
            table.find('[data-toggle="tooltip"]').tooltip();
        },
        initComplete : function(){
            $('button[loading="true"]').button('reset');
        }
    });
    atualizaBotoes(table);
}

$.fn.dataTable.ext.errMode = function (settings, helpPage, message) {
    $(settings.nTable).dataTable().fnClearTable();
//    $('#msg-global').html(message);
};

$.extend(true, $.fn.dataTable.defaults, {
    "dom": "<'row'<'col-8 btn-group-to'><'col-4'f>>" +
            "<'row'<'col-12'tr>>" +
            "<'row'<'col-9'<'float-left'p>><'col-3'<'row pull-right'<'col-auto table-limit'l><'col-auto'i>>>>",
    "destroy": true,
    "columnDefs": [
        {
            "targets": 0,
            "sorting": false,
            "width": "1%",
            "orderable": false
        }
    ],
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
    "order": [],
    "searching": false,
    "sPaginationType": "full_numbers",
    "language": {
        "sEmptyTable": "Não há registros",
        "sInfo": "Total <b>_TOTAL_</b>",
        "sInfoEmpty": "Total <b><font color='red'>0</font></b>",
        "sInfoFiltered": "",
        "sInfoPostFix": "",
        "sThousands": ".",
        "sInfoThousands": ".",
        "sLengthMenu": "Exibir _MENU_",
        "sLoadingRecords": "<i class='fa fa-circle-o-notch fa-spin fa-2x fa-fw'></i>",
        "sProcessing": "<i class='fa fa-circle-o-notch fa-spin fa-2x fa-fw'></i>",
        "sSearch": "Pesquisa rápida",
        "sZeroRecords": "Registro não encontrado",
        "oPaginate": {
            "sFirst": "<i class='fa fa-angle-double-left' title='Primeira Página'></i>",
            "sPrevious": "<i class='fa fa-angle-left' title='Página Anterior'></i>",
            "sNext": "<i class='fa fa-angle-right' title='Próxima Página'></i>",
            "sLast": "<i class='fa fa-angle-double-right' title='Última Página'></i>"
        },
        "oAria": {
            "sSortAscending": "",
            "sSortDescending": ""
        }
    }
});

$(document).ready(function () {
    var ctrl = false;
    var clickChk = false;
    $(document).keydown(function (event) {
        ctrl = event.keyCode === 17;
    });
    
    $(document).keyup(function (event) {
        ctrl = false;
    });
    
    $('table').on('click', '.chk-acao', function () {
        atualizaBotoes($(this).closest('table'));
        clickChk = true;
    });

    $('body').on('click', 'tr[role="row"]', function (e) {
        var td = $(this).children().eq(0);
        var check = $(td).children();
        if(check.prop('id') !== 'chk-all'){
            var checked = (clickChk) ? !check.prop('checked') : check.prop('checked');
            if (!ctrl) {
                var checks = $(this).closest('table').find('.chk-acao');
                checks.each(function(){
                    $(this).prop('checked', false);
                });
            }
            check.prop('checked', !checked);
            atualizaBotoes($(this).closest('table'));
            validaControllers(check.data('valida-controller'),!checked);
            clickChk = false;            
        } 
    });

    $('body').on('click', '#chk-all', function () {
        var inputs, x, chks;
        chks = $('table[url="'+$(this).closest('table').attr('url')+'"]').find('.chk-acao');
        inputs = chks.get();
        for (x = 0; x < inputs.length; x++) {
            inputs[x].checked = this.checked;
        }
        atualizaBotoes(chks.closest('table'));
    });

    $('.dropdown-submenu .dropdown-toggle').on('click', function () {
        $('.dropdown-submenu .dropdown-menu').css('display', 'none');
        $(this).siblings().css('display', 'block');
        return false;
    });

    $('body').on('click', '#btn-validacep', function () {
        var cep = document.getElementById('pencep[]').value;
        var sUrl = 'https://viacep.com.br/ws/' + cep + '/json/';
        $.ajax({
            url: sUrl,
            success: function (data) {
                var estados = document.getElementById('estcodigo[]');
                for (i = 0; i < estados.length; i++) {
                    if (data.uf === estados.options[i].text) {
                        estados.options[i].selected = true;
                        break;
                    }
                }
                document.getElementById('pencep[]').value = data.cep;
                document.getElementById('bainome[]').value = data.bairro;
                document.getElementById('cidnome[]').value = data.localidade;
                document.getElementById('lognome[]').value = data.logradouro;
            }
        });
    });

    $('body').on('click', '.btn-excluir',function (e) {
        if (botaoHabilitado($(this))) {
            if (confirm('Deseja realmente excluir o(s) registro(s) selecionado(s)?')) {
                var form = $($(this).data('form'));
                $.post(form.prop('action') + '/excluir', form.serialize(), function (data) {
                    switch (data.status) {
                        case 'ERRO':
                            $('#msg-global').html(data.msg);
                            break;
                        case 'OK' :
                            var table = form.find('table');
                            if(table.length > 0){
                                carregaDados(table,form.serialize());
                            }
                            break;
                    }
                });
            } else {
                e.preventDefault();
                e.stopPropagation();
            }
        }
    });

    $('body').on('click', '.chk-ativo', function () {
        $(this).attr('value', ($(this).prop('checked') ? 1 : 0));
    });

//    $('body').on('keyup', 'input[type="search"]', function () {
//        var sTable = $(this).attr('aria-controls');
//        var table = $('#' + sTable);
//        setFiltro(table, false);
//    });

    $('body').on('select:flexdatalist', '.flexdatalist', function (item, options) {
        var props = $(this).data('properties');
        var propsAlt = $(this).data('properties-alt');
        var divMain = $(this).closest($(this).data('main')); 
        props = props.slice(0, props.length);
        propsAlt = propsAlt.slice(0, propsAlt.length);
        for (i = 0; i < props.length; i++) {
            if (propsAlt[i] !== $(this).prop("id")) {
                divMain.find('#' + propsAlt[i]).val(options[props[i]]);
                divMain.find('#' + propsAlt[i]).attr('validado', true);
            }
        }
    });

    $('body').on('input', '.flexdatalist-id', function () {
        $(this).attr('validado', false);
        $(this).tooltip('dispose');
        var divMain = $($(this).data('main'));
        divMain.find($(this).data('target')).attr('tabindex', -1);
        divMain.find($(this).data('target')+'-flexdatalist').attr('tabindex', -1);
    });

    $('body').on('blur', '.flexdatalist-id', function () {
        var divMain = $(this).closest($(this).data('main'));
        var idFlex = $(this).data('target');
        var flex = divMain.find(idFlex);
        var campoId = $(this).attr('campoid').replace('[]','\\[\\]');
        var id = $(this).prop('id').replace('[]','\\[\\]');
        var valId = $(this).val();
        var validado = $(this).attr('validado');
        if (valId !== "" && (validado !== true && validado !== 'true')) {
            var props = $(flex).data('properties');
            var propsAlt = $(flex).data('properties-alt');
            props = props.slice(0, props.length);
            propsAlt = propsAlt.slice(0, propsAlt.length);
            $(flex).removeClass('flexdatalist-selected');
            $(flex).val("");
            divMain.find(idFlex + '-flexdatalist').val("");
            divMain.find(idFlex + '-flexdatalist').removeClass('flexdatalist-selected');
            $.ajax({
                url: $(flex).data('data'),
                data: campoId + "=" + valId,
                success: function (data) {
                    var result = data;//JSON.parse(data);
                    if (result.length > 0) {
                        divMain.find('#' + id).tooltip('dispose');
                        for (var i = 0; i < propsAlt.length; i++) {
                            var prop = props[i];
                            var propAlt = propsAlt[i];
                            if (propAlt === $(flex).attr('id')) {
                                divMain.find('.flexdatalist').flexdatalist('value',result[0][prop]);
                            } else {
                                divMain.find('#' + propAlt).val(result[0][prop]);
                            }
                            divMain.find('#' + propAlt).attr('validado', true);    
                        }
                        // divMain.find(idFlex + '-flexdatalist').focus();
                    } else {
                        for (var i = 0; i < props.length; i++) {
                            var propAlt = propsAlt[i];
                            divMain.find('#' + propAlt).val("");
                        }
                        divMain.find('#' + id).tooltip({
                            placement: "bottom",
                            title: 'Registro "' + valId + '" não encontrado'
                        });
                        divMain.find('#' + id).val('');
                        divMain.find('#' + id).focus();
                    }
                }
            });
        }
    });

    $('body').on('click', '[data-toggle="modal"]', function (e) {
        if(botaoHabilitado($(this))){
            var $this = $(this);
            var modal = $($(this).data('target') + ' .modal-dialog');
            var form = $($(this).data('form'));
            var url = $(this).data('url');
            var action = $(this).data('action');
            var data = null;
            var arr = ['alterar', 'visualizar'];
            $this.button('loading');
            if ((arr.indexOf(action) > -1) || (url !== "")) {
                data = form.serialize();
            }
            if($(this).data('data')){
                data = data ? data + '&' + $(this).data('data') : $(this).data('data');
            }
            url = url !== undefined ? url : form.prop('action') + '/' + action;
            modal.load(url, data,function (responseText, textStatus, XMLHttpRequest){
                var size = 'modal-xl';
                if(textStatus === "error"){
                    var title = $('<h5></h5>').addClass('modal-title').html('Erro');
                    var buttonClose = $('<button></button>').addClass('close').attr('data-dismiss','modal').html('<span>&times;</span>');
                    var header = $('<div></div>').addClass('modal-header').append(title).append(buttonClose);
                    var body = $('<div></div>').addClass('modal-body').html(responseText);
                    var content = $('<div></div>').addClass('modal-content').addClass('modal-xl').append(header).append(body);
                    modal.html('');
                    modal.append(content);
                } else {
                    size = modal.find('#modal-size').html() ? modal.find('#modal-size').html() : size;;
                }
                modal.removeClass('modal-xl').removeClass('modal-lg').removeClass('modal-md')
                    .removeClass('modal-sm').addClass(size);
                eval(modal.find('#table-scripts').html());
                $this.button('reset');
            });
            if($(this).hasClass('btn-input-consulta')){
                $(this).closest('.input-consulta').find('.flexdatalist-id').addClass('wait-response');
            }
        } else {
            e.preventDefault();
            e.stopPropagation();
        }
    });

    $('body').on('hidden.bs.modal', '.modal', function () {
        var modal = $(this);
        if(!modal.hasClass('modal-consulta')){
            var table = $('#'+modal.attr('id').replace('modal-fr-','')),
                formData = $('#'+modal.attr('id').replace('modal-fr-','fr-registros-'));
            carregaDados(table,formData.serialize());  
        }
        $('[modal-parent="'+modal.attr('id')+'"]').each(function(){
            $(this).remove();
        });
        $(this).find('.modal-dialog').each(function(){
            var table = $(this).find('table'),
                btnSeleciona = $(this).find('.btn-seleciona');
            if(table){
                table.DataTable().destroy();
            }
            if(btnSeleciona.length > 0){
                $('[name="'+btnSeleciona.data('camporetorno').replace('[]','\\[\\]')+'"]').removeClass('wait-response');
            }
            $(this).html('');
        });
    });
    
    $('body').on('show.bs.modal','.modal',function(e){
        var parent = $(this).parent().closest('.modal'); 
        if(parent.length > 0){
            $(this).attr('modal-parent',parent.attr('id'));
            var aux = parent;
            while(aux.length > 0){
                aux = aux.parent().closest('.modal');
                if(aux.length > 0){
                    parent = aux;
                } else {
                    break;
                }
            }
            $(this).appendTo(parent.parent());
        }
        
    });
    
    $('body').on('shown.bs.modal','.modal',function(){
        $(this).find('input').not('[type="hidden"]').eq(0).focus();
    });

    $('body').on('click','[data-action="replicar"]',function(){
        var from = $($(this).data('from')).eq(0).clone(),
            appendTo = $($(this).data('append'));
        from.find('.modal').remove();
        from.removeClass('sr-only');
        appendTo.append(from.prop('outerHTML'));
        if($(this).attr('datalist')){
            appendTo.find('.flexdatalist').last().flexdatalist();
        }
        appendTo.closest('form').vindicate('init');
    });

    $('body').on('click','[data-action="remover"]',function(){
        var $this = $(this),
            $campoId = $this.closest('.form-group').find('[name="'+$this.data('id')+'[]"]'),
            valorId = "";
        if($campoId.length > 0){
            valorId = $campoId.val();
        }
        if(valorId === ""){
            if($this.closest('.tab-pane').find('.form-group').length > 2){
                $this.closest('.form-group').remove();
            }
        } else {
            if(confirm($this.data('confirm'))){
                var data = '_token='+$('[name="_token"]').val()+'&id[]='+valorId;
                $.post($this.data('url'),data,function(data){
                    switch (data.status) {
                        case 'ERRO':
                            $('#msg-fr-modal').html(data.msg);
                            break;
                        case 'OK' :
                            if($this.closest('.tab-pane').find('.form-group').length <= 2){
                                $this.closest('.form-group').find('[data-action="replicar"]').trigger('click');
                            }
                            $this.closest('.form-group').remove();
                            break;
                    }
                });
            }
        }
    });

    $('body').on('change','[name="pestipo"]',function(){
        formataCampoCpfCnpj($(this));
    });

    $('body').on('click','[data-toggle="submit"]' ,function () {
        var form = $(this).closest('form');
        var validado = form.vindicate("validate");
        var $this = $(this);
        form.prop('submited',true);
        $this.button('loading');
        if (validado) {
            var url = form.prop('action');
            var data = form.serialize();
            $.post(url, data, function (data) {
                $this.button('reset');
                switch (data.status) {
                    case 'ERRO':
                        form.find('#msg-fr-modal').html(data.msg);
                        break;
                    case 'OK' :
                        form.closest('.modal').modal('hide');
                        break;
                }
            });
        } else {
            var firstInvalid = form.vindicate('get').firstInvalid.element;
            var closest = firstInvalid.closest('.tab-pane');
            $this.button('reset');
            if(closest){
                $('.nav a[href="#' + closest.attr('id') + '"]').tab('show');
            }
            firstInvalid.focus();
        }
    });

    $('body').on('input change','[data-function="vindicate"]',function(){
        var form = $(this).closest('form');
        if(form.prop('submited')){
            form = form.vindicate("get");
            var id = $(this).attr("id");
            var field = form.findById(id);
            if(field){
                field.validate(form.options);
            }
        }
    });
    
    $('body').on('click','.btn-seleciona',function(e){
        if(botaoHabilitado($(this))){
            var val = $(this).closest('form').find('input[type="checkbox"]:checked').val();
            var campoRetorno = '[name="'+$(this).data('camporetorno').replace('[]','\\[\\]')+'"]';
            $(campoRetorno).each(function(){
                if($(this).hasClass('wait-response')){
                    $(this).trigger('input').val(val).trigger('blur');
                } 
            });
            $(this).closest('.modal').modal('hide');
        } else {
            e.preventDefault();
            e.stopPropagation();
        }
    });
    
});
