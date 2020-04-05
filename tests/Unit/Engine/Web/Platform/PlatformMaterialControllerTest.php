<?php


namespace Ydb\Test\Unit\Engine\Web\Platform;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class PlatformMaterialControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'platform';
        $_GET['a'] = 'material';
        $this->route();
    }
}