<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Period extends Model
{
    use HasFactory;

    protected $table = 'periods';
    protected $primaryKey = 'idperiod';

    // Tu tabla usa created_at pero no tiene updated_at por defecto
    const UPDATED_AT = null;

    protected $fillable = [
        'period_name',
        'start_date',
        'end_date',
        'status'
    ];
}