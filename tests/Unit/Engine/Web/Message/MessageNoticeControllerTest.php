<?php


namespace Ydb\Test\Unit\Engine\Web\Message;


use Doctrine\Common\Persistence\ObjectManager;
use Ydb\Data\Fixtures\Engine\CoreCacheFixture;
use Ydb\Data\Fixtures\Engine\CoreSettingsFixture;
use Ydb\Data\Fixtures\Engine\UsersFixture;
use Ydb\Test\Unit\BaseUnitTest;
use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class MessageNoticeControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'message';
        $_GET['a'] = 'notice';
        $this->route();
    }

    public function testEventNotice(): void
    {
        $this->expectExceptionMessage('message');

        $_GET['c'] = 'message';
        $_GET['a'] = 'notice';
        $_GET['do'] = 'event_notice';
        $this->route();
    }
}