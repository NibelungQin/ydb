<?php


namespace Ydb\Test\Unit\Core\Web\Order;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class OrderListControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order.list';
        $this->route();
    }

    public function testStatus4(): void
    {
        $_GET['r'] = 'order.list.status4';
        $this->route();
    }
}