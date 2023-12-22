<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
    protected $table = 'memodata';
    protected $guarded = [
        'id',
    ];
}
