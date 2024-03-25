<?php
declare(strict_types=1);

namespace app\subscribers;

use app\event\BookCreatedEvent;
use app\models\Subscription;
use Yii;

class BookCreatedSubscriber
{
    public static function handle(BookCreatedEvent $event)
    {
        $book = $event->book;
        foreach ($book->authors as $author) {
            $subscriptions = Subscription::findAll(['author_id' => $author->id]);
            foreach ($subscriptions as $subscription) {
                $user = $subscription->getUser();
                $message = "Новая книга автора {$author->name}: {$book->title}";
                Yii::$app->get('smsService')->send($user->phone, $message);
            }
        }
    }
}