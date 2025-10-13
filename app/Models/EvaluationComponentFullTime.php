<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationComponentFullTime extends Model
{
    use HasFactory;
    protected $table = 'evaluation_component_full_time_employee';
    protected $fillable = [
        'component_name',
        'component_status',
        'weight_score',
    ];
}
