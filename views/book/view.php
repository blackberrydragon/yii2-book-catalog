<?php

use app\models\User;
use yii\helpers\Html;
use yii\web\YiiAsset;

/** @var yii\web\View $this */
/** @var app\models\Book $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-4">
            <?= Html::img('@web/uploads/' . $model->photo, ['alt' => $model->title, 'style' => 'width:100%;']) ?>
        </div>
        <div class="col-md-8">
            <p><strong><?= Yii::t('app', 'Title') ?>:</strong> <?= Html::encode($model->title) ?></p>
            <p><strong><?= Yii::t('app', 'Authors') ?>:</strong>
                <?php
                $authors = [];
                foreach ($model->authors as $author) {
                    $authors[] = Html::a(Html::encode($author->name), ['author/view', 'id' => $author->id]);
                }
                echo implode(', ', $authors);
                ?>
            </p>
            <p><strong><?= Yii::t('app', 'Year') ?>:</strong> <?= Html::encode($model->year) ?></p>
            <p><strong><?= Yii::t('app', 'ISBN') ?>:</strong> <?= Html::encode($model->isbn) ?></p>
            <p><strong><?= Yii::t('app', 'Description') ?>:</strong> <?= Html::encode($model->description) ?></p>
        </div>
    </div>

    <?php if (User::isUser()){  ?>
    <p class="mt-5">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php }?>

</div>
