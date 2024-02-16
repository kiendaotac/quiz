<?php

namespace App\Models;

use App\Enums\ExamStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'number_question', 'user_id', 'status'];

    protected $casts = [
        'status' => ExamStatusEnum::class,
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(ExamQuestion::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
