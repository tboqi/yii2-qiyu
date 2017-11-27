<?php
namespace qiyu\web_api;

class Curl{

    static function curl_get($url, $need_token=0,$timeout = 60)
    {
        $ch = curl_init();
        if ($need_token) {
            $headers = array(
                'Authorization: Bearer ' .\Yii::$app->params['beisen_token'],
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }


    static function curl_post($url, array $params = array(), $need_token=0,$timeout = 60)
    {
        $ch = curl_init();
        if ($need_token) {
            $headers = array(
                'Authorization: Bearer ' .\Yii::$app->params['beisen_token'],
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_URL, $url);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        return ($data);
    }
}