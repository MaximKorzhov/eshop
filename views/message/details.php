<?php
/* @var $id */
/* @var Product $item  */
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Html;

?>

<style>  
    .detail-toolbox {
        width: 100%;
        box-shadow: 0 0 5px rgba(0,0,0,0.5);
        padding: 10px;
    }
    .detail-icon {
        float: left;
        padding-left: 25px;
    }
    .details {
        width: 100%;       
        height: calc(100% - 45px);
    }
    .inner-details {
        overflow-y: auto;
        height: 110%;
        width: 100%;
        box-shadow: 0 0 5px rgba(0,0,0,0.5);
        padding: 20px;
    }
    .inner-message {
        overflow-y: auto;        
        width: 100%;
        box-shadow: 0 0 5px rgba(0,0,0,0.5);
        padding: 20px;
        margin-top: 12px;
    }
    .inner-product-item {
        padding: 5px 1px;
        width: 100%;
    }
    .file-contaner {
    padding: 6px 30px 7px 0;
    position: relative;
    margin: 0 7px;
    cursor: pointer;
}

 .selected-icon:hover {
      webkit-transform: scale(1.6);
      ms-transform: scale(1.6);
      transform: scale(1.6);
    }
</style>

<div class="details bg">
    <div class="inner-details bgcolor clearfix">        
        <h2>По заказу <?= $orders[$orderId]->id ?> от <?= $orders[$orderId]->date ?></h2>
        <?php foreach ($messages as $message): ?>                    
            <div class="inner-message bgcolor clearfix">
                <?php if($message->orgFrom->id == $model->from_id):?>
                <?=
                    Html::a(Html::tag('span', '', ['class' => "glyphicon glyphicon-trash selected-icon", 'style'=>"float: right; color:red; font-size: 70%", 'title' => 'Удалить сообщение']), ['/message/remove?id=' . $message->id])
                ?>                                
                <?php endif; ?>
                <p><font style="font-weight: bold"><?= $message->orgFrom->name?></font>
                <?= date("d-m-Y h:i:s") ?></p>                    
                <?= $message->message_text?> 
                <?php if(!empty ($message->downloads)): ?>
                    <?php $files = explode(",", $message->downloads); ?>                                                
                    <div class = "file-contaner">
                        <br/>
                        <?php foreach ($files as $file): ?> 
                            <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/'."$file")): ?>
                                <div class = "file-contaner">
                                    <span class = "inner-product-item">
                                        <?=
                                            Html::a(Html::tag('span', '', ['class' => "glyphicon glyphicon-download", 'style'=>"color:blue;", 'title' => 'Загрузить файл']), ['/message/download?fileName=' . $file])
                                        ?>
                                    </span> 
                                    <?= Html::a(Html::tag('span', $file, ['class' => 'inner-product-item', 'title' => 'Загрузить файл']), ['/message/download?fileName=' . $file]) ?>
                                    <span class = "inner-product-item">
                                        <?=
                                            Html::a(Html::tag('span', '', ['class' => "glyphicon glyphicon-trash", 'style'=>"color:red; font-size: 70%", 'title' => 'Удалить файл']), ['/message/delete-file', 'fileName'=>$file, 'id'=>$message->id])
                                        ?>
                                    </span> 
                                </div>
                                <br/>
                            <?php endif; ?>        
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>  
            </div>
        <?php endforeach; ?>  
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>                   
            <div class="inner-message bgcolor clearfix">
                <?= $form->field($model,'message_text')->textarea(['placeholder'=>'Введите текст нового сообщения','rows' => '6']); ?>
                <?= $form->field($model, 'to_id')->hiddenInput()->label(false)->hint(false); ?>
                <?= $form->field($model, 'from_id')->hiddenInput()->label(false)->hint(false); ?>
                <?= $form->field($model, 'zakaz_id')->hiddenInput()->label(false)->hint(false);?>
                <?= $form->field($model, 'type')->hiddenInput()->label(false)->hint(false);?>
                <?= $form->field($model, 'status')->hiddenInput()->label(false)->hint(false); ?>
                <?= $form->field($downloads, 'downloads[]')->fileInput(['multiple' => true, 'accept' => "application/pdf/docx"]) ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-info']) ?>   
                </div>    
            </div>

        <?php ActiveForm::end(); ?>
        <p>________________________</p>
        <p>Данные поставщика:</p>
        <p><?= $model->orgTo->user->fullname ?></p>
        <p><?= $model->orgTo->name ?></p>
        <p>Контактный телефон: <?= $model->orgTo->user->tel ?></p>
        <p>Электронный адрес: <?= $model->orgTo->user->email ?></p>        
    </div>
</div>