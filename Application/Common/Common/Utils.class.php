<?php
namespace Common\Common;

use Think\Exception;
use Think\Log;

class Utils
{
	// 防止配置文件中的误设置，限定最小最大价格精度
    const MAX_PRICE_PRECISION = 1;
    const MIN_PRICE_PRECISION = 0.01;

	/**
     * 对价格进行精度调整
     * @param float $cost
     * @param null $roundMethod
     * @return float
     */
    public static function calcPreciseCost($cost, $roundMethod = null) {
        $precision = C('ORDER_PRICE_PRECISION');
        if ($precision > self::MAX_PRICE_PRECISION || $precision < self::MIN_PRICE_PRECISION) {
            $precision = self::MIN_PRICE_PRECISION;
        }

        if (empty($roundMethod)) {
            $roundMethod = C('ORDER_PRICE_ROUND_METHOD');
        }
        if (!in_array($roundMethod, array('round', 'ceil', 'floor'))) {
            $roundMethod = 'floor';
        }
        $cost = $cost / $precision;
        $cost = call_user_func($roundMethod, $cost);
        $cost = $cost * $precision;
        return $cost;
    }


    /**
     * 获取完整的URL
     * @param string $uri
     * @param string $host
     * @param array|string $params
     * @return string
     */
    public static function getUrl($uri = '', $host = '', $params = array()) {
        $uri = ($uri == '' ? $_SERVER['REQUEST_URI'] : $uri);
        $host = ($host == '' ? $_SERVER['HTTP_HOST'] : $host);
        if (strpos($host, 'https://') !== 0 && strpos($host, 'http://') !== 0 && strpos($uri, 'https://') !== 0 && strpos($uri, 'http://') !== 0) {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        }
        else {
            $protocol = '';
        }
        $url = "${protocol}${host}${uri}";

        $params = Utils::toArray($params);
        foreach ($params as $key => $value) {
            if (strpos($url, '?') === false) {
                $url .= '?';
            }
            else {
                $url .= '&';
            }

            if (is_int($key)) {  // 直接传入字符串参数的情况
                $url .= $value;
            }
            else {
                $url .= sprintf('%s=%s', $key, $value);
            }
        }
        return $url;
    }

    /**
     * 是否是在微信中打开页面
     * @return bool
     */
    public static function isInWeixin()
    {
        if (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        }
        return false;
    }

