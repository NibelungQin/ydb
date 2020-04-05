<?php


namespace Ydb\Test\Unit\Core\Mobile\Goods;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class GoodsRecentControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.recent';
        $this->route();
    }
}