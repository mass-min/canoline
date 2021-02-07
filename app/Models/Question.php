<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'text',
    ];

    /**
     * @return BelongsTo
     */
    public function bot(): BelongsTo
    {
        return $this->belongsTo(Bot::class);
    }

    /**
     * @return HasOne
     */
    public function answer(): HasOne
    {
        return $this->hasOne(Answer::class);
    }
}
