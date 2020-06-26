<?php
namespace frontend\components;

use frontend\controllers\MessageControllerShop;
use frontend\controllers\MessageControllerSupplier;

class MessageDataFactory
{
    public static function getMessageData($id)
    {
        switch ($id)
        {
            case "0":
                return new MessageControllerShop();
            case "1":
                return new MessageControllerSupplier();
            default:
                throw new \Exception("Unknown User type");
        }
    }
}