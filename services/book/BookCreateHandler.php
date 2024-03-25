<?php

declare(strict_types=1);

namespace app\services\book;

use app\event\BookCreatedEvent;
use app\models\Book;
use yii\base\Component;
use yii\web\UploadedFile;

class BookCreateHandler extends Component
{
    public function handle(Book $book): bool
    {
        $book->imageFile = UploadedFile::getInstance($book, 'imageFile');
        $book->photo = $book->imageFile->baseName . '.' . $book->imageFile->extension;
        if ($book->upload() && $book->save(false)) {
            $event = new BookCreatedEvent(['book' => $book]);
            $this->trigger(BookCreatedEvent::NAME, $event);

            return true;
        }

        return false;
    }
}
