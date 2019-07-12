<?php
/**
 * Created by zbfzn,My GitHub: https://github.com
 * 依赖文件douyinDevice.txt
 */
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
        }//短链接支持<?php
/**
 * Created by zbfzn,My GitHub: https://github.com
 * 依赖文件douyinDevice.txt
 */
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
    private function getOutPutForError($errorMes,$old){
        if($old){
            $error=[
                'status'=>false,
                'message'=>$errorMes
            ];
            return json_encode($error);
        }else{
            $error=[
                'status'=>false,
                'errorMes'=>$errorMes
            ];
            return json_encode($error);
        }

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
    private function getDevices(){
        return explode("\n",file_get_contents("./douyinDevice.txt"));
    }
    private function getApis($deviceInfos,$api_n,&$api_positions){
        $base_api="https://aweme.snssdk.com/aweme/v1/aweme/detail/?origin_type=link&retry_type=no_retry&{}&ac=wifi&channel=update&aid=1128&app_name=aweme&version_code=251&version_name=2.5.1&device_platform=android&ssmix=a&device_type=MI+8&device_brand=xiaomi&language=zh&os_api=22&os_version=5.1.1&uuid=865166029463703&openudid=ec6d541a2f7350cd&manifest_version_code=251&resolution=1080*1920&dpi=480&update_version_code=2512&ts=1561136204&as=a1e500706c54fd8c8d&cp=004ad55fc8d60ac4e1&aweme_id=";
        $apis=[];
        $devices_size=sizeof($deviceInfos);
        for($i=0;$i<($devices_size<$api_n?$devices_size:$api_n);$i++){
            try{
                $rand=random_int(0,sizeof($deviceInfos)-1);
            }catch (Exception $e){
                exit($this->getOutPutForError("PHP随机数错误"));
            }
            $apis[]=str_replace("{}",$deviceInfos[$rand],$base_api);
            $api_positions[]=$rand;
        }
        return $apis;
    }
    /** 
     * @param $url
     * @param $isFormat
     * @param $old
     * @return false|string
     */
    private function parseVideoByLink($url,$isFormat,$old){
        $awemeId=$this->getAwemeId($url,$this->UA);
        $api_positions=[];
        $api_positions_error=[];
        $api_n=4;//控制每次取得设备信息数量
        $deviceInfos=$this->getDevices();
        $apis=$this->getApis($deviceInfos,$api_n,$api_positions);
        $header=array("Accept-Encoding: utf-8",
            "User-Agent: okhttp/3.10.0.1"
        );
        $context=stream_context_create(array("http"=>array("header"=>$header)));
        if($awemeId){
            $isSuccess=false;
            $count=-1;
            foreach ($apis as $api){
                $count++;
                $api_position=$api_positions[$count];
                $data=json_decode(file_get_contents($api.$awemeId,0,$context),true);
                $detail=@$data['aweme_detail'];
                $short_id=@$data['aweme_detail']['author']['short_id'];
                if($detail&&$short_id){
                    $isSuccess=true;
                    break;
                }
                $api_positions_error[]=$api_position;
            }
            $str_position=null;//储存失败接口位置
            foreach ($api_positions_error as $p){
                $str_position=$str_position."[$p]";
            }
            if(!$isSuccess){
                return $this->getOutPutForError("抖音接口调用失败$str_position",$old);
            }
            if($old){
                if($isFormat) {
                    $out = $this->getFormatVideoData($data['aweme_detail']);
                }else{
                    $out['data']=$data['aweme_detail'];
                }
                $out['status']=true;
                $out['message']=$url;
                $out['api_position']=$api_position;
                $out['error_api']=$str_position;
                $out['dataType_new']=!$old;
                return json_encode($out);
            }else{
                $out=[
                    'status'=>true,
                    'message'=>$url,
                    'data'=>null,
                    'api_position'=>$api_position,
                    'dataType_new'=>!$old,
                    'error_api'=>$str_position
                ];
                if($isFormat) {
                    $out['data'] = $this->getFormatVideoData($data['aweme_detail']);
                }else{
                    $out['data']=$data['aweme_detail'];
                }
                return json_encode($out);
            }

        }
        return $this->getOutPutForError('链接不正确',$old);
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
            return $this->getOutPutForError("地址无效",$old);
        else
            return $this->parseVideoByLink($url,$isFormat,$old);
    }
}

$douyin=new Douyin();
echo $douyin->get($url,$isFormat,$old);

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
    private function getDevices(){
        return explode("\n",file_get_contents("./douyinDevice.txt"));
    }
    private function getApis($deviceInfos,$api_n,&$api_positions){
        $base_api="https://aweme.snssdk.com/aweme/v1/aweme/detail/?origin_type=link&retry_type=no_retry&{}&ac=wifi&channel=update&aid=1128&app_name=aweme&version_code=251&version_name=2.5.1&device_platform=android&ssmix=a&device_type=MI+8&device_brand=xiaomi&language=zh&os_api=22&os_version=5.1.1&uuid=865166029463703&openudid=ec6d541a2f7350cd&manifest_version_code=251&resolution=1080*1920&dpi=480&update_version_code=2512&ts=1561136204&as=a1e500706c54fd8c8d&cp=004ad55fc8d60ac4e1&aweme_id=";
        $apis=[];
        $devices_size=sizeof($deviceInfos);
        for($i=0;$i<($devices_size<$api_n?$devices_size:$api_n);$i++){
            try{
                $rand=random_int(0,sizeof($deviceInfos)-1);
            }catch (Exception $e){
                exit($this->getOutPutForError("PHP随机数错误"));
            }
            $apis[]=str_replace("{}",$deviceInfos[$rand],$base_api);
            $api_positions[]=$rand;
        }
        return $apis;
    }
    /**
     * @param $url
     * @param $isFormat
     * @param $old
     * @return false|string
     */
    private function parseVideoByLink($url,$isFormat,$old){
        $awemeId=$this->getAwemeId($url,$this->UA);
        $api_positions=[];
        $api_positions_error=[];
        $api_n=4;//控制每次取得设备信息数量
        $deviceInfos=$this->getDevices();
        $apis=$this->getApis($deviceInfos,$api_n,$api_positions);
        $header=array("Accept-Encoding: utf-8",
            "User-Agent: okhttp/3.10.0.1"
        );
        $context=stream_context_create(array("http"=>array("header"=>$header)));
        if($awemeId){
            $isSuccess=false;
            $count=-1;
            foreach ($apis as $api){
                $count++;
                $api_position=$api_positions[$count];
                $data=json_decode(file_get_contents($api.$awemeId,0,$context),true);
                $detail=@$data['aweme_detail'];
                $short_id=@$data['aweme_detail']['author']['short_id'];
                if($detail&&$short_id){
                    $isSuccess=true;
                    break;
                }
                $api_positions_error[]=$api_position;
            }
            $str_position=null;//储存失败接口位置
            foreach ($api_positions_error as $p){
                $str_position=$str_position."[$p]";
            }
            if(!$isSuccess){
                return $this->getOutPutForError("抖音接口调用失败$str_position");
            }
            if($old){
                if($isFormat) {
                    $out = $this->getFormatVideoData($data['aweme_detail']);
                }else{
                    $out['data']=$data['aweme_detail'];
                }
                $out['status']=true;
                $out['api_position']=$api_position;
                $out['dataType_new']=!$old;
                return json_encode($out);
            }
            $out=[
                'status'=>true,
                'data'=>null,
                'api_position'=>$api_position,
                'dataType_new'=>!$old,
                'error_api'=>$str_position
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
