{{Html::navTabs([
    ['label'=>'Pessoa',
     'link'=>'tab-pessoa',
     'tab'=>
        Form::hidden('idpessoa',$record->idpessoa) . 
        Form::formGroup([
            Form::select('pestipo',$tiposPessoa,$record->pestipo,['label'=>'Tipo','required','size'=>'sm1'])
        ]) .
        Form::formGroup([
            Form::text('pesnome',$record->pesnome,['label'=>'Nome','required'])
        ]) .
        Form::formGroup([
            Form::text('pescpfcnpj',$record->pescpfcnpj,['label'=>'Cpf / Cnpj','required','size'=>'md'])
        ]) .
        Form::formGroup([
            Form::text('pesrgie',$record->pesrgie,['label'=>'RG / IE','required','size'=>'sm1'])
        ])
    ],
    ['label'=>'Endereço',
     'link'=>'tab-endereco',
     'tab'=>
        Form::hidden('idpessoaendereco',$record->endereco()->idpessoaendereco) .
        Form::formGroup([
            Form::select('peetipo',$record->endereco()->tiposEndereco(),$record->endereco()->peetipo,['label'=>'Tipo','size'=>'md'])
        ]) .
        Form::formGroup([
            Form::text('peecep',$record->endereco()->peecep,['label'=>'CEP','size'=>'sm1'])
        ]) . 
        Form::formGroup([
            Form::select('peeestado',$record->endereco()->estados(),$record->endereco()->peeestado,['label'=>'UF','size'=>'sm'])
        ]) .
        Form::formGroup([
            Form::text('peecidade',$record->endereco()->peecidade,['label'=>'Cidade','size'=>'md1'])
        ]) .
        Form::formGroup([
            Form::text('peebairro',$record->endereco()->peebairro,['label'=>'Bairro','size'=>'md1'])
        ]) .
        Form::formGroup([
            Form::text('peelogradouro',$record->endereco()->peelogradouro,['label'=>'Logradouro','size'=>'md2'])
        ]) .
        Form::formGroup([
            Form::text('peenumero',$record->endereco()->peenumero,['label'=>'N.','size'=>'sm'])
        ]) .
        Form::formGroup([
            Form::text('peecomplemento',$record->endereco()->peecomplemento,['label'=>'Complemento','size'=>'md2'])
        ])
    ],
    ['label'=>'Contato',
     'link'=>'tab-contato',
     'tab'=> 
        Form::hidden('idpectelefone' , $record->contato(1)->idpessoacontato) .
        Form::hidden('idpeccelular' , $record->contato(2)->idpessoacontato) .
        Form::hidden('idpecemail' , $record->contato(3)->idpessoacontato) .
        Form::formGroup([
            Form::text('pectelefone',$record->contato(1)->peccontato,['label'=>'Telefone','size'=>'sm1'])
        ]) . 
        Form::formGroup([
            Form::text('peccelular',$record->contato(2)->peccontato,['label'=>'Celular','size'=>'sm1'])
        ]) .
        Form::formGroup([
            Form::text('pecemail',$record->contato(3)->peccontato,['label'=>'E-mail','size'=>'md2'])
        ]) 
    ]
  ])
}}
    