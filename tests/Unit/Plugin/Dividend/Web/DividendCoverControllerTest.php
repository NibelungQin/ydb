<?php


namespace Ydb\Test\Unit\Plugin\Dividend\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class DividendCoverControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'dividend.cover';
        $this->route(function () {
            $this->pluginSets['dividend']['init'] = '1';
        });
    }
}