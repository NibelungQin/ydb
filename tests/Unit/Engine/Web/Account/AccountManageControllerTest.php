<?php


namespace Ydb\Test\Unit\Engine\Web\Account;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class AccountManageControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'account';
        $_GET['a'] = 'manage';
        $_GET['account_type'] = '1';
        $this->route();
    }
}