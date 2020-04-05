<?php


namespace Ydb\Test\Unit\Engine\App\Home;


use Ydb\Test\Unit\Engine\App\BaseEngineAppUnitTest;

class HomeHomeControllerTest extends BaseEngineAppUnitTest
{
    public function testMain(): void
    {
        $_GET['i'] = '1';
        $_GET['c'] = 'home';
        $_GET['t'] = '1';
        $this->route();
    }
}