<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopIndexControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['i'] = '3';
        $_GET['r'] = 'shop';
        $this->route();
    }
}