<?php

declare(strict_types=1);

namespace app\services\book;

use app\models\Book;
use Yii;
use yii\web\UploadedFile;

class BookUpdateHandler
{
    public function handle(Book $book): bool
    {
        $oldImage = $book->photo;
        $book->imageFile = UploadedFile::getInstance($book, 'imageFile');
        if ($book->imageFile && $book->upload()) {
            $book->photo = $book->imageFile->baseName . '.' . $book->imageFile->extension;
        }

        if ($book->save(false)) {
            if ($oldImage && file_exists(Yii::getAlias('@webroot/uploads/') . $oldImage)) {
                unlink(Yii::getAlias('@webroot/uploads/') . $oldImage);
            }
            return true;
        }
        return false;
    }
}
