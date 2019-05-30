<?php
header("Content-Type:text/html;charset=utf-8");
$url_g=@$_GET['url'];//抖音视频地址
$api="https://api-hl.amemv.com/aweme/v1/aweme/detail/?retry_type=no_retry&iid=43619087057&device_id=57318346369&ac=wifi&channel=update&aid=1128&app_name=aweme&version_code=251&version_name=2.5.1&device_platform=android&ssmix=a&device_type=MI+8&device_brand=xiaomi&language=zh&os_api=22&os_version=5.1.1&uuid=865166029463703&openudid=ec6d541a2f7350cd&manifest_version_code=251&resolution=1080*1920&dpi=480&update_version_code=2512&_rticket=1559206461097&ts=1559206460&as=a115996edcf39c7adf4355&cp=9038c058c7f6e4ace1IcQg&mas=01af833c02eb8913ecc7909389749e6d89acaccc2c662686ecc69c&aweme_id=";//6691388713936653576
$cookie="odin_tt=9a16fa42e650a96379a5901a3d146c7c244dc0c35971927f6e13c208fc4bcf9cc952542516f78dc9098ac4d179f3b127cddfdff2942d259dda9ca33de8ae7677; install_id=43619087057; ttreq=1$4c4b4cc4b31e6f2f4203b62a1df12b43e224434c; qh[360]=1";
$user_agent="Mozilla/5.0 (Linux; Android 8.0.0; MI 6 Build/OPR1.170623.027; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/62.0.3202.84 Mobile Safari/537.36";

function getLinkFromDouyinShareText($shareOrUrl){
    $url="http".explode("http",$shareOrUrl)[1];
    $url=explode("复制此链接，",$url)[0];
    return $url;
}
function getAwemeId($link,$UA){
    $context=stream_context_create(array('http'=>array('header'=>'User-Agent:'.$UA)));
    $html_text= file_get_contents($link,0,$context);
    $str=explode("itemId: \"",$html_text)[1];
    $str=explode("\",",$str)[0];
    return $str;
}
function doCurlGetRequest($url,$headers,$timeout = 5){
    if($url == '' || $timeout <=0){
        return false;
    }
    $con = curl_init((string)$url);
    curl_setopt($con, CURLOPT_HEADER, false);
    curl_setopt($con, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($con,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($con, CURLOPT_TIMEOUT,(int)$timeout);
    return curl_exec($con);
}
function getVideoData($api,$cookie,$awemeId){
    $header=array("Accept-Encoding: utf-8",
                "Cookie: ".$cookie,
                "Host: api-hl.amemv.com",
                "Connection: Keep-Alive",
                "User-Agent: okhttp/3.10.0.1");

    $data=json_decode(doCurlGetRequest($api.$awemeId,$header),true);

    $info=$data['aweme_detail']['share_info'];//视频描述
    $user_name=$data['aweme_detail']['author']['nickname'];//作者昵称
    $user_headImg=$data['aweme_detail']['author']['avatar_medium']['url_list'][0];//作者头像
    $image=$data['aweme_detail']['video']['origin_cover']['url_list'][0];//封面图片
    $urls=$data['aweme_detail']['video']['play_addr']['url_list'];//无水印地址
    $music_urls=$data['aweme_detail']['music']['play_url']['url_list'];//音乐地址

    $douyin=[
        'status'=>true,
        'nickname'=>$user_name,
        'awemeId'=>$awemeId,
        'headImage'=>$user_headImg,
        'image'=>$image,
        'urls'=>$urls,
        'music_urls'=>$music_urls,
        'info'=>$info
    ];
    return json_encode($douyin);

}

if(strstr($url_g,'http://v.douyin.com/')) {
    $url_g = getLinkFromDouyinShareText($url_g);
    $awemeId=getAwemeId($url_g,$user_agent);
    echo getVideoData($api,$cookie,$awemeId);

}else{
    echo json_encode(["status"=>false,"message"=>"地址无效"]);
}
