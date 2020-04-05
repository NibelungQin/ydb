<?php


namespace Ydb\Test\Unit\Plugin\Commission\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class CommissionRankControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'commission.rank';
        $this->route();
    }
}