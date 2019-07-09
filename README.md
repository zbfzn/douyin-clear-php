# douyin-clear-php
抖音去水印PHP版接口  

修复5.29无法解析的问题  
源码已上传  
19-06-04:接口变更（https://aweme.snssdk.com/aweme/v1/aweme/detail/）  
19-06-05：新增长视频，userId、抖音id  
19-06-13：提供几个可用API，在apis.txt里，源代码的api不能使用时换一个即可  
19-06-25：3种接口失效自动切换（注：官方APP在某些时候也会出现不能解析出视频链接的情况，此情况下若你的APP能识别并解析分享链接，而接口解析不出来的话请反馈给我，接口抓取请参照https://github.com/zbfzn/douyin-clear-php/issues/5 ）  
19-07-10：优化代码结构，删除一些不必要的代码，取消curl

使用方法：  
==
    环境：php（本人v7.2）
    ./parseByLink.php?url=视频分享地址&isFormat=1
    （喜欢给个star呗┗( ▔, ▔ )┛）
 ********
 文档： 
 ==
  请求方式：GET  
  --
  请求参数：  
  --
  url：http://v.douyin.com/jJub3C/ 或 http://v.douyin.com/jJub3C/ 复制此链接，打开【抖音短视频】，直接观看视频！
都行。（地址前面不能带\#号，服务器会忽略\#后面的内容）  
  isFormat:是否格式化数据，0为不格式化，默认：格式化  
  
  Response：JSON  
  --
