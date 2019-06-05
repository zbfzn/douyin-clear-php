# douyin-clear-php
抖音去水印PHP版接口  

修复5.29无法解析的问题  
源码已上传  
19-06-04:接口变更（https://aweme.snssdk.com/aweme/v1/aweme/detail/）  
19-06-05：新增长视频，userId、抖音id  

使用方法：  
==
    ./parseByLink.php?url=视频分享地址
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

  Response：JSON  
  --
请求成功：
````json
{
	"status": true,
	"nickname": "翔翔大作战",
	"shortId": "11397472",
	"userId": 59618628613,
	"awemeId": "6690863055015775502",
	"headImage": "https://p1-dy.byteimg.com/aweme/720x720/552800247d0a9e145b74.jpeg",
	"image": "http://p3-dy.byteimg.com/large/2395d000017931e0e0962.jpeg",
	"dynamic_cover": "https://p3-dy.byteimg.com/obj/238500004db5ff26aea6a",
	"urls": [
		"http://v6-dy.ixigua.com/f241156742f35b7fa6032a01ced1e241/5cf76908/video/m/220c37bbfd63b114b48a33ec7fe99ff4cab116210f630000aa53aeba0895/?rc=amhpeWp0dW1lbTMzZGkzM0ApQHRAb0RIMzwzNzYzNDc1Nzg5PDNAKXUpQGczdSlAZjN2KUBmaHV5cTFmc2hoZGY7NEBiaWVoNDNuZGFfLS02LTBzczVvI28jNDM2LjItLi0tLS0uLS0uL2k6YjBwIzphLXEjOmAwbyNwYmZyaF4ranQ6Iy8uXg%3D%3D",
		"http://v9-dy.ixigua.com/e2661685f7d73630e2818deaa3404a31/5cf76908/video/m/220c37bbfd63b114b48a33ec7fe99ff4cab116210f630000aa53aeba0895/",
		"https://aweme.snssdk.com/aweme/v1/play/?video_id=v0300f9a0000bjdbgjqr6q7gkvhfleeg&line=0&ratio=540p&media_type=4&vr_type=0&improve_bitrate=0",
		"https://api.amemv.com/aweme/v1/play/?video_id=v0300f9a0000bjdbgjqr6q7gkvhfleeg&line=1&ratio=540p&media_type=4&vr_type=0&improve_bitrate=0"
	],
	"long_video": [
		{
			"gear_name": "normal_720",
			"quality_type": 10,
			"bit_rate": 1697129,
			"play_addr": {
				"uri": "v0300f090000bjdbf7bjvclba8s62vq0",
				"url_list": [
					"http://v5-dy.ixigua.com/770c1a2cc317bfed39ba69519d4bb15f/5cf76a18/video/m/220f78f17639c464b24900c30f7f77fbb6311620e43c000056cfc17f4827/?rc=M3k5O2VmbTplbTMzPGkzM0ApQHRAb0RIMzwzNzYzNDc1Nzg5PDNAKXUpQGczdSlAZjN2KUBmaHV5cTFmc2hoZGY7NEBuL3BeaXNfY2FfLS0tLTBzczVvI28jNDM2LjItLi0tLS0uLS0uL2k6YjBwIzphLXEjOmAtbyNwYmZyaF4ranQ6Iy8uXg%3D%3D",
					"http://v9-dy.ixigua.com/340a9ac9ec2f27494755c2622e732e9b/5cf76a18/video/m/220f78f17639c464b24900c30f7f77fbb6311620e43c000056cfc17f4827/",
					"https://aweme.snssdk.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=0&ratio=720p&media_type=4&vr_type=0&improve_bitrate=0",
					"https://api.amemv.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=1&ratio=720p&media_type=4&vr_type=0&improve_bitrate=0"
				],
				"width": 720,
				"height": 720,
				"url_key": "v0300f090000bjdbf7bjvclba8s62vq0_h264_720p_1697129"
			},
			"is_h265": 0
		},
		{
			"is_h265": 0,
			"gear_name": "normal_540",
			"quality_type": 20,
			"bit_rate": 1503995,
			"play_addr": {
				"uri": "v0300f090000bjdbf7bjvclba8s62vq0",
				"url_list": [
					"http://v5-dy.ixigua.com/f33f6ec0a2a35f9877a297653e0cca38/5cf76a18/video/m/220477b41d319374f16ae3f3a60861490c911620dd33000097146d7159d2/?rc=M3k5O2VmbTplbTMzPGkzM0ApQHRAb0RIMzwzNzYzNDc1Nzg5PDNAKXUpQGczdSlAZjN2KUBmaHV5cTFmc2hoZGY7NEBuL3BeaXNfY2FfLS0tLTBzczVvI28jNDM2LjItLi0tLS0uLS0uL2k6YjBwIzphLXEjOmAtbyNwYmZyaF4ranQ6Iy8uXg%3D%3D",
					"http://v9-dy.ixigua.com/a550335a201cda2aa2175dfd708dfcd5/5cf76a18/video/m/220477b41d319374f16ae3f3a60861490c911620dd33000097146d7159d2/",
					"https://aweme.snssdk.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=0&ratio=540p&media_type=4&vr_type=0&improve_bitrate=0",
					"https://api.amemv.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=1&ratio=540p&media_type=4&vr_type=0&improve_bitrate=0"
				],
				"width": 720,
				"height": 720,
				"url_key": "v0300f090000bjdbf7bjvclba8s62vq0_h264_540p_1503995"
			}
		},
		{
			"gear_name": "normal_360",
			"quality_type": 40,
			"bit_rate": 376426,
			"play_addr": {
				"height": 720,
				"url_key": "v0300f090000bjdbf7bjvclba8s62vq0_h264_360p_376426",
				"uri": "v0300f090000bjdbf7bjvclba8s62vq0",
				"url_list": [
					"http://v5-dy.ixigua.com/076b7b4c5ece2b5792c612b3b0fb6569/5cf76a18/video/m/22044ef5d82c05446f488d4e6e2bc399f1e116210b63000033af3f0b1ce9/?rc=M3k5O2VmbTplbTMzPGkzM0ApQHRAb0RIMzwzNzYzNDc1Nzg5PDNAKXUpQGczdSlAZjN2KUBmaHV5cTFmc2hoZGY7NEBuL3BeaXNfY2FfLS0tLTBzczVvI28jNDM2LjItLi0tLS0uLS0uL2k6Yi5wIzphLXEjOmAtbyNwYmZyaF4ranQ6Iy8uXg%3D%3D",
					"http://v9-dy.ixigua.com/43f0d44bff84d30edbdc2b9efb2bb614/5cf76a18/video/m/22044ef5d82c05446f488d4e6e2bc399f1e116210b63000033af3f0b1ce9/",
					"https://aweme.snssdk.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=0&ratio=360p&media_type=4&vr_type=0&improve_bitrate=0",
					"https://api.amemv.com/aweme/v1/play/?video_id=v0300f090000bjdbf7bjvclba8s62vq0&line=1&ratio=360p&media_type=4&vr_type=0&improve_bitrate=0"
				],
				"width": 720
			},
			"is_h265": 0
		}
	],
	"music_urls": [
		"http://p3-dy.byteimg.com/obj/ies-music/1633496586048539.mp3"
	],
	"info": {
		"share_weibo_desc": "#在抖音，记录美好生活#高铁商务座和普通座到底什么区别，一节车厢竟只有5个座位，太爽#vlog美食记 #抖音玩乐攻略 ",
		"bool_persist": 0,
		"share_signature_desc": "TikTok: Make Every Second Count",
		"share_url": "https://www.iesdouyin.com/share/video/6690863055015775502/?region=CN&mid=6690707475848809230&u_code=hgd1c58i&titleType=title",
		"share_desc": "在抖音，记录美好生活",
		"share_title": "高铁商务座和普通座到底什么区别，一节车厢竟只有5个座位，太爽#vlog美食记 #抖音玩乐攻略 ",
		"share_title_myself": "",
		"share_title_other": "",
		"share_link_desc": "#在抖音，记录美好生活#高铁商务座和普通座到底什么区别，一节车厢竟只有5个座位，太爽#vlog美食记 #抖音玩乐攻略 %s 复制此链接，打开【抖音短视频】，直接观看视频！",
		"share_signature_url": "https://tiktokv.com/",
		"share_quote": ""
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
    
    
   接口验证机制貌似是一个app_log向服务器发送设备信息，使用通过验证的设备信息发起请求（目前了解cookie可以去掉，但user-agent不能为电脑的UA，且接口稳定性待测试，如有间歇性无法使用请反馈给我）

**喜欢的话，给个star呗**

衍生项目：  
==
安卓版项目地址：https://github.com/zbfzn/douyinquick  


<font>注：仅供学习,切勿用于其他用途。</font>测试站点：https://lyfzn.top/plugins/douyin/videoPrase/
