<?php
namespace qiyu\web_api;
use qiyu\web_api\Curl;

class BeisenApi{


    //获取所有职位
    static function getJobs(){
        $url='http://api.beisenapp.com/recruit/'.\Yii::$app->params['beisen_tenant_id'].'/Job/ListJobs';
        $res=Curl::curl_get($url,1);
        $res=json_decode($res,true);
        return $res;
    }

    //获取已录用的应聘者id
    //开始时间 $start_date Y-m-d
    //结束时间 $end_date Y-m-d
    static function getHiredApplicantIdsByDate($start_date,$end_date){
        //时间
        $dtt_st=time($start_date);
        $dtt_et=time($end_date);
        if(!$dtt_st||!$dtt_et) return 'error';
        $start_date=date('Ymdhis',$dtt_st);//yyyyMMddhhmmss
        $end_date=date('Ymdhis',$dtt_et);//yyyyMMddhhmmss

        $url='http://api.beisenapp.com/RecruitV2/'.\Yii::$app->params['beisen_tenant_id'].'/Applicant/Hired/'.$start_date.'/'.$end_date;
        $res=Curl::curl_get($url,1);
        $res=json_decode($res,true);
        return $res;
    }

}