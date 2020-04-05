<?php

namespace Ydb\Test\Unit\Core\Web\Plugins;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class PluginsIndexControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'plugins';
        $this->route();
    }
}
