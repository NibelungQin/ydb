<?php

namespace Ydb\Test\Unit\Core\Web\Sale;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SaleCouponSetticketControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sale.coupon.setticket';
        $this->route();
    }
}
