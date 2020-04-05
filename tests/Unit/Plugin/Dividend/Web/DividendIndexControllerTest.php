<?php

namespace Ydb\Test\Unit\Plugin\Dividend\Web;

use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DividendIndexControllerTest extends BasePluginWebUnitTest
{
    public function testNotInitialized(): void
    {
        $this->expectExceptionMessage('团队分红未初始化');

        $_GET['r'] = 'dividend';
        $this->route();
    }

    public function testInitialized(): void
    {
        $this->expectExceptionMessage('团队分红已初始化');

        $_GET['r'] = 'dividend.init';
        $this->route(function () {
            $this->pluginSets['dividend']['init'] = '1';
        });
    }

    public function testMain(): void
    {
        $_GET['r'] = 'dividend';
        $this->route(function () {
            $this->pluginSets['dividend']['init'] = '1';
        });
    }

    public function testNotice(): void
    {
        $_GET['r'] = 'dividend.notice';
        $this->route(function () {
            $this->pluginSets['dividend']['init'] = '1';
        });
    }

    public function testSet(): void
    {
        $_GET['r'] = 'dividend.set';
        $this->route(function () {
            $this->pluginSets['dividend']['init'] = '1';
        });
    }
}