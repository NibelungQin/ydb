<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopNavControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.nav';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'shop.nav.add';
        $this->route();
    }
}