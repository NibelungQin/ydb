<?php


namespace Ydb\Test\Unit\Core\Web\Goods;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class GoodsCategoryControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.category';
        $this->route();
    }
}