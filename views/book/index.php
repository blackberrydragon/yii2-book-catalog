<?php

use app\models\User;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var string $sortOrder */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss("
    .card-img-top {
        width: 100%;
        height: 15vw;
        object-fit: cover;
    }
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .card-body {
        flex-grow: 1;
    }
");

// Текущий порядок сортировки
$sortOrder = $sortOrder === 'DESC' ? 'ASC' : 'DESC';
$sortText = $sortOrder === 'DESC' ? 'Сначала старые' : 'Сначала новые';

// URL для переключения порядка сортировки
$toggleSortUrl = Url::current(['sortOrder' => $sortOrder]);
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= User::isUser()?Html::a(Yii::t('app', 'Create Book'), ['create'], ['class' => 'btn btn-success']):'' ?>
        <?= Html::a($sortText, $toggleSortUrl, ['class' => 'btn btn-default']) ?>
    </p>


    <div class="row">
        <?php foreach ($dataProvider->getModels() as $model): ?>
            <div class="col-md-4">
                <div class="card" style="margin-bottom: 20px;">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= Html::encode($model->title) ?>
                            <p><?php
                                $authors = [];
                                foreach ($model->authors as $author) {
                                    $authors[] = Html::a(Html::encode($author->name), ['author/view', 'id' => $author->id]);
                                }
                                echo implode(', ', $authors);
                                ?></p>
                        </h5>
                        <p class="card-text">
                            <?= Html::img($model->photo ? '@web/uploads/' . $model->photo : '@web/images/default.png', ['alt' => $model->title, 'class' => 'img-fluid']) ?>
                        </p>
                        <a href="<?= Url::to(['view', 'id' => $model->id]) ?>" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?= LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ]); ?>


</div>
