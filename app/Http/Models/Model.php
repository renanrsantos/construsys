<?php

namespace App\Http\Models;

class Model extends \Illuminate\Database\Eloquent\Model{
       
    protected $ativo;
    
    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $this->incrementing = false;
        $this->timestamps = false;
        
        $class = explode('\\', strtolower(get_class($this)));
        $tabela = array_pop($class);
        $modulo = array_pop($class);
        $this->table = self::getTableName($modulo, $tabela);
        
        $this->primaryKey = 'id' . $tabela;       
    }
    
    public static function getTableName($modulo,$tabela){
        switch( config('database.default')){
            case 'mysql':
                return $modulo.'_'.$tabela;
            case 'pgsql':
                return $modulo.'.'.$tabela;
            default:
                throw new Exception('Database não especificado.');
        }
            
    }
    
//    public function getBelongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null) {
//        $return = parent::belongsTo($related, $foreignKey, $ownerKey, $relation)->first();
//        return ($return) ? $return : new $related();
//    }
    
    public function processaNovo(){
        // $key = $this->getKeyName();
        // $this->$key = $this->max($key)+1;
    }
    
    public function getCampoAtivo(){
        return '';
    }

    public function ativo(){
        if($this->getCampoAtivo()){
            $campoAtivo = $this->getCampoAtivo();
            return $this->$campoAtivo ? 'Sim' : 'Não';
        }
        throw new \Exception('Campo ativo não determinado.');
    }
}
