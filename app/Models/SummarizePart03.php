<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummarizePart03 extends Model
{
    //
    use HasFactory;
    protected $table = 'summarize_part_03';
    protected $fillable = [
        'personal_num',
        'assessment_acknowledgement_num',
        'evaluation_date',
        'evaluator_num',
        'evaluator_signature',
        'round',
    ];

    public function personal() {
        return $this->belongsTo(User::class,'personal_num');
    }

    public function evaluator() {
        return $this->belongsTo(User::class,'evaluator_num');
    }
}
