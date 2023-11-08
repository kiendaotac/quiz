<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['group', 'category_id', 'content', 'status'];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function answer(): HasMany
    {
        return $this->hasMany(Answer::class)->where('correct', true);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
