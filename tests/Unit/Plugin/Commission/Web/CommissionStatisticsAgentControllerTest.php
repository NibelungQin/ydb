<?php


namespace Ydb\Test\Unit\Plugin\Commission\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class CommissionStatisticsAgentTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'commission.statistics.agent';
        $this->route();
    }
}