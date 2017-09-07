<?php

namespace qiyu;

class Controller extends \yii\web\Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    public function render($tpl, $data = [])
    {
        if ($this->isJson()) {
            return $this->renderJson([
                'tpl' => $tpl,
                'data' => $data,
                'controller' => \Yii::$app->controller->id,
                'action' => \Yii::$app->controller->action->id,
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
