<?php


namespace Ydb\Test\Unit\Engine\Web\Site;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class SiteMultiControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'site';
        $_GET['a'] = 'multi';
        $_GET['do'] = 'display';
        $this->route();
    }

    public function testPost(): void
    {
        $_GET['c'] = 'site';
        $_GET['a'] = 'multi';
        $_GET['do'] = 'post';
        $_GET['multiid'] = '1';
        $this->route();
    }
}