<?php

namespace Ydb\Test\Unit\Core\Web\Sale;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SaleCouponSendtaskControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sale.coupon.sendtask';
        $this->route();
    }
}
