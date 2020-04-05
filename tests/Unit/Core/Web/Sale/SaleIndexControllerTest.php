<?php

namespace Ydb\Test\Unit\Core\Web\Sale;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SaleIndexControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sale';
        $this->route();
    }

    public function testEnough(): void
    {
        $_GET['r'] = 'sale.enough';
        $this->route();
    }

    public function testEnoughFree(): void
    {
        $_GET['r'] = 'sale.enoughfree';
        $this->route();
    }

    public function testDeduct(): void
    {
        $_GET['r'] = 'sale.deduct';
        $this->route();
    }

    public function testRecharge(): void
    {
        $_GET['r'] = 'sale.recharge';
        $this->route();
    }

    public function testCredit1(): void
    {
        $_GET['r'] = 'sale.credit1';
        $this->route();
    }

    public function testBindMobile(): void
    {
        $_GET['r'] = 'sale.bindmobile';
        $this->route();
    }
}
