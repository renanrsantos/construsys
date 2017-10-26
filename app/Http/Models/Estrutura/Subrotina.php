<?php
                    
namespace App\Http\Models\Estrutura;

use App\Http\Models\Model;

class Subrotina extends Model {
    
    protected $fillable = [
        'sbrnome','sbrpath','idrotina','sbricone' 
    ];

    function rotina(){
        return $this->belongsTo(Rotina::class,'idrotina','idrotina');
    }
    
}