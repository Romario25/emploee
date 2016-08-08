<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $rejectForm \app\forms\InterviewRejectForm */

$this->title = 'Оклонение интервью';
$this->params['breadcrumbs'][] = ['label' => 'Интервью', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interview-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($rejectForm, 'reason')->textarea(['rows' => 8]) ?>



    <div class="form-group">
        <?= Html::submitButton('Reject', ['class' => 'btn btn-error']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
