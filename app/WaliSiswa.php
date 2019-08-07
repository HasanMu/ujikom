<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaliSiswa extends Model
{
    public function siswa()
    {
        return $this->belongsTo('App\Siswa', 'siswa_id');
    }
}
