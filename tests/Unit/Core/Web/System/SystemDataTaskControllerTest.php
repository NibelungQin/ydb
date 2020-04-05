<?php

namespace Ydb\Test\Unit\Core\Web\System;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SystemDataTaskControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'system.data.task';
        $this->route();
    }
}
