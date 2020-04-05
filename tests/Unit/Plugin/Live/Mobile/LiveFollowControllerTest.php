<?php


namespace Ydb\Test\Unit\Plugin\Live\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class LiveFollowControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live.follow';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'live.follow.get_list';
        $_GET['page'] = '1';
        $_GET['type'] = '';
        $this->route();
    }

    public function testGetListLiving(): void
    {
        $_GET['r'] = 'live.follow.get_list';
        $_GET['page'] = '1';
        $_GET['type'] = 'living';
        $this->route();
    }

    public function testGetListNoLiving(): void
    {
        $_GET['r'] = 'live.follow.get_list';
        $_GET['page'] = '1';
        $_GET['type'] = 'noliving';
        $this->route();
    }
}