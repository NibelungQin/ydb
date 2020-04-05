<?php


namespace Ydb\Test\Unit\Plugin\Live\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class LiveViewControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live.view';
        $this->route();
    }

    public function testGetView(): void
    {
        $_GET['r'] = 'live.view.get_view';
        $_GET['page'] = '1';
        $this->route();
    }
}