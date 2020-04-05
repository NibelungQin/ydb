<?php


namespace Ydb\Test\Unit\Plugin\Dividend\Mobile;


use Ydb\Test\Unit\Plugin\BasePluginMobileUnitTest;

class DividendApplyControllerTest extends BasePluginMobileUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'dividend.apply';
        $this->route(function () {
            $this->members[125]['isheads'] = '1';
            $this->members[125]['headsstatus'] = '1';
            $this->members[125]['isagent'] = '1';
            $this->members[125]['status'] = '1';
            $this->pluginSets['dividend']['open'] = '1';
        });
    }
}