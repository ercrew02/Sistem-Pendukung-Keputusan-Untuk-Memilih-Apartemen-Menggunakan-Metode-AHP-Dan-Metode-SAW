<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
	protected $table = 'tb_kriteria';
	protected $primaryKey = 'kode_kriteria';
    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'bobot',
        'atribut',
        'created_at',
        'updated_at'
    ];
    public $incrementing = false;
    use HasFactory;
}
