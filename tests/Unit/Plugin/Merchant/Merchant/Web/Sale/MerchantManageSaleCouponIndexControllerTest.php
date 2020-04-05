<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Sale;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageSaleCouponIndexControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sale.coupon';
        $this->route();
    }

    public function testSet(): void
    {
        $_GET['r'] = 'sale.coupon.set';
        $this->route();
    }
}