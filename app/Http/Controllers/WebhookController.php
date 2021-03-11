<?php
namespace App\Http\Controllers;

use App\Jobs\ReceiveLineEvent;
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
     *
     * @return JsonResponse
     */
    public function webhook(Request $request): JsonResponse
    {
        try {
            $signature = $request->headers->get(HTTPHeader::LINE_SIGNATURE);
            ReceiveLineEvent::dispatch($signature, $request->getContent());

            return response()->json([], 200, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            \Log::debug($e);
        }
    }
}
