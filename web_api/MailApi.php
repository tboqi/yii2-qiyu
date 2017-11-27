<?php
namespace qiyu\web_api;
use qiyu\web_api\Curl;

class MailApi{
    static function send($to,$title,$content) {
        $to=urlencode($to);
        $title=urlencode($title);
        $content=urlencode($content);
        $url='http://offer.liusida.cn/admin/sendMail.php?to='.$to.'&title='.$title.'&content='.$content;
        return Curl::curl_get($url,0,60);
    }
}