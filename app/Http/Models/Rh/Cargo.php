<?php

namespace App\Http\Models\Rh;

use App\Http\Models\Model;
/**
 * Description of Cargo
 *
 * @author renan.santos
 */
class Cargo extends Model{
    protected $fillable = ['carnome'];
    
    public $consulta = [
        'visible'=>'idcargo,carnome',
        'text'=>'carnome',
        'search'=>'carnome',
        'label'=>'Cargo'
    ];
    
    public static function getCargos(){
        $cargos = [''=>''];
        foreach(self::all() as $cargo){
            $cargos[$cargo->idcargo] = $cargo->carnome;
        }
        return $cargos;
    }
}
