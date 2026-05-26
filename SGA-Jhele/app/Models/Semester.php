<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semesters';
    protected $primaryKey = 'idsemester';

    // Si tu tabla no tiene columnas created_at/updated_at, desactivamos timestamps
    public $timestamps = false;

    protected $fillable = [
        'semester_name',
        'idperiod',
        'status'
    ];

    // Relación: Un Semestre pertenece a un Periodo
    public function period()
    {
        return $this->belongsTo(Period::class, 'idperiod', 'idperiod');
    }
}