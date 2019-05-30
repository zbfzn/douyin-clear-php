# douyin-clear-php
抖音去水印PHP版接口  

注：因抖音更新，本解析方法失效，请等待修复

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
    "nickname": "刘怡歆",
    "headImage": "https://p9-dy.byteimg.com/aweme/720x720/42dd001908d2257ba12b.jpeg",
    "image": "http://p3-dy.byteimg.com/large/22d020006a5c167c1ba34.jpeg",
    "urls": [
        "http://v3-dy-x.ixigua.com/01f1c6a4a7a03b17ebc691aa9b3d0789/5cef9992/video/m/220549fd926f4f649d9bd37366deabab29511621b8a30000316498fcc2c1/?rc=ajo4O2pxZzVwbTMzaGkzM0ApQHRAb0dGPDM1NDczNDk0ODM4PDNAKXUpQGczdSlAZjN2KUBmaHV5cTFmc2hoZGY7NEBecmQ1NWJiaDVfLS0xLTBzczVvI28jPy0yMDQtLi0tLjIuMC0uL2k6Yi9wIzphLXEjOmAwbyNwYmZyaF4ranQ6Iy8uXg%3D%3D",
        "http://v6-dy.ixigua.com/dd335609f814a7bb09b6f48a2cb98b2b/5cef9992/video/m/220549fd926f4f649d9bd37366deabab29511621b8a30000316498fcc2c1/",
        "https://aweme-hl.snssdk.com/aweme/v1/play/?video_id=v0300f4e0000bj8mk2eden8g88g5u7ag&line=0&ratio=540p&media_type=4&vr_type=0&improve_bitrate=0",
        "https://api-hl.amemv.com/aweme/v1/play/?video_id=v0300f4e0000bj8mk2eden8g88g5u7ag&line=1&ratio=540p&media_type=4&vr_type=0&improve_bitrate=0"
    ],
    "music_urls": [
        "http://p9-dy.byteimg.com/obj/ies-music/1631882631746583.mp3"
    ],
    "info": {
        "share_signature_desc": "TikTok: Make Every Second Count",
        "share_quote": "",
        "share_weibo_desc": "#在抖音，记录美好生活#家里只能有一个不干活的！",
        "share_title": "家里只能有一个不干活的！",
        "bool_persist": 0,
        "share_link_desc": "#在抖音，记录美好生活#家里只能有一个不干活的！ %s 复制此链接，打开【抖音短视频】，直接观看视频！",
        "share_signature_url": "https://tiktokv.com/",
        "share_url": "https://www.iesdouyin.com/share/video/6688223965720169735/?region=CN&mid=6684136905203895051&u_code=hgd1c58i&titleType=title",
        "share_desc": "在抖音，记录美好生活",
        "share_title_myself": "",
        "share_title_other": ""
    }
}
      
````
请求失败：
````json
{
    "status": false,
    "message": "地址无效"
}
````

    参数：
    status:请求状态码true/false  
    message:提示文本，返回结果错误时会返回地址信息  
    nickname:抖音昵称  
    info:视频信息 
    image:封面图片地址  
    headImage:用户头像地址  
    urls:无水印地址  
    music_urls:音乐原声地址  

**喜欢的话，给个star呗**

安卓版项目地址：https://github.com/zbfzn/douyinquick  

![image](https://github.com/zbfzn/douyin-clear-php/blob/master/douyin/douyin-no-wm.png) 

<font>注：仅供学习,切勿用于其他用途。</font>测试站点：https://lyfzn.top/plugins/douyin/videoPrase/
