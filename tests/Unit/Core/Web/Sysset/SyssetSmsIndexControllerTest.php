<?php

namespace Ydb\Test\Unit\Core\Web\Sysset;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SyssetSmsIndexControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $this->expectExceptionMessage('');

        $_GET['r'] = 'sysset.sms';
        $this->route();
    }

    public function testSet(): void
    {
        $_GET['r'] = 'sysset.sms.set';
        $this->route();
    }
}
