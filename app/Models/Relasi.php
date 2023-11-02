<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relasi extends Model
{
	protected $table = 'tb_relasi';
	protected $primaryKey = 'ID';
    protected $fillable = [
        'ID',
        'kode_alternatif',
        'kode_kriteria',
        'nilai',
        'created_at',
        'updated_at'
    ];
    use HasFactory;
}
