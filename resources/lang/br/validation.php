<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute deve ser aceito.',
    'active_url'           => ':attribute não é uma URL válida.',
    'after'                => ':attribute deve ser uma data posterior à :date.',
    'after_or_equal'       => ':attribute deve ser uma data posterior ou igual à :date.',
    'alpha'                => ':attribute deve conter apenas letras.',
    'alpha_dash'           => ':attribute deve conter letras, números e símbolos.',
    'alpha_num'            => ':attribute deve conter letras e números.',
    'array'                => ':attribute deve ser um array.',
    'before'               => ':attribute deve ser uma data anterior à :date.',
    'before_or_equal'      => ':attribute deve ser uma data anterior ou igual à :date.',
    'between'              => [
        'numeric' => ':attribute deve estar entre :min e :max.',
        'file'    => ':attribute deve estar entre :min e :max kilobytes.',
        'string'  => ':attribute deve estar entre :min e :max characters.',
        'array'   => ':attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => ':attribute deve ser verdadeiro ou falso.',
    'confirmed'            => ':attribute confirmação não corresponde.',
    'date'                 => ':attribute não é uma data válida.',
    'date_format'          => ':attribute não corresponde ao formato :format.',
    'different'            => ':attribute e :other devem ser diferentes.',
    'digits'               => ':attribute deve ter :digits dígitos.',
    'digits_between'       => ':attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => ':attribute tem dimensões inválidas.',
    'distinct'             => ':attribute campo tem um valor duplicado.',
    'email'                => ':attribute deve ser um endereço de e-mail válido.',
    'exists'               => 'Seleção :attribute é inválida.',
    'file'                 => ':attribute deve ser um arquivo.',
    'filled'               => ':attribute campo deve ter um valor.',
    'image'                => ':attribute deve ser uma imagem.',
    'in'                   => 'selected :attribute é inválido.',
    'in_array'             => ':attribute campo não existe em :other.',
    'integer'              => ':attribute deve ser um inteiro.',
    'ip'                   => ':attribute deve ser um endereço de IP válido.',
    'json'                 => ':attribute deve ser um JSON válido.',
    'max'                  => [
        'numeric' => ':attribute não deve ser maior que :max.',
        'file'    => ':attribute não deve ser maior que :max kb.',
        'string'  => ':attribute não deve ter mais de :max caracteres.',
        'array'   => ':attribute não deve ter mais de :max itens.',
    ],
    'mimes'                => ':attribute deve ser um aqruivo do tipo: :values.',
    'mimetypes'            => ':attribute deve ser um aqruivo do tipo: :values.',
    'min'                  => [
        'numeric' => ':attribute deve ser pelo menos :min.',
        'file'    => ':attribute deve ter pelo menos :min kb.',
        'string'  => ':attribute deve ter pelo menos :min caracteres.',
        'array'   => ':attribute deve ter pelo menos :min itens.',
    ],
    'not_in'               => 'A seleção :attribute é inválida.',
    'numeric'              => ':attribute deve ser um número.',
    'present'              => ':attribute campo deve estar presente.',
    'regex'                => ':attribute formato é inválido.',
    'required'             => ':attribute campo obrigatório.',
    'required_if'          => ':attribute campo obrigatório quando :other for :value.',
    'required_unless'      => ':attribute campo obrigatório, a menos que :other for :values.',
    'required_with'        => ':attribute campo obrigatório quando :values for presente.',
    'required_with_all'    => ':attribute campo obrigatório quando :values forem presentes.',
    'required_without'     => ':attribute campo obrigatório quando :values não for presente.',
    'required_without_all' => ':attribute campo obrigatório quando nenhum de :values estiver presente.',
    'same'                 => ':attribute e :other devem corresponder.',
    'size'                 => [
        'numeric' => ':attribute deve ter :size.',
        'file'    => ':attribute deve ter :size kb.',
        'string'  => ':attribute deve ter :size caracteres.',
        'array'   => ':attribute deve conter :size itens.',
    ],
    'string'               => ':attribute deve ser um texto.',
    'timezone'             => ':attribute deve ser uma zona válida.',
    'unique'               => ':attribute já utilizado.',
    'uploaded'             => ':attribute falha ao carregar.',
    'url'                  => ':attribute formato inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
