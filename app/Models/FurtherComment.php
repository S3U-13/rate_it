<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurtherComment extends Model
{
    //
    use HasFactory;
    protected $table = 'further_comments';
    protected $fillable = [
        'personal_num',
        'further_comment_num',
        'further_comment_detail',
        'further_comment_detail_1',
        'further_comment_detail_2',
        'further_comment_detail_3',
        'further_num',
        'further_signature',
        'further_date',
        'round',
    ];
    public function personal() {
        return $this->belongsTo(User::class,'personal_num');
    }

    public function further() {
        return $this->belongsTo(User::class,'further_num');
    }

    public function comments() {
        return $this->belongsTo(Comments::class,'further_comment_num');
    }
}
