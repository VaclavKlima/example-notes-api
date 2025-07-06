<?php

namespace App\Models;

use App\Enums\NotePriorityEnum;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
    ];

    protected $casts = [
        'priority' => NotePriorityEnum::class,
    ];
}
