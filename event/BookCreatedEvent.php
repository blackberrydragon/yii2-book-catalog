<?php

declare(strict_types=1);

namespace app\event;

use app\models\Book;
use yii\base\Event;

class BookCreatedEvent extends Event
{
    const NAME = 'bookCreated';
    public Book $book;
}