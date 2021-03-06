<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $updateForm \app\forms\InterviewJoinForm */

$this->title = 'Редактирование интервью';
$this->params['breadcrumbs'][] = ['label' => 'Интервью', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="interview-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($updateForm, 'date')->widget(DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>

    <?= $form->field($updateForm, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($updateForm, 'lastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($updateForm, 'email')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
