<?php

namespace Ydb\Test\Unit\Core\Web\System;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SystemPluginIndexControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'system.plugin';
        $this->route();
    }
}
