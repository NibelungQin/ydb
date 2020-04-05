<?php
declare(strict_types=1);

namespace Ydb\Util;


use RuntimeException;

class ExceptionUtil
{
    public static function exit($msg = '', $exception = false): void
    {
        if (DevelopmentUtil::isProductionEnvironment()) {
            exit($msg);
        }
        // 测试条件下
        if ($exception) {  // 输出消息为异常情况时
            throw new RuntimeException($msg);
        }
        if (!empty($msg)) {   // 输出消息为正常情况
            if (DevelopmentUtil::notCITestingEnvironment()) {  // 非 CI 测试环境
                echo $msg;
            }
        }
    }

    public static function die($msg = '', $exception = false): void
    {
        if (DevelopmentUtil::isProductionEnvironment()) {
            die($msg);
        }
        if (!empty($msg)) {
            if ($exception) {
                throw new RuntimeException($msg);
            }

            if (DevelopmentUtil::notCITestingEnvironment()) {  // 非 CI 测试环境
                echo $msg;
            }
            if (DevelopmentUtil::isTestingEnvironment()) {
                file_put_contents('/tmp/php-output.txt', $msg);
            }
        }
    }
}