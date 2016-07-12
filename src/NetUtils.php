<?php
namespace ZenPHP\utils;

class NetUtils {
    /**
     * Validate string is a ip address
     * @param $str
     * @param int $flag
     * @return mixed
     */
    public static function isIP($str = '', $flag = FILTER_FLAG_IPV4 & FILTER_FLAG_IPV6) {
        if($str == '') {
            $str = self::ip();
        }
        if(is_numeric($str)) {
            $str = long2ip($str);
        }
        return filter_var($str, FILTER_VALIDATE_IP, $flag);
    }

    /**
     * Validate string is a ipv4 address
     * @param string $str
     * @return mixed
     */
    public static function isIpv4($str = '') {
        if($str == '') {
            $str = self::ip();
        }
        if(is_numeric($str)) {
            $str = long2ip($str);
        }
        return filter_var($str, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /**
     * Validate string is a ipv6 address
     * @param string $str
     * @return mixed
     */
    public static function isIpv6($str = '') {
        if($str == '') {
            $str = self::ip();
        }
        return filter_var($str, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }

    /**
     * Get current client ip
     * @return string
     */
    public static function ip() {
        $ip = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ip = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ip = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ip = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ip = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ip = getenv('REMOTE_ADDR');
        else
            $ip = 'unknown';

        return $ip;
    }
}
