<?php


namespace Ydb\Test\Unit\Engine\Web\System;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class SystemPlatformControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $this->expectExceptionMessage('');

        $_GET['c'] = 'system';
        $_GET['a'] = 'platform';
        $this->route();
    }
}