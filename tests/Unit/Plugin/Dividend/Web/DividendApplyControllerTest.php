<?php

namespace Ydb\Test\Unit\Plugin\Dividend\Web;

use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DividendApplyControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'dividend.apply';
        $_GET['status'] = '1';
        $this->route(function () {
            $this->pluginSets['dividend']['init'] = '1';
        });
    }
}