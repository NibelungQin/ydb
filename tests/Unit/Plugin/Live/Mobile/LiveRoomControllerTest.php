<?php


namespace Ydb\Test\Unit\Plugin\Live\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class LiveRoomControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live.room';
        $_GET['id'] = '1';
        $this->route();
    }

    public function testFavorite(): void
    {
        $_GET['r'] = 'live.room.favorite';
        $_POST['roomid'] = '1';
        $this->post();
        $this->route();
    }
}