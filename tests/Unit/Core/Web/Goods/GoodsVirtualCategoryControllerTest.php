<?php


namespace Ydb\Test\Unit\Core\Web\Goods;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class GoodsVirtualCategoryControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.virtual.category';
        $this->route();
    }
}