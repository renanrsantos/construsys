<?php


namespace App\Http\Models\Cadastros;

use App\Http\Models\Model;

/**
 * Description of Fornecedor
 *
 * @author Renan Rodrigues
 */
class Fornecedor extends Model{
    
    protected $fillable = [
        'idfornecedor','idpessoa',
    ];
    

	public $consulta = ['visible'=>'idfornecedor,pesnome,pescpfcnpj',
        'search'=>'pesnome,pescpfcnpj',
        'text'=>'pesnome',
        'label'=>'Fornecedor',
        'objetos'=>['pesnome'=>'pessoa','pescpfcnpj'=>'pessoa']
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class,'idpessoa','idpessoa');
    }
}
