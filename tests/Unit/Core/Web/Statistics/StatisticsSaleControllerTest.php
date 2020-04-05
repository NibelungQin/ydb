<?php

namespace Ydb\Test\Unit\Core\Web\Statistics;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class StatisticsSaleControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'statistics.sale';
        $this->route();
    }
}
