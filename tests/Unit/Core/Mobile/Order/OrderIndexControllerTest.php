<?php


namespace Ydb\Test\Unit\Core\Mobile\Order;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class OrderIndexControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'order';
        $this->route();
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'order.get_list';
        $_GET['page'] = '1';
        $_GET['status'] = '';
        $_GET['merchid'] = '0';
        $this->route();
    }

    public function testDetail(): void
    {
        $_GET['r'] = 'order.detail';
        $_GET['id'] = '346';
        $this->route();
    }

    public function testExpress(): void
    {
        $_GET['r'] = 'order.express';
        $_GET['id'] = '370';
        $this->route();
    }
}