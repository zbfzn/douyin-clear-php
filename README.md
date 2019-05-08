# douyin-clear-php
抖音去水印PHP版接口  
使用方法：  
==
    将文件夹放到站点目录即可。  
 ********
 文档： 
 ==
  请求方式：GET  
  --
  请求参数：  
  --
  url：http://v.douyin.com/jJub3C/ 或 http://v.douyin.com/jJub3C/ 复制此链接，打开【抖音短视频】，直接观看视频！
都行。（地址前面不能带\#号，服务器会忽略\#后面的内容）  

  Response：JSON  
  --
请求成功：
````json
{
"status": true,
"message": "http://v.douyin.com/jJub3C/ ",
"user_name": "@DJI 大疆创新",   
"description": "#前方高能 不要眨眼！",  
"imgurl": "https://p3.pstatp.com/large/1d35f00015501740f447b.jpg",  
"user_headimg": "https://p3.pstatp.com/thumb/6c530001ce5f9e9207fe",  
"url": "https://aweme.snssdk.com/aweme/v1/play/?video_id=v0300ffb0000biabmhqhh3mrpo38d760&line=0", 
"url_wm": "https://aweme.snssdk.com/aweme/v1/playwm/?video_id=v0300ffb0000biabmhqhh3mrpo38d760&line=0"  
 }  
      
````
请求失败：
````json
{
	"status": false,
	"message": "地址错误: http:// 复制此链接，打开【抖音短视频】，直接观看视频！"
}
````

    参数：
    `status`:请求状态码true/false  
    message:提示文本，返回结果错误时会返回地址信息  
    user_name:抖音昵称  
    description:视频描述  
    imgurl:封面图片地址  
    user_headimg:用户头像地址  
    url:无水印地址  
    url_wm:有水印地址  

**喜欢的话，给个star呗**

![image](https://github.com/zbfzn/douyin-clear-php/blob/master/douyin/douyin-no-wm.png) 
<font>注：仅供学习,切勿用于其他用途。</font>测试站点：https://lyfzn.top/plugins/douyin/videoPrase/
