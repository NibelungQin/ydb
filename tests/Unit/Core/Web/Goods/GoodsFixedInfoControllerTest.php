<?php


namespace Ydb\Test\Unit\Core\Web\Goods;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class GoodsFixedInfoControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.fixedInfo';
        $this->route();
    }
}