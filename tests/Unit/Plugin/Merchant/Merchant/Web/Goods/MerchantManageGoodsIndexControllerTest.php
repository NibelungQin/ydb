<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Goods;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageGoodsIndexControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods';
        $this->route();
    }

    public function testAdd(): void
    {
        $_GET['r'] = 'goods.add';
        $this->route();
    }

    public function testCheck(): void
    {
        $_GET['r'] = 'goods.check';
        $this->route();
    }

    public function testOut(): void
    {
        $_GET['r'] = 'goods.out';
        $this->route();
    }

    public function testStock(): void
    {
        $_GET['r'] = 'goods.stock';
        $this->route();
    }

    public function testCycle(): void
    {
        $_GET['r'] = 'goods.cycle';
        $this->route();
    }
}