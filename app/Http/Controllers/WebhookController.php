<?php
namespace App\Http\Controllers;

use App\Jobs\ReceiveLineEvent;
use App\Models\Bot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LINE\LINEBot\Constant\HTTPHeader;

/**
 * Class WebhookController
 *
 * @package App\Http\Controllers
 */
class WebhookController extends Controller
{
    /**
     * @param Request $request
     * @param string $alias
     * @return JsonResponse
     */
    public function webhook(Request $request, string $alias): JsonResponse
    {
        try {
            $bot = Bot::where('alias', $alias)->first();
            $signature = $request->headers->get(HTTPHeader::LINE_SIGNATURE);
            ReceiveLineEvent::dispatch($bot, $signature, $request->getContent());

            return response()->json([], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            \Log::debug($e);
            return response()->json([], 200, [], JSON_UNESCAPED_UNICODE);
        }
    }
}