请求成功：
````json
{
    "status": true,
    "data": {
        "nickname": "翔翔大作战",
        "shortId": "11397472",
        "userId": 59618628613,
        "awemeId": "6690863055015775502",
        "headImage": "https://p3-dy.byteimg.com/aweme/720x720/552800247d0a9e145b74.jpeg",
        "image": "http://p3-dy.byteimg.com/large/238d400031b33bbc76f6b.jpeg",
        "dynamic_cover": "https://p1-dy.byteimg.com/obj/238500004db5ff26aea6a",
        "urls": [
            "http://v3-dy-y.bytecdn.cn/299e7df9631aabf06a62face0b166dd7/5d24d545/video/m/220c37bbfd63b114b48a33ec7fe99ff4cab116210f630000aa53aeba0895/?rc=amhpeWp0dW1lbTMzZGkzM0ApQHRAbzQ3ODozNjczNDY4MzM6PDNAKXUpQGczdSlAZjN2KUBmcHcxZnNoaGRmOzRAYmllaDQzbmRhXy0tNi0wc3MtbyNvIy42MjM1LS4tLTIyLS4tLi9pOmIvcCM6YS1xIzpgLW8jYmZoXitqdDojLy5e",
            "http://v6-dy.bytecdn.cn/016a468e9b01421a8a4c080a9c7b959d/5d24d545/video/m/220c37bbfd63b114b48a33ec7fe99ff4cab116210f630000aa53aeba0895/",
            "https://aweme.snssdk.com/aweme/v1/play/?video_id=v0300f9a0000bjdbgjqr6q7gkvhfleeg&line=0&ratio=540p&media_type=4&vr_type=0&improve_bitrate=0&is_play_url=1",
            "https://api.amemv.com/aweme/v1/play/?video_id=v0300f9a0000bjdbgjqr6q7gkvhfleeg&line=1&ratio=540p&media_type=4&vr_type=0&improve_bitrate=0&is_play_url=1"
        ],
        "long_video": [
            {
                "play_addr": {
                    "uri": "v0300f090000bjdbf7bjvclba8s62vq0",
                    "url_list": [
                        "http://v6-dy.bytecdn.cn/6a7f9b2894642c1e92d66f6bb3922dd0/5d24d655/video/m/220f78f17639c464b24900c30f7f77fbb6311620e43c000056cfc17f4827/?rc=M3k5O2VmbTplbTMzPGkzM0ApQHRAbzQ3ODozNjczNDY4MzM6PDNAKXUpQGczdSlAZjN2KUBmcHcxZnNoaGRmOzRAbi9wXmlzX2NhXy0tLS0wc3M1byNvIy42MjM1LS4tLTIyLS4tLi9pOmIwcCM6YS1xIzpgLW8jYmZoXitqdDojLy5e",
                        "http://v9-dy.bytecdn.cn/ef61fb7c4733f7df0f76ac2ff5183f92/5d24d655/video/m/220f78f17639c464b24900c30f7f77fbb6311620e43c000056cfc17f4827/",
                        "https://aweme.snssdk.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=0&ratio=720p&media_type=4&vr_type=0&improve_bitrate=0&is_play_url=1",
                        "https://api.amemv.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=1&ratio=720p&media_type=4&vr_type=0&improve_bitrate=0&is_play_url=1"
                    ],
                    "width": 720,
                    "height": 720,
                    "url_key": "v0300f090000bjdbf7bjvclba8s62vq0_h264_720p_1697129"
                },
                "is_h265": 0,
                "gear_name": "normal_720",
                "quality_type": 10,
                "bit_rate": 1697129
            },
            {
                "gear_name": "normal_540",
                "quality_type": 20,
                "bit_rate": 1503995,
                "play_addr": {
                    "uri": "v0300f090000bjdbf7bjvclba8s62vq0",
                    "url_list": [
                        "http://v6-dy.bytecdn.cn/04558f52f2ac82fa1411c10890aabd03/5d24d655/video/m/220477b41d319374f16ae3f3a60861490c911620dd33000097146d7159d2/?rc=M3k5O2VmbTplbTMzPGkzM0ApQHRAbzQ3ODozNjczNDY4MzM6PDNAKXUpQGczdSlAZjN2KUBmcHcxZnNoaGRmOzRAbi9wXmlzX2NhXy0tLS0wc3M1byNvIy42MjM1LS4tLTIyLS4tLi9pOmIwcCM6YS1xIzpgLW8jYmZoXitqdDojLy5e",
                        "http://v9-dy.bytecdn.cn/66b0fbf6db122a5e7f7e56c9fbb9cfaa/5d24d655/video/m/220477b41d319374f16ae3f3a60861490c911620dd33000097146d7159d2/",
                        "https://aweme.snssdk.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=0&ratio=540p&media_type=4&vr_type=0&improve_bitrate=0&is_play_url=1",
                        "https://api.amemv.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=1&ratio=540p&media_type=4&vr_type=0&improve_bitrate=0&is_play_url=1"
                    ],
                    "width": 720,
                    "height": 720,
                    "url_key": "v0300f090000bjdbf7bjvclba8s62vq0_h264_540p_1503995"
                },
                "is_h265": 0
            },
            {
                "bit_rate": 376426,
                "play_addr": {
                    "height": 720,
                    "url_key": "v0300f090000bjdbf7bjvclba8s62vq0_h264_360p_376426",
                    "uri": "v0300f090000bjdbf7bjvclba8s62vq0",
                    "url_list": [
                        "http://v6-dy.bytecdn.cn/fc869acfc2e2a5952a310a311029477c/5d24d655/video/m/22044ef5d82c05446f488d4e6e2bc399f1e116210b63000033af3f0b1ce9/?rc=M3k5O2VmbTplbTMzPGkzM0ApQHRAbzQ3ODozNjczNDY4MzM6PDNAKXUpQGczdSlAZjN2KUBmcHcxZnNoaGRmOzRAbi9wXmlzX2NhXy0tLS0wc3M1byNvIy42MjM1LS4tLTIyLS4tLi9pOmIucCM6YS1xIzpgLW8jYmZoXitqdDojLy5e",
                        "http://v9-dy.bytecdn.cn/9b2c55f65280961b3385282a01e4aeb2/5d24d655/video/m/22044ef5d82c05446f488d4e6e2bc399f1e116210b63000033af3f0b1ce9/",
                        "https://aweme.snssdk.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=0&ratio=360p&media_type=4&vr_type=0&improve_bitrate=0&is_play_url=1",
                        "https://api.amemv.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=1&ratio=360p&media_type=4&vr_type=0&improve_bitrate=0&is_play_url=1"
                    ],
                    "width": 720
                },
                "is_h265": 0,
                "gear_name": "normal_360",
                "quality_type": 40
            }
        ],
        "music_urls": [
            "http://p3-dy.byteimg.com/obj/ies-music/1633496586048539.mp3"
        ],
        "info": {
            "share_signature_url": "https://tiktokv.com/",
            "share_url": "https://www.iesdouyin.com/share/video/6690863055015775502/?region=CN&mid=6690707475848809230&u_code=gj49fkd1&titleType=title",
            "bool_persist": 0,
            "share_title_myself": "",
            "share_title_other": "",
            "share_signature_desc": "TikTok: Make Every Second Count",
            "share_quote": "",
            "share_weibo_desc": "#在抖音，记录美好生活#高铁商务座和普通座到底什么区别，一节车厢竟只有5个座位，太爽#vlog美食记 #抖音玩乐攻略 ",
            "share_desc": "在抖音，记录美好生活",
            "share_title": "高铁商务座和普通座到底什么区别，一节车厢竟只有5个座位，太爽#vlog美食记 #抖音玩乐攻略 ",
            "share_link_desc": "#在抖音，记录美好生活#高铁商务座和普通座到底什么区别，一节车厢竟只有5个座位，太爽#vlog美食记 #抖音玩乐攻略  %s 复制此链接，打开【抖音短视频】，直接观看视频！"
        }
    },
    "api_position": 0
}
      
````
请求失败：
````json
{
    "status": false,
    "errorMes": "地址无效"
}
````
````json
{
   "status": false,
   "errorMes": "抖音接口调用失败"
}
````

    参数：
    status:请求状态码true/false  
    message:提示文本，返回结果错误时会返回地址信息  
    data:返回的数据都在这里面  
    nickname:抖音昵称  
    awemeId：视频资源Id
    info:视频信息 
    image:封面图片地址(静态)
    headImage:用户头像地址  
    urls:无水印地址  
    music_urls:音乐原声地址 
    dynamic_cover:动态封面图（19-06-05加）  
    long_video:长视频（完整视频信息（19-06-05加）  
    userId:作者userId（19-06-05加）  
    shortId：作者抖音Id（19-06-05加）  
    api_position:具体使用的api的下标（19-07-10加）  
    
    
   如有间歇性无法使用请反馈给我。经测试，有时候APP也会出现无法解析的情况，这种情况可以换低版本的API试试。    
   鉴于当前版本需手动获取链接，之后会提供更加稳定的方式（动态生成链接）。    

**喜欢的话，给个star呗**

衍生项目：  
==
安卓版项目地址：https://github.com/zbfzn/douyinquick  


<font>注：仅供学习,切勿用于其他用途。</font>测试站点：https://lyfzn.top/plugins/douyin/videoPrase/
