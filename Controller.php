<?php

namespace qiyu;

class Controller extends \yii\web\Controller
{
    public $layout = false;

    public function render($tpl, $data = [])
    {
        if ($this->isJson()) {
            return $this->renderJson(['tpl' => $tpl, 'data' => $data]);
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
