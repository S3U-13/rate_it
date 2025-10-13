<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WagePromotionOnePointFive extends Model
{
    use HasFactory;
    protected $table = 'wage_promotion_1_5';
    protected $fillable = [
        'wage_promotion_1_5_name',
        'wage_promotion_1_5_status'
    ];
}
