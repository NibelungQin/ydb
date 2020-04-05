<?php


namespace Ydb\Test\Unit\Plugin\Live\Web;


use Ydb\Test\Unit\Plugin\BasePluginWebUnitTest;

class LiveIndexControllerTest extends BasePluginWebUnitTest
{
    public function testMain(): void
    {
        $_GET['r'] = 'live';
        $this->route();
    }
}