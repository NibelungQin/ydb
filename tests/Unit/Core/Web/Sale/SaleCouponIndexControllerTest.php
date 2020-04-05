<?php

namespace Ydb\Test\Unit\Core\Web\Sale;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SaleCouponIndexControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sale.coupon';
        $this->route();
    }

    public function testEdit(): void
    {
        $_GET['r'] = 'sale.coupon.edit';
        $_GET['id'] = '16';
        $this->route();
    }
}
