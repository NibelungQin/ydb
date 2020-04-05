<?php
declare(strict_types=1);

namespace Ydb\Test\Unit\Receiver;


use Ydb\Test\Unit\BaseUnitTest;

class ReceiverTest extends BaseUnitTest
{
    /**
     * 测试微信公众号关注事件
     */
    public function testWechatPlatformSubscribeEventSubscribe(): void
    {
        global $container;
        global $_W;
        global $_GPC;

        $_GET['uniacid'] = 1;
        require __DIR__ . '/../../../framework/bootstrap.inc.php';
        $_W['uniacid'] = 1;
        require_once __DIR__ . '/../../../addons/ewei_shopv2/defines.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/functions.php';
        require_once __DIR__ . '/../../../addons/ewei_shopv2/core/inc/receiver.php';

        $receiver = new \Receiver();
        $receiver->message = [
            'event' => 'subscribe',
            'type' => 'subscribe'
        ];
        $receiver->receive();
        $this->assertNotNull($receiver);
    }
}