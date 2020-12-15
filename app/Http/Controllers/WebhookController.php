<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\Exception\InvalidSignatureException;
use LINE\LINEBot\SignatureValidator;

class WebhookController extends Controller
{
    /**
     * @param Request $request
     */
    public function webhook(Request $request)
    {
        try {
            $signature = $this->getValidSignature($request);

            $lineBotClient = app('line-bot');
            $events = $lineBotClient->parseEventRequest($request->getContent(), $signature);

            foreach ($events as $event) {
                \Log::debug($event->getText());
                $res = $lineBotClient->replyText($event->getReplyToken(), $event->getText());

                if ($res->isSucceeded()) {
                    \Log::debug('Succeeded!');
                } else {
                    \Log::debug($res->getHTTPStatus() . ' ' . $res->getRawBody());
                }
            }
        } catch (\Exception $e) {
            \Log::debug($e);
        }
    }

    /**
     * @param Request $request
     * @return string|null
     * @throws InvalidSignatureException
     */
    private function getValidSignature(Request $request): ?string
    {
        $signature = $request->headers->get(HTTPHeader::LINE_SIGNATURE);

        if (!SignatureValidator::validateSignature($request->getContent(), env('LINE_BOT_CHANNEL_SECRET'), $signature)) {
            abort(400);
        }

        return $signature;
    }
}
