<?php

namespace Ydb\Test\Unit\Core\Web\Order;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class OrderDetailControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order.detail';
        $this->route();
    }
}
