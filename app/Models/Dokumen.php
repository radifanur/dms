<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';
    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'path',
        'uploader',
        'uploader_email',
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
