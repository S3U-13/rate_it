<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WagePromotion extends Model
{
    use HasFactory;
    protected $table = 'wage_promotion';
    protected $fillable = [
        'wage_promotion_name',
        'wage_promotion_status'
    ];
}
