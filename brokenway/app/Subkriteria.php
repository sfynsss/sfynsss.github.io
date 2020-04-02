<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subkriteria extends Model
{
    protected $table = 'subkriteria';
    protected $fillable = ['id_subkriteria', 'id_kriteria','subkriteria','utility'];
    public $timestamps = false;

    public function kriteria()
    {
    	return $this->belongsTo('App\Kriteria','id_kriteria','id_kriteria');
    }
}
