<?php


namespace Ydb\Util;


class DevelopmentUtil
{
    public static function isProductionEnvironment(): bool
    {
        return !self::isTestingEnvironment();
    }

    public static function isTestingEnvironment(): bool
    {
        return self::isDevelopmentTestingEnvironment() || self::isCITestingEnvironment();
    }

    public static function isDevelopmentTestingEnvironment(): bool
    {
        return getenv('MODE') === 'test_dev';
    }

    public static function isCITestingEnvironment(): bool
    {
        return getenv('MODE') === 'test_ci';
    }

    public static function notCITestingEnvironment(): bool
    {
        return !self::isCITestingEnvironment();
    }

    public static function isDemo($password): bool
    {
        return DEVELOPMENT && AUTH_KEY === $password;  // 调试演示系统
    }
}