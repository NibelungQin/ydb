<?php

namespace Ydb\Test\Unit\Core\Web\Finance;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class FinanceDownloadbillControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'finance.downloadbill';
        $this->route();
    }
}
