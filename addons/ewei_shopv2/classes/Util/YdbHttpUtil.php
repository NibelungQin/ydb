<?php
declare(strict_types=1);

namespace Ydb\Util;


class YdbHttpUtil
{
    public static function header(string $header): void
    {
        if (DevelopmentUtil::isProductionEnvironment()) {
            header($header);
        } elseif (DevelopmentUtil::notCITestingEnvironment()) {  // 非 CI 测试环境
            echo $header;
        }
    }

    public static function setcookie($name, $value = '', $expire = 0, $path = '', $domain = '', $secure = false, $httponly = false)
    {
        if (DevelopmentUtil::isProductionEnvironment()) {
            return setcookie($name, (string)$value, $expire, $path, $domain, (bool)$secure, $httponly);
        }
        if (DevelopmentUtil::notCITestingEnvironment()) {  // 非 CI 测试环境
            echo var_export([
                'name' => $name,
                'value' => $value,
                'expire' => $expire,
                'path' => $path,
                'domain' => $domain,
                'secure' => $secure,
                'httponly' => $httponly
            ]);
        }
        return true;
    }

    public static function session_id(string $session_id)
    {
        if (DevelopmentUtil::isProductionEnvironment()) {
            return session_id($session_id);
        }
        if (DevelopmentUtil::notCITestingEnvironment()) {  // 非 CI 测试环境
            echo var_export($session_id);
        }
        return $session_id;
    }

    public static function session_start()
    {
        if (DevelopmentUtil::isProductionEnvironment()) {
            session_start();
        }
    }
}