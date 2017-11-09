<?php

namespace qiyu;

use Yii;

class ControllerPlus extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        // var_dump(Yii::$app->controller->module);exit;
        $action = Yii::$app->controller->module->module->requestedRoute;
        // var_dump($action);exit;
        if (\Yii::$app->user->can('/' . $action)) {
            return true;
        } else {
            echo '<div style="margin: 100px auto;text-align: center;background-color: #1ab394; color: #ffffff;width: 500px;height: 50px;line-height: 50px;border-radius: 5px;"><h4>对不起，您现在还没获此操作的权限</h4></div>';
        }
    }
}
