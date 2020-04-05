<?php


namespace Ydb\Test\Unit\Plugin\App\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class AppTabbarControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'app.tabbar';
        $this->route();
    }
}