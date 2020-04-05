<?php

namespace Ydb\Test\Unit\Plugin\Dividend\Mobile;

use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class DividendRegisterControllerTest extends BasePluginMobileUnitTest
{
    public function testNotCommissionAgent(): void
    {
        $this->expectExceptionMessage('请先成为分销商');

        $_GET['r'] = 'dividend.register';
        $this->route(function () {
            $this->pluginSets['dividend']['open'] = '1';
        });
    }

    public function testMain(): void
    {
        $_GET['r'] = 'dividend.register';
        $this->route(function () {
            $this->members[125]['isagent'] = '1';
            $this->members[125]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }
}