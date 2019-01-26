// window.vindicateClass =
window.vindicate = {};

function vindicateForm(options) {
    this.fields = {};
    this.validationSoftFail = false;
    this.validationHardFail = false;
    this.firstInvalid = null;
    this.options = $.extend(true, {
        // These are the defaults.
        soft: false,
        activeForm: false,
        showSuccess: true,
        submitTo: "",
        requiredMessage: "Este campo é obrigatório.",
        minLengthMessage: "Você não preencheu o comprimento mínimo.",
        minValMessage: "O valor deve ser maior que [MIN]",
        maxValMessage: "O valor deve ser menor que [MAX]",
        betweenMessage: "O valor deve ser entre [MIN] e [MAX]",
        parent: "input-validate",
        helper: "form-control-feedback",
        validationStates: {
            valid: {
                parent: "valid-feedback",
                input: "is-valid",
                label: ""
            },
            warning: {
                parent: "invalid-feedback",
                input: "is-invalid",
                label: ""
            },
            invalid: {
                parent: "invalid-feedback",
                input: "is-invalid",
                label: ""
            }
        },
        formats: {
            alpha: {
                regex: /^[a-zA-Z]+/,
                message: "Este campo só aceita letras. (a-z)"
            },
            alphanumeric: {
                regex: /^[a-zA-Z0-9]+/,
                message: "Este campo não aceita caracteres especiais. (a-z, 0-9)"
            },
            creditcard: {
                regex: /^d{16}/,
                message: "Insira um número de cartão de crédito válido."
            },
            date: {
                regex: /([0-9]{4}.[0-9]{1,2}.[0-9]{1,2})|([0-9]{1,2}.[0-9]{1,2}.[0-9]{4})/,
                message: "Insira uma data válida. (DD-MM-AAAA)"
            },
            decimal: {
                regex: /^(\d+\.\d{0,2})|(\d)$/,
                message: "Insira um decimal válido. (xxx.xx)",
                mask : {
                    mask: '#0.00',
                    placeholder : '0.00',
                    reverse : true
                }
            },
            email: {
                regex: /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/,
                message: "Insira um e-mail válido. (email@domain.com)"
            },
            numeric: {
                regex: /^\d+$/,
                message: "Insira um número válido. (0-9)",
                mask : {
                    mask : '0#'
                }
            },
            phone: {
                regex: /^(\([0-9]{2}\)[-\s\.]?[0-9]{4}[-\s\.]?[0-9]{4})$/,
                message: "Insira um número de telefone válido. (xx) xxxx-xxxx",
                mask : {
                    mask : '(00) 0000-0000',
                    placeholder: '(00) 0000-0000'
                }
            },
            cellphone: {
                regex: /^(\([0-9]{2}\)[-\s\.]?[0-9]{1}\.[-\s\.]?[0-9]{4}[-\s\.]?[0-9]{4})$/,
                message: "Insira um número de celular válido. (xx) x.xxxx-xxxx",
                mask : {
                    mask: '(00) 0.0000-0000',
                    placeholder: '(00) 0.0000-0000'
                }
            },
            time: {
                regex: /[0-9]{1,2}(\:[0-9]{0,2})?/,
                message: "Insira uma hora válida (xx:xx)"
            },
            url: {
                regex: /^\d+$/,
                message: "Insira uma url válida. (www.website.com/example)"
            },
            cpf: {
                regex : /^([0-9]{3}[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{2})$/,
                message: "Insira um cpf válido. (xxx.xxx.xxx-xx)",
                mask : {
                    mask : '000.000.000-00',
                    placeholder : '000.000.000-00', 
                    reverse: true
                }
            },
            cnpj: {
                regex : /^([0-9]{2}[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3}[-\s\/]?[0-9]{4}[-\s\-]?[0-9]{2})$/,
                message: "Insira um cnpj válido. (xx.xxx.xxx/xxxx-xx)",
                mask : {
                    mask : '00.000.000/0000-00', 
                    placeholder : '00.000.000/0000-00', 
                    reverse: true
                }                
            },
            cep : {
                regex : /^([0-9]{2}[-\s\.]?[0-9]{3}[-\s\-]?[0-9]{3})$/, 
                message : 'Insira um cep válido',
                mask : {
                    mask : '00.000-000',
                    placeholder : '00.000-000',
                    reverse : true
                }
            }
        }
    }, options);

    this.validate = function () {
        var retornoGeral = true;
        this.firstInvalid = null;
        for (var index in this.fields) {
            var retornoIndividual = this.fields[index].validate(this.options);
            retornoGeral = retornoGeral && retornoIndividual;
            if(this.firstInvalid === null && !retornoIndividual){
                this.firstInvalid = this.fields[index];
            }
        }
        return retornoGeral;
    };

    this.findById = function (id) {
        for (var field in this.fields) {
            if (this.fields[field].id === id) {
                return this.fields[field];
            }
        }
        return false;
    };
}

function vindicateField($element,$form, formId, options) {
    this.element = $element;
    this.form = $form;
    this.formId = formId;
    this.formGroup = this.element.closest("." + options.parent);
    this.formFeedback = this.formGroup.find(".form-control-feedback");
    this.label = this.formGroup.find('.control-label');
    this.id = this.element.attr("id").replace('[]','\\[\\]');
    this.data = this.element.data("vindicate").split("|");
    this.validationSoftFail = false;
    this.validationHardFail = false;
    this.fieldType = "*";
    this.required = false;
    this.requiredField = false;
    this.requiredFields = false;
    this.format = false;
    this.options = {
        soft: options.soft,
        activeForm: options.activeForm,
        showSuccess: options.showSuccess,
        requiredMessage: options.requiredMessage,
        minLengthMessage: options.minLengthMessage,
        parent: options.parent,
        helper: options.helper,
        validationStates: options.validationStates,
        formatRegex: false,
        formatMessage: false
    };
    this.group = false;
    this.minLength = false;
    this.minVal = false;
    this.maxVal = false;
    this.between = false;
    this.matchValue = false;
    this.matchField = false;
    this.function = false;
    this.chainedField = false;
    this.setMask = function(){
        var maskOptions = options.formats[this.format].mask;
        if(maskOptions){
            switch(this.format){ 
                case 'decimal':
                    var valor = this.element.val();//.replace('.','').replace(',','.');
                    if(valor){
                        this.element.val(parseFloat(valor).toFixed(2));
                    }
                    break;
            }      
            console.log(this.element);
            this.element.mask(maskOptions.mask,maskOptions);
        }
    };
    // Determine type of input field
    if (this.element.is(":text") || this.element.is("textarea") || this.element.is("[type=email]") 
        || this.element.is("[type=date]")|| this.element.is("[type=password]")) {
        this.fieldType = "text";
    } else if (this.element.is("select")) {
        this.fieldType = "dropdown";
    } else if (this.element.is(":checkbox")) {
        this.fieldType = "checkbox";
    } else if (this.element.is(":radio")) {
        this.fieldType = "radio";
    } else {
//        console.warn("Vindicate - Unknown element", this.element);
    }
    // Object Methods
    this.init = function (options) {
        // Process Options
        for (var option in this.data) {
            var input_option = this.data[option];
            if (input_option === "required") {
                this.required = true;
            } else if (input_option.substring(0, 9) === "required:") {
                this.requiredField = input_option.substring(9, input_option.length);
            } else if (input_option.substring(0, 14) === "requiredField:") {
                this.requiredField = input_option.substring(14, input_option.length);
                requiredFieldsPre = this.requiredField.split(",");
                requiredFields = [];
                for (var index in requiredFieldsPre) {
                    requiredString = requiredFieldsPre[index];
                    // console.log(requiredString);
                    if (requiredString.indexOf("[") > -1) {
                        var element_id = requiredString.slice(0, requiredString.indexOf("["));
                        requiredFields.push({
                            "id": this.form.findById(element_id).fieldId,
                            "value": requiredString.slice(requiredString.indexOf("[") + 1, requiredString.indexOf("]"))
                        });
                    } else {
                        //console.log(requiredString, $("#" + requiredString).data("vindicate-id"));
                        requiredFields.push({"id": requiredString, "value": false});
                    }
                }
                this.requiredFields = requiredFields;
            } else if (input_option.substring(0, 7) === "format:") {
                this.format = input_option.substring(7, input_option.length);
                this.options["formatRegex"] = options.formats[this.format].regex;
                this.options["formatMessage"] = options.formats[this.format].message;
                this.setMask();
            } else if (input_option.substring(0, 6) === "group:") {
                this.group = input_option.substring(6, input_option.length);
                this.element.data("vindicate-group", this.group);
            } else if (input_option.substring(0, 4) === "min:") {
                this.minLength = input_option.substring(4, input_option.length);
            } else if (input_option.substring(0, 7) === "equals:") {
                this.matchValue = input_option.substring(7, input_option.length);
            } else if (input_option.substring(0, 6) === "match:") {
                this.matchField = input_option.substring(6, input_option.length);
            } else if(input_option.substring(0,9) === "function:"){
                this.function = input_option.substring(9, input_option.length);
            } else if(input_option.substring(0,7) === "minVal:"){
                this.minVal = input_option.substring(7, input_option.length);
            } else if(input_option.substring(0,7) === "maxVal:"){
                this.maxVal = input_option.substring(7, input_option.length);
            } else if(input_option.substring(0,8) === "between:"){
                this.between = input_option.substring(8, input_option.length).split(';');
                this.minVal = this.between[0];
                this.maxVal = this.between[1];
            }else if(input_option.substring(0,13) === "chainedField:"){
                this.chainedField = input_option.substring(13, input_option.length);
            }
        }

        // EXTEND Options on field level so they don't have to be passed in
        // this.options = {}

        return true;
    };

    this.init(options);


    this.fieldChained = function(){
        console.log(this.form);
        return this.form.findById(this.chainedField);
    };
    
    this.clearState = function(){
        this.element.removeClass(this.options.validationStates.valid.input);
        this.formFeedback.removeClass(this.options.validationStates.valid.parent);
        this.element.removeClass(this.options.validationStates.invalid.input);
        this.formFeedback.removeClass(this.options.validationStates.invalid.parent);
        this.element.removeClass(this.options.validationStates.warning.input);
        this.formFeedback.removeClass(this.options.validationStates.warning.parent);
    };
    
    this.setSuccess = function(){
        this.clearState();
        this.element.addClass(this.options.validationStates.valid.input);
        this.formFeedback.addClass(this.options.validationStates.valid.parent);
        if(this.chainedField){
            this.fieldChained().setSucces();
        }
    };
    
    this.setHardFail = function(){
        this.clearState();
        this.element.addClass(this.options.validationStates.invalid.input);
        this.formFeedback.addClass(this.options.validationStates.invalid.parent);
        this.validationHardFail = false;
        if(this.chainedField){
            this.fieldChained().setHardFail();
        }
    };
   
    this.setSoftFail = function(){
        this.clearState();
        this.element.addClass(this.options.validationStates.warning.input);
        this.formFeedback.addClass(this.options.validationStates.warning.parent);
        this.validationSoftFail = false;
        if(this.chainedField){
            this.fieldChained().setSoftFail();
        }
    };
    
    this.validatePrep = function () {
        this.formFeedback.text("");
        if (this.validationSoftFail) {
            this.setSoftFail();
        }
        if (this.validationHardFail) {
            this.setHardFail();
        }
    };

    this.validateComplete = function (options) {
        if (this.validationHardFail) {
            this.setHardFail();
            this.formFeedback.text(this.validationMessage);            
            return false;
        } else {
            if (this.validationSoftFail) {
                this.setSoftFail();
                this.formFeedback.text(this.validationMessage);
                return false;
            } else {
                if (options.showSuccess) {
                    this.setSuccess();
                }
                return true;
            }
        }
    };

    this.validateRequiredFields = function (options) {
        if (this.requiredField) {
            // requiredFields values
            var validate = true;
            this.validationSoftFail = false;
            for (var index in this.requiredFields) {
                var field_id = this.requiredFields[index].id; // id does not contain loop index prefix...?
                // console.log("field_id", field_id);
                validate = validate && this.form.findById(field_id).validateRequired(options);
                if(!validate){
                    this.validationSoftFail = true;
                    this.validationMessage = options.requiredMessage;
                    break;
                }
            }
            return validate;
        }
        return false; // Not Required
    };

    this.validateRequired = function (options) {
        if (this.fieldType === "text") {
            if (this.element.val().length === 0) {
                this.validationSoftFail = true;
                this.validationMessage = options.requiredMessage;
                return false;
            }
        }
        if (this.fieldType === "checkbox") {
            if (!this.element.is(":checked")) {
                this.validationSoftFail = true;
                this.validationMessage = options.requiredMessage;
                return false;
            }
        }
        if (this.fieldType === "radio") {
            if (this.group) {
                if ($('[data-vindicate*="group:' + this.group + '"]:checked').length === 0) {
                    this.validationSoftFail = true;
                    this.validationMessage = options.requiredMessage;
                    return false;
                }
            } else {
                if (!this.element.is(":checked")) {
                    this.validationSoftFail = true;
                    this.validationMessage = options.requiredMessage;
                    return false;
                }
            }
        }
        if(this.fieldType === "dropdown"){
            if (this.element.val() === null) {
                this.validationSoftFail = true;
                this.validationMessage = options.requiredMessage;
                return false;
            }
        }
        return true;
    };

    this.validateFormat = function (options) {
        format = options.formats[this.format];
        if (format && this.element.val() !== "") {
            if (!this.element.val().match(format.regex)) {
                this.validationHardFail = true;
                this.validationMessage = format.message;
            }
        }
        if (this.format === "custom") { // THIS IS NOT YET IMPLEMENTED
            if (!this.element.val().match(options.formats.date.regex)) {
                this.validationHardFail = true;
                this.validationMessage = options.formats.date.message;
            }
        }
    };

    this.validateMinLength = function (options) {
        if (this.element.val().length < this.minLength) {
            this.validationSoftFail = true;
            this.validationMessage = options.minLengthMessage;
        }
    };
    
    this.validateMinVal = function (options) {
        if (this.element.val() <= this.minVal) {
            this.validationSoftFail = true;
            this.validationMessage = options.minValMessage.replace('[MIN]',this.minVal);
        }
    };
    
    this.validateMaxVal = function (options) {
        if (this.element.val() >= this.maxVal) {
            this.validationSoftFail = true;
            this.validationMessage = options.maxValMessage.replace('[MAX]',this.maxVal);
        }
    };
    
    this.validateBetween = function (options) {
        if (this.element.val() <= this.minVal || this.element.val() >= this.maxVal) {
            this.validationSoftFail = true;
            this.validationMessage = options.betweenMessage
                    .replace('[MIN]',this.minVal)
                    .replace('[MAX]',this.maxVal);
        }
    };

    this.validateEquals = function (options) {
        if (this.element.val() !== this.form.findById(this.matchField).element.val()) {
            this.validationSoftFail = true;
            this.validationMessage = "Os valores precisam ser iguais.";
        }
    };

    this.validate = function (options) {
        this.validatePrep(options);
        if (this.required === false && this.requiredField) {
            this.validateRequiredFields(options);
        }
        if (this.required) {
            if (!this.validateRequired(options)) {
                return this.validateComplete(options); // If required but no value, skip validations
            }
        } else {
            // Check for empty and exit?
        }
        if (this.matchField) {
            this.validateEquals(options);
        }
        if (this.format) {
            this.validateFormat(options);
        }
        if (this.minLength) {
            this.validateMinLength(options);
        }
        if(this.function){
            eval(this.function);
        }
        
        if(this.between){
            this.validateBetween(options);
        } else if(this.minVal){
            this.validateMinVal(options);
        } else if(this.maxVal){
            this.validateMaxVal(options);
        }
        
        return this.validateComplete(options);
    };
}

(function ($) {
    $.fn.vindicate = function () {
        action = "init";
        options = {};
        if (arguments.length === 1) {
            if (typeof (arguments[0]) === "string") {
                action = arguments[0];
            } else {
                options = arguments[0];
            }
        } else if (arguments.length === 2) {
            action = arguments[0];
            options = arguments[1];
        }

        var $form_this = $(this);
        var form_id = $form_this.attr("id");

        if (action === "init") {
            var vin = new vindicateForm(options);
            var fields = $form_this.find(":input").map(function () {
                var $input_this = $(this);
                if ($input_this.attr('data-vindicate') && !$input_this.hasClass('flexdatalist-set')) {
                    var field = new vindicateField($input_this, vin,form_id, vin.options);
                    return field;
                }
            }).toArray();
            // vin.fields = {} // already declared
            for (var index in fields) {
                field = fields[index];
                field.fieldId = index + "-" + field.id;
                if (field.id) {
                    $("#" + field.id).data("vindicate-id", field.fieldId);
                    // console.log("vindicate-id:", $("#" + field.id).data("vindicate-id"));
                }
                vin.fields[field.fieldId] = field; // index prefix to maintain form ordering
            }
            window.vindicate[form_id] = vin;
            //window.vindicate.push(vin);
            //form_index = (window.vindicate.length-1); // Minus 1 because array is 0 based
            //$form_this.data("vindicate-index", form_index);
            // }
            //console.log("Vindicate - Form Initialized", form_id);
        } 
        if (action === "validate") {
            var vin = window.vindicate[form_id];
            return vin.validate();
        } 
        if(action === "get"){
            return window.vindicate[form_id];
        }
    };

}(jQuery));
