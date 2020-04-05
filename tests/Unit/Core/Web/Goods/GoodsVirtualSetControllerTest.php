<?php


namespace Ydb\Test\Unit\Core\Web\Goods;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class GoodsVirtualSetControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.virtual.set';
        $this->route();
    }
}