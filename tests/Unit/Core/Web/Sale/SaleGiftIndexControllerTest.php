<?php

namespace Ydb\Test\Unit\Core\Web\Sale;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SaleGiftIndexControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sale.gift';
        $this->route();
    }
}
