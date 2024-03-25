<?php

declare(strict_types=1);

namespace app\services\sms;

use Yii;
use yii\base\Component;

class SmsService extends Component
{
    public $apiKey;

    public function send($phoneNumber, $message): void
    {
        $phone = $phoneNumber;
        $text = $message;
        $sender = 'INFORM';
        $apikey = $this->apiKey;

        $url = 'https://smspilot.ru/api.php'
            . '?send=' . urlencode($text)
            . '&to=' . urlencode($phone)
            . '&from=' . $sender
            . '&apikey=' . $apikey
            . '&format=json';

        $json = file_get_contents($url);

        $result = json_decode($json);
        if (!isset($result->error)) {
            Yii::info('SMS успешно отправлена server_id=' . $result->send[0]->server_id);;
        } else {
            Yii::error($result->error->description_ru);
        }
    }
}