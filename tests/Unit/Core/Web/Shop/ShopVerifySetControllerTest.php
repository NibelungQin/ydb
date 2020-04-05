<?php


namespace Ydb\Test\Unit\Core\Web\Shop;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class ShopVerifySetControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'shop.verify.set';
        $this->route();
    }
}