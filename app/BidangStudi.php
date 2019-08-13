<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidangStudi extends Model
{
    protected $fillable = [
        'kode', 'nama'
    ];

    public function kompkeahlian()
    {
        return $this->hasMany('App\KompetensiKeahlian', 'bidang_id');
    }
}
