<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $createForm \app\forms\EmployeeCreateForm */

$this->title = 'Create Employee';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="employee-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($createForm, 'firstName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($createForm, 'lastName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($createForm, 'address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($createForm, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($createForm, 'orderDate')->widget(DatePicker::className(), [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => [
                'class' => 'form-control'
            ]
        ]) ?>

        <?= $form->field($createForm, 'contractDate')->widget(DatePicker::className(), [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => [
                'class' => 'form-control'
            ]
        ]) ?>

        <?= $form->field($createForm, 'recruitDate')->widget(DatePicker::className(), [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => [
                'class' => 'form-control'
            ]
        ]) ?>



        <div class="form-group">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
