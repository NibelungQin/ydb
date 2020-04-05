<?php


namespace Ydb\Test\Unit\Engine\App\Entry;


use Ydb\Test\Unit\Engine\App\BaseEngineAppUnitTest;

class EntrySiteControllerTest extends BaseEngineAppUnitTest
{
    public function testModule(): void
    {
        $this->expectExceptionMessage('html');
        $_GET['i'] = '1';
        $_GET['c'] = 'entry';
        $_GET['m'] = 'ewei_shopv2';
        $_GET['do'] = 'mobile';
        $this->route();
    }
}