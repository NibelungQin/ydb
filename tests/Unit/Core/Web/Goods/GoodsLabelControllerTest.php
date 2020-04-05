<?php


namespace Ydb\Test\Unit\Core\Web\Goods;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class GoodsLabelControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.label';
        $this->route();
    }
}