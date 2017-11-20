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


    /**
     * 获取已录用的应聘者id
     * @开始时间 $start_date Y-m-d
     * @结束时间 $end_date Y-m-d
     *
     * @return array
     **/
    static function getHiredApplicantIdsByDate($start_date,$end_date){
        //时间
        $dtt_st=strtotime($start_date);
        $dtt_et=strtotime($end_date);
        if(!$dtt_st||!$dtt_et) return 'error';
        $start_date=date('Ymdhis',$dtt_st);//yyyyMMddhhmmss
        $end_date=date('Ymdhis',$dtt_et);//yyyyMMddhhmmss

        $url='http://api.beisenapp.com/RecruitV2/'.\Yii::$app->params['beisen_tenant_id'].'/Applicant/Hired/'.$start_date.'/'.$end_date;
        $res=Curl::curl_get($url,1);
        $res=json_decode($res,true);
        return $res;
    }


    /**
     * 获取指定状态或阶段的应聘者id
     * @开始时间 $start_date Y-m-d
     * @结束时间 $end_date Y-m-d
     * @状态 $status_id S12
     * @阶段 phase_id U11
     *
     * @return array
     **/
    static function getApplicantIdsByDateAndStatus($start_date,$end_date,$status_id='S12',$phase_id='U11'){
        //时间
        $dtt_st=strtotime($start_date);
        $dtt_et=strtotime($end_date);
        if(!$dtt_st||!$dtt_et) return 'error';
        $start_date=date('Ymdhis',$dtt_st);//yyyyMMddhhmmss
        $end_date=date('Ymdhis',$dtt_et);//yyyyMMddhhmmss

        $url='http://api.beisenapp.com/RecruitV2/'.\Yii::$app->params['beisen_tenant_id'].'/applicant/GetApplicantIdsByDateAndStatus?start_time='.$start_date.'&end_time='.$end_date.'&phase_id='.$phase_id.'&status_id='.$status_id;
        $res=Curl::curl_get($url,1);
        $res=json_decode($res,true);
        return $res;
    }

    /**
     * 根据时间戳(更新时间)获取时间段内新增或更新的应聘者ID
     * @开始时间 $start_date Y-m-d
     * @结束时间 $end_date Y-m-d
     * @状态 $status_id S12
     * @阶段 phase_id U11
     * @页数 $page
     * @每页个数 $page_size 最多1000
     * @return array
     **/
    static function getApplicantIdsByDate($start_date,$end_date,$page=1,$page_size=1000){
        //时间
        $dtt_st=strtotime($start_date);
        $dtt_et=strtotime($end_date);
        if(!$dtt_st||!$dtt_et) return 'error';
        $start_date=date('Ymdhis',$dtt_st);//yyyyMMddhhmmss
        $end_date=date('Ymdhis',$dtt_et);//yyyyMMddhhmmss


        $url='http://api.beisenapp.com/RecruitV2/'.\Yii::$app->params['beisen_tenant_id'].'/applicant/GetApplicantIdsByDate?start_time='.$start_date.'&end_time='.$end_date.'&pageNum_Str='.$page.'&pageSize_Str='.$page_size;
        $res=Curl::curl_get($url,1);
        var_dump($res);exit;
        $res=json_decode($res,true);
        return $res;
    }





    /**
     * 根据应聘者ID获取应聘者信息
     * @应聘者id集 以逗号隔开 $applicant_id_collection
     * 注:最多20个
     *
     * @return array
     **/
    static function getApplicantsById($applicant_id_collection){
        if(!$applicant_id_collection) return [];
        $url='http://api.beisenapp.com/RecruitV2/'.\Yii::$app->params['beisen_tenant_id'].'/Applicant/ById/'.$applicant_id_collection.'?language=1&photo_base64=1&has_Long=0';
        $res=Curl::curl_get($url,1);
        $res=json_decode($res,true);

        return $res;
    }





}