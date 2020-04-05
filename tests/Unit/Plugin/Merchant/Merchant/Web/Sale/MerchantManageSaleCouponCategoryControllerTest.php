<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Sale;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageSaleCouponCategoryControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sale.coupon.category';
        $this->route();
    }
}