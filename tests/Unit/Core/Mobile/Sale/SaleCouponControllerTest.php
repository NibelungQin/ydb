<?php


namespace Ydb\Test\Unit\Core\Mobile\Sale;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class SaleCouponControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sale.coupon';
        $this->route();
    }
}