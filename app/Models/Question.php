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
        'bot_id',
        'question_text',
        'answer_text'
    ];

    /**
     * @return BelongsTo
     */
    public function bot(): BelongsTo
    {
        return $this->belongsTo(Bot::class);
    }
}
