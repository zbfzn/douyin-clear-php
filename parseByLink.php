<?php
header("Content-Type:text/html;charset=utf-8");
error_reporting(0);
$url=@$_GET['url'];//抖音视频地址
$isFormat=@$_GET['isFormat'];//是否格式化数据，默认true
$old=@$_GET['old'];//是否使用旧版数据格式，默认false
class Douyin{
    private $UA="Mozilla/5.0 (Linux; Android 8.0.0; MI 6 Build/OPR1.170623.027; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/62.0.3202.84 Mobile Safari/537.36";
    private function getSubstr($str, $leftStr, $rightStr){
        $left = strpos($str, $leftStr);
        $right = strpos($str, $rightStr,$left);
        if($left < 0 or $right < $left) return '';
        return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
    }
    private function getAwemeId($link,$UA)
    {
        $link=ltrim($link);//移除左侧空白字符
        if(strstr($link,'http://v.douyin.com/')){
            $context = stream_context_create(array('http' => array('header' => 'User-Agent:' . $UA)));
            $html_text = file_get_contents($link, 0, $context);
            $str=$this->getSubstr($html_text,"itemId: \"","\",");
            if(!strstr($html_text,"itemId: ")){
                return false;
            }
            return $str;
        }//短链接支持
        if (strstr($link, "https://www.iesdouyin.com")) {//长链接
            $str=$this->getSubstr($link,"video/","/?");
            return $str;
        }//长链接支持
        return false;
    }
    private function getOutPutForError($errorMes){
        $error=[
            'status'=>false,
            'errorMes'=>$errorMes
        ];
        return json_encode($error);
    }
    private function getFormatVideoData($data){

        $detail=@$data;
        $info=@$detail['share_info'];//视频分享信息
        $aweme_id=@$detail['aweme_id'];
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
        $videoData=[
            'nickname'=>$user_name,
            'shortId'=>$shortId,
            'userId'=>$userId,
            'awemeId'=>$aweme_id,
            'headImage'=>$user_headImg,
            'image'=>$image,
            'dynamic_cover'=>$dynamic_cover,
            'urls'=>$urls,
            'long_video'=>$longVideo,
            'music_urls'=>$music_urls,
            'info'=>$info,
        ];
        return $videoData;

    }
    private function parseVideoByLink($url,$isFormat,$old){
        $awemeId=$this->getAwemeId($url,$this->UA);
        $api_position=-1;
        $apis=[
            "https://aweme.snssdk.com/aweme/v1/aweme/detail/?origin_type=link&retry_type=no_retry&iid=40848822342&device_id=56150513062&ac=wifi&channel=update&aid=1128&app_name=aweme&version_code=251&version_name=2.5.1&device_platform=android&ssmix=a&device_type=MI+8&device_brand=xiaomi&language=zh&os_api=22&os_version=5.1.1&uuid=865166029463703&openudid=ec6d541a2f7350cd&manifest_version_code=251&resolution=1080*1920&dpi=480&update_version_code=2512&ts=1561136204&as=a1e500706c54fd8c8d&cp=004ad55fc8d60ac4e1&aweme_id=",//更换设备信息
            "https://aweme.snssdk.com/aweme/v1/aweme/detail/?origin_type=link&retry_type=no_retry&iid=74655440239&device_id=57318346369&ac=wifi&channel=wandoujia&aid=1128&app_name=aweme&version_code=140&version_name=1.4.0&device_platform=android&ssmix=a&device_type=MI+8&device_brand=xiaomi&os_api=22&os_version=5.1.1&uuid=865166029463703&openudid=ec6d541a2f7350cd&manifest_version_code=140&resolution=1080*1920&dpi=1080&update_version_code=1400&ts=1561136201&as=a13520b0e9c40d9cbd&cp=064fdf579fdd07cae1&aweme_id=",
            "https://aweme.snssdk.com/aweme/v1/aweme/detail/?origin_type=link&retry_type=no_retry&iid=75364831157&device_id=68299559251&ac=wifi&channel=wandoujia&aid=1128&app_name=aweme&version_code=650&version_name=6.5.0&device_platform=android&ssmix=a&device_type=xiaomi+8&device_brand=xiaomi&language=zh&os_api=22&os_version=5.1.1&openudid=2e5c5ff4ce710faf&manifest_version_code=660&resolution=1080*1920&dpi=480&update_version_code=6602&mcc_mnc=46000&js_sdk_version=1.16.2.7&ts=1561136206&as=a1257080aec45ddcad&cp=0b4cd25fe4d00ccfe1&aweme_id="
        ];
        $header=array("Accept-Encoding: utf-8",
            "User-Agent: okhttp/3.10.0.1"
        );
        $context=stream_context_create(array("http"=>array("header"=>$header)));
        if($awemeId){
            $isSuccess=false;
            foreach ($apis as $api){
                $ts=time();
                $_rticket=$ts.'182';
                $api_position++;
                $data=json_decode(file_get_contents($api.$awemeId."&ts=$ts&_rticket=$_rticket",0,$context),true);
                $detail=@$data['aweme_detail'];
                $short_id=@$data['aweme_detail']['author']['short_id'];
                if($detail&&$short_id){
                    $isSuccess=true;
                    break;
                }
            }

            if(!$isSuccess){
                return $this->getOutPutForError("抖音接口调用失败");
            }
            if($old){
                if($isFormat) {
                    $out = $this->getFormatVideoData($data['aweme_detail']);
                }else{
                    $out=$data['aweme_detail'];
                }
                $out['status']=true;
                $out['api_position']=$api_position;
                $out['dataType_new']=!old;
                return json_encode($out);
            }
            $out=[
                'status'=>true,
                'data'=>null,
                'api_position'=>$api_position,
                'dataType_new'=>!$old
            ];
            if($isFormat) {
                $out['data'] = $this->getFormatVideoData($data['aweme_detail']);
            }else{
                $out['data']=$data['aweme_detail'];
            }
            return json_encode($out);
        }
        return $this->getOutPutForError('链接不正确');
    }
    private function checkParams($url,&$isFormat,&$old){
        if(empty($url)) return false;
        if($isFormat==null) $isFormat=true;
        if($old==null) $old=false;
        return true;
    }
    function get($url,$isFormat,$old){
        $pass=$this->checkParams($url,$isFormat,$old);
        if(!$pass)
            return $this->getOutPutForError("地址无效");
        else
            return $this->parseVideoByLink($url,$isFormat,$old);
    }
}

$douyin=new Douyin();
echo $douyin->get($url,$isFormat,$old);
