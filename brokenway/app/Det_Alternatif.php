<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Det_Alternatif extends Model
{
    protected $table = 'det_alternatif';
    
    public $timestamps = false;

    function mst_alternatif(){
    	return $this->belongsTo('App\Mst_Alternatif','id_mst','id_mst');
    }
}
