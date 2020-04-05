<?php


namespace Ydb\Test\Unit\Core\Web\Shop;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class ShopNavControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.nav';
        $this->route();
    }
}