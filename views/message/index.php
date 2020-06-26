<?php
use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Messages;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Messages');
$this->registerJs('
    $(".delete-prod").on("click", function() {
        return confirm("Вы действительно хотите удалить товар?"); 
    });
');
?>

<style>
    a, a:link, a:visited, a:hover, a:active {
        text-decoration: none;
        cursor: pointer;
        color: #000;
    }
    a:hover {
        color: #000;
    }
    a:hover span {
        color: #fff;
    }
    .middle-panel {
        padding-left: 5px;
        width: 20%;
        height: 100%;
        float: left;
    }
    .inner-middle-panel {
        height: 100%;
        width: 100%;
    }
    .right-panel {
        padding-left: 5px;
        width: 40%;
        height: 100%;
        float: left;
    }
    .inner-right-panel {
        height: 100%;
        width: 100%;
    }
    .central-panel {
        padding-left: 5px;
        width: 20%;
        height: 100%;
        float: left;
    }
    .products-list {
        width: 100%;
        height: calc(100% - 45px);
        padding-top: 5px;
    }
    .inner-products-list {
        overflow-y: auto;
        height: 100%;
        box-shadow: 0 0 5px rgba(0,0,0,0.5);
        padding: 20px;
    }
    .inner-product-item {
        padding: 10px 5px;
        width: 100%;
    }
    .inner-product-item:hover {
        color: #000;
        background: #eee;
        width: 100%;
        border-radius: 10px 10px;
        padding: 10px 5px;
    }
    .product-item-active {
        color: #000;
        background: #eee;
        width: 100%;
        border-radius: 10px 10px;
        padding: 10px 5px;
    }
    .product-item {
        width: 100%;
        padding: 5px 0;
        color: #fff;
    }
    .product-toolbox {
        width: 100%;
    }
    .inner-product-toolbox {
        width: 100%;
        box-shadow: 0 0 5px rgba(0,0,0,0.5);
        padding: 10px;
    }
    .product-icon {
        float: left;
        padding-left: 25px;
    }
    .inner-product-toolbox span.glyphicon-remove {
        color: #d33;
    }
    .inner-product-toolbox span.glyphicon-remove:hover {
        color: #f00;
    }
    .inner-product-toolbox span.glyphicon-plus {
        color: #3d3;
    }
    .inner-product-toolbox span.glyphicon-plus:hover {
        color: #0f0;
    }
    .glyphicon {
    	font-size: 20px;
    }
    @media screen and (max-width: 768px) {
    	.middle-panel {
            padding-left: 5px;
        	width: 50%;
    	}
    	.right-panel {
        	width: 50%;
    	}
    }
</style>
<div class="middle-panel">
    <div class="inner-middle-panel bgcolor">                    
        <?php if (Yii::$app->controller->action->id == 'index' || Yii::$app->controller->action->id == 'update') : ?>            
            <div class="inner-products-list bgcolor">
                <?php foreach ($contacts as $key => $contact): ?>                        
                    <div class="product-item">
                        <?= Html::a(Html::tag('div', $contact->org->name, ['class' => $contact->org_id == $id ? 'product-item-active' :'inner-product-item']), ['/message/index', 'id' => $key]) ?>
                    </div>
                <?php endforeach; ?>
            </div>            
        <?php endif; ?>
    </div>
</div>
<div class="central-panel">
    <div class="inner-right-panel bgcolor">
        <?php foreach ($orders as $keyOrder => $order): ?>                        
            <div class="product-item">
                <?= Html::a(Html::tag('div', $order->id, ['class' => $order->id == $orderId ? 'product-item-active' :'inner-product-item']), ['/message/index', 'id' => $id, 'orderId' =>$keyOrder]) ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="right-panel">
    <div class="inner-right-panel bgcolor">
        <?php
//            Pjax::begin();           
            if (Yii::$app->controller->action->id == 'index')
            {
                if (!empty($orders))
                {                   
                    echo $this->render('details', [
                        'model' => $model,
                        'orderId' => $orderId,
                        'id' => $id,
                        'messages' => $messages,
                        'user' => $user,                        
                        'orders' => $orders,
                        'downloads' => $downloads,
                    ]);
                }
            }

//            Pjax::end();
        ?>
        
    </div>
</div>

