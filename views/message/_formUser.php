<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//namespace frontend\models;
/* @var $this yii\web\View */
/* @var $model frontend\models\Messages */
/* @var $form yii\widgets\ActiveForm */
?>
    <?php $form = ActiveForm::begin(); ?>        
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-info']) ?>
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Заказ <span class="caret"></span></button>
                  <ul class="dropdown-menu" role="menu">
                    <?php foreach ($allOrders as $selectOrder): ?>   
                      <li><?= Html::a($selectOrder->order_group_id, ['/message/created?id=' . $selectOrder->order_group_id]) ?></li>                        
                    <?php endforeach; ?>
                  </ul>
            </div>           
        </div>    
        <?= $form->field($allOrders[$id]->org, 'name') ?>
        <?= $form->field($model,'message_text')->textarea(['class' => 'my_post' ,]); ?>
        <?= $form->field($model, 'to_id')->hiddenInput()->label(false)->hint(false); ?>
        <?= $form->field($model, 'from_id')->hiddenInput()->label(false)->hint(false); ?>
        <?= $form->field($model, 'zakaz_id')->hiddenInput()->label(false)->hint(false);?>
        <?= $form->field($model, 'type')->hiddenInput()->label(false)->hint(false);?>
        <?= $form->field($model, 'status')->hiddenInput()->label(false)->hint(false); ?>
    
    <?php ActiveForm::end(); ?>
