<?php

namespace Ydb\Test\Unit\Core\Web\Order;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class OrderOpRefundControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order.op.refund';
        $this->route();
    }
}
