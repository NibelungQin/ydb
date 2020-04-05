<?php


namespace Ydb\Test\Unit\Plugin\Commission\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class CommissionDownControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'commission.down';
        $this->route(function () {
            $this->members[125]['isagent'] = 1;
            $this->members[125]['status'] = 1;
        });
    }

    public function testGetList(): void
    {
        $_GET['r'] = 'commission.down.get_list';
        $_GET['page'] = '1';
        $_GET['level'] = '2';
        $this->route(function () {
            $this->members[125]['isagent'] = 1;
            $this->members[125]['status'] = 1;
        });
    }
}