<?php


namespace Ydb\Test\Unit\Plugin\Live\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class LiveCategoryControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live.category';
        $this->route();
    }
}