<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class MerchantMapControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'merch.map';
        $_GET['merchid'] = '2';
        $this->route();
    }
}