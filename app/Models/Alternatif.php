<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
	protected $table = 'tb_alternatif';
	protected $primaryKey = 'kode_alternatif';
    protected $fillable = [
        'kode_alternatif',
        'nama_alternatif',
        'created_at',
        'updated_at'
    ];
    public $incrementing = false;
    use HasFactory;
}
