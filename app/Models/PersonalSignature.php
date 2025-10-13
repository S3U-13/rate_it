<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalSignature extends Model
{
    //
    use HasFactory;
    protected $table = 'personal_signature';
    protected $fillable = [
        'personal_num',
        'personal_signature',
        'personal_date',
        'round'
    ];
    public function personal()
    {
        return $this->belongsTo(User::class, 'personal_num');
    }
}
