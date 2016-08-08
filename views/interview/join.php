<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $joinForm \app\forms\InterviewJoinForm */

$this->title = 'Пригласить на интервью';
$this->params['breadcrumbs'][] = ['label' => 'Интервью', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interview-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($joinForm, 'date')->widget(DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>

    <?= $form->field($joinForm, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($joinForm, 'lastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($joinForm, 'email')->textInput(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
