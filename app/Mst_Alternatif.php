<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mst_Alternatif extends Model
{
    protected $table = 'mst_alternatif';
    
    protected $primaryKey = 'id_mst';

    public $timestamps = false;

    function det_alternatif(){
    	return $this->hasMany('App\Det_Alternatif','id_mst','id_mst');
    }
}
