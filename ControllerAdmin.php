<?php

namespace qiyu;

use Yii;
use yii\web\BadRequestHttpException;

class ControllerAdmin extends Controller
{
    public function beforeAction($action)
    {
        parent::beforeAction($action);
        if (!Yii::$app->user->getId()) {
            throw new BadRequestHttpException('没有登录');
        }
        return true;
    }
}
