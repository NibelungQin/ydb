<?php


namespace Ydb\Test\Unit\Core\Mobile\Account;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class AccountPostControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'account';
        $_GET['a'] = 'post';
        $_GET['uniacid'] = '1';
        $_GET['acid'] = '1';
        $this->route();
    }
}