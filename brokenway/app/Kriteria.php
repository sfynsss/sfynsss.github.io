<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
	protected $table = 'kriteria';
	protected $fillable = ['id_kriteria','nama_kriteria','bobot'];
	public $timestamps = false;

	function subkriteria(){
		return $this->hasMany('App\Subkriteria','id_kriteria','id_kriteria');
	}
}
