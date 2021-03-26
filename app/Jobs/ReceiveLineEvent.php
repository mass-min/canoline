<?php
namespace App\Jobs;

use App\Models\Bot;
use App\Services\LineEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use LINE\LINEBot;
use LINE\LINEBot\Exception\InvalidSignatureException;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\buttonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\SignatureValidator;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;

/**
 * Class ReceiveLineEvent
 *
 * @package App\Jobs
 */
class ReceiveLineEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Bot $bot;
    private string $signature;
    private string $requestBody;

    /**
     * @param Bot $bot
     * @param string $signature
     * @param string $requestBody
     */
    public function __construct(Bot $bot, string $signature, string $requestBody)
    {
        $this->bot = $bot;
        $this->signature = $signature;
        $this->requestBody = $requestBody;
    }

    /**
     * @return void
     */
    public function handle()
    {
        if (!$this->isValidSignature($this->signature, $this->requestBody)) {
            \Log::error("invalid signature\n" . $this->requestBody);

            return;
        }

        $httpClient = new CurlHTTPClient($this->bot->channel_access_token);
        $lineBotClient = new LINEBot($httpClient, ['channelSecret' => $this->bot->channel_secret]);

        $events = $lineBotClient->parseEventRequest($this->requestBody, $this->signature);

        foreach ($events as $event) {
            $eventType = $event->getType();

//            if ($this->bot->id === 1) {
                $questions = $this->bot->questions;
                \Log::info($event->getText());
                foreach ($questions as $question) {
                    \Log::info($question->question_text);
                    if ($event->getText() === $question->question_text) {
                        $textMessageBuilder = new TextMessageBuilder($question->answer_text);
                        $lineBotClient->pushMessage($event->getUserId(), $textMessageBuilder);
                        return;
                    }
                }
                $textMessageBuilder = new TextMessageBuilder('よく分かりません');
                $lineBotClient->pushMessage($event->getUserId(), $textMessageBuilder);
                return;
//            } else {
//                if ($eventType === LineEvent::TYPE_MESSAGE_EVENT) {
//                    $postbackActionBuilder1 = new PostbackTemplateActionBuilder('2021-04-01 10:00', '2021年04月01日 10:00', '2021年04月01日 10:00');
//                    $postbackActionBuilder2 = new PostbackTemplateActionBuilder('2021-04-02 10:00', '2021年04月02日 10:00', '2021年04月02日 10:00');
//                    $postbackActionBuilder3 = new PostbackTemplateActionBuilder('2021-04-03 10:00', '2021年04月03日 10:00', '2021年04月03日 10:00');
//                    $postbackActionBuilder4 = new PostbackTemplateActionBuilder('2021-04-04 10:00', '2021年04月05日 10:00', '2021年04月04日 10:00');
//
//                    $buttonTemplateBuilder = new ButtonTemplateBuilder(
//                        '内見予約日時',
//                        '希望日時を以下から選択してください',
//                        'https://storage.googleapis.com/gweb-uniblog-publish-prod/images/Chrome__logo.max-500x500.png',
//                        [$postbackActionBuilder1, $postbackActionBuilder2, $postbackActionBuilder3, $postbackActionBuilder4],
//                        'rectangle',
//                        'contain',
//                        '#000000'
//                    );
//                    $templateMessageBuilder = new TemplateMessageBuilder('this message is disabled on your device.', $buttonTemplateBuilder);
//                    $lineBotClient->pushMessage($event->getUserId(), $templateMessageBuilder);
//                } elseif ($eventType === LineEvent::TYPE_POSTBACK_EVENT) {
//                    $data = $event->getPostbackData();
//                    //                $params = $event->getPostbackParams();
//                    $textMessageBuilder = new TextMessageBuilder("日時選択ありがとうございます！\nそれでは、" . $data . ' にお待ちしております！');
//                    $lineBotClient->pushMessage($event->getUserId(), $textMessageBuilder);
//                }
//            }
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
