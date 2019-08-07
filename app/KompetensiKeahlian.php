<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KompetensiKeahlian extends Model
{
    public function bidangstudi()
    {
        return $this->belongsTo('App\BidangStudi', 'bidang_id');
    }

    public function guru()
    {
        return $this->hasMany('App\Guru', 'kompetensi_id');
    }

    public function standarkomp()
    {
        return $this->hasMany('App\StandarKompetensi', 'kompetensi_id');
    }

    public function siswa()
    {
        return $this->hasMany('App\Siswa', 'kompetensi_id');
    }
}
