<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $from_id
 * @property string $to_id
 * @property string $zakaz_id
 * @property string $type
 * @property string $status
 * @property string $message_text
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }   
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message_text'], 'required'],            
            [['from_id', 'to_id', 'zakaz_id', 'type', 'status'], 'integer'],
            [['message_text'], 'string', 'max' => 255],
            [['downloads'], 'string', 'max' => 255],         
//            [['downloads'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, txt', 'maxFiles' => 10],
//            ['downloads', 'required', 'message' => 'Please choose a username.'],
//            [['downloads'], 'file', 'extensions' => ['jpg','png'],'checkExtensionByMimeType'=>false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from_id' => Yii::t('app', 'From ID'),
            'to_id' => Yii::t('app', 'To ID'),
            'zakaz_id' => Yii::t('app', 'Zakaz ID'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'message_text' => Yii::t('app', ''),
            'downloads' => Yii::t('app', ''),
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->downloads as $file) {
                $file->saveAs('D:/Develop/eshop/frontend/uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
       
    public function getOrd()
    {
        return $this->hasOne(OrderGroup::className(), ['id' => 'zakaz_id']);
    }
    public function getOrgTo()
    {
        return $this->hasOne(Organization::className(), ['id' => 'to_id']);
    }
    public function getOrgFrom()
    {
        return $this->hasOne(Organization::className(), ['id' => 'from_id']);
    }
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['order_group_id' => 'zakaz_id']);
    }
}
