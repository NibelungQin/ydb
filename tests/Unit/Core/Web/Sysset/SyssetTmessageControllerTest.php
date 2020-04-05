<?php

namespace Ydb\Test\Unit\Core\Web\Sysset;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SyssetTmessageControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sysset.tmessage';
        $this->route();
    }
}
