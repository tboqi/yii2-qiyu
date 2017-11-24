<?php

namespace qiyu;

use Yii;

class ControllerAdmin extends Controller {
    public function beforeAction($action) {
        parent::beforeAction($action);
        if (!Yii::$app->user->getId()) {
            return $this->redirect('/account/login');
        }
        return true;
    }
}
