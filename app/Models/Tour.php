<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_public',
        'image',
        'likes',
        'title',
        'description',
        'price',
        'currency',
        'hotel_stars',
        'city',
        'tour_composition',
        'amenities',
        'days',
        'nights'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tour_tags', 'tour_id', 'tag_id');
    }
}
