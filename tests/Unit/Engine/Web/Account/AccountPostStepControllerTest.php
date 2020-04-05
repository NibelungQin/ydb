<?php


namespace Ydb\Test\Unit\Engine\Web\Account;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class AccountPostStepControllerTest extends BaseEngineWebUnitTest
{
    public function testMain(): void
    {
        $_GET['c'] = 'account';
        $_GET['a'] = 'post-step';
        $this->route();
    }

    public function testStep2(): void
    {
        $_GET['c'] = 'account';
        $_GET['a'] = 'post-step';
        $_GET['step'] = '2';
        $this->route();
    }
}