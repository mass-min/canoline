<?php
namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BotController extends Controller
{
    public function index()
    {
        $bots = Bot::all();
        return view('bot.index', compact('bots'));
    }

    public function create()
    {
        return view('bot.create');
    }

    public function store(Request $request)
    {
        Company::create([
            'name' => 'hoge 株式会社',
            'email' => 'test@example.com',
            'password' => 'hogehoge',
        ]);
        Bot::create([
            'company_id' => 1,
            'bot_user_id' => '1655333830',
            'basic_id' => $request->basic_id,
            'alias' => Str::uuid(),
            'status' => Bot::STATUS_INACTIVE,
            'display_name' => $request->display_name,
            'channel_secret' => $request->channel_secret,
            'channel_access_token' => $request->channel_access_token,
        ]);

        return redirect(route('bot.index'));
    }

    public function show(Bot $bot)
    {
        return view('bot.show', compact('bot'));
    }
}
