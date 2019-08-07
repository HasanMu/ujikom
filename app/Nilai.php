<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    public function siswa()
    {
        return $this->belongsTo('App\Siswa', 'siswa_id');
    }

    public function guru()
    {
        return $this->belongsTo('App\Guru', 'guru_id');
    }

    public function standarkomp()
    {
        return $this->belongsTo('App\StandarKompetensi', 'sk_id');
    }
}
