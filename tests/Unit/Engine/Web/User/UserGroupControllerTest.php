<?php


namespace Ydb\Test\Unit\Engine\Web\User;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class UserGroupControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'user';
        $_GET['a'] = 'group';
        $this->route();
    }
}