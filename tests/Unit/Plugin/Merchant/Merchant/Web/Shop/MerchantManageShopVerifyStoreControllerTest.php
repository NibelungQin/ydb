<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Shop;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageShopVerifyStoreControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.verify.store';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'shop.verify.store.add';
        $this->route();
    }
}