<?php


namespace Ydb\Test\Unit\Engine\Web\Wxapp;

use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class WxappDisplayControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'wxapp';
        $_GET['a'] = 'display';
        $this->route();
    }

    public function testHome(): void
    {
        $this->expectExceptionMessage('');

        $_GET['c'] = 'wxapp';
        $_GET['a'] = 'display';
        $_GET['do'] = 'home';
        $this->route();
    }
}