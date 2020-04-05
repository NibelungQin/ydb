<?php
            
namespace Ydb\Test\Unit\Core\Web\System;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SystemPluginPluginpackageControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'system.plugin.pluginpackage';
        $this->route();
    }
}
