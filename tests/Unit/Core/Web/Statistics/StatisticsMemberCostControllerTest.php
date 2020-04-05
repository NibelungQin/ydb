<?php

namespace Ydb\Test\Unit\Core\Web\Statistics;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class StatisticsMemberCostControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'statistics.member_cost';
        $this->route();
    }
}
