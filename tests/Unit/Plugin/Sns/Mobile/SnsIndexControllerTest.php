<?php


namespace Ydb\Test\Unit\Plugin\Sns\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class SnsIndexControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sns';
        $this->route();
    }
}