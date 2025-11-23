<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdBlock extends Model
{
    protected $fillable = [
        'position_key',
        'slot',
        'title',
        'image',
        'url',
        'is_active',
    ];
}
