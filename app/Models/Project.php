<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'details' => 'array',
        'roles' => 'array',
        'technologies' => 'array',
    ];

    public function imageUrl(): string
    {
        return asset('/images/'.$this->image);
    }
}
