<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['amount', 'note'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
