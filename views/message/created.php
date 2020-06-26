<style>
.middle-panel {
        padding-left: 5px;
        width: 60%;
        height: 100%;
        float: left;
    }
</style>
<div class="middle-panel">
    
 <div class="form-group">
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Messages */

//$this->title = Yii::t('app', 'Create Messages');           
 ?>
     
<div class="messages-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUser', [
        'model' => $model,
        'dropdownOrders' => $dropdownOrders,
        'allOrders' => $allOrders,
        'id' => $id,
    ]) ?>

</div>    
