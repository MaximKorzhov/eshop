<style>
.middle-panel {
        padding-left: 5px;
        width: 60%;
        height: 100%;
        float: left;
    }
</style>
<div class="middle-panel">
    
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Messages */

//$this->title = Yii::t('app', 'Create Messages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
       
<div class="messages-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>    
</div>