    //检测是否手机端
    public static function isInMobileBrowser()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
        {
            // 找不到为false,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientKeywords = array ('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientKeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            }
        }
        return false;
    }

    public static function determineBrowser($userAgent){
        $browserAgent = "";   //浏览器
        $browserVersion = ""; //浏览器的版本
        if (preg_match('/Trident\/[0-9.;]*? rv:([0-9.]{1,5})/i', $userAgent, $version)) {
            $browserVersion=$version[1];
            $browserAgent="Internet Explorer";
        } else if (preg_match('/MSIE ([0-9].[0-9]{1,2})/', $userAgent, $version)) {
            $browserVersion=$version[1];
            $browserAgent="Internet Explorer";
        } else if (preg_match( '/Opera\/([0-9]{1,2}.[0-9]{1,2})/', $userAgent, $version)) {
            $browserVersion=$version[1];
            $browserAgent="Opera";
        } else if (preg_match( '/Firefox\/([0-9.]{1,5})/', $userAgent, $version)) {
            $browserVersion=$version[1];
            $browserAgent="Firefox";
        }else if (preg_match( '/Chrome\/([0-9.]{1,3})/', $userAgent, $version)) {
            $browserVersion=$version[1];
            $browserAgent="Chrome";
        }
        else if (preg_match( '/Safari\/([0-9.]{1,3})/', $userAgent, $version)) {
            $browserVersion=$version[1];
            $browserAgent="Safari";
        }
        else {
            $browserVersion="";
            $browserAgent="Unknown";
        }
        return $browserAgent." ".$browserVersion;
    }

    public static function determinePlatform($userAgent) {
        $platform='';
        if (preg_match('/win/i',$userAgent) && strpos($userAgent, '95')) {
            $platform="Windows 95";
        }
        elseif (preg_match('/win 9x/i',$userAgent) && strpos($userAgent, '4.90')) {
            $platform="Windows ME";
        }
        elseif (preg_match('/win/i',$userAgent) && preg_match('/98/',$userAgent)) {
            $platform="Windows 98";
        }
        elseif (preg_match('/win/i',$userAgent) && preg_match('/nt 5.0/i',$userAgent)) {
            $platform="Windows 2000";
        }
        elseif (preg_match('/win/i',$userAgent) && preg_match('/nt 5.1/i',$userAgent)) {
            $platform="Windows XP";
        }
        elseif (preg_match('/win/i',$userAgent) && preg_match('/nt 6.0/i',$userAgent)) {
            $platform="Windows Vista";
        }
        elseif (preg_match('/win/i',$userAgent) && preg_match('/nt 6.1/i',$userAgent)) {
            $platform="Windows 7";
        }
        elseif (preg_match('/win/i',$userAgent) && preg_match('/32/',$userAgent)) {
            $platform="Windows 32";
        }
        elseif (preg_match('/win/i',$userAgent) && preg_match('/nt/i',$userAgent)) {
            $platform="Windows NT";
        }elseif (preg_match('/Mac OS/i',$userAgent)) {
            $platform="Mac OS";
        }
        elseif (preg_match('/linux/i',$userAgent)) {
            $platform="Linux";
        }
        elseif (preg_match('/unix/i',$userAgent)) {
            $platform="Unix";
        }
        elseif (preg_match('/sun/i',$userAgent) && preg_match('/os/i',$userAgent)) {
            $platform="SunOS";
        }
        elseif (preg_match('/ibm/i',$userAgent) && preg_match('/os/i',$userAgent)) {
            $platform="IBM OS/2";
        }
        elseif (preg_match('/Mac/i',$userAgent) && preg_match('/PC/i',$userAgent)) {
            $platform="Macintosh";
        }
        elseif (preg_match('/PowerPC/i',$userAgent)) {
            $platform="PowerPC";
        }
        elseif (preg_match('/AIX/i',$userAgent)) {
            $platform="AIX";
        }
        elseif (preg_match('/HPUX/i',$userAgent)) {
            $platform="HPUX";
        }
        elseif (preg_match('/NetBSD/i',$userAgent)) {
            $platform="NetBSD";
        }
        elseif (preg_match('/BSD/i',$userAgent)) {
            $platform="BSD";
        }
        elseif (preg_match('/OSF1/i',$userAgent)) {
            $platform="OSF1";
        }
        elseif (preg_match('/IRIX/i',$userAgent)) {
            $platform="IRIX";
        }
        elseif (preg_match('/FreeBSD/i',$userAgent)) {
            $platform="FreeBSD";
        }
        if ($platform=='') {
            $platform = "Unknown";
        }
        return $platform;
    }

    public static function determineClient($userAgent, $isInWeixin = false) {
        if ($isInWeixin) {
            $client = 'Wechat';
        }
        else {
            $osPattern = C('ORDER_SOURCE_DATA.PLATFORMS'); //winwap 模拟WAP手机上网的一个浏览器; openwave|后面为各pc操作系统
            if(preg_match("/($osPattern)/i", $userAgent )) {
                $client = 'Browser';
            }
            else {
                $client = 'Phone';
            }
        }
        return $client;
    }

    /**
     * 对数据库中timestamp类型字段判断是否为默认空值
     *
     * @param $timeStamp
     * @return bool
     */
    public static function isZeroTime($timeStamp)
    {
        if(empty($timeStamp)) {

            return true;
        }
        return "0000-00-00 00:00:00" === $timeStamp;
    }

    /**
     * 对字符串进行部分隐藏(一半长度)
     *
     * @param $string
     * @param string $maskChar
     * @return mixed
     */
    public static function maskString($string, $maskChar='*')
    {
        $length = strlen($string);
        $maskLength = $length / 2;
        $from = ceil(($length - $maskLength) / 2);
        $mask = str_repeat($maskChar, $maskLength);
        return substr_replace($string, $mask, $from, $maskLength);
    }


    private static $chars = array('1', '2', '3', '4', '5',
        '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I',
        'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V',
        'W', 'X', 'Y', 'Z');

    /**
     * 生成uuid作为优惠券码
     * @return string
     */
    public static function uuid() {
        $shortBuffer = '';
        $uuid = md5(uniqid(mt_rand(), true));
        for ($i = 0; $i < 8; $i++) {
            $hexStr = substr($uuid, $i * 4, 4);
            $decStr = hexdec($hexStr);
            $shortBuffer .= self::$chars[$decStr % 34];
        }

        return $shortBuffer;
    }

    /**
     * 请求新浪微博接口获取短链接
     *
     * @param string $url 带{http|https}头的url
     * @return string|bool 成功返回短链接|失败返回false
     */
    public static function shortUrl($url)
    {
        $apiUrl = C('WEIBO.API_URL');
        $appId = C('WEIBO.APP_KEY');
        try{
            $params = array(
                'source' => $appId,
                'url_long' => $url
            );
            $retJson = http($apiUrl . 'short_url/shorten.json', $params);
            $data = json_decode($retJson, true);
            if(isset($data[0]) && isset($data[0]['url_short'])) {

                return $data[0]['url_short'];
            }

            if(isset($data['error'])) {

                throw new Exception($data['error'], $data['error_code']);
            }

            Log::record("unknown short url request failure : [{$retJson}]");

        }catch (Exception $e) {

            Log::record("get short url failed : [{$e->getMessage()}]");
            return false;
        }

        return false;
    }

    public static function toArray($data) {
        if (is_null($data) || $data === '') {
            return array();
        }
        if (is_string($data)) {
            $data = str_replace(' ', '', $data);
            $data = explode(',', $data);
        }
        if (!is_array($data)) {
            $data = array($data);
        }
        return $data;
    }

    public static function getDateInterval($a,$b){
        //检查两个日期大小，默认前小后大，如果前大后小则交换位置以保证前小后大
        if(strtotime($a)>strtotime($b)) list($a,$b)=array($b,$a);
        $start  = strtotime($a);
        $stop   = strtotime($b);
        $extend = ($stop-$start)/86400;
        $result['extends'] = $extend;
        if($extend<7){                //如果小于7天直接返回天数
            $result['daily'] = $extend;
        }elseif($extend<=31){        //小于28天则返回周数，由于闰年2月满足了
            if($stop==strtotime($a.'+1 month')){
                $result['monthly'] = 1;
            }else{
                $w = floor($extend/7);
                $d = ($stop-strtotime($a.'+'.$w.' week'))/86400;
                $result['weekly']  = $w;
                $result['daily']   = $d;
            }
        }else{
            $y=    floor($extend/365);
            if($y>=1){                //如果超过一年
                $start = strtotime($a.'+'.$y.'year');
                $a     = date('Y-m-d',$start);
                //判断是否真的已经有了一年了，如果没有的话就开减
                if($start>$stop){
                    $a = date('Y-m-d',strtotime($a.'-1 month'));
                    $m =11;
                    $y--;
                }
                $extend = ($stop-strtotime($a))/86400;
            }
            if(isset($m)){
                $w = floor($extend/7);
                $d = $extend-$w*7;
            }else{
                $m = isset($m)?$m:round($extend/30);
                $stop>=strtotime($a.'+'.$m.'month')?$m:$m--;
                if($stop>=strtotime($a.'+'.$m.'month')){
                    $d=$w=($stop-strtotime($a.'+'.$m.'month'))/86400;
                    $w = floor($w/7);
                    $d = $d-$w*7;
                }
            }
            $result['yearly']  = $y;
            $result['monthly'] = $m;
            $result['weekly']  = $w;
            $result['daily']   = isset($d)?$d:null;
        }
        return array_filter($result);
    }

    public static function curl_file_get_contents($durl){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $durl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
        curl_setopt($ch, CURLOPT_REFERER,_REFERER_);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }

    public static function localizeImage($name, $url){

        $fileUrl = C('TEMP_DIR_IMG') . $name . ".png";
        $urlResource = file_get_contents($url);

        file_put_contents($fileUrl, $urlResource);
        $imageFile = imagecreatefrompng($fileUrl);

        return $imageFile;
    }

    public static function arrayMultiSort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC){
        if(is_array($arrays)){
            foreach ($arrays as $array){
                if(is_array($array)){
                    $key_arrays[] = $array[$sort_key];
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
        array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
        return $arrays;
    }

    /**
     * 金额转换中文大写
     * @param $number
     * @return mixed
     */
    public static function cny($number) {
        static $cnums=array("零","壹","贰","叁","肆","伍","陆","柒","捌","玖"),
        $cnyunits=array("圆","角","分"),
        $grees=array("拾","佰","仟","万","拾","佰","仟","亿");
        list($ns1,$ns2)=explode(".",$number,2);
        $ns2=array_filter(array($ns2[1],$ns2[0]));
        $ret=array_merge($ns2,array(implode("",self::cny_map_unit(str_split($ns1),$grees)),""));
        $ret=implode("",array_reverse(self::cny_map_unit($ret,$cnyunits)));
        return str_replace(array_keys($cnums),$cnums,$ret);
    }

    protected function cny_map_unit($list,$units) {
        $ul=count($units);
        $xs=array();
        foreach (array_reverse($list) as $x) {
            $l=count($xs);
            if ($x!="0" || !($l%4)) $n=($x=='0'?'':$x).($units[($l-1)%$ul]);
            else $n=is_numeric($xs[0][0])?$x:'';
            array_unshift($xs,$n);
        }
        return $xs;
    }
    
}