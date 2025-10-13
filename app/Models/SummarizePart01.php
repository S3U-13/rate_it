<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummarizePart01 extends Model
{
    //
    use HasFactory;
    protected $table = 'summarize_part_01';
    protected $fillable = [
        'personal_num',
        'current_responsibilities',
        'evaluation_component_num',
        'evaluation_component_full_time_employee_num',
        'points',
        'points_multiply',
        'total_points',
        'criterion_num',
        'wage_promotion_num',
        'wage_promotion_detail',
        'wage_promotion_num_1_5',
        'wage_promotion_detail_1_5',
        'evaluator_num',
        'round',
    ];

    public function personal() {
        return $this->belongsTo(User::class,'personal_num');
    }

    public function evaluator() {
        return $this->belongsTo(User::class,'evaluator_num');
    }
    public function criterion() {
        return $this->belongsTo(Criterion::class,'criterion_num');
    }
    public function wage_promotion() {
        return $this->belongsTo(WagePromotion::class,'wage_promotion_num');
    }
    public function wage_promotion_1_5() {
        return $this->belongsTo(WagePromotionOnePointFive::class,'wage_promotion_num_1_5');
    }
    public function evaluation_components() {
        return EvaluationComponent::whereIn('id', json_decode($this->evaluation_component_num, true))->get();
    }
    public function evaluation_component_full_time() {
        return EvaluationComponentFullTime::whereIn('id', json_decode($this->evaluation_component_full_time_employee_num, true))->get();
    }
}
