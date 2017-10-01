{{Html::navTabs([
    ['label'=>'Pessoa',
     'link'=>'tab-pessoa',
     'tab'=>
        Form::hidden('idpessoa',$record->idpessoa) . 
        Form::formGroup([
            Html::col(
                Form::validate(
                    Form::select('pestipo',$tiposPessoa,$record->pestipo),
                    Form::label('pestipo','Tipo')
                )
            ,'4'),
            Html::col(
                Form::validate(
                    Form::text('pesnome',$record->pesnome,['data-vindicate'=>'required']),
                    Form::label('pesnome','Nome')
                )
            ,'8')
        ]) .
        Form::formGroup([
            Html::col(
                Form::validate(
                    Form::text('pescpfcnpj',$record->pescpfcnpj,['data-vindicate'=>'required']),
                    Form::label('pescpfcnpj','CPF / CNPJ')
                )
            ,'7'),
            Html::col(
                Form::validate(
                    Form::text('pesrgie',$record->pesrgie,['data-vindicate'=>'required']),
                    Form::label('pesrgie','RG / IE')
                )
            ,'5')            
        ])
    ],
    ['label'=>'Endereço',
     'link'=>'tab-endereco',
     'tab'=>
        Form::hidden('idpessoaendereco',$record->endereco()->idpessoaendereco) .
        Form::formGroup([
            Html::col(
                Form::validate(
                    Form::select('peetipo',$record->endereco()->tiposEndereco(),$record->endereco()->peetipo),
                    Form::label('peetipo','Tipo')
                )
            ,'auto'),
            Html::col(
                Form::validate(
                    Form::text('peecep',$record->endereco()->peecep),
                    Form::label('peecep','CEP')
                )
            ,'3'),
            Html::col(
                Form::validate(
                    Form::select('peeestado',$record->endereco()->estados(),$record->endereco()->peeestado),
                    Form::label('peeestado','UF')
                )
            ,'auto'),
            Html::col(
                Form::validate(
                    Form::text('peecidade',$record->endereco()->peecidade),
                    Form::label('peecidade','Cidade')
                )
            ,'3')
        ]) .
        Form::formGroup([
            Html::col(
                Form::validate(
                    Form::text('peebairro',$record->endereco()->peebairro),
                    Form::label('peebairro','Bairro')
                )
            ,'3'),
            Html::col(
                Form::validate(
                    Form::text('peelogradouro',$record->endereco()->peelogradouro),
                    Form::label('peelogradouro','Logradouro')
                )
            ,'5'),
            Html::col(
                Form::validate(
                    Form::text('peenumero',$record->endereco()->peenumero),
                    Form::label('peenumero','Nº.')
                )
            ,'2')
        ]) .
        Form::formGroup([
            Html::col(
                Form::validate(
                    Form::text('peecomplemento',$record->endereco()->peecomplemento),
                    Form::label('peecomplemento','Complemento')
                )
            ,'10')            
        ])
    ],
    ['label'=>'Contato',
     'link'=>'tab-contato',
     'tab'=> 
        Form::hidden('idpectelefone' , $record->contato(1)->idpessoacontato) .
        Form::hidden('idpeccelular' , $record->contato(2)->idpessoacontato) .
        Form::hidden('idpecemail' , $record->contato(3)->idpessoacontato) .
        Form::formGroup([
            Html::col(
                Form::validate(
                    Form::text('pectelefone',$record->contato(1)->peccontato),
                    Form::label('pectelefone','Telefone')
                )
            ,'3'),
            Html::col(
                Form::validate(
                    Form::text('peccelular',$record->contato(2)->peccontato),
                    Form::label('peccelular','Celular')
                )
            ,'3'),
            Html::col(
                Form::validate(
                    Form::text('pecemail',$record->contato(3)->peccontato),
                    Form::label('pecemail','E-mail')
                )
            ,'6')
        ]) 
    ]
  ])
}}
    