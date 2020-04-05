<?php


namespace Ydb\Test\Unit\Engine\Web\Module;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class ManageSystemControllerTest extends BaseEngineWebUnitTest
{
    public function testInstalled(): void
    {
        //$this->expectExceptionMessage('');

        $_GET['c'] = 'module';
        $_GET['a'] = 'manage-system';
        $_GET['do'] = 'installed';
        $_GET['account_type'] = '1';
        $this->route();
    }
}