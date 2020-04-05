<?php

namespace Ydb\Test\Unit\Core\Web\Order;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class OrderOpControllerTest extends BaseShopWebUnitTest
{
    public function testDelete(): void
    {
        $_GET['r'] = 'order.op.delete';
        $this->route();
    }
}
