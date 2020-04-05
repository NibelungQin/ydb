<?php


namespace Ydb\Test\Unit\Engine\Web\System;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class SystemSiteControllerTest extends BaseEngineWebUnitTest
{
    public function testSetting(): void
    {
        //$this->expectExceptionMessage('');

        $_GET['c'] = 'system';
        $_GET['a'] = 'site';
        $_GET['do'] = 'setting';
        $this->route();
    }
}