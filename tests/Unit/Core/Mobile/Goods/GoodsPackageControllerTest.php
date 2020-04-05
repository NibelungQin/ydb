<?php


namespace Ydb\Test\Unit\Core\Mobile\Goods;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class GoodsPackageControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.package';
        $_GET['goodsid'] = '74';
        $this->route();
    }

    public function testDetail(): void
    {
        $_GET['r'] = 'goods.package.detail';
        $_GET['pid'] = '1';
        $this->route();
    }

    public function testOption(): void
    {
        $_GET['r'] = 'goods.package.option';
        $_GET['pid'] = '1';
        $_GET['goodsid'] = '69';
        $this->route();
    }
}