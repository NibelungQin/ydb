<?php

namespace Ydb\Test\Unit\Plugin\Dividend\Web;

use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DividendAgentControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'dividend.agent';
        $this->route(function () {
            $this->pluginSets['dividend']['init'] = '1';
        });
    }
}