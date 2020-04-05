<?php
declare(strict_types=1);

namespace Ydb\Util;


use Exception;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Class DebugUtil
 * @package Ydb\Util
 *
 * 调试工具类
 */
class DebugUtil
{
    /**
     * @var LoggerInterface
     */
    private static $logger;

    private static function getLogger(): LoggerInterface
    {
        if (empty(self::$logger)) {
            try {
                $formatter = new LineFormatter(LineFormatter::SIMPLE_FORMAT, LineFormatter::SIMPLE_DATE);
                $formatter->includeStacktraces(true);
                $handler = new StreamHandler(__DIR__ . '/../../../../logs/debug.log', Logger::DEBUG);
                $handler->setFormatter($formatter);
                self::$logger = new Logger('ydb');
                self::$logger->pushHandler($handler);
            } catch (Exception $e) {
            }
        }
        return self::$logger;
    }

    /**
     * 打印调用栈
     */
    public static function backtrace(): void
    {
        $traces = array_map(static function ($trace) {
            return ['file' => $trace['file'], 'line' => $trace['line']];
        }, debug_backtrace());
        self::getLogger()->debug(var_export($traces, true));
    }

    /**
     * 打印调试的变量值
     * @param string $name
     * @param $value
     */
    public static function varExport(string $name, $value): void
    {
        $callerTrace = debug_backtrace()[0];
        self::getLogger()->debug($callerTrace['file'] . ': ' . $callerTrace['line'] . "\n"
            . $name . ":\n" . var_export($value, true));
    }
}