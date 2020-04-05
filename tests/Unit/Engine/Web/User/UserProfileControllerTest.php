<?php


namespace Ydb\Test\Unit\Engine\Web\User;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class UserProfileControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'user';
        $_GET['a'] = 'profile';
        $this->route();
    }

    public function testBind(): void
    {
        $_GET['c'] = 'user';
        $_GET['a'] = 'profile';
        $_GET['do'] = 'bind';
        $this->route();
    }
}