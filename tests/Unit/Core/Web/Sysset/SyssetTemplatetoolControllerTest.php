<?php

namespace Ydb\Test\Unit\Core\Web\Sysset;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SyssetTemplatetoolControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sysset.templatetool';
        $this->route();
    }
}
