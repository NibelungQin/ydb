<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Sale;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageSaleCouponLogControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sale.coupon.log';
        $this->route();
    }
}