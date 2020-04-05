<?php


namespace Ydb\Test\Unit\Engine\Web\Platform;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class PlatformMenuControllerTest extends BaseEngineWebUnitTest
{
    public function testPost(): void
    {
        $_GET['c'] = 'platform';
        $_GET['a'] = 'menu';
        $_GET['do'] = 'post';
        $this->route();
    }
}