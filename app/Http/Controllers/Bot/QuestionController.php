<?php
namespace App\Http\Controllers\Bot;

use App\Http\Controllers\Controller;
use App\Models\Bot;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function index(Bot $bot)
    {
        $questions = $bot->questions;
        return view('bot.question.index', compact('bot', 'questions'));
    }

    public function create(Bot $bot)
    {
        return view('bot.question.create', compact('bot'));
    }

    public function store(Request $request, Bot $bot)
    {
        Question::create([
            'bot_id' => $bot->id,
            'question_text' => $request->question_text,
            'answer_text' => $request->answer_text,
        ]);

        return redirect(route('bot.question.index', compact('bot')));
    }
}
