<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Messages;
use frontend\models\Organization;
use frontend\Helpers\OrganizationHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use frontend\models\Downloads;
use frontend\components\MessageDataFactory;

class MessageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex($id = 0, $orderId = 0)
    {
        $objectOfStrategy = MessageDataFactory :: getMessageData(OrganizationHelper::getCurrentOrg()->org_type_id);
        $contacts = $objectOfStrategy->getContacts();
        $id = $id ?: key($contacts);
        $orders = $objectOfStrategy->getOrders($contacts[$id]);
        $user = Organization::findOne(OrganizationHelper::getCurrentOrg()->id);
        $orderId = $orderId ?: key($orders);

        $messages = Messages::find()                                                    
                        ->where(['zakaz_id' => $orders[$orderId]->id])                          
                        ->all();
        
        $model = new Messages();
        $downloads = new Downloads();
        if($model->load(Yii::$app->request->post()))        
        {
            if($model->from_id == OrganizationHelper::getCurrentOrg()->id)
            {                       
                if (Yii::$app->request->isPost) 
                {
                    $fileNames = $this->uploadFile($downloads);
                    if(isset($fileNames))
                    {
                       $fileNames = implode(",", $fileNames);
                    }
                    $model->setAttribute("downloads","$fileNames");
                }

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['index', 'id' => $id, 'orderId' =>$orderId]);
                }
            }
            else throw new NotFoundHttpException(Yii::t('app', 'You do not have the right to perform this action'));
        }
        
        $model->zakaz_id = $orderId;
        $model->from_id = OrganizationHelper::getCurrentOrg()->id;
        $model->to_id = $id;

        return $this->render('index', [  
            'model' => $model,
            'downloads' => $downloads,
            'orders' => array_reverse($orders, true),
            'messages' => $messages,
            'user' => $user,            
            'contacts' => $contacts,
            'orderId' => $orderId,
            'id' => $id,
        ]);
    }

    public function uploadFile($downloads)
    {       
        if (Yii::$app->request->isPost) 
        {
            $downloads->downloads = UploadedFile::getInstances($downloads, 'downloads');
            if(!empty($downloads->downloads))
            {
                $fileNames = $downloads->upload();
                return $fileNames;
            }
            return NULL;
        }        
    }
    
    public function actionDownload($fileName)
    {
        $file = Yii::getAlias($_SERVER['DOCUMENT_ROOT'].'/uploads/'."$fileName");
        return Yii::$app->response->sendFile($file);
    }
    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDeleteFile($fileName, $id)
    {
        $messageData = $this->findModel($id);
        $fileNames = explode(",", $messageData->downloads);
        if(OrganizationHelper::getCurrentOrg()->id == $messageData->from_id)
        {            
            if(is_file($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$fileName))
            {
                $file = Yii::getAlias($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$fileName);
                unlink($file);
                if(($key = array_search($fileName,$fileNames)) !== FALSE)
                {
                    unset($fileNames[$key]);
                    $fileNames = implode(",", $fileNames);
                    $messageData->setAttribute("downloads","$fileNames");
                    $messageData->save();
                }        
            }
            else
            {
                foreach ($fileNames as $fileName)
                {
                    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/'."$fileName"))
                    {
                        $file = Yii::getAlias($_SERVER['DOCUMENT_ROOT'].'/uploads/'."$fileName");
                        unlink($file);
                    }
                }
                return;
            }
            return $this->redirect(['index','id' => $messageData->order->org_id, 'orderId' =>$messageData->zakaz_id]);        
        }
        else throw new NotFoundHttpException(Yii::t('app', 'You do not have the right to perform this action'));
    }
 
    public function actionCreated($shopsId, $orderId)
    {                   
        $model = new Messages();
        $dropdownOrders = Messages::find()
                        ->select(['zakaz_id', 'id'])
                        ->indexBy('zakaz_id')                
                        ->column();        

        $model->zakaz_id = $orderId;
        $model->from_id = OrganizationHelper::getCurrentOrg()->id;
        $model->to_id = $shopsId;
        
        return $model;
    }

    public function actionUpdate($id = 0)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionRemove($id)
    {        
        $messageData = $this->findModel($id);
        if(!empty($messageData->downloads) && $messageData->downloads !== NULL)
        {
            $this->actionDeleteFile(NULL, $id);
        }
        if(OrganizationHelper::getCurrentOrg()->id == $messageData->from_id)
        {
            $orgId = $messageData->order->org_id;
            $orderId  = $messageData->zakaz_id;
            $messageData = $this->findModel($id)->delete();

            return $this->redirect(['index','id' => $orgId, 'orderId' => $orderId]); 
        }
        throw new NotFoundHttpException(Yii::t('app', 'You do not have the right to perform this action'));
    }

    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
