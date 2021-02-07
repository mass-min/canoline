<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnswerImage extends Model
{
    /**
     * @return BelongsTo
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }
}
