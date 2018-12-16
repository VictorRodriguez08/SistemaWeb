<?php

namespace sistemaWeb;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = "estados";
    
    public function tesis(){
    	 return $this->hasMany('sistemaWeb\Tesis');
    }
}
