<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;

class BaseController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                [
                    'allow' => true,
                    'actions' => ['view', 'index'],
                    'matchCallback' => function () {
                        return User::isUser() || User::isUserGuest();
                    }
                ],
                [
                    'allow' => true,
                    'actions' => ['create', 'update', 'delete'],
                    'matchCallback' => function () {
                        return User::isUser();
                    }
                ],
            ],
            ],
        ];
    }
}