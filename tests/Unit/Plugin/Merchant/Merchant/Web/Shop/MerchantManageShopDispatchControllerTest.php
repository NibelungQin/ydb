<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopDispatchControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.dispatch';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'shop.dispatch.add';
        $this->route();
    }
}