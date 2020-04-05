<?php


namespace Ydb\Test\Unit\Plugin\Commission\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class CommissionShareControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'commission.share';
        $_GET['mid'] = '125';
        $this->route(function () {
            $this->members[1]['isagent'] = 1;
            $this->members[1]['status'] = 1;
        });
    }
}