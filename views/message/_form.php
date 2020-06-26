<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//namespace frontend\models;

/* @var $this yii\web\View */
/* @var $model frontend\models\Messages */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="dropdown">
  <button class="btn dropdown-toggle sr-only" type="button" id="dropdownMenu1" data-toggle="dropdown">
        Dropdown
        <span class="caret"></span>
      </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Действие</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Другое действие</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Что-то еще</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Отдельная ссылка</a></li>
  </ul>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-default">Левая</button>
  <button type="button" class="btn btn-default">Средняя</button>
  <button type="button" class="btn btn-default">Правая</button>
</div>

<div class="btn-group">
  <button type="button" class="btn btn-default">1</button>
  <button type="button" class="btn btn-default">2</button>

  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
        Dropdown
        <span class="caret"></span>
      </button>
    <ul class="dropdown-menu">
      <li><a href="#">Dropdown ссылка</a></li>
      <li><a href="#">Dropdown ссылка</a></li>
    </ul>
  </div>
</div>
<div class="messages-form">

    <?php $form = ActiveForm::begin(); ?>                
        <?= $form->field($model, 'to_id') ?>
        <?= $form->field($model,'message_text')->textarea(['class' => 'my_post' ,]); ?>
        <?= $form->field($model, 'from_id') ?>
        <?= $form->field($model, 'zakaz_id') ?>
        <?= $form->field($model, 'type') ?>
        <?= $form->field($model, 'status') ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>    
    <?php ActiveForm::end(); ?>

</div>
