<?php

use app\models\Subscription;
use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Author $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="author-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (User::isUser()) { ?>

        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
        ],
    ]) ?>

    <div class="subscription-form">
        <?php $form = ActiveForm::begin([
            'action' => ['subscribe', 'id' => $model->id],
            'method' => 'post',
        ]);
        $subscription = Subscription::findOne(['user_id' => Yii::$app->user->id, 'author_id' => $model->id]);
        if ($subscription) {
            echo Html::a('Отписаться', ['unsubscribe', 'authorId' => $model->id], ['class' => 'btn btn-warning']);
        } else {
            echo Html::a('Подписаться на обновления', ['subscribe', 'authorId' => $model->id], ['class' => 'btn btn-success']);
        }
        ?>

        <?php ActiveForm::end(); ?>
    </div>

</div>
