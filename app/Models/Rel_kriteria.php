<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rel_kriteria extends Model
{
	protected $table = 'tb_rel_kriteria';
	protected $primaryKey = 'ID';
    protected $fillable = [
        'ID',
        'ID1',
        'ID2',
        'nilai',
        'created_at',
        'updated_at'
    ];
    use HasFactory;
}
