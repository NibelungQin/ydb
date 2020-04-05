<?php


namespace Ydb\Service;

/**
 * Interface SubscribeListener
 * @package Ydb\Service
 *
 * 公众号会员关注事件监听器
 */
interface WechatPlatformSubscribeListener
{
    public function onSubscribe(array $message): void;
}