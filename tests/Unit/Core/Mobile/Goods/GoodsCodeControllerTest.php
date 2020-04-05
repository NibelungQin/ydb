<?php


namespace Ydb\Test\Unit\Core\Mobile\Goods;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class GoodsCodeControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.code';
        $_GET['id'] = '74';
        $this->route();
    }
}