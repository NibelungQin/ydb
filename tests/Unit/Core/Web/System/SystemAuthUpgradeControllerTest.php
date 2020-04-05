<?php

namespace Ydb\Test\Unit\Core\Web\System;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SystemAuthUpgradeControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'system.auth.upgrade';
        $this->route();
    }
}
