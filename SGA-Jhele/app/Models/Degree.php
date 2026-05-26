<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Degree extends Model
{
    use HasFactory;

    protected $table = 'degrees';
    protected $primaryKey = 'iddegree';

    // Desactivamos timestamps si no los usas
    public $timestamps = false;

    protected $fillable = [
        'degree_name',
        'status',
        'idsemester'
    ];

    // Relación: Un Grado pertenece a un Semestre
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'idsemester', 'idsemester');
    }
}