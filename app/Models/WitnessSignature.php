<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WitnessSignature extends Model
{
    //
    use HasFactory;
    protected $table = 'witness_signature';
    protected $fillable = [
        'personal_num',
        'witness_num',
        'witness_signature',
        'witness_date',
        'round'
    ];
    public function personal()
    {
        return $this->belongsTo(User::class, 'personal_num');
    }

    public function witness()
    {
        return $this->belongsTo(User::class, 'witness_num');
    }
}
