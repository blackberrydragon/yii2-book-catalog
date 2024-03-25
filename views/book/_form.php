<?php

use app\models\Author;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Book $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
    <?php $authors = ArrayHelper::map(Author::find()->all(), 'id', 'name');
    echo $form->field($model, 'author_ids')->widget(Select2::class, [
        'data' => $authors,
        'options' => ['placeholder' => 'Выберите авторов...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>
    <?php
    if ($model->photo) {
        echo Html::img('@web/uploads/' . $model->photo, ['width' => '200px']);
        echo Html::tag('p', 'Загрузите новое изображение, если хотите его изменить:');
    }
    ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
