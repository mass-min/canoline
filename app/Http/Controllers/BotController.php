<?php
namespace App\Http\Controllers;

use App\Models\Bot;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BotController extends Controller
{
    public function create()
    {
        return view('bots.create');
    }

    public function store(Request $request)
    {
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

        return redirect('/');
    }
}
