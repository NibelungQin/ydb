<?php


namespace Ydb\Test\Unit\Plugin\Live\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class LiveIndexControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'live.get_list';
        $_GET['page'] = '1';
        $_GET['type'] = '';
        $this->route();
    }
}