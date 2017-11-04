<?php

namespace App\Http\Models\Obras;

use App\Http\Models\Model;
/**
 * Description of Fase
 *
 * @author Renan Rodrigues
 */
class Fase extends Model{
    protected $fillable = [
        'fsedescricao',
    ];
    
    public $consulta = [
        'visible'=>'idfase,fsedescricao',
        'search'=>'fsedescricao',
        'label'=>'Tipo',
        'text'=>'fsedescricao'
    ];
    
    public static function getFases($addNulo = true){
        $fases = [];
        if($addNulo){
            $fases = [''=>''];
        }
        foreach(self::all() as $fase){
            $fases[$fase->idfase] = $fase->fsedescricao;
        }
        return $fases;
    }    
}
