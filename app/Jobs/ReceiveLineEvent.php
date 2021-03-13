<?php
namespace App\Jobs;

use App\Services\LineEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use LINE\LINEBot;
use LINE\LINEBot\Exception\InvalidSignatureException;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\SignatureValidator;

/**
 * Class ReceiveLineEvent
 *
 * @package App\Jobs
 */
class ReceiveLineEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $signature;
    private string $requestBody;

    /**
     * @param string $signature
     * @param string $requestBody
     */
    public function __construct(string $signature, string $requestBody)
    {
        $this->signature = $signature;
        $this->requestBody = $requestBody;
    }

    /**
     * @return void
     */
    public function handle()
    {
        if (!$this->isValidSignature($this->signature, $this->requestBody)) {
            \Log::error('invalid signature');
            return;
        }

        $httpClient = new CurlHTTPClient(env('LINE_BOT_CHANNEL_ACCESS_TOKEN'));
        $lineBotClient = new LINEBot($httpClient, ['channelSecret' => env('LINE_BOT_CHANNEL_SECRET')]);

        $events = $lineBotClient->parseEventRequest($this->requestBody, $this->signature);

        foreach ($events as $event) {
            if ($event->getType() === LineEvent::TYPE_MESSAGE_EVENT) {
                $textMessageBuilder = new TextMessageBuilder($event->getText());
                $lineBotClient->pushMessage($event->getUserId(), $textMessageBuilder);
            }
        }
    }

    /**
     * @param string $signature
     * @param string $requestBody
     *
     * @return string|null
     *
     * @throws InvalidSignatureException
     */
    private function isValidSignature(string $signature, string $requestBody): ?string
    {
        return (bool)SignatureValidator::validateSignature($requestBody, env('LINE_BOT_CHANNEL_SECRET'), $signature);
    }
}
