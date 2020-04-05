<?php


namespace Ydb\Test\Unit\Plugin\App\Mobile;


class AppShopControllerTest extends BasePluginAppMobileUnitTest
{
    public function testGetShopIndex(): void
    {
        $_GET['r'] = 'shop.get_shopindex';
        $this->route();
    }
}