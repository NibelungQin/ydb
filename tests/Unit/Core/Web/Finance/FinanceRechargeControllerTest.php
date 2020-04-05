<?php

namespace Ydb\Test\Unit\Core\Web\Finance;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class FinanceRechargeControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'finance.recharge';
        $this->route();
    }
}
