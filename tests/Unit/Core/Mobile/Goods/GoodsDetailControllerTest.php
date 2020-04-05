<?php


namespace Ydb\Test\Unit\Core\Mobile\Goods;


use Ydb\Test\Unit\Core\Mobile\BaseShopMobileUnitTest;

class GoodsDetailControllerTest extends BaseShopMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'goods.detail';
        $_GET['id'] = '74';
        $this->route();
    }

    public function testGetDetail(): void
    {
        $_GET['r'] = 'goods.detail.get_detail';
        $_GET['id'] = '74';
        $this->route();
    }

    public function testGetComment(): void
    {
        $_GET['r'] = 'goods.detail.get_comments';
        $_GET['id'] = '74';
        $this->route();
    }
}