<?php
    $tarefas = [
        [   'name'=>'Serviços Gerais',
            'desc' => '',
            'values'=>[
                [
                    'from'=>'2017-10-19',
                    'to'=>'2017-10-30',
                    'label'=>'Serviços Gerais'
                ],
                [
                    'from'=>'2017-10-19',
                    'to'=>'2017-11-11',
                    'label'=>'',
                    'customClass'=>'ganttOrange'
                ]                 
            ]
        ],
        [   'name'=>'Fundação',
            'desc' => '',
            'values'=>[
                [
                    'from'=>'2017-10-30',
                    'to'=>'2017-11-15',
                    'label'=>'Fundação'
                ]                
            ]
        ],
        [   'name'=>'Paredes',
            'desc' => '',
            'values'=>[
                [
                    'from'=>'2017-11-07',
                    'to'=>'2017-11-25',
                    'label'=>'Paredes',
                    'customClass'=>"ganttOrange"
                ]                
            ]
        ]
    ];
    
    echo json_encode($tarefas);

