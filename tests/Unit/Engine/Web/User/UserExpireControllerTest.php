<?php


namespace Ydb\Test\Unit\Engine\Web\User;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class UserExpireControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'user';
        $_GET['a'] = 'expire';
        $this->route();
    }

    public function testSaveExpire(): void
    {
        $_GET['c'] = 'user';
        $_GET['a'] = 'save_expire';
        $_POST['day'] = '1';
        $this->route();
    }
}