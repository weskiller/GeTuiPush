<?php

use Weskiller\GeTuiPush\IGeTui;
use Weskiller\GeTuiPush\Library\IGtAppMessage;
use Weskiller\GeTuiPush\Library\Template\IGtNotificationTemplate;

    require __DIR__ . '/vendor/autoload.php';

    $host = 'http://api.getui.com/apiex.htm';
    $appId = 'toyMDzDnet893SbF6W6ZBA';
    $appKey = 'daCHqFgNek662NqYIcPwM8';
    $masterSecret = 'Gi5FFWsYQCAn3MhoZSmmdA';
    $geTui =  new IGeTui($host,$appKey,$masterSecret);
    $template =  new IGtNotificationTemplate();
    $template->set_appId($appId);                   //应用appid
    $template->set_appkey($appKey);                 //应用appkey
    $template->set_transmissionType(1);            //透传消息类型
    $template->set_transmissionContent("测试离线");//透传内容
    $template->set_title("请输入通知栏标题");      //通知栏标题
    $template->set_text("请输入通知栏内容");     //通知栏内容
    $template->set_logo("");                       //通知栏logo
    $template->set_logoURL("");                    //通知栏logo链接
    $template->set_isRing(true);                   //是否响铃
    $template->set_isVibrate(true);                //是否震动
    $template->set_isClearable(true);              //通知栏是否可清除
    $message = new IGtAppMessage();
    $message->set_isOffline(true);
    $message->set_offlineExpireTime(10 * 60 * 1000);//离线时间单位为毫秒，例，两个小时离线为3600*1000*2
    $message->set_data($template);
    $appIdList=array($appId);
    $message->set_appIdList($appIdList);
    $rep = $geTui->pushMessageToApp($message,"任务组名");
    var_dump($rep);