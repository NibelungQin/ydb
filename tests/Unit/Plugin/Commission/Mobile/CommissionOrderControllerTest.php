<?php


namespace Ydb\Test\Unit\Plugin\Commission\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class CommissionOrderControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'commission.order';
        $this->route(function () {
            $this->members[125]['isagent'] = 1;
            $this->members[125]['status'] = 1;
        });
    }

    public function testGetList(): void
    {
        $_GET['i'] = '3';
        $_GET['c'] = 'entry';
        $_GET['m'] = 'ewei_shopv2';
        $_GET['do'] = 'mobile';
        $_GET['r'] = 'commission.order.get_list';
        $_GET['page'] = '1';
        $_GET['status'] = '1';
        $this->route(function () {
            $this->members[125]['isagent'] = 1;
            $this->members[125]['status'] = 1;
        });
    }
}