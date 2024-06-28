<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => asset('front-assets/images'.$this->image)
        );
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
