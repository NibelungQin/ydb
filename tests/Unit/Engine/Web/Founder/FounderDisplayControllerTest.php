<?php


namespace Ydb\Test\Unit\Engine\Web\Founder;


use Ydb\Test\Unit\Engine\Web\BaseEngineWebUnitTest;

class FounderDisplayControllerTest extends BaseEngineWebUnitTest
{
    public function testDisplay(): void
    {
        $_GET['c'] = 'founder';
        $_GET['a'] = 'display';
        $this->route();
    }
}