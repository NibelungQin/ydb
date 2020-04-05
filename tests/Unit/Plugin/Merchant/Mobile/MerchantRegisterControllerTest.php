<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class MerchantRegisterControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'merch.register';
        $this->route();
    }
}