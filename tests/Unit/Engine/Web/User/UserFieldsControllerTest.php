<?php


namespace Ydb\Test\Unit\Engine\Web\User;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class UserFieldsControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'user';
        $_GET['a'] = 'fields';
        $_GET['do'] = 'display';
        $this->route();
    }
}