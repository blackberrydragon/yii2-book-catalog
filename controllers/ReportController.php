<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\YearForm;
use app\models\Book;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class ReportController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['author-report'],
                        'roles' => ['@'],
                    ],

                ],
            ],
        ];
    }
    public function actionAuthorReport(): string
    {
        $model = new YearForm();
        $dataProvider = null;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $authors = Book::find()
                ->select(['author.name AS authorName', 'COUNT(book.id) AS booksCount'])
                ->joinWith('authors author')
                ->where(['book.year' => $model->year])
                ->groupBy('author.id')
                ->orderBy(['booksCount' => SORT_DESC])
                ->limit(10)
                ->asArray()
                ->all();

            $dataProvider = new ArrayDataProvider([
                'allModels' => $authors,
                'pagination' => false,
            ]);
        }

        return $this->render('author-report', [
            'year' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }
}
