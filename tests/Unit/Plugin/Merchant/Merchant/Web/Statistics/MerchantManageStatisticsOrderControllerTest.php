<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Statistics;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageStatisticsOrderControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'statistics.order';
        $this->route();
    }
}