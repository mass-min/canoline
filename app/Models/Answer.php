<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    const MAX_ANSWER_COUNT = 5;

    /**
     * @return HasMany
     */
    public function texts()
    {
        return $this->hasMany(AnswerText::class);
    }

    /**
     * @return HasMany
     */
    public function images()
    {
        return $this->hasMany(AnswerImage::class);
    }
}
