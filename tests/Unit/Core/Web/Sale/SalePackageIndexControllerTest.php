<?php

namespace Ydb\Test\Unit\Core\Web\Sale;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SalePackageIndexControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sale.package';
        $this->route();
    }
}
