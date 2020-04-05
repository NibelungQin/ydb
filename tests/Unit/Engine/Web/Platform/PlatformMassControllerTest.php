<?php


namespace Ydb\Test\Unit\Engine\Web\Platform;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class PlatformMassControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'platform';
        $_GET['a'] = 'mass';
        $this->route();
    }

    public function testSend(): void
    {
        $_GET['c'] = 'platform';
        $_GET['a'] = 'mass';
        $_GET['do'] = 'send';
        $this->route();
    }
}