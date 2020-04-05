<?php


namespace Ydb\Test\Unit\Plugin\Merchant\Merchant\Web\Statistics;


use Ydb\Test\Unit\Plugin\Merchant\Merchant\BaseMerchantWebUnitTest;

class MerchantManageStatisticsGoodsRankControllerTest extends BaseMerchantWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'statistics.goods_rank';
        $this->route();
    }
}