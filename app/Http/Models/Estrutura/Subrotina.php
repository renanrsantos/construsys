<?php
                    
namespace App\Http\Models\Estrutura;

use App\Http\Models\Model;

class Subrotina extends Model {
    
    protected $fillable = [
        'idsubrotina','sbrnome','sbrpath','idrotina','sbricone' 
    ];

    function rotina(){
        return $this->belongsTo(Rotina::class,'idrotina','idrotina');
    }
    
}