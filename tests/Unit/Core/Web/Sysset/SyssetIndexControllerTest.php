<?php

namespace Ydb\Test\Unit\Core\Web\Sysset;


use Ydb\Test\Unit\Core\Web\BaseShopWebUnitTest;

class SyssetIndexControllerTest extends BaseShopWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'sysset';
        $this->route();
    }

    public function testPayset(): void
    {
        $_GET['r'] = 'sysset.payset';
        $this->route();
    }

    public function testExpress(): void
    {
        $_GET['r'] = 'sysset.express';
        $this->route();
    }

    public function testExpressPost(): void
    {
        $_GET['r'] = 'sysset.express';
        $_POST['isopen'] = '0';
        $_POST['apikey'] = '';
        $_POST['customer'] = '';
        $_POST['cache'] = '0';
        $this->post();
        $this->route();
    }
}
