<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_tags', 'tag_id', 'tour_id');
    }
}
