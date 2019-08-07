<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidangStudi extends Model
{
    public function kompkeahlian()
    {
        return $this->hasMany('App\KompetensiKeahlian', 'bidang_id');
    }
}
