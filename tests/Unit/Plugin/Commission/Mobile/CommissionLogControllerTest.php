<?php


namespace Ydb\Test\Unit\Plugin\Commission\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class CommissionLogControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'commission.log';
        $this->route(function () {
            $this->members[125]['isagent'] = 1;
            $this->members[125]['status'] = 1;
        });
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'commission.log.get_list';
        $_GET['page'] = '1';
        $this->route(function () {
            $this->members[125]['isagent'] = 1;
            $this->members[125]['status'] = 1;
        });
    }
}