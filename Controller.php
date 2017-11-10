<?php

namespace qiyu;

use Yii;

class Controller extends \yii\web\Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    private $isLogin = false;

    public function render($tpl, $data = [])
    {
        if (Yii::$app->user->getId()) {
            $this->isLogin = true;
        }
        $data += [
            'isLogin' => $this->isLogin,
            'router' => [
                'controller' => \Yii::$app->controller->id,
                'action' => \Yii::$app->controller->action->id,
                'module' => \Yii::$app->controller->module->id,
            ],
            'url' => [
                'static' => '',
            ],
        ];

        if ($this->isJson()) {
            return $this->renderJson([
                'tpl' => $tpl,
                'data' => $data,
            ]);
        } else {
            return parent::render($tpl, $data);
        }
    }

    public function renderJson($arr)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $arr;
    }

    private function isJson()
    {
        if (isset($_GET['isJson']) && $_GET['isJson'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
