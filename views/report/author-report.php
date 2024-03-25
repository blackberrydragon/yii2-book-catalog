<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use app\models\YearForm;

$model = new YearForm();

?>

<h1>ТОП 10 авторов по году</h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'year')->dropDownList($model->getYearsList(), ['prompt' => 'Выберите год...']) ?>

<div class="form-group">
    <?= Html::submitButton('Сформировать', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php if (isset($dataProvider)): ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'authorName',
            'booksCount',
        ],
    ]); ?>
<?php endif; ?>
