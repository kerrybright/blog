<?php
namespace Home\Controller;
use Think\Controller;

class DailyPieController extends Controller {
    public function wechatAction(){
	    header('Content-type:text/html;charset=utf-8');
	    $appkey = "00cb3552e4b8578a8c5f015df006ef90";
	    $url = "http://v.juhe.cn/weixin/query";
	    $params = array(
		    "pno" => "",//当前页数，默认1
		    "ps" => "",//每页返回条数，最大100，默认20
		    "key" => $appkey,//应用APPKEY(应用详细页查询)
		    "dtype" => "",//返回数据的格式,xml或json，默认json
	    );
	    $paramstring = http_build_query($params);
	    $content = juhecurl($url,$paramstring);
	    $result = json_decode($content,true);
	    if($result){
		    if($result['error_code']=='0'){
			    $wechatList = $result['result']['list'];
			    $this->assign('wechatList', $wechatList);
		    }else{
			    echo $result['error_code'].":".$result['reason'];
		    }
	    }else{
		    echo "请求失败";
	    }

        $this->display();
    }

	public function yaowenAction(){
		header('Content-type:text/html;charset=utf-8');
		$url = "https://api.tianapi.com/it/?num=20&key=1bfa82dc6968be017c90c671ff3e0877";

		$key = "yaowen_list";
		if(S($key)){
			$result = S($key);
		}else{
			$result = curl_https($url);
			$result = json_decode($result);
			$result = get_array($result);
			S($key,$result,60*60*2);
		}

		if($result){
			if($result['code']=='200'){
				$yaowenList = $result['newslist'];
				$this->assign('yaowenList', $yaowenList);
			}else{
				echo $result['code'].":".$result['msg'];
			}
		}else{
			echo "请求失败";
		}

		$this->display();
	}
}