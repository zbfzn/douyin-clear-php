<?php
header("Content-Type:text/html;charset=utf-8");
$url_g=@$_GET['url'];//抖音视频地址
$api="https://aweme.snssdk.com/aweme/v1/aweme/detail/?retry_type=no_retry&iid=74655440239&device_id=57318346369&ac=wifi&channel=wandoujia&aid=1128&app_name=aweme&version_code=140&version_name=1.4.0&device_platform=android&ssmix=a&device_type=MI+8&device_brand=xiaomi&os_api=22&os_version=5.1.1&uuid=865166029463703&openudid=ec6d541a2f7350cd&manifest_version_code=140&resolution=1080*1920&dpi=1080&update_version_code=1400&ts=1560245644&as=a125372f1c487cb50f&cp=728dcc5bc7f4f558e1&aweme_id=";
$apis=null;
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
    global $apis;
    $header=array("Accept-Encoding: utf-8",
                "Cookie: ".$cookie,
                "User-Agent: okhttp/3.10.0.1"
				);

	$time=time();
	$_rticket=$time.'139';
	$contex=stream_context_create(array('http'=>array('header'=>$header)));
    $data=json_decode(doCurlGetRequest($api.$awemeId."&ts=$time"."&_rticket=$_rticket",$header),true);//curl使用
//    $data=json_decode(file_get_contents($api.$awemeId."&ts=$time"."&_rticket=$_rticket",0,$contex),true);//未开启curl使用

    if(!@$data['aweme_detail']['author']['short_id']){
        $api=$apis['api_251'][0];
        $data=json_decode(doCurlGetRequest($api.$awemeId,$header),true);
//        $data=json_decode(file_get_contents($api.$awemeId."&ts=$time"."&_rticket=$_rticket",0,$contex),true);//未开启curl使用
    }
    if(!@$data['aweme_detail']['author']['short_id']){
        $api=$apis['api_140'][0];
        $data=json_decode(doCurlGetRequest($api.$awemeId,$header),true);
//        $data=json_decode(file_get_contents($api.$awemeId."&ts=$time"."&_rticket=$_rticket",0,$contex),true);//未开启curl使用
    }


	$detail=@$data['aweme_detail'];
    $info=@$detail['share_info'];//视频分享信息
    $user_name=@$detail['author']['nickname'];//作者昵称
	$shortId=@$detail['author']['short_id'];//作者抖音号
    $user_headImg=@$detail['author']['avatar_medium']['url_list'][0];//作者头像
    $image=@$detail['video']['origin_cover']['url_list'][0];//封面图片
    $urls=@$detail['video']['play_addr']['url_list'];//无水印地址
    $music_urls=@$detail['music']['play_url']['url_list'];//音乐地址
	$userId=@$detail['author_user_id'];//用户userId
	$dynamic_cover=@$detail['video']['dynamic_cover']['url_list'][0];//封面动态图地址
	$longVideo=@$detail['long_video'][0]['video']['bit_rate'];//长视频
	
	if(!$longVideo){
		$longVideo=[];
	}
	
    $douyin=[
        'status'=>true,
        'nickname'=>$user_name,
		'shortId'=>$shortId,
		'userId'=>$userId,
        'awemeId'=>$awemeId,
        'headImage'=>$user_headImg,
        'image'=>$image,
		'dynamic_cover'=>$dynamic_cover,
        'urls'=>$urls,
		'long_video'=>$longVideo,
        'music_urls'=>$music_urls,
        'info'=>$info,
        'ts'=>$time
    ];
	if($urls==null&&$user_name==null){
	    $error=[
	        'status'=>false,
            'message'=>'抖音接口调用失败'
        ];
	    return json_encode($error);
    }
    return json_encode($douyin);

}

if(strstr($url_g,'http://v.douyin.com/')) {
    $url_g = getLinkFromDouyinShareText($url_g);
    $awemeId=getAwemeId($url_g,$user_agent);
    $apis=json_decode(file_get_contents("./apis.json"),true);
    echo getVideoData($apis['api_650'][0],null,$awemeId);

}else{
    echo json_encode(["status"=>false,"message"=>"地址无效"]);
}
