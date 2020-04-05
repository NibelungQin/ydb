<?php

namespace Ydb\Test\Unit\Plugin\Dividend\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class DividendIndexControllerTest extends BasePluginMobileUnitTest
{
    public function testNotOpen(): void
    {
        $this->expectExceptionMessage('团队分红未开启');

        $_GET['r'] = 'dividend';
        $this->route();
    }

    public function testNotCommissionAgent(): void
    {
        $this->expectExceptionMessage('请先注册');

        $_GET['r'] = 'dividend';
        $this->route(function () {
            $this->pluginSets['dividend']['open'] = '1';
        });
    }

    public function testNotDividendHead(): void
    {
        $this->expectExceptionMessage('请先注册');

        $_GET['r'] = 'dividend';
        $this->route(function () {
            $this->members[1]['isagent'] = '1';
            $this->members[1]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }

    public function testMain(): void
    {
        $_GET['r'] = 'dividend';
        $this->route(function () {
            $this->members[125]['isheads'] = '1';
            $this->members[125]['headsstatus'] = '1';
            $this->members[125]['isagent'] = '1';
            $this->members[125]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }
}