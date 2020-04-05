<?php


namespace Ydb\Test\Unit\Engine\Web\Account;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class AccountRecycleControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'account';
        $_GET['a'] = 'recycle';
        $this->route();
    }
}