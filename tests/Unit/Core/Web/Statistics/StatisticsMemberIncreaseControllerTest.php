<?php

namespace Ydb\Test\Unit\Core\Web\Statistics;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class StatisticsMemberIncreaseControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'statistics.member_increase';
        $this->route();
    }
}
