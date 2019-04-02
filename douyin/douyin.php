<?php
#获取的地址访问时需要自定义User-Agent  为手机模式(抖音的监测机制，电脑端不能播放)
include("simple_html_dom.php");
$url_g=@$_GET['url'];//抖音视频地址
function getLinkFromDouyinShareText($shareOrUrl){
    $url="http".explode("http",$shareOrUrl)[1];
    $url=explode("复制此链接，",$url)[0];
    return $url;
}
function getImgDouyin($attr){
    $attr=explode("url(",$attr)[1];
    $attr=explode(")",$attr)[0];
    return $attr;
}
if(strstr($url_g,'http://v.douyin.com/')){
    $url_g=getLinkFromDouyinShareText($url_g);
    $context=stream_context_create(array('http'=>array('header'=>'User-Agent:Mozilla/5.0 (Linux; Android 8.0.0; MI 6 Build/OPR1.170623.027; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/62.0.3202.84 Mobile Safari/537.36')));
    $html_text= file_get_contents($url_g,0,$context);

    $html=str_get_html($html_text);
    $dom_main=$html->find('#theVideo');
    $dom_title=$html->find('#videoUser .user-title');

    $url_wm=$dom_main[0]->src;//有水印地址
    $info=$dom_title[0]->plaintext;//视频描述
    $user_name=$html->find('#videoUser > div.user-info > p.user-info-name')[0]->plaintext;//作者昵称
    $imgurl=getImgDouyin($html->find('#videoPoster')[0]->style);//封面图片
    $user_headImg=getImgDouyin($html->find('#videoUser > div.user-avator')[0]->style);//作者头像
    $url=str_replace("playwm","play",$url_wm);//无水印地址

    echo json_encode(['status'=>true,'message'=>$url_g,'user_name'=>$user_name,'description'=>$info,'imgurl'=>$imgurl,'user_headimg'=>$user_headImg,'url'=>$url,'url_wm'=>$url_wm]);//
    $html->clear();
}else{
    echo json_encode(['status'=>false,'message'=>'地址错误:'.$url_g]);
}

?>