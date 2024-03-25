<?php

declare(strict_types=1);

namespace app\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class YearForm extends Model
{
    public $year;

    public function rules()
    {
        return [
            ['year', 'required'],
        ];
    }

    public function getYearsList(): array
    {
        $years = Book::find()->select('year')->distinct()->orderBy('year DESC')->all();
        return ArrayHelper::map($years, 'year', 'year');
    }
}